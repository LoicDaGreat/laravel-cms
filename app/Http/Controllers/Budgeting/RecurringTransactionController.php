<?php

namespace App\Http\Controllers\Budgeting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Budgeting\RecurringTransactionStoreRequest;
use App\Http\Requests\Budgeting\RecurringTransactionUpdateRequest;
use App\Services\CategoryService;
use App\Services\RecurringTransactionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RecurringTransactionController extends Controller
{
    public function __construct(
        private readonly RecurringTransactionService $recurringService,
        private readonly CategoryService $categoryService,
    ) {}

    public function index(Request $request): Response
    {
        return Inertia::render('budgeting/recurring/index', [
            'recurring' => $this->recurringService->getAll($request->user()),
            'due' => $this->recurringService->getDueToday($request->user()),
            'categories' => $this->categoryService->getAll($request->user()),
        ]);
    }

    public function store(RecurringTransactionStoreRequest $request): RedirectResponse
    {
        $this->recurringService->create($request->user(), $request->validated());

        return back()->with('toast', ['type' => 'success', 'message' => 'Recurring transaction created.']);
    }

    public function update(RecurringTransactionUpdateRequest $request, int $id): RedirectResponse
    {
        $this->recurringService->update($request->user(), $id, $request->validated());

        return back()->with('toast', ['type' => 'success', 'message' => 'Recurring transaction updated.']);
    }

    public function destroy(Request $request, int $id): RedirectResponse
    {
        $this->recurringService->delete($request->user(), $id);

        return back()->with('toast', ['type' => 'success', 'message' => 'Recurring transaction deleted.']);
    }
}
