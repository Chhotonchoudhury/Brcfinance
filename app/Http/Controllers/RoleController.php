<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
class RoleController extends Controller
{
    //
    // List roles
    public function index(Request $request)
    {
        $search = $request->query('search');

        $roles = Role::with('permissions')
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhereHas('permissions', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%");
                    });
            })
            ->paginate(10); // ✅ Paginate result

        return view('roles.index', compact('roles'));
    }


    // Show form to create a role
    public function create(Role $role = null)
    {
        $permissions = Permission::all(); // Get all permissions for the form

        // If a role is provided, we're editing, otherwise, it's a create form
        return view('roles.create', compact('role', 'permissions'));
    }


     // Store method (for creating a new role)
     public function store(Request $request)
     {
         // Validate the form input
         $validated = $request->validate([
             'name' => 'required|string|max:255|unique:roles,name', // Role name must be unique
             'permissions' => 'required|array', // Ensure at least one permission is selected
             'permissions.*' => 'exists:permissions,id', // Ensure each permission ID is valid
         ]);
 
         // Create the role
         $role = Role::create([
             'name' => $validated['name'],
         ]);
 
         // Attach the selected permissions to the role
         $role->permissions()->sync($validated['permissions']);
 
         // Redirect with a success message
         return redirect()->route('roles.index')->with('success', 'Role created successfully!');
     }
 
     // Update method (for editing an existing role)
     public function update(Request $request, Role $role)
     {
         // Validate the form input
         $validated = $request->validate([
             'name' => 'required|string|max:255|unique:roles,name,' . $role->id, // Unique name except for the current role
             'permissions' => 'required|array', // Ensure at least one permission is selected
             'permissions.*' => 'exists:permissions,id', // Ensure each permission ID is valid
         ]);
 
         // Update the role name
         $role->update([
             'name' => $validated['name'],
         ]);
 
         // Sync the selected permissions with the role
         $role->permissions()->sync($validated['permissions']);
 
         // Redirect with a success message
         return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
     }
     
     
      public function destroy(Role $role)
    {
        // Check if the role is assigned to any user
        $userCount = User::role($role->name)->count();

        if ($userCount > 0) {
            return redirect()->route('roles.index')->with('error', "Can't delete this role because it is assigned to {$userCount} user(s).");
        }

        // Detach permissions before deleting (optional, good practice)
        $role->permissions()->detach();

        // Delete the role
        $role->delete();

        return back()->with('success', 'Role deleted successfully!');
    }
}
