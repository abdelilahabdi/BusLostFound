<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    /**
     * Display a paginated list of users.
     */
    public function index(): View
    {
        $users = User::query()
            ->withCount('announcements')
            ->orderBy('name')
            ->paginate(10);

        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Toggle active status for a user account.
     */
    public function toggleActive(Request $request, User $user): RedirectResponse
    {
        if ($request->user()->id === $user->id) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Vous ne pouvez pas desactiver votre propre compte.');
        }

        $user->update([
            'is_active' => ! $user->is_active,
        ]);

        $message = $user->is_active
            ? 'Compte utilisateur active avec succes.'
            : 'Compte utilisateur desactive avec succes.';

        return redirect()
            ->route('admin.users.index')
            ->with('success', $message);
    }
}
