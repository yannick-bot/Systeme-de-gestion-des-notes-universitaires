<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
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
        $ecs = EC::where('ue_id', $id)->get();

        return Inertia::render('EC/EC_Index', [
            'ecs' => $ecs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $ues = UE::all();
        return Inertia::render('EC/EC_Form', [
            'ues' => $ues
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'code' => ['required', 'string', 'max:4', 'regex:/^EC[0-9]{2}$/'],
            'coefficient' => 'required|integer|in:1,2,3,4,5',
            'ue_id' => 'required|integer|exists:u_e_s,id'
        ]);

        $eC = EC::create($validated);
        return redirect(route('EC.index', $eC->ue_id));

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
    public function edit(EC $id)
    {
        //


        $allUEs = UE::all();
        return Inertia::render('EC/EC_EditForm', [
            'ec' => $id,
            'ues' => $allUEs
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EC $ec):RedirectResponse
    {
        //

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'code' => ['required', 'string', 'max:4', 'regex:/^EC[0-9]{2}$/'],
            'coefficient' => 'required|integer|in:1,2,3,4,5',
            'ue_id' => 'required|integer|exists:u_e_s,id'
        ]);


        $ec->update($validated);
        return redirect(route('EC.index', $ec->ue_id));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EC $eC)
    {
        //
        $ue_id = $eC->ue_id;
        $eC->delete();
        return redirect(route('EC.index', $ue_id));
    }
}
