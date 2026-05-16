<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class TransactionService
{
    /**
     * Get paginated transactions for a user with optional filters.
     */
    public function getAll(User $user, array $filters = []): LengthAwarePaginator
    {
        return $user->transactions()
            ->with(['account', 'category'])
            ->when($filters['type'] ?? null, fn ($q, $type) => $q->where('type', $type))
            ->when($filters['category_id'] ?? null, fn ($q, $id) => $q->where('category_id', $id))
            ->when($filters['account_id'] ?? null, fn ($q, $id) => $q->where('account_id', $id))
            ->when($filters['from'] ?? null, fn ($q, $date) => $q->whereDate('date', '>=', Carbon::parse($date)))
            ->when($filters['to'] ?? null, fn ($q, $date) => $q->whereDate('date', '<=', Carbon::parse($date)))
            ->when($filters['search'] ?? null, fn ($q, $search) => $q->where('note', 'like', "%{$search}%"))
            ->latest('date')
            ->paginate(20);
    }

    /**
     * Get a single transaction scoped to the user.
     */
    public function getById(User $user, int $id): Transaction
    {
        return $user->transactions()->with(['account', 'category'])->findOrFail($id);
    }

    /**
     * Create a new transaction and update account balance.
     */
    public function create(User $user, array $data): Transaction
    {
        $transaction = $user->transactions()->create($data);
        $this->adjustBalance($transaction, 1);

        return $transaction->load(['account', 'category']);
    }

    /**
     * Update a transaction and recalculate account balance.
     */
    public function update(User $user, int $id, array $data): Transaction
    {
        $transaction = $this->getById($user, $id);

        // Reverse old balance effect
        $this->adjustBalance($transaction, -1);

        $transaction->update($data);

        // Apply new balance effect
        $this->adjustBalance($transaction->fresh(), 1);

        return $transaction->fresh(['account', 'category']);
    }

    /**
     * Delete a transaction and reverse its effect on account balance.
     */
    public function delete(User $user, int $id): void
    {
        $transaction = $this->getById($user, $id);
        $this->adjustBalance($transaction, -1);
        $transaction->delete();
    }

    /**
     * Get income vs expense summary for a given period.
     */
    public function getSummary(User $user, array $filters = []): array
    {
        $from = isset($filters['from']) ? Carbon::parse($filters['from']) : Carbon::now()->startOfMonth();
        $to = isset($filters['to']) ? Carbon::parse($filters['to']) : Carbon::now()->endOfMonth();

        $transactions = $user->transactions()
            ->whereDate('date', '>=', $from)
            ->whereDate('date', '<=', $to)
            ->get(['type', 'amount']);

        return [
            'income' => $transactions->where('type', 'income')->sum('amount'),
            'expense' => $transactions->where('type', 'expense')->sum('amount'),
            'net' => $transactions->where('type', 'income')->sum('amount') -
                     $transactions->where('type', 'expense')->sum('amount'),
            'from' => $from->toDateString(),
            'to' => $to->toDateString(),
        ];
    }

    /**
     * Adjust the linked account balance based on transaction type.
     */
    private function adjustBalance(Transaction $transaction, int $direction): void
    {
        $account = $transaction->account;

        $delta = match ($transaction->type->value) {
            'income' => $transaction->amount * $direction,
            'expense' => -$transaction->amount * $direction,
            default => 0,
        };

        $account->increment('balance', $delta);
    }
}
