<?php

use App\Http\Controllers\Budgeting\AccountController;
use App\Http\Controllers\Budgeting\BudgetController;
use App\Http\Controllers\Budgeting\CategoryController;
use App\Http\Controllers\Budgeting\CurrencyController;
use App\Http\Controllers\Budgeting\DashboardController;
use App\Http\Controllers\Budgeting\GoalController;
use App\Http\Controllers\Budgeting\RecurringTransactionController;
use App\Http\Controllers\Budgeting\TransactionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Accounts
    Route::get('accounts', [AccountController::class, 'index'])->name('accounts.index');
    Route::post('accounts', [AccountController::class, 'store'])->name('accounts.store');
    Route::patch('accounts/{id}', [AccountController::class, 'update'])->name('accounts.update');
    Route::delete('accounts/{id}', [AccountController::class, 'destroy'])->name('accounts.destroy');

    // Transactions
    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::patch('transactions/{id}', [TransactionController::class, 'update'])->name('transactions.update');
    Route::delete('transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

    // Budgets
    Route::get('budgets', [BudgetController::class, 'index'])->name('budgets.index');
    Route::post('budgets', [BudgetController::class, 'store'])->name('budgets.store');
    Route::patch('budgets/{id}', [BudgetController::class, 'update'])->name('budgets.update');
    Route::delete('budgets/{id}', [BudgetController::class, 'destroy'])->name('budgets.destroy');

    // Goals
    Route::get('goals', [GoalController::class, 'index'])->name('goals.index');
    Route::post('goals', [GoalController::class, 'store'])->name('goals.store');
    Route::patch('goals/{id}', [GoalController::class, 'update'])->name('goals.update');
    Route::delete('goals/{id}', [GoalController::class, 'destroy'])->name('goals.destroy');
    Route::get('goals/{id}/progress', [GoalController::class, 'progress'])->name('goals.progress');

    // Recurring Transactions
    Route::get('recurring', [RecurringTransactionController::class, 'index'])->name('recurring.index');
    Route::post('recurring', [RecurringTransactionController::class, 'store'])->name('recurring.store');
    Route::patch('recurring/{id}', [RecurringTransactionController::class, 'update'])->name('recurring.update');
    Route::delete('recurring/{id}', [RecurringTransactionController::class, 'destroy'])->name('recurring.destroy');

    // Categories
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::patch('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Currencies (read-only for now)
    Route::get('currencies', [CurrencyController::class, 'index'])->name('currencies.index');
});
