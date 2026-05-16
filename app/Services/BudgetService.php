<?php

namespace App\Services;

use App\Models\Budget;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class BudgetService
{
    /**
     * Get all budgets for a user with spent amount calculated.
     */
    public function getAll(User $user): Collection
    {
        return $user->budgets()
            ->with('category')
            ->get()
            ->map(fn (Budget $budget) => $this->appendSpent($budget, $user));
    }

    /**
     * Get a single budget scoped to the user.
     */
    public function getById(User $user, int $id): Budget
    {
        return $user->budgets()->with('category')->findOrFail($id);
    }

    /**
     * Create a new budget.
     */
    public function create(User $user, array $data): Budget
    {
        return $user->budgets()->create($data)->load('category');
    }

    /**
     * Update an existing budget.
     */
    public function update(User $user, int $id, array $data): Budget
    {
        $budget = $this->getById($user, $id);
        $budget->update($data);

        return $budget->fresh('category');
    }

    /**
     * Delete a budget.
     */
    public function delete(User $user, int $id): void
    {
        $this->getById($user, $id)->delete();
    }

    /**
     * Get a health overview of all budgets.
     */
    public function getOverview(User $user): array
    {
        $budgets = $this->getAll($user);

        return [
            'total_budgeted' => $budgets->sum('amount'),
            'total_spent' => $budgets->sum('spent'),
            'over_budget' => $budgets->filter(fn ($b) => $b->spent > $b->amount)->values(),
            'on_track' => $budgets->filter(fn ($b) => $b->spent <= $b->amount)->values(),
        ];
    }

    /**
     * Append the spent and remaining amount to a budget instance.
     */
    private function appendSpent(Budget $budget, User $user): Budget
    {
        $periodStart = Carbon::parse($budget->start_date);

        $spent = $user->transactions()
            ->where('category_id', $budget->category_id)
            ->where('type', 'expense')
            ->whereDate('date', '>=', $periodStart)
            ->sum('amount');

        $budget->spent = (float) $spent;
        $budget->remaining = max(0, $budget->amount - $spent);

        return $budget;
    }
}
