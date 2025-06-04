<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission): Response
    {
        if (!hasRolePermission($permission)) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }

    // /**
    //  * Handle an incoming request.
    //  *
    //  * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    //  */
    // // public function handle(Request $request, Closure $next, $permission): Response
    // // {
    // //     // Step 1: Check if the user is active
    // //     // if ($request->user()?->status !== 'active') {
    // //     //     abort(403, 'User is inactive.');
    // //     // }

    // //     // Step 2: Check if the user has any of the given permissions using `hasRolePermission()`
    // //     $permissions = explode(',', $permission); // Supports multiple permissions

    // //     // Loop through each permission and check using the `hasRolePermission` helper
    // //     foreach ($permissions as $perm) {
    // //         if (hasRolePermission(trim($perm))) {
    // //             return $next($request); // Permission found, proceed
    // //         }
    // //     }

    // //     // If none of the permissions match, abort with Unauthorized
    // //     abort(403, 'Unauthorized access.');
    // // }
}
