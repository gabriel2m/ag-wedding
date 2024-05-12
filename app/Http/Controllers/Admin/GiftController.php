<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGiftRequest;
use App\Http\Requests\UpdateGiftRequest;
use App\Models\Gift;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(request()->header('X-HX-Page', false) ? 'admin.gifts.page' : 'admin.gifts.index');
    }

    public function list()
    {
        return view('admin.gifts.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gifts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGiftRequest $request)
    {
        Gift::create($request->validated());

        return response(
            content: view('admin.gifts.index')->withAlert([
                'type' => 'success',
                'message' => trans_rep(':resource saved', ['resource' => 'Gift']),
            ]),
            headers: [
                'HX-Retarget' => '#content',
                'HX-Reswap' => 'outerHTML',
                'HX-Push-Url' => route('admin.gifts.index'),
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gift $gift)
    {
        return view('admin.gifts.edit', compact('gift'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGiftRequest $request, Gift $gift)
    {
        $gift->fill($request->validated())->save();

        return response(
            content: view('admin.gifts.index')->withAlert([
                'type' => 'success',
                'message' => trans_rep(':resource saved', ['resource' => 'Gift']),
            ]),
            headers: [
                'HX-Retarget' => '#content',
                'HX-Reswap' => 'outerHTML',
                'HX-Push-Url' => route('admin.gifts.index'),
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gift $gift)
    {
        $gift->delete();

        return view('admin.alert', [
            'message' => trans_rep(':resource removed', ['resource' => 'Gift']),
            'type' => 'warning',
        ]);
    }
}
