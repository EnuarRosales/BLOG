<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //CREACION DE ROLES OJO IMPORTAR EL MODELO DESDE LA UBICACION DE SPATIE
        $role1 = Role::create(['name'=>'Admin']);
        $role2 = Role::create(['name'=>'Monitor']);
        $role3 = Role::create(['name'=>'Modelo']);

        //CREACION DE PERMISOS OJO IMPORTAR EL MODELO PERMISION DESDE LA UBICACION DE SPATIE
        //ASI MISMO SE LE  ASIGNA ESTEPERMISO A UN ROL
        Permission::create(['name'=>'admin.home',
                            'description'=>'Ver el dashboard'])->syncRoles([$role1],$role2);
        Permission::create(['name'=>'admin.users',
                            'description'=>'ver ruta usuarios'])->syncRoles([$role1],$role2);
        Permission::create(['name'=>'admin.users.index',
                            'description'=>'Ver listado de usuarios'])->syncRoles([$role1],$role2);
        Permission::create(['name'=>'admin.users.create',
                            'description'=>'crear usuarios'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.users.edit',
                            'description'=>'editar usuarios'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.users.destroy',
                            'description'=>'eliminar usuarios'])->syncRoles([$role1,$role2]); 
                            
        //PERMISOS ASIGNACION TURNO
        Permission::create(['name'=>'admin.asignacionTurnos.index',
                            'description'=>'Ver listado de asignacionTurno'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.asignacionTurnos.create',
                            'description'=>'Crear asignacionTurno'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.asignacionTurnos.edit',
                            'description'=>'Editar asignacionTurno'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.asignacionTurnos.destroy',
                            'description'=>'Eliminar asignacionTurno'])->syncRoles([$role1]);

        //PERMISOS ASIGNACION ROOM
        Permission::create(['name'=>'admin.asignacionRooms.index',
                            'description'=>'Ver listado de asignacionRooms'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.asignacionRooms.create',
                            'description'=>'Crear asignacionRooms'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.asignacionRooms.edit',
                            'description'=>'Editar asignacionRooms'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.asignacionRooms.destroy',
                            'description'=>'Eliminar asignacionRooms'])->syncRoles([$role1]);
                                    
                     
        //CON EL FIN DE CREAR UN USUARIO ADMINISTRADOR
        $user = new User();
        $user->name = 'Enuar Emilio Rosales Salazar';
        $user->cedula = '108613644';
        $user->celular = '3057465217';
        $user->direccion = 'Sandona centenario';
        $user->email = 'admin@gmail.com';
        $user->email_verified_at ='2023-05-11 22:39:30';
        $user->tipoUsuario_id = 1;
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user->syncRoles([$role1]);        
        $user->save();
        
        
        //PERMISOS ROLES
        Permission::create(['name'=>'admin.roles.index',
                            'description'=>'Ver listado de roles'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.roles.create',
                            'description'=>'Crear roles'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.roles.edit',
                            'description'=>'Editar roles'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.roles.destroy',
                            'description'=>'Eliminar roles'])->syncRoles([$role1]);

        //PERMISOS REGISTRO MULTAS                    
        Permission::create(['name'=>'admin.registroMultas.index',
                            'description'=>'Ver listado de multas'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'admin.registroMultas.create',
                            'description'=>'Crear multas'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.registroMultas.edit',
                            'description'=>'Editar multas'])->syncRoles([$role1,$role2,]);
        Permission::create(['name'=>'admin.registroMultas.destroy',
                            'description'=>'Eliminar multas'])->syncRoles([$role1]);


        //PERMISOS  CONFIGURACIONES

        Permission::create(['name'=>'admin.configuraciones',
                            'description'=>'configuraciones studio'])->syncRoles([$role1]);



                
    }
}
