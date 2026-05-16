<?php

namespace App\Services;

use App\Enums\Frequency;
use App\Models\RecurringTransaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class RecurringTransactionService
{
    /**
     * Get all recurring transactions for a user.
     */
    public function getAll(User $user): Collection
    {
        return $user->recurringTransactions()->with('category')->get();
    }

    /**
     * Get a single recurring transaction scoped to the user.
     */
    public function getById(User $user, int $id): RecurringTransaction
    {
        return $user->recurringTransactions()->with('category')->findOrFail($id);
    }

    /**
     * Create a new recurring transaction.
     */
    public function create(User $user, array $data): RecurringTransaction
    {
        return $user->recurringTransactions()->create($data)->load('category');
    }

    /**
     * Update a recurring transaction.
     */
    public function update(User $user, int $id, array $data): RecurringTransaction
    {
        $recurring = $this->getById($user, $id);
        $recurring->update($data);

        return $recurring->fresh('category');
    }

    /**
     * Delete a recurring transaction.
     */
    public function delete(User $user, int $id): void
    {
        $this->getById($user, $id)->delete();
    }

    /**
     * Calculate the next due date based on frequency using Carbon.
     */
    public function calculateNextDueDate(RecurringTransaction $recurring): string
    {
        $nextDue = Carbon::parse($recurring->next_due_date);

        return match ($recurring->frequency) {
            Frequency::DAILY => $nextDue->addDay()->toDateString(),
            Frequency::WEEKLY => $nextDue->addWeek()->toDateString(),
            Frequency::MONTHLY => $nextDue->addMonth()->toDateString(),
            Frequency::YEARLY => $nextDue->addYear()->toDateString(),
        };
    }

    /**
     * Get all recurring transactions that are due today or overdue.
     */
    public function getDueToday(User $user): Collection
    {
        return $user->recurringTransactions()
            ->with('category')
            ->whereDate('next_due_date', '<=', Carbon::today())
            ->get();
    }
}
