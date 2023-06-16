<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(): Response
    {
        $user = Auth::user();
        $address = ['street' => '', 'city' => '', 'zip_code' => '', 'country' => ''];

        // Vérifier si l'utilisateur est un auditeur et a une adresse
        if ($user->roleable_type === 'App\Models\Auditor') {
            /**
             * @var \App\Models\Auditor $auditor
             */
            $auditor = $user->roleable;

            if ($auditor->address !== null) {
                $address = $auditor->address;
            }
        }

        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $user instanceof MustVerifyEmail,
            'status' => session('status'),
            'address' => $address, // Ajouter l'adresse à la réponse
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($user->roleable_type === 'App\Models\Auditor') {
            /**
             * @var \App\Models\Auditor $auditor
             */
            $auditor = $user->roleable;

            // Vérifier si le payload contient une adresse
            if ($request->has('address')) {
                // Créer ou mettre à jour l'adresse
                $address = $auditor->address()->updateOrCreate(
                    ['id' => $auditor->address_id],
                    $request->input('address')
                );

                // Mettre à jour l'auditeur avec l'ID de l'adresse
                $auditor->address_id = $address->id;
                $auditor->save();
            }
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
