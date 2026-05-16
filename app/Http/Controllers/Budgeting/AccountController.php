<?php

namespace App\Http\Controllers\Budgeting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Budgeting\AccountStoreRequest;
use App\Http\Requests\Budgeting\AccountUpdateRequest;
use App\Services\AccountService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AccountController extends Controller
{
    public function __construct(
        private readonly AccountService $accountService,
    ) {}

    public function index(Request $request): Response
    {
        return Inertia::render('budgeting/accounts/index', [
            'accounts' => $this->accountService->getAll($request->user()),
            'summary' => $this->accountService->getSummary($request->user()),
        ]);
    }

    public function store(AccountStoreRequest $request): RedirectResponse
    {
        $this->accountService->create($request->user(), $request->validated());

        return back()->with('toast', ['type' => 'success', 'message' => 'Account created.']);
    }

    public function update(AccountUpdateRequest $request, int $id): RedirectResponse
    {
        $this->accountService->update($request->user(), $id, $request->validated());

        return back()->with('toast', ['type' => 'success', 'message' => 'Account updated.']);
    }

    public function destroy(Request $request, int $id): RedirectResponse
    {
        $this->accountService->delete($request->user(), $id);

        return back()->with('toast', ['type' => 'success', 'message' => 'Account deleted.']);
    }
}
