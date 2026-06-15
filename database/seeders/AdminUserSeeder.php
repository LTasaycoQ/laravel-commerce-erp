<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin = User::create([
                'email'=>'dw@fiestatoursperu.com',
                'name'=>'Luis Tasayco',
                'password'=>Hash::make('luis123'),
        ]);
        $admin->assignRole('admin');
    }
}
