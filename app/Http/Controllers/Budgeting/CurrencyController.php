<?php

namespace App\Http\Controllers\Budgeting;

use App\Http\Controllers\Controller;
use App\Services\CurrencyService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CurrencyController extends Controller
{
    public function __construct(
        private readonly CurrencyService $currencyService,
    ) {}

    public function index(Request $request): Response
    {
        return Inertia::render('budgeting/currencies/index', [
            'currencies' => $this->currencyService->getAll(),
        ]);
    }
}
