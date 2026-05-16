<?php

namespace App\Http\Controllers\Budgeting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Budgeting\CategoryStoreRequest;
use App\Http\Requests\Budgeting\CategoryUpdateRequest;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryService $categoryService,
    ) {}

    public function index(Request $request): Response
    {
        return Inertia::render('budgeting/categories/index', [
            'categories' => $this->categoryService->getAll($request->user()),
        ]);
    }

    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        $this->categoryService->create($request->user(), $request->validated());

        return back()->with('toast', ['type' => 'success', 'message' => 'Category created.']);
    }

    public function update(CategoryUpdateRequest $request, int $id): RedirectResponse
    {
        $this->categoryService->update($request->user(), $id, $request->validated());

        return back()->with('toast', ['type' => 'success', 'message' => 'Category updated.']);
    }

    public function destroy(Request $request, int $id): RedirectResponse
    {
        $this->categoryService->delete($request->user(), $id);

        return back()->with('toast', ['type' => 'success', 'message' => 'Category deleted.']);
    }
}
