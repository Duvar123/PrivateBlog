<?php

namespace App\Helpers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RolHelper
{
    public static function currentUserIsAdmin(): bool
    {
        if (!Auth::check()) {
            return false;
        }

        $user = User::where('id', Auth::id())->with('role')->first();

        return $user && $user->role && $user->role->name === 'admin';
    }

    public static function isAuthorized(string $permission): bool
    {
        if (!Auth::check()) {
            return false;
        }

        if (self::currentUserIsAdmin()) {
            return true;
        }

        $userId = Auth::id();

        $found = Permission::select('permissions.id')
            ->join('rol_permissions', 'permissions.id', '=', 'rol_permissions.permission_id')
            ->join('rols', 'rol_permissions.rol_id', '=', 'rols.id')
            ->join('users', 'rols.id', '=', 'users.rol_id')
            ->where('permissions.name', '=', $permission)
            ->where('users.id', '=', $userId)
            ->first();

        return $found !== null;
    }
}
