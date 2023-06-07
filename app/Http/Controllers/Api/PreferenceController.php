<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Preference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PreferencesResource;

class PreferenceController extends Controller
{
    public function ajoutPreferences(Request $request)
    {
        $user_id = Auth::id();
        $user = User::find($user_id);

        if (!$user) {
            return response()->json([
                'message' => 'Utilisateur non trouvé.'
            ], 404);
        }

        $preferences = $request->input('preference');

        $preferenceModel = new Preference(['preference' => $preferences]);
        $preferenceModel->user_id = $user_id;
        $preferenceModel->save();
        $user->preferences()->attach($preferenceModel->id);
        //dd($user);

        //$user = User::with('preferences')->find($user_id);

        return response()->json([
            'data' => $preferenceModel
        ], 201);
    }

    public function recuperePreferences(Request $request)
    {
        $user = $request->user();
        $pref = new Preference();
    
        $preferences = $user->preferences;
        //$preference = new PreferencesResource($preferences);

        return response()->json([
            'preferences'=>$user['preferences'][0]['preference'],
        ], 201);
    }

    public function modifiePreferences(Request $request)
    {
        $user = $request->user();
        $preferenceId = $user->preferences[0]->id;
        $preferenceValue = $request->input('preference');

        $preference = Preference::find($preferenceId);

        if (!$preference) {
            return response()->json([
                'message' => 'Préférence non trouvée.'
            ], 404);
        }

        if ($preference->user_id != $user->id) {
            return response()->json([
                'message' => 'Vous n\'êtes pas autorisé à modifier cette préférence.'
            ], 403);
        }

        $preference->preference = $preferenceValue;
        $preference->save();

        return response()->json([
            'preferencesModifie'=>$preference,
            'message' => 'Préférence modifiée avec succès.'
        ], 200);
    }
}