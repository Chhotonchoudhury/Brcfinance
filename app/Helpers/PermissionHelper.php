<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('hasRolePermission')) {
    function hasRolePermission(string $permissionName): bool
    {
        $user = Auth::user();

        if (!$user || !$user->roles) {
            return false;
        }

        return $user->roles->flatMap->permissions->pluck('name')->contains($permissionName);
    }
}
