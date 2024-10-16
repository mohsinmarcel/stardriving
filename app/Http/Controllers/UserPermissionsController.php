<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class UserPermissionsController extends Controller
{
    //
    public function permissions($id)
    {
        $user = Admin::role('user')->findOrFail($id);
    
        // Get the permissions assigned to the user
        $userPermissions = $user->permissions->pluck('name')->toArray();
    
        // Get all permissions from the database
        $allPermissions = Permission::where('guard_name', 'admin')->pluck('name')->toArray();
    
        // Determine the role based on the user's permissions
        $selectedRole = $this->determineUserRole($userPermissions);

        // Assign permissions based on the determined role
        switch ($selectedRole) {
            case 'super_admin':
                $allowedPermissions = $allPermissions;
                break;
            case 'admin':
                $allowedPermissions = array_diff($allPermissions, [
                    'settings-view', 'settings-create', 'settings-edit', 'settings-delete',
                    'users-view', 'users-create', 'users-edit', 'users-delete',
                    'import', 'export', 'backup-view', 'backup-download', 'backup-delete'
                ]);
                break;
            case 'secretary':
                $allowedPermissions = array_diff($allPermissions, [
                    'modules-view', 'modules-create', 'modules-edit', 'modules-delete',
                    'rates-view', 'rates-edit',
                    'settings-view', 'settings-create', 'settings-edit', 'settings-delete',
                    'users-view', 'users-create', 'users-edit', 'users-delete',
                    'reports-view', 'reports-edit',
                    'import', 'export', 'backup-view', 'backup-download', 'backup-delete'
                ]);
                break;
            case 'teacher':
                $allowedPermissions = preg_grep('/^student-/', $allPermissions);
                break;
            default:
                $allowedPermissions = [];
                break;
        }
    
        // Your existing logic here to retrieve permissions
        $permissions = collect($allowedPermissions)->groupBy(function ($item, $key) {
            return explode("-", $item)[0];
        })->toArray();
    
        // Pass the selected role to the view
        return view('userpermissions.permissions', compact('permissions', 'userPermissions', 'selectedRole'));
    }
    
    
    // Function to determine user role based on permissions
    private function determineUserRole($permissions)
    {
        // Check for specific permissions to determine the role
    
        $allPermissions = Permission::where('guard_name', 'admin')->pluck('name')->toArray();
    
        if ($permissions === $allPermissions) {
            return 'super_admin';
        }
    
        $adminPermissions = array_diff($allPermissions, [
            'settings-view', 'settings-create', 'settings-edit', 'settings-delete',
            'users-view', 'users-create', 'users-edit', 'users-delete',
            'import', 'export', 'backup-view', 'backup-download', 'backup-delete'
        ]);
    
        $secretaryPermissions = array_diff($allPermissions, [
            'modules-view', 'modules-create', 'modules-edit', 'modules-delete',
            'rates-view', 'rates-edit',
            'settings-view', 'settings-create', 'settings-edit', 'settings-delete',
            'users-view', 'users-create', 'users-edit', 'users-delete',
            'reports-view', 'reports-edit',
            'import', 'export', 'backup-view', 'backup-download', 'backup-delete'
        ]);
    
        $teacherPermissions = preg_grep('/^student-/', $allPermissions);

if ($permissions === $adminPermissions) {
    return 'admin';
} elseif ($permissions === $secretaryPermissions) {
    return 'secretary';
} elseif (array_values($permissions) === array_values($teacherPermissions) && count($permissions) === count($teacherPermissions)) {
    return 'teacher';
}

    
        // Default to 'super_admin' if no specific permissions match
        return 'super_admin';
    }
    
    
    
    // public function permissionsUpdate(Request $request){
    //     $user = Admin::findOrFail(request()->session()->get('userId'));
    //     $user->syncPermissions();
    //     foreach ($request->except('_token') as $key => $value) {
    //         $user->givePermissionTo($key);
    //     }
    //     return redirect()->route('users.index')->withMessage("User Permission Changed Successfully.");
    // }
    public function permissionsUpdate(Request $request)
    {
        $userId = request()->session()->get('userId');
        $user = Admin::findOrFail($userId);
    
        // Clear existing permissions
        $user->syncPermissions();
    
        // Get all permissions from the database
        $allPermissions = Permission::where('guard_name', 'admin')->pluck('name')->toArray();
    
        // Get the selected role from the form
        $selectedRole = $request->input('userRole');
    
        // Assign permissions based on the selected role
        switch ($selectedRole) {
            case 'super_admin':
                // Assign all permissions
                $user->givePermissionTo($allPermissions);
                break;
            case 'admin':
                // Assign permissions excluding settings, users, import, export, backup
                $allowedPermissions = array_diff($allPermissions, [
                    'settings-view', 'settings-create', 'settings-edit', 'settings-delete',
                    'users-view', 'users-create', 'users-edit', 'users-delete',
                    'import', 'export', 'backup-view', 'backup-download', 'backup-delete'
                ]);
                $user->givePermissionTo($allowedPermissions);
                break;
            case 'secretary':
                // Assign permissions excluding modules, rates, settings, users, reports, import, export, backup
                $allowedPermissions = array_diff($allPermissions, [
                    'modules-view', 'modules-create', 'modules-edit', 'modules-delete',
                    'rates-view', 'rates-edit',
                    'settings-view', 'settings-create', 'settings-edit', 'settings-delete',
                    'users-view', 'users-create', 'users-edit', 'users-delete',
                    'reports-view', 'reports-edit',
                    'import', 'export', 'backup-view', 'backup-download', 'backup-delete'
                ]);
                $user->givePermissionTo($allowedPermissions);
                break;
            case 'teacher':
                // Assign permissions related to students only
                $allowedPermissions = preg_grep('/^student-/', $allPermissions);
                $user->givePermissionTo($allowedPermissions);
                break;
            default:
                // Default case, handle as needed
                break;
        }
    
        return redirect()->route('users.index')->withMessage("User Permission Changed Successfully.");
    }
    
}
