<?php

namespace App\Http\Controllers;

use App\Models\UE;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UEController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
        $ues = UE::all();
        return Inertia::render('UE/UE_Index', [
            'ues' => $ues
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
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'credits_ects' => 'required|integer|between:1,30',
            'code' => ['required', 'string', 'max:4', 'regex:/^UE[0-9]{2}$/'],
            'semestre' => 'required|integer|in:1,2,3,4,5,6',
        ]);

        UE::create($validated);

        return redirect(route('EC.create'));
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
    public function edit(UE $uE):Response
    {
        //
        return Inertia::render('UE/UE_EditForm', [
            'ue' => $uE
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UE $uE)
    {
        //
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'credits_ects' => 'required|integer',
            'code' => 'required|string|max:4',
            'semestre' => 'required|integer|in:1,2,3,4,5,6',
        ]);
        $uE->update($validated);
        return redirect(route('UE.index'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UE $uE): RedirectResponse
    {
        //
        $uE->delete();
        return redirect(route('UE.index'));
    }
}
