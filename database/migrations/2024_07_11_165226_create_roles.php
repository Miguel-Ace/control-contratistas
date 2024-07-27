<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'contratista']);

        $usuario = User::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $usuario->assignRole($role1);

        $usuario = User::create([
            'name' => 'Miguel Acevedo Cruz',
            'email' => 'acevedo51198mac@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $usuario->assignRole($role2);

        $usuario = User::create([
            'name' => 'Ramsés Rivas',
            'email' => 'ramses.rivas@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $usuario->assignRole($role2);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 
    }
};
