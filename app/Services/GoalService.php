<?php

namespace App\Services;

use App\Enums\Status;
use App\Models\Goal;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class GoalService
{
    /**
     * Get all goals for a user with progress data.
     */
    public function getAll(User $user): Collection
    {
        return $user->goals()
            ->get()
            ->map(fn (Goal $goal) => $this->appendProgress($goal));
    }

    /**
     * Get a single goal scoped to the user.
     */
    public function getById(User $user, int $id): Goal
    {
        return $user->goals()->findOrFail($id);
    }

    /**
     * Create a new goal.
     */
    public function create(User $user, array $data): Goal
    {
        return $user->goals()->create($data);
    }

    /**
     * Update a goal or add a contribution.
     */
    public function update(User $user, int $id, array $data): Goal
    {
        $goal = $this->getById($user, $id);
        $goal->update($data);

        // Auto-complete if target reached
        if ($goal->saved_amount >= $goal->target_amount) {
            $goal->update(['status' => Status::COMPLETED]);
        }

        return $this->appendProgress($goal->fresh());
    }

    /**
     * Delete a goal.
     */
    public function delete(User $user, int $id): void
    {
        $this->getById($user, $id)->delete();
    }

    /**
     * Get detailed progress for a single goal.
     */
    public function getProgress(User $user, int $id): array
    {
        $goal = $this->getById($user, $id);

        $remaining = max(0, $goal->target_amount - $goal->saved_amount);
        $percentage = $goal->target_amount > 0
            ? round(($goal->saved_amount / $goal->target_amount) * 100, 1)
            : 0;

        $createdAt = Carbon::parse($goal->created_at);
        $monthsElapsed = max(1, Carbon::now()->diffInMonths($createdAt));
        $avgMonthly = $goal->saved_amount > 0 ? $goal->saved_amount / $monthsElapsed : 0;

        $monthsToComplete = $avgMonthly > 0 ? (int) ceil($remaining / $avgMonthly) : null;
        $projectedDate = $monthsToComplete
            ? Carbon::now()->addMonths($monthsToComplete)->toDateString()
            : null;

        return [
            'goal' => $goal,
            'percentage' => $percentage,
            'remaining' => $remaining,
            'projected_completion_date' => $projectedDate,
        ];
    }

    /**
     * Append progress data to a goal.
     */
    private function appendProgress(Goal $goal): Goal
    {
        $goal->percentage = $goal->target_amount > 0
            ? round(($goal->saved_amount / $goal->target_amount) * 100, 1)
            : 0;

        $goal->remaining = max(0, $goal->target_amount - $goal->saved_amount);

        return $goal;
    }
}
