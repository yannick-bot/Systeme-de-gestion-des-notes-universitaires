<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\EC;
use App\Models\UE;
use Illuminate\Http\Request;

class ECController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id): Response
    {
        //
        return Inertia::render('EC/EC_Index', [
            'ecs' => EC::where('ue_id', $id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return Inertia::render('EC/EC_Form', [
            'ues' => UE::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        

    }

    /**
     * Display the specified resource.
     */
    public function show(EC $eC)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EC $eC)
    {
        //
        $allUEs = UE::all();
        return Inertia::render('EC/EC_EditForm', [
            'ec' => $eC, 'ues' => $allUEs
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EC $eC)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EC $eC)
    {
        //

    }
}
