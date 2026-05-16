<?php

namespace App\Services;

use App\Enums\Status;
use App\Models\User;
use Illuminate\Support\Carbon;

class DashboardService
{
    public function __construct(
        private readonly AccountService $accountService,
        private readonly TransactionService $transactionService,
        private readonly BudgetService $budgetService,
        private readonly GoalService $goalService,
    ) {}

    /**
     * Get all dashboard summary data for the user.
     */
    public function getSummary(User $user): array
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        return [
            // Net worth across all accounts
            'net_worth' => $user->accounts()->sum('balance'),

            // Account balances grouped by type
            'accounts' => $this->accountService->getSummary($user),

            // This month's income vs expense
            'monthly_summary' => $this->transactionService->getSummary($user, [
                'from' => $startOfMonth->toDateString(),
                'to' => $endOfMonth->toDateString(),
            ]),

            // Recent 5 transactions
            'recent_transactions' => $user->transactions()
                ->with(['category', 'account'])
                ->latest('date')
                ->limit(5)
                ->get(),

            // Budget health overview
            'budget_overview' => $this->budgetService->getOverview($user),

            // Active savings goals with progress
            'goals' => $this->goalService->getAll($user)
                ->filter(fn ($goal) => $goal->status === Status::ACTIVE)
                ->values(),
        ];
    }
}
