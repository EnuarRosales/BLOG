<?php

namespace Database\Seeders;

use App\Models\MetaModelo;
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
        $role_admin = Role::create(['name'=>'Administrador']);
        $role_modelo = Role::create(['name'=>'Modelo']);
        $role_modelo_satelite = Role::create(['name'=>'Modelo Satélite']);
        $role_monitor = Role::create(['name'=>'Monitor']);
        $role_contador = Role::create(['name'=>'Contador']);

        //CREACION DE PERMISOS OJO IMPORTAR EL MODELO PERMISION DESDE LA UBICACION DE SPATIE
        //ASI MISMO SE LE  ASIGNA ESTEPERMISO A UN ROL
        //PERMISOS USUARIOS
        Permission::create(['name'=>'admin.home',
                            'description'=>'Ver el dashboard'])->syncRoles([$role_admin]);
        Permission::create(['name'=>'admin.users',
                            'description'=>'Ver ruta usuarios'])->syncRoles([$role_admin]);
        Permission::create(['name'=>'admin.users.index',
                            'description'=>'Ver listado de usuarios'])->syncRoles([$role_admin]);
        Permission::create(['name'=>'admin.users.create',
                            'description'=>'Crear usuarios'])->syncRoles([$role_admin]);
        Permission::create(['name'=>'admin.users.edit',
                            'description'=>'Editar usuarios'])->syncRoles([$role_admin]);
        Permission::create(['name'=>'admin.users.destroy',
                            'description'=>'Eliminar usuarios'])->syncRoles([$role_admin]);

        //PERMISOS ASIGNACION TURNO
        Permission::create(['name'=>'admin.asignacionTurnos.index',
                            'description'=>'Ver listado de asignacion de Turno'])->syncRoles([$role_admin, $role_monitor, $role_modelo]);
        Permission::create(['name'=>'admin.asignacionTurnos.create',
                            'description'=>'Crear una asignación de Turno'])->syncRoles([$role_admin, $role_monitor]);
        Permission::create(['name'=>'admin.asignacionTurnos.edit',
                            'description'=>'Editar una asignación de Turno'])->syncRoles([$role_admin, $role_monitor]);
        Permission::create(['name'=>'admin.asignacionTurnos.destroy',
                            'description'=>'Eliminar asignacionTurno'])->syncRoles([$role_admin, $role_monitor]);

        //PERMISOS ASIGNACION ROOM
        Permission::create(['name'=>'admin.asignacionRooms.index',
                            'description'=>'Ver listado de asignación de rooms'])->syncRoles([$role_admin, $role_monitor, $role_modelo]);
        Permission::create(['name'=>'admin.asignacionRooms.create',
                            'description'=>'Crear asignación de rooms'])->syncRoles([$role_admin, $role_monitor]);
        Permission::create(['name'=>'admin.asignacionRooms.edit',
                            'description'=>'Editar asignacion de rooms'])->syncRoles([$role_admin, $role_monitor]);
        Permission::create(['name'=>'admin.asignacionRooms.destroy',
                            'description'=>'Eliminar asignacionRooms'])->syncRoles([$role_modelo]);
                                    
                     
        //CON EL FIN DE CREAR UN USUARIO ADMINISTRADOR
        // $user = new User();
        // $user->name = 'Enuar Emilio Rosales Salazar';
        // $user->cedula = '108613644';
        // $user->celular = '3057465217';
        // $user->direccion = 'Sandona centenario';
        // $user->email = 'admin@gmail.com';
        // $user->email_verified_at ='2023-05-11 22:39:30';
        // $user->tipoUsuario_id = 1;
        // $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        // $user->syncRoles([$role_admin]);        
        // $user->save();

        $metaModelo = new MetaModelo();
        $metaModelo->porcentaje=0;
        $metaModelo->mayorQue=0;
        $metaModelo->save();


        
        
        //PERMISOS ROLES
        Permission::create(['name'=>'admin.roles.index',
                            'description'=>'Ver listado de roles'])->syncRoles([$role_admin]);
        Permission::create(['name'=>'admin.roles.create',
                            'description'=>'Crear roles'])->syncRoles([$role_admin]);
        Permission::create(['name'=>'admin.roles.edit',
                            'description'=>'Editar roles'])->syncRoles([$role_admin]);
        Permission::create(['name'=>'admin.roles.destroy',
                            'description'=>'Eliminar roles'])->syncRoles([$role_admin]);

        //PERMISOS REGISTRO MULTAS
        Permission::create(['name'=>'admin.registroMultas.index',
                            'description'=>'Ver listado de multas'])->syncRoles([$role_admin, $role_monitor, $role_modelo]);
        Permission::create(['name'=>'admin.registroMultas.create',
                            'description'=>'Crear multas'])->syncRoles([$role_admin, $role_monitor]);
        Permission::create(['name'=>'admin.registroMultas.edit',
                            'description'=>'Editar multas'])->syncRoles([$role_admin, $role_monitor]);
        Permission::create(['name'=>'admin.registroMultas.destroy',
                            'description'=>'Eliminar multas'])->syncRoles([$role_admin, $role_monitor]);


        //PERMISOS  CONFIGURACIONES
        Permission::create(['name'=>'admin.configuraciones',
                            'description'=>'Configuraciones studio'])->syncRoles([$role_admin]);

        //PERMISOS EMPRESA
        Permission::create(['name'=>'admin.empresa.index',
            'description'=>'Ver listado de empresas'])->syncRoles([$role_admin]);
        Permission::create(['name'=>'admin.empresa.create',
            'description'=>'Crear empresas'])->syncRoles([$role_admin]);
        Permission::create(['name'=>'admin.empresa.edit',
            'description'=>'Editar empresas'])->syncRoles([$role_admin]);
        Permission::create(['name'=>'admin.empresa.destroy',
            'description'=>'Eliminar Empresas'])->syncRoles([$role_admin]);

        //MODELOS STUDIO BLUM ICE
        $user1 = new User();
        $user1->name = 'David Diaz Lotero';
        $user1->cedula = '1006017454';
        $user1->celular = '3057465217';
        $user1->direccion = 'Sandona centenario';
        $user1->email = 'admin1@gmail.com';
        $user1->email_verified_at ='2023-05-11 22:39:30';
        $user1->tipoUsuario_id = 1;
        $user1->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user1->syncRoles([$role_modelo]);        
        $user1->save();
        //MODELOS STUDIO BLUM ICE
        $user2 = new User();
        $user2->name = 'Abraham Ricardo Charris Ariza';
        $user2->cedula = '1107535076';
        $user2->celular = '3057465217';
        $user2->direccion = 'Sandona centenario';
        $user2->email = 'admin2@gmail.com';
        $user2->email_verified_at ='2023-05-11 22:39:30';
        $user2->tipoUsuario_id = 1;
        $user2->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user2->syncRoles([$role_modelo]);        
        $user2->save();
        //MODELOS STUDIO BLUM ICE
        $user3 = new User();
        $user3->name = 'Linda Alvarez Calderon';
        $user3->cedula = '1081512474';
        $user3->celular = '3057465217';
        $user3->direccion = 'Sandona centenario';
        $user3->email = 'admin3@gmail.com';
        $user3->email_verified_at ='2023-05-11 22:39:30';
        $user3->tipoUsuario_id = 1;
        $user3->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user3->syncRoles([$role_modelo]);        
        $user3->save();
        //MODELOS STUDIO BLUM ICE
        $user4 = new User();
        $user4->name = 'Rivero Guite Carlos Audedi';
        $user4->cedula = '6967342';
        $user4->celular = '3057465217';
        $user4->direccion = 'Sandona centenario';
        $user4->email = 'admin4@gmail.com';
        $user4->email_verified_at ='2023-05-11 22:39:30';
        $user4->tipoUsuario_id = 1;
        $user4->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user4->syncRoles([$role_modelo]);        
        $user4->save();
        //MODELOS STUDIO BLUM ICE
        $user5 = new User();
        $user5->name = 'Barry Stivens Zapata Rendon';
        $user5->cedula = '1118312219';
        $user5->celular = '3057465217';
        $user5->direccion = 'Sandona centenario';
        $user5->email = 'admin5@gmail.com';
        $user5->email_verified_at ='2023-05-11 22:39:30';
        $user5->tipoUsuario_id = 1;
        $user5->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user5->syncRoles([$role_modelo]);        
        $user5->save();
        //MODELOS STUDIO BLUM ICE
        $user6 = new User();
        $user6->name = 'Jhojan Esteban Bermeo Mejia';
        $user6->cedula = '1143995841';
        $user6->celular = '3057465217';
        $user6->direccion = 'Sandona centenario';
        $user6->email = 'admin6@gmail.com';
        $user6->email_verified_at ='2023-05-11 22:39:30';
        $user6->tipoUsuario_id = 1;
        $user6->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user6->syncRoles([$role_modelo]);        
        $user6->save();
        //MODELOS STUDIO BLUM ICE
        $user7 = new User();
        $user7->name = 'Sabina Bejarano';
        $user7->cedula = '1193251842';
        $user7->celular = '3057465217';
        $user7->direccion = 'Sandona centenario';
        $user7->email = 'admin7@gmail.com';
        $user7->email_verified_at ='2023-05-11 22:39:30';
        $user7->tipoUsuario_id = 1;
        $user7->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user7->syncRoles([$role_modelo]);        
        $user7->save();
        //MODELOS STUDIO BLUM ICE
        $user8 = new User();
        $user8->name = 'Nicole Rodriguez Zoriilla';
        $user8->cedula = '1006010863';
        $user8->celular = '3057465217';
        $user8->direccion = 'Sandona centenario';
        $user8->email = 'admin8@gmail.com';
        $user8->email_verified_at ='2023-05-11 22:39:30';
        $user8->tipoUsuario_id = 1;
        $user8->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user8->syncRoles([$role_modelo]);        
        $user8->save();
        //MODELOS STUDIO BLUM ICE
        $user9 = new User();
        $user9->name = 'Jhonatan Estiven Moreno Guaza';
        $user9->cedula = '1192735426';
        $user9->celular = '3057465217';
        $user9->direccion = 'Sandona centenario';
        $user9->email = 'admin9@gmail.com';
        $user9->email_verified_at ='2023-05-11 22:39:30';
        $user9->tipoUsuario_id = 1;
        $user9->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user9->syncRoles([$role_modelo]);        
        $user9->save();
        //MODELOS STUDIO BLUM ICE
        $user10 = new User();
        $user10->name = 'Dayanna Katherine Gomez Pantoja';
        $user10->cedula = '186132127';
        $user10->celular = '3057465217';
        $user10->direccion = 'Sandona centenario';
        $user10->email = 'admin10@gmail.com';
        $user10->email_verified_at ='2023-05-11 22:39:30';
        $user10->tipoUsuario_id = 1;
        $user10->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user10->syncRoles([$role_modelo]);        
        $user10->save();
        //MODELOS STUDIO BLUM ICE
        $user11 = new User();
        $user11->name = 'Brahyan Eduardo Rodriguez Cardonas';
        $user11->cedula = '6473437';
        $user11->celular = '3057465217';
        $user11->direccion = 'Sandona centenario';
        $user11->email = 'admin11@gmail.com';
        $user11->email_verified_at ='2023-05-11 22:39:30';
        $user11->tipoUsuario_id = 1;
        $user11->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user11->syncRoles([$role_modelo]);        
        $user11->save();
        //MODELOS STUDIO BLUM ICE
        $user12 = new User();
        $user12->name = 'Jordy Fabian Narvaez Velazco';
        $user12->cedula = '1110363024';
        $user12->celular = '3057465217';
        $user12->direccion = 'Sandona centenario';
        $user12->email = 'admin12@gmail.com';
        $user12->email_verified_at ='2023-05-11 22:39:30';
        $user12->tipoUsuario_id = 1;
        $user12->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user12->syncRoles([$role_modelo]);        
        $user12->save();


        //CON EL FIN DE CREAR UN USUARIO ADMINISTRADOR
        $user_admin = new User();
        $user_admin->name = 'Enuar Emilio Rosales Salazar';
        $user_admin->cedula = '108613644';
        $user_admin->celular = '3057465217';
        $user_admin->direccion = 'Sandona centenario';
        $user_admin->email = 'admin@gmail.com';
        $user_admin->email_verified_at ='2023-05-11 22:39:30';
        $user_admin->tipoUsuario_id = 1;
        $user_admin->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user_admin->syncRoles([$role_admin]);
        $user_admin->save();

        //CON EL FIN DE CREAR UN USUARIO de Soporte
        $user_soporte = new User();
        $user_soporte->name = 'Enuar Emilio Rosales Salazar';
        $user_soporte->cedula = '108613644';
        $user_soporte->celular = '3057465217';
        $user_soporte->direccion = 'Sandona centenario';
        $user_soporte->email = 'tech@studio.com';
        $user_soporte->email_verified_at ='2023-05-11 22:39:30';
        $user_soporte->tipoUsuario_id = 1;
        $user_soporte->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user_soporte->syncRoles([$role_admin]);
        $user_soporte->save();
    }
}
