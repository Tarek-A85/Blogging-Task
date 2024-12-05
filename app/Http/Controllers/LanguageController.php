<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $lang)
    {
        session()->put('locale', $lang);

        return redirect()->back();
    }
}
