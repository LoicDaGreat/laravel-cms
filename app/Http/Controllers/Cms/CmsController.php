<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Inertia\Response;

class CmsController extends Controller
{
    public function index(): Response
    {
        return inertia('cms/Index');
    }
}
