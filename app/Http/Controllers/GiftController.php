<?php

namespace App\Http\Controllers;

use App\Models\Gift;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('gifts.index', [
            'gifts' => Gift::query()->cursorPaginate(50),
        ]);
    }
}
