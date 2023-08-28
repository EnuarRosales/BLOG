<?php

namespace Database\Seeders;

use App\Models\MetaModelo;
use App\Models\Pagina;
use App\Models\User;
use Carbon\Carbon;
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
        $role_super_admin= Role::create(['name'=>'Super Admin']);

        //CREACION DE PERMISOS OJO IMPORTAR EL MODELO PERMISION DESDE LA UBICACION DE SPATIE
        //ASI MISMO SE LE  ASIGNA ESTEPERMISO A UN ROL
        //PERMISOS USUARIOS

        //PERMISOS DASHBOARD

        Permission::create(['name'=>'admin.dashboard',
                            'description'=>'Ver dashboard'])->syncRoles([$role_super_admin]);

        //PERMISOS TENANTS
        Permission::create(['name'=>'admin.tenants.index',
                            'description'=>'Ver listado de dominios'])->syncRoles([$role_super_admin]);

        Permission::create(['name'=>'admin.tenants.create',
                            'description'=>'Crear un dominio'])->syncRoles([$role_super_admin]);

        Permission::create(['name'=>'admin.tenants.edit',
                            'description'=>'Editar un dominio'])->syncRoles([$role_super_admin]);

        Permission::create(['name'=>'admin.tenants.destroy',
                            'description'=>'Eliminar un dominio'])->syncRoles([$role_super_admin]);

        Permission::create(['name'=>'admin.tenants.seeders',
                            'description'=>'Ejecutar seeders dominio'])->syncRoles([$role_super_admin]);



        //PERMISOS USERS
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

        Permission::create(['name'=>'admin.users.asignarRol',
                            'description'=>'Ver boton asinacion rol'])->syncRoles([$role_admin]);



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

        //PERMISOS ROLES
        Permission::create(['name'=>'admin.roles.index',
                            'description'=>'Ver listado de roles'])->syncRoles([$role_admin]);
        Permission::create(['name'=>'admin.roles.create',
                            'description'=>'Crear roles'])->syncRoles([$role_admin]);
        Permission::create(['name'=>'admin.roles.edit',
                            'description'=>'Editar roles'])->syncRoles([$role_admin]);
        Permission::create(['name'=>'admin.roles.destroy',
                            'description'=>'Eliminar roles'])->syncRoles([$role_admin]);

        


        //PERMISOS  CONFIGURACIONES
        Permission::create(['name'=>'admin.configuraciones.menu',
                            'description'=>'Ver Menu Configuraciones'])->syncRoles([$role_admin]);
        //MENU METAS
        Permission::create(['name'=>'admin.configuraciones.metas',
                            'description'=>'Ver menu metas'])->syncRoles([$role_admin]);

        //TIPO METAS  ESTUDIO
        Permission::create(['name'=>'admin.tipoMetas',
                            'description'=>'Ver, crear, editar, eliminar, menu metas estudio'])->syncRoles([$role_admin]);

        Permission::create(['name'=>'admin.metasModelos',
                            'description'=>'Ver, crear, editar, eliminar, menu metas modelos'])->syncRoles([$role_admin]);          

        Permission::create(['name'=>'admin.empresas',
                            'description'=>'Ver, crear, editar, eliminar, menu empresa'])->syncRoles([$role_admin]);
        
        Permission::create(['name'=>'admin.impuestos',
                            'description'=>'Ver, crear, editar, eliminar, menu impuesto'])->syncRoles([$role_admin]);

        Permission::create(['name'=>'admin.tipoUsuarios',
                            'description'=>'Ver, crear, editar, eliminar, menu tipo usuarios'])->syncRoles([$role_admin]);

        Permission::create(['name'=>'admin.tipoTurnos',
                            'description'=>'Ver, crear, editar, eliminar,menu tipo turnos'])->syncRoles([$role_admin]);
                            

        Permission::create(['name'=>'admin.tipoRooms',
                            'description'=>'Ver, crear, editar, eliminar, menu tipo rooms'])->syncRoles([$role_admin]);

        Permission::create(['name'=>'admin.tipoMultas',
                            'description'=>'Ver, crear, editar, eliminar, menu tipo multas'])->syncRoles([$role_admin]);
                            
        Permission::create(['name'=>'admin.tipoDescuentos',
                            'description'=>'Ver, crear, editar, eliminar, menu tipo descuentos'])->syncRoles([$role_admin]);

        Permission::create(['name'=>'admin.paginas',
                            'description'=>'Ver, crear, editar, eliminar, menu paginas'])->syncRoles([$role_admin]);

        //PERMISOS CERTIFICACIONES        
        Permission::create(['name'=>'admin.certificaciones',
                            'description'=>'Ver menu certificaiones'])->syncRoles([$role_admin]);

        Permission::create(['name'=>'admin.certificacion.laboral',
                            'description'=>'Ver y generar  menu certificacion laboral'])->syncRoles([$role_admin]);

        Permission::create(['name'=>'admin.certificacion.tiempo',
                            'description'=>'Ver y generar  menu certificacion tiempo'])->syncRoles([$role_admin]);

        Permission::create(['name'=>'admin.certificacion.impuesto',
                            'description'=>'Ver y generar  menu certificacion impuesto'])->syncRoles([$role_admin]);

        Permission::create(['name'=>'admin.certificacion.pago',
                            'description'=>'Ver y generar  menu certificacion pago'])->syncRoles([$role_admin]);


         //PERMISOS REGISTRO MULTAS
        Permission::create(['name'=>'admin.registroMultas.index',
        'description'=>'Ver listado de multas'])->syncRoles([$role_admin, $role_monitor, $role_modelo]);
        Permission::create(['name'=>'admin.registroMultas.create',
        'description'=>'Crear multas'])->syncRoles([$role_admin, $role_monitor]);
        Permission::create(['name'=>'admin.registroMultas.edit',
        'description'=>'Editar multas'])->syncRoles([$role_admin, $role_monitor]);
        Permission::create(['name'=>'admin.registroMultas.destroy',
        'description'=>'Eliminar multas'])->syncRoles([$role_admin, $role_monitor]);

         //PERMISOS REGISTRO ASISTENCIAS
         Permission::create(['name'=>'admin.registroAsistencias.index',
        'description'=>'Ver listado de asistencia'])->syncRoles([$role_admin, $role_monitor, $role_modelo]);
        Permission::create(['name'=>'admin.registroAsistencias.create',
        'description'=>'Crear asistencia'])->syncRoles([$role_admin, $role_monitor]);
        Permission::create(['name'=>'admin.registroAsistencias.edit',
        'description'=>'Editar asistencia'])->syncRoles([$role_admin, $role_monitor]);
        Permission::create(['name'=>'admin.registroAsistencias.destroy',
        'description'=>'Eliminar asistencia'])->syncRoles([$role_admin, $role_monitor]);
        Permission::create(['name'=>'admin.registroAsistencias.control',
        'description'=>'Ver columna de control'])->syncRoles([$role_admin, $role_monitor, $role_modelo]);



        //PERMISOS REGISTRO PRODUCCION
        Permission::create(['name'=>'admin.registroProduccion.index',
        'description'=>'Ver listado de produccion'])->syncRoles([$role_admin, $role_monitor, $role_modelo]);        
        Permission::create(['name'=>'admin.registroProduccion.resumen',        
        'description'=>'Ver resumen produccion'])->syncRoles([$role_admin, $role_monitor]);        
        Permission::create(['name'=>'admin.registroProduccion.create',
        'description'=>'Crear produccion'])->syncRoles([$role_admin, $role_monitor]);
        Permission::create(['name'=>'admin.registroProduccion.edit',
        'description'=>'Editar produccion'])->syncRoles([$role_admin, $role_monitor]);
        Permission::create(['name'=>'admin.registroProduccion.destroy',
        'description'=>'Eliminar produccion'])->syncRoles([$role_admin, $role_monitor]);

         //PERMISOS REGISTRO DESCUENTOS
         Permission::create(['name'=>'admin.registroDescuentos.index',
        'description'=>'Ver listado de descuentos'])->syncRoles([$role_admin, $role_monitor, $role_modelo]);
        Permission::create(['name'=>'admin.registroDescuentos.create',
        'description'=>'Crear descuentos'])->syncRoles([$role_admin, $role_monitor]);
        Permission::create(['name'=>'admin.registroDescuentos.edit',
        'description'=>'Editar descuentos'])->syncRoles([$role_admin, $role_monitor]);
        Permission::create(['name'=>'admin.registroDescuentos.destroy',
        'description'=>'Eliminar descuentos'])->syncRoles([$role_admin, $role_monitor]);
        Permission::create(['name'=>'admin.registroDescuentos.total',
        'description'=>'Ver boton descuento total'])->syncRoles([$role_admin, $role_monitor]);
        Permission::create(['name'=>'admin.registroDescuentos.parcial',
        'description'=>'Ver boton descuento parcial'])->syncRoles([$role_admin, $role_monitor]);

        
        //PERMISOS REPORTE APGINAS
        Permission::create(['name'=>'admin.reportePaginas.index',
        'description'=>'Ver listado de produccion'])->syncRoles([$role_admin, $role_monitor]);     






        // //PERMISOS EMPRESA
        // Permission::create(['name'=>'admin.empresa.index',
        //     'description'=>'Ver listado de empresas'])->syncRoles([$role_admin]);
        // Permission::create(['name'=>'admin.empresa.create',
        //     'description'=>'Crear empresas'])->syncRoles([$role_admin]);
        // Permission::create(['name'=>'admin.empresa.edit',
        //     'description'=>'Editar empresas'])->syncRoles([$role_admin]);
        // Permission::create(['name'=>'admin.empresa.destroy',
        //     'description'=>'Eliminar Empresas'])->syncRoles([$role_admin]);

        

        //CON EL FIN DE CREAR UN USUARIO de Soporte
        $user_soporte = new User();
        $user_soporte->fechaIngreso = Carbon::now();
        $user_soporte->name = 'Super Usuario';
        $user_soporte->cedula = '111111111';
        $user_soporte->celular = '11111111';
        $user_soporte->direccion = 'Super';
        $user_soporte->email = 'admin@gmail.com';
        $user_soporte->email_verified_at ='2023-05-11 22:39:30';
        $user_soporte->tipoUsuario_id = 2;
        // $user_soporte->empresa_id = 1;
        $user_soporte->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user_soporte->syncRoles([$role_admin]);
        $user_soporte->save();     




        $user1 = new User();
        $user1->fechaIngreso = '2023-07-15';
        $user1->name = 'David Diaz Lotero';
        $user1->cedula = '1006017454';
        $user1->celular = '3057465217';
        $user1->direccion = 'Sandona centenario';
        $user1->email = 'admin1@gmail.com';
        $user1->email_verified_at ='2023-05-11 22:39:30';
        $user1->tipoUsuario_id = 2;
        $user1->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user1->syncRoles([$role_modelo]);
        $user1->save();
        //MODELOS STUDIO BLUM ICE
        $user2 = new User();
        $user2->fechaIngreso = '2023-07-15';
        $user2->name = 'Abraham Ricardo Charris Ariza';
        $user2->cedula = '1107535076';
        $user2->celular = '3057465217';
        $user2->direccion = 'Sandona centenario';
        $user2->email = 'admin2@gmail.com';
        $user2->email_verified_at ='2023-05-11 22:39:30';
        $user2->tipoUsuario_id = 2;
        $user2->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user2->syncRoles([$role_modelo]);
        $user2->save();
        //MODELOS STUDIO BLUM ICE
        $user3 = new User();
        $user3->fechaIngreso = '2023-07-15';
        $user3->name = 'Linda Alvarez Calderon';
        $user3->cedula = '1081512474';
        $user3->celular = '3057465217';
        $user3->direccion = 'Sandona centenario';
        $user3->email = 'admin3@gmail.com';
        $user3->email_verified_at ='2023-05-11 22:39:30';
        $user3->tipoUsuario_id = 2;
        $user3->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user3->syncRoles([$role_modelo]);
        $user3->save();
        //MODELOS STUDIO BLUM ICE
        $user4 = new User();
        $user4->fechaIngreso = '2023-07-15';
        $user4->name = 'Rivero Guite Carlos Audedi';
        $user4->cedula = '6967342';
        $user4->celular = '3057465217';
        $user4->direccion = 'Sandona centenario';
        $user4->email = 'admin4@gmail.com';
        $user4->email_verified_at ='2023-05-11 22:39:30';
        $user4->tipoUsuario_id = 2;
        $user4->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user4->syncRoles([$role_modelo]);
        $user4->save();
        //MODELOS STUDIO BLUM ICE
        $user5 = new User();
        $user5->fechaIngreso = '2023-07-15';
        $user5->name = 'Barry Stivens Zapata Rendon';
        $user5->cedula = '1118312219';
        $user5->celular = '3057465217';
        $user5->direccion = 'Sandona centenario';
        $user5->email = 'admin5@gmail.com';
        $user5->email_verified_at ='2023-05-11 22:39:30';
        $user5->tipoUsuario_id = 2;
        $user5->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user5->syncRoles([$role_modelo]);
        $user5->save();
        //MODELOS STUDIO BLUM ICE
        $user6 = new User();
        $user6->fechaIngreso = '2023-07-15';
        $user6->name = 'Jhojan Esteban Bermeo Mejia';
        $user6->cedula = '1143995841';
        $user6->celular = '3057465217';
        $user6->direccion = 'Sandona centenario';
        $user6->email = 'admin6@gmail.com';
        $user6->email_verified_at ='2023-05-11 22:39:30';
        $user6->tipoUsuario_id = 2;
        $user6->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user6->syncRoles([$role_modelo]);
        $user6->save();
        //MODELOS STUDIO BLUM ICE
        $user7 = new User();
        $user7->fechaIngreso = '2023-07-15';
        $user7->name = 'Sabina Bejarano';
        $user7->cedula = '1193251842';
        $user7->celular = '3057465217';
        $user7->direccion = 'Sandona centenario';
        $user7->email = 'admin7@gmail.com';
        $user7->email_verified_at ='2023-05-11 22:39:30';
        $user7->tipoUsuario_id = 2;
        $user7->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user7->syncRoles([$role_modelo]);
        $user7->save();
        //MODELOS STUDIO BLUM ICE
        $user8 = new User();
        $user8->fechaIngreso = '2023-07-15';
        $user8->name = 'Nicole Rodriguez Zoriilla';
        $user8->cedula = '1006010863';
        $user8->celular = '3057465217';
        $user8->direccion = 'Sandona centenario';
        $user8->email = 'admin8@gmail.com';
        $user8->email_verified_at ='2023-05-11 22:39:30';
        $user8->tipoUsuario_id = 2;
        $user8->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user8->syncRoles([$role_modelo]);
        $user8->save();
        //MODELOS STUDIO BLUM ICE
        $user9 = new User();
        $user9->fechaIngreso = '2023-07-15';
        $user9->name = 'Jhonatan Estiven Moreno Guaza';
        $user9->cedula = '1192735426';
        $user9->celular = '3057465217';
        $user9->direccion = 'Sandona centenario';
        $user9->email = 'admin9@gmail.com';
        $user9->email_verified_at ='2023-05-11 22:39:30';
        $user9->tipoUsuario_id = 2;
        $user9->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user9->syncRoles([$role_modelo]);
        $user9->save();
        //MODELOS STUDIO BLUM ICE
        $user10 = new User();
        $user10->fechaIngreso = '2023-07-15';
        $user10->name = 'Dayanna Katherine Gomez Pantoja';
        $user10->cedula = '186132127';
        $user10->celular = '3057465217';
        $user10->direccion = 'Sandona centenario';
        $user10->email = 'admin10@gmail.com';
        $user10->email_verified_at ='2023-05-11 22:39:30';
        $user10->tipoUsuario_id = 2;
        $user10->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user10->syncRoles([$role_modelo]);
        $user10->save();
        //MODELOS STUDIO BLUM ICE
        $user11 = new User();
        $user11->fechaIngreso = '2023-07-15';
        $user11->name = 'Brahyan Eduardo Rodriguez Cardonas';
        $user11->cedula = '6473437';
        $user11->celular = '3057465217';
        $user11->direccion = 'Sandona centenario';
        $user11->email = 'admin11@gmail.com';
        $user11->email_verified_at ='2023-05-11 22:39:30';
        $user11->tipoUsuario_id = 2;
        $user11->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user11->syncRoles([$role_modelo]);
        $user11->save();
        //MODELOS STUDIO BLUM ICE
        $user12 = new User();
        $user12->fechaIngreso = '2023-07-15';
        $user12->name = 'Jordy Fabian Narvaez Velazco';
        $user12->cedula = '1110363024';
        $user12->celular = '3057465217';
        $user12->direccion = 'Sandona centenario';
        $user12->email = 'admin12@gmail.com';
        $user12->email_verified_at ='2023-05-11 22:39:30';
        $user12->tipoUsuario_id = 2;
        $user12->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user12->syncRoles([$role_modelo]);
        $user12->save();

        $user13 = new User();
        $user13->fechaIngreso = '2023-07-15';
        $user13->name = 'Adriana Patricia Obando Mora'; 
        $user13->cedula = '1004540560';
        $user13->celular = '3057465217';
        $user13->direccion = 'Sandona centenario';
        $user13->email = 'admin13@gmail.com';
        $user13->email_verified_at ='2023-05-11 22:39:30';
        $user13->tipoUsuario_id = 2;
        $user13->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user13->syncRoles([$role_modelo]);
        $user13->save();

        $user14 = new User();
        $user14->fechaIngreso = '2023-07-15';
        $user14->name = 'Daniel Andres Escobar Acosta ';  
        $user14->cedula = '1004540187';
        $user14->celular = '1004540187';
        $user14->direccion = 'Sandona centenario';
        $user14->email = 'admin14@gmail.com';
        $user14->email_verified_at ='2023-05-11 22:39:30';
        $user14->tipoUsuario_id = 2;
        $user14->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user14->syncRoles([$role_modelo]);
        $user14->save();

        $user15 = new User();
        $user15->fechaIngreso = '2023-07-15';
        $user15->name = 'Liseth Katerine Rodriguez Redin';  
        $user15->cedula = '1080832335';
        $user15->celular = '1004540187';
        $user15->direccion = 'Sandona centenario';
        $user15->email = 'admin15@gmail.com';
        $user15->email_verified_at ='2023-05-11 22:39:30';
        $user15->tipoUsuario_id = 2;
        $user15->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user15->syncRoles([$role_modelo]);
        $user15->save();

        $user16 = new User();
        $user16->fechaIngreso = '2023-07-15';
        $user16->name = 'Edgar David Bedoya Andrade';  
        $user16->cedula = '1081273020';
        $user16->celular = '1004540187';
        $user16->direccion = 'Sandona centenario';
        $user16->email = 'admin16@gmail.com';
        $user16->email_verified_at ='2023-05-11 22:39:30';
        $user16->tipoUsuario_id = 2;
        $user16->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';//password
        $user16->syncRoles([$role_modelo]);
        $user16->save();


        
        


        
    }

    








}
