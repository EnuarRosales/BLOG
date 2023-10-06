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











    }










}
