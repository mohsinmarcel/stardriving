<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::firstOrCreate([
            'email' => 'admin@star-driving.info',
        ],[
            'first_name' => 'Star',
            'last_name' => 'Driving',
            'username' => 'scorpiom68',
            'password' => Hash::make("22119609aM$!$"),
        ]);
        if(!$admin->hasRole('admin')){
            $admin->assignRole('admin');
        }
        $permissions = Permission::select('name')->get();
        $admin->syncPermissions([]);
        foreach ($permissions as $key => $value) {
            $admin->givePermissionTo($value->name);
        }
    }
}
