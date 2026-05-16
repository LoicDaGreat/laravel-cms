<?php

namespace App\Http\Controllers\Budgeting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Budgeting\GoalStoreRequest;
use App\Http\Requests\Budgeting\GoalUpdateRequest;
use App\Services\GoalService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class GoalController extends Controller
{
    public function __construct(
        private readonly GoalService $goalService,
    ) {}

    public function index(Request $request): Response
    {
        return Inertia::render('budgeting/goals/index', [
            'goals' => $this->goalService->getAll($request->user()),
        ]);
    }

    public function store(GoalStoreRequest $request): RedirectResponse
    {
        $this->goalService->create($request->user(), $request->validated());

        return back()->with('toast', ['type' => 'success', 'message' => 'Goal created.']);
    }

    public function update(GoalUpdateRequest $request, int $id): RedirectResponse
    {
        $this->goalService->update($request->user(), $id, $request->validated());

        return back()->with('toast', ['type' => 'success', 'message' => 'Goal updated.']);
    }

    public function destroy(Request $request, int $id): RedirectResponse
    {
        $this->goalService->delete($request->user(), $id);

        return back()->with('toast', ['type' => 'success', 'message' => 'Goal deleted.']);
    }

    public function progress(Request $request, int $id): Response
    {
        return Inertia::render('budgeting/goals/progress', [
            'progress' => $this->goalService->getProgress($request->user(), $id),
        ]);
    }
}
