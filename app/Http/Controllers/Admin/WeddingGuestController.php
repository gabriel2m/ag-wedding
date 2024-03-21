<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnswerWeddingGuestRequest;
use App\Http\Requests\StoreWeddingGuestRequest;
use App\Http\Requests\UpdateWeddingGuestRequest;
use App\Models\WeddingGuest;

class WeddingGuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(request()->header('X-HX-Page', false) ? 'admin.guests.page' : 'admin.guests.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.guests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWeddingGuestRequest $request)
    {
        WeddingGuest::create($request->validated());

        return response(
            content: view('admin.guests.index')->withAlert([
                'type' => 'success',
                'message' => trans_rep(':resource saved', ['resource' => 'Guest']),
            ]),
            headers: [
                'HX-Retarget' => '#content',
                'HX-Reswap' => 'outerHTML',
                'HX-Push-Url' => route('admin.guests.index'),
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WeddingGuest $guest)
    {
        return view('admin.guests.edit', compact('guest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWeddingGuestRequest $request, WeddingGuest $guest)
    {
        $guest->fill($request->validated())->save();

        return response(
            content: view('admin.guests.index')->withAlert([
                'type' => 'success',
                'message' => trans_rep(':resource saved', ['resource' => 'Guest']),
            ]),
            headers: [
                'HX-Retarget' => '#content',
                'HX-Reswap' => 'outerHTML',
                'HX-Push-Url' => route('admin.guests.index'),
            ]
        );
    }

    /**
     * Update guest response.
     */
    public function answer(AnswerWeddingGuestRequest $request, WeddingGuest $guest)
    {
        $guest->fill($request->validated())->save();

        return view('admin.alert', [
            'message' => 'Response saved',
            'type' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WeddingGuest $guest)
    {
        $guest->delete();

        return view('admin.alert', [
            'message' => trans_rep(':resource removed', ['resource' => 'Guest']),
            'type' => 'warning',
        ]);
    }
}
