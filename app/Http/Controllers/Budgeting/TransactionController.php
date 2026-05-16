<?php

namespace App\Http\Controllers\Budgeting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Budgeting\TransactionStoreRequest;
use App\Http\Requests\Budgeting\TransactionUpdateRequest;
use App\Services\CategoryService;
use App\Services\TransactionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TransactionController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService,
        private readonly CategoryService $categoryService,
    ) {}

    public function index(Request $request): Response
    {
        $filters = $request->only(['type', 'category_id', 'account_id', 'from', 'to', 'search']);

        return Inertia::render('budgeting/transactions/index', [
            'transactions' => $this->transactionService->getAll($request->user(), $filters),
            'categories' => $this->categoryService->getAll($request->user()),
            'summary' => $this->transactionService->getSummary($request->user(), $filters),
            'filters' => $filters,
        ]);
    }

    public function store(TransactionStoreRequest $request): RedirectResponse
    {
        $this->transactionService->create($request->user(), $request->validated());

        return back()->with('toast', ['type' => 'success', 'message' => 'Transaction added.']);
    }

    public function update(TransactionUpdateRequest $request, int $id): RedirectResponse
    {
        $this->transactionService->update($request->user(), $id, $request->validated());

        return back()->with('toast', ['type' => 'success', 'message' => 'Transaction updated.']);
    }

    public function destroy(Request $request, int $id): RedirectResponse
    {
        $this->transactionService->delete($request->user(), $id);

        return back()->with('toast', ['type' => 'success', 'message' => 'Transaction deleted.']);
    }
}
