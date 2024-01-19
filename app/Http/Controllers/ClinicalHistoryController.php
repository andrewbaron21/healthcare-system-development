<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClinicalHistory;
use Illuminate\Support\Facades\Auth;
use App\Events\NotificationSent;

class ClinicalHistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;

        $clinicalHistories = null;

        // Check user role
        if ($user->hasRole('professional')) {
            $clinicalHistories = ClinicalHistory::with('patient')
                ->with('professional')
                ->get();
        } elseif ($user->hasRole('patient')) {
            $clinicalHistories = ClinicalHistory::with('patient')
                ->with('professional')
                ->where('patient_id', $userId)
                ->get();
        }

        // Pasar los roles del usuario a la vista
        $roles = $user->roles;

        return view('clinicalhistories.index', compact('clinicalHistories', 'roles', 'userId'));
    }

    public function show($id)
    {
        // Fetch the clinical history details based on the $id
        $clinicalHistory = ClinicalHistory::find($id);

        // Return the details in JSON format
        return response()->json($clinicalHistory);
    }

    public function create()
    {
        // Return view for creating a new clinical history
        return view('clinicalhistories.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->hasRole('professional')) {
            $clinicalHistory = ClinicalHistory::create([
                'professional_id' => auth()->id()
            ] + $request->all());

            event(new NotificationSent($clinicalHistory));

        }
        return response()->json(200);
    }

    public function edit(ClinicalHistory $clinicalhistory)
    {
        // Return view for editing a clinical history
        $user = Auth::user();
        $userId = $user->id;
        $roles = $user->roles;
        return view('clinicalhistories.edit', compact('roles'));
    }

    public function update(Request $request, ClinicalHistory $clinicalhistory)
    {
        $user = Auth::user();
        $userId = $user->id;

        $clinicalHistories = null;

         // Check user role
         if ($user->hasRole('professional')) {
            $clinicalhistory->update([
                'professional_id' => auth()->id()
            ] + $request->all());
        } elseif ($user->hasRole('patient')) {
            $clinicalhistory->update($request->all());
        }

        event(new NotificationSent($clinicalhistory));

        $user = Auth::user();

        return response()->json(200);
    }

    public function destroy(ClinicalHistory $clinicalhistory)
    {
        // Delete the clinical history
        $clinicalhistory->delete();

        return response()->json(200);
    }
}
