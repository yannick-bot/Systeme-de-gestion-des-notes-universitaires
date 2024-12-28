<?php

namespace App\Http\Controllers;

use App\Models\UE;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class UEController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
        return Inertia::render('UE/UE_Index', [
            'ues' => UE::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return Inertia::render('UE/UE_Form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //

    }

    /**
     * Display the specified resource.
     */
    public function show(UE $uE)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UE $uE)
    {
        //
        Inertia::render('UE/UE_EditForm', [
            'ue' => $uE
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UE $uE)
    {
        //


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UE $uE)
    {
        //
        
    }
}
