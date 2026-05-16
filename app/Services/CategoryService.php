<?php

namespace App\Services;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    /**
     * Get all categories available to the user (defaults + their own).
     */
    public function getAll(User $user): Collection
    {
        return Category::where('is_default', true)
            ->orWhere('user_id', $user->id)
            ->orderBy('type')
            ->orderBy('name')
            ->get();
    }

    /**
     * Get a single category scoped to the user or default.
     */
    public function getById(User $user, int $id): Category
    {
        return Category::where('id', $id)
            ->where(fn ($q) => $q->where('is_default', true)->orWhere('user_id', $user->id))
            ->firstOrFail();
    }

    /**
     * Create a custom category for the user.
     */
    public function create(User $user, array $data): Category
    {
        return $user->categories()->create([...$data, 'is_default' => false]);
    }

    /**
     * Update a user-owned category.
     */
    public function update(User $user, int $id, array $data): Category
    {
        $category = $user->categories()->findOrFail($id);
        $category->update($data);

        return $category->fresh();
    }

    /**
     * Delete a user-owned category.
     */
    public function delete(User $user, int $id): void
    {
        $user->categories()->findOrFail($id)->delete();
    }
}
