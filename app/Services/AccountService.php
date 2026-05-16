<?php

namespace App\Services;

use App\Models\Accounts;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class AccountService
{
    /**
     * Get all accounts for a user.
     */
    public function getAll(User $user): Collection
    {
        return $user->accounts()->with('currency')->get();
    }

    /**
     * Get a single account by ID scoped to the user.
     */
    public function getById(User $user, int $id): Accounts
    {
        return $user->accounts()->with('currency')->findOrFail($id);
    }

    /**
     * Create a new account for the user.
     */
    public function create(User $user, array $data): Accounts
    {
        return $user->accounts()->create($data);
    }

    /**
     * Update an existing account.
     */
    public function update(User $user, int $id, array $data): Accounts
    {
        $account = $this->getById($user, $id);
        $account->update($data);

        return $account->fresh('currency');
    }

    /**
     * Delete an account.
     */
    public function delete(User $user, int $id): void
    {
        $account = $this->getById($user, $id);
        $account->delete();
    }

    /**
     * Get total net worth summary grouped by account type.
     */
    public function getSummary(User $user): array
    {
        return $user->accounts()
            ->get()
            ->groupBy(fn (Accounts $account) => $account->type->value)
            ->map(fn ($accounts) => $accounts->sum('balance'))
            ->toArray();
    }
}
