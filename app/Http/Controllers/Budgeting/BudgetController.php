<?php

namespace App\Http\Controllers\Budgeting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Budgeting\BudgetStoreRequest;
use App\Http\Requests\Budgeting\BudgetUpdateRequest;
use App\Services\BudgetService;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BudgetController extends Controller
{
    public function __construct(
        private readonly BudgetService $budgetService,
        private readonly CategoryService $categoryService,
    ) {}

    public function index(Request $request): Response
    {
        return Inertia::render('budgeting/budgets/index', [
            'budgets' => $this->budgetService->getAll($request->user()),
            'overview' => $this->budgetService->getOverview($request->user()),
            'categories' => $this->categoryService->getAll($request->user()),
        ]);
    }

    public function store(BudgetStoreRequest $request): RedirectResponse
    {
        $this->budgetService->create($request->user(), $request->validated());

        return back()->with('toast', ['type' => 'success', 'message' => 'Budget created.']);
    }

    public function update(BudgetUpdateRequest $request, int $id): RedirectResponse
    {
        $this->budgetService->update($request->user(), $id, $request->validated());

        return back()->with('toast', ['type' => 'success', 'message' => 'Budget updated.']);
    }

    public function destroy(Request $request, int $id): RedirectResponse
    {
        $this->budgetService->delete($request->user(), $id);

        return back()->with('toast', ['type' => 'success', 'message' => 'Budget deleted.']);
    }
}
