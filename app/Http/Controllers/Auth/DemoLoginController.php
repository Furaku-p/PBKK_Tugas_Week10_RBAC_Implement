<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class DemoLoginController extends Controller
{
    public function __invoke(string $role): RedirectResponse
    {
        abort_unless(app()->environment('local'), 404);
        abort_unless(in_array($role, ['admin', 'staf'], true), 404);

        $roleName = $role === 'admin' ? 'Admin' : 'Staf';
        $user = User::role($roleName)->firstOrFail();

        Auth::login($user);
        request()->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }
}
