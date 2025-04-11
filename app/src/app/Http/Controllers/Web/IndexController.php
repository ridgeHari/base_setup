<?php

namespace app\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class IndexController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('login');
    }
}
