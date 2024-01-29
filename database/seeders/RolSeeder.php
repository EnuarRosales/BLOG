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
        $role_admin = Role::firstOrCreate(['name' => 'Administrador']);
        $role_modelo = Role::firstOrCreate(['name' => 'Modelo']);
        $role_modelo_satelite = Role::firstOrCreate(['name' => 'Modelo Satélite']);
        $role_monitor = Role::firstOrCreate(['name' => 'Monitor']);
        $role_contador = Role::firstOrCreate(['name' => 'Contador']);
        $role_super_admin = Role::firstOrCreate(['name' => 'Super Admin']);

        //CREACION DE PERMISOS OJO IMPORTAR EL MODELO PERMISION DESDE LA UBICACION DE SPATIE
        //ASI MISMO SE LE  ASIGNA ESTEPERMISO A UN ROL
        //PERMISOS USUARIOS

        //PERMISOS DASHBOARD
        Permission::firstOrCreate([
            'name' => 'admin.dashboard',
            'description' => 'Ver dashboard'
        ])->syncRoles([$role_super_admin]);

        //PERMISOS TENANTS
        Permission::firstOrCreate([
            'name' => 'admin.tenants.index',
            'description' => 'Ver listado de dominios'
        ])->syncRoles([$role_super_admin]);

        Permission::firstOrCreate([
            'name' => 'admin.tenants.create',
            'description' => 'Crear un dominio'
        ])->syncRoles([$role_super_admin]);

        Permission::firstOrCreate([
            'name' => 'admin.tenants.edit',
            'description' => 'Editar un dominio'
        ])->syncRoles([$role_super_admin]);

        Permission::firstOrCreate([
            'name' => 'admin.tenants.destroy',
            'description' => 'Eliminar un dominio'
        ])->syncRoles([$role_super_admin]);

        Permission::firstOrCreate([
            'name' => 'admin.tenants.seeders',
            'description' => 'Ejecutar seeders dominio'
        ])->syncRoles([$role_super_admin]);



        //PERMISOS USERS
        Permission::firstOrCreate([
            'name' => 'admin.home',
            'description' => 'Ver el dashboard'
        ])->syncRoles([$role_admin]);

        Permission::firstOrCreate([
            'name' => 'admin.users',
            'description' => 'Ver ruta usuarios'
        ])->syncRoles([$role_admin]);

        Permission::firstOrCreate([
            'name' => 'admin.users.index',
            'description' => 'Ver listado de usuarios'
        ])->syncRoles([$role_admin]);

        Permission::firstOrCreate([
            'name' => 'admin.users.create',
            'description' => 'Crear usuarios'
        ])->syncRoles([$role_admin]);

        Permission::firstOrCreate([
            'name' => 'admin.users.edit',
            'description' => 'Editar usuarios'
        ])->syncRoles([$role_admin]);

        Permission::firstOrCreate([
            'name' => 'admin.users.destroy',
            'description' => 'Eliminar usuarios'
        ])->syncRoles([$role_admin]);

        Permission::firstOrCreate([
            'name' => 'admin.users.asignarRol',
            'description' => 'Ver boton asinacion rol'
        ])->syncRoles([$role_admin]);



        //PERMISOS ASIGNACION TURNO
        Permission::firstOrCreate([
            'name' => 'admin.asignacionTurnos.index',
            'description' => 'Ver listado de asignacion de Turno'
        ])->syncRoles([$role_admin, $role_monitor, $role_modelo]);
        Permission::firstOrCreate([
            'name' => 'admin.asignacionTurnos.create',
            'description' => 'Crear una asignación de Turno'
        ])->syncRoles([$role_admin, $role_monitor]);
        Permission::firstOrCreate([
            'name' => 'admin.asignacionTurnos.edit',
            'description' => 'Editar una asignación de Turno'
        ])->syncRoles([$role_admin, $role_monitor]);
        Permission::firstOrCreate([
            'name' => 'admin.asignacionTurnos.destroy',
            'description' => 'Eliminar asignacionTurno'
        ])->syncRoles([$role_admin, $role_monitor]);

        //PERMISOS ASIGNACION ROOM

        Permission::firstOrCreate([
            'name' => 'admin.asignacionRooms.index',
            'description' => 'Ver listado de asignación de rooms'
        ])->syncRoles([$role_admin, $role_monitor, $role_modelo]);

        Permission::firstOrCreate([
            'name' => 'asignacionRooms.personal',
            'description' => 'Ver solo la asignación de rooms pesonal'
        ])->syncRoles([$role_modelo]);

        
        Permission::firstOrCreate([
            'name' => 'admin.asignacionRooms.create',
            'description' => 'Crear asignación de rooms'
        ])->syncRoles([$role_admin, $role_monitor]);
        Permission::firstOrCreate([
            'name' => 'admin.asignacionRooms.edit',
            'description' => 'Editar asignacion de rooms'
        ])->syncRoles([$role_admin, $role_monitor]);
        Permission::firstOrCreate([
            'name' => 'admin.asignacionRooms.destroy',
            'description' => 'Eliminar asignacionRooms'
        ])->syncRoles([$role_modelo]);

        //PERMISOS ROLES
        Permission::firstOrCreate([
            'name' => 'admin.roles.index',
            'description' => 'Ver listado de roles'
        ])->syncRoles([$role_admin]);
        Permission::firstOrCreate([
            'name' => 'admin.roles.create',
            'description' => 'Crear roles'
        ])->syncRoles([$role_admin]);
        Permission::firstOrCreate([
            'name' => 'admin.roles.edit',
            'description' => 'Editar roles'
        ])->syncRoles([$role_admin]);
        Permission::firstOrCreate([
            'name' => 'admin.roles.destroy',
            'description' => 'Eliminar roles'
        ])->syncRoles([$role_admin]);


        //PERMISOS  CONFIGURACIONES
        Permission::firstOrCreate([
            'name' => 'admin.configuraciones.menu',
            'description' => 'Ver Menu Configuraciones'
        ])->syncRoles([$role_admin]);
        //MENU METAS
        Permission::firstOrCreate([
            'name' => 'admin.configuraciones.metas',
            'description' => 'Ver menu metas'
        ])->syncRoles([$role_admin]);

        //METAS ESTUDIO
        Permission::firstOrCreate([
            'name' => 'admin.metaEstudios.index',
            'description' => 'Ver listado de metas estudio'
        ])->syncRoles([$role_admin]);
        Permission::firstOrCreate([
            'name' => 'admin.metaEstudio.create',
            'description' => 'Crear meta Estudio'
        ])->syncRoles([$role_admin]);
        Permission::firstOrCreate([
            'name' => 'admin.metaEstudio.edit',
            'description' => 'Editar meta estudio'
        ])->syncRoles([$role_admin]);
        Permission::firstOrCreate([
            'name' => 'admin.metaEstudio.destroy',
            'description' => 'Eliminar meta estudio'
        ])->syncRoles([$role_admin]);


        //METAS MODELOS
        Permission::firstOrCreate([
            'name' => 'admin.metaModelos.index',
            'description' => 'Ver listado de metas de los modelos'
        ])->syncRoles([$role_admin]);
        Permission::firstOrCreate([
            'name' => 'admin.metaModelos.create',
            'description' => 'Crear meta modelos'
        ])->syncRoles([$role_admin]);
        Permission::firstOrCreate([
            'name' => 'admin.metaModelos.edit',
            'description' => 'Editar meta modelos'
        ])->syncRoles([$role_admin]);
        Permission::firstOrCreate([
            'name' => 'admin.metaModelos.destroy',
            'description' => 'Eliminar meta modelos'
        ])->syncRoles([$role_admin]);

        Permission::firstOrCreate([
            'name' => 'admin.prueba',
            'description' => 'prueba'
        ])->syncRoles([$role_admin]);


        //EMPRESA
        Permission::firstOrCreate([
            'name' => 'admin.empresas',
            'description' => 'Ver, crear, editar, eliminar, menu empresa'
        ])->syncRoles([$role_admin]);

        //IMPUESTOS
        Permission::firstOrCreate([
            'name' => 'admin.impuestos',
            'description' => 'Ver, crear, editar, eliminar, menu impuesto'
        ])->syncRoles([$role_admin]);

        //TIPOUSUARIOS
        Permission::firstOrCreate([
            'name' => 'admin.tipoUsuarios',
            'description' => 'Ver, crear, editar, eliminar, menu tipo usuarios'
        ])->syncRoles([$role_admin]);

        //TIPOTURNOS
        Permission::firstOrCreate([
            'name' => 'admin.tipoTurnos',
            'description' => 'Ver, crear, editar, eliminar,menu tipo turnos'
        ])->syncRoles([$role_admin]);

        //TIPOROOMS
        Permission::firstOrCreate([
            'name' => 'admin.tipoRooms',
            'description' => 'Ver, crear, editar, eliminar, menu tipo rooms'
        ])->syncRoles([$role_admin]);

        //TIPOMULTAS
        Permission::firstOrCreate([
            'name' => 'admin.tipoMultas',
            'description' => 'Ver, crear, editar, eliminar, menu tipo multas'
        ])->syncRoles([$role_admin]);

        //TIPODESCUENTOS
        Permission::firstOrCreate([
            'name' => 'admin.tipoDescuentos',
            'description' => 'Ver, crear, editar, eliminar, menu tipo descuentos'
        ])->syncRoles([$role_admin]);

        //TIPOPAGINAS
        Permission::firstOrCreate([
            'name' => 'admin.paginas',
            'description' => 'Ver, crear, editar, eliminar, menu paginas'
        ])->syncRoles([$role_admin]);

        //PERMISOS CERTIFICACIONES
        Permission::firstOrCreate([
            'name' => 'admin.certificaciones',
            'description' => 'Ver menu certificaiones'
        ])->syncRoles([$role_admin]);

        Permission::firstOrCreate([
            'name' => 'admin.certificacion.laboral',
            'description' => 'Ver y generar  menu certificacion laboral'
        ])->syncRoles([$role_admin]);

        Permission::firstOrCreate([
            'name' => 'admin.certificacion.tiempo',
            'description' => 'Ver y generar  menu certificacion tiempo'
        ])->syncRoles([$role_admin]);

        Permission::firstOrCreate([
            'name' => 'admin.certificacion.impuesto',
            'description' => 'Ver y generar  menu certificacion impuesto'
        ])->syncRoles([$role_admin]);

        Permission::firstOrCreate([
            'name' => 'admin.certificacion.pago',
            'description' => 'Ver y generar  menu certificacion pago'
        ])->syncRoles([$role_admin]);


        //PERMISOS REGISTRO MULTAS
        Permission::firstOrCreate([
            'name' => 'admin.registroMultas.index',
            'description' => 'Ver listado de multas'
        ])->syncRoles([$role_admin, $role_monitor, $role_modelo]);
        Permission::firstOrCreate([
            'name' => 'admin.registroMultas.create',
            'description' => 'Crear multas'
        ])->syncRoles([$role_admin, $role_monitor]);
        Permission::firstOrCreate([
            'name' => 'admin.registroMultas.edit',
            'description' => 'Editar multas'
        ])->syncRoles([$role_admin, $role_monitor]);
        Permission::firstOrCreate([
            'name' => 'admin.registroMultas.destroy',
            'description' => 'Eliminar multas'
        ])->syncRoles([$role_admin, $role_monitor]);

        //PERMISOS REGISTRO ASISTENCIAS
        Permission::firstOrCreate([
            'name' => 'admin.registroAsistencias.index',
            'description' => 'Ver listado de asistencia'
        ])->syncRoles([$role_admin, $role_monitor, $role_modelo]);
        Permission::firstOrCreate([
            'name' => 'admin.registroAsistencias.create',
            'description' => 'Crear asistencia'
        ])->syncRoles([$role_admin, $role_monitor]);
        Permission::firstOrCreate([
            'name' => 'admin.registroAsistencias.edit',
            'description' => 'Editar asistencia'
        ])->syncRoles([$role_admin, $role_monitor]);
        Permission::firstOrCreate([
            'name' => 'admin.registroAsistencias.destroy',
            'description' => 'Eliminar asistencia'
        ])->syncRoles([$role_admin, $role_monitor]);
        Permission::firstOrCreate([
            'name' => 'admin.registroAsistencias.control',
            'description' => 'Ver columna de control'
        ])->syncRoles([$role_admin, $role_monitor, $role_modelo]);

        //PERMISOS REGISTRO PRODUCCION
        Permission::firstOrCreate([
            'name' => 'admin.registroProduccion.index',
            'description' => 'Ver listado de produccion'
        ])->syncRoles([$role_admin, $role_monitor, $role_modelo]);
        Permission::firstOrCreate([
            'name' => 'admin.registroProduccion.resumen',
            'description' => 'Ver resumen produccion'
        ])->syncRoles([$role_admin, $role_monitor]);
        Permission::firstOrCreate([
            'name' => 'admin.registroProduccion.create',
            'description' => 'Crear produccion'
        ])->syncRoles([$role_admin, $role_monitor]);
        Permission::firstOrCreate([
            'name' => 'admin.registroProduccion.edit',
            'description' => 'Editar produccion'
        ])->syncRoles([$role_admin, $role_monitor]);
        Permission::firstOrCreate([
            'name' => 'admin.registroProduccion.destroy',
            'description' => 'Eliminar produccion'
        ])->syncRoles([$role_admin, $role_monitor]);

        //PERMISOS REGISTRO DESCUENTOS
        Permission::firstOrCreate([
            'name' => 'admin.registroDescuentos.index',
            'description' => 'Ver listado de descuentos'
        ])->syncRoles([$role_admin, $role_monitor, $role_modelo]);
        Permission::firstOrCreate([
            'name' => 'admin.registroDescuentos.create',
            'description' => 'Crear descuentos'
        ])->syncRoles([$role_admin, $role_monitor]);
        Permission::firstOrCreate([
            'name' => 'admin.registroDescuentos.edit',
            'description' => 'Editar descuentos'
        ])->syncRoles([$role_admin, $role_monitor]);
        Permission::firstOrCreate([
            'name' => 'admin.registroDescuentos.destroy',
            'description' => 'Eliminar descuentos'
        ])->syncRoles([$role_admin, $role_monitor]);
        Permission::firstOrCreate([
            'name' => 'admin.registroDescuentos.total',
            'description' => 'Ver boton descuento total'
        ])->syncRoles([$role_admin, $role_monitor]);
        Permission::firstOrCreate([
            'name' => 'admin.registroDescuentos.parcial',
            'description' => 'Ver boton descuento parcial'
        ])->syncRoles([$role_admin, $role_monitor]);


        //PERMISOS REPORTE APGINAS
        Permission::firstOrCreate([
            'name' => 'admin.reportePaginas.index',
            'description' => 'Ver listado de produccion'
        ])->syncRoles([$role_admin, $role_monitor]);






        // //PERMISOS EMPRESA
        // Permission::firstOrCreate(['name'=>'admin.empresa.index',
        //     'description'=>'Ver listado de empresas'])->syncRoles([$role_admin]);
        // Permission::firstOrCreate(['name'=>'admin.empresa.create',
        //     'description'=>'Crear empresas'])->syncRoles([$role_admin]);
        // Permission::firstOrCreate(['name'=>'admin.empresa.edit',
        //     'description'=>'Editar empresas'])->syncRoles([$role_admin]);
        // Permission::firstOrCreate(['name'=>'admin.empresa.destroy',
        //     'description'=>'Eliminar Empresas'])->syncRoles([$role_admin]);

        $userEmail = 'admin@gmail.com';
        $userCedula = '111111111';

        // Verificar si el usuario ya existe por correo electrónico o cédula
        $existingUser = User::where('email', $userEmail)->orWhere('cedula', $userCedula)->first();

        if (!$existingUser) {
            //CON EL FIN DE CREAR UN USUARIO de Soporte
            $user_soporte = new User();
            $user_soporte->fechaIngreso = Carbon::now();
            $user_soporte->name = 'Super Usuario';
            $user_soporte->cedula = '111111111';
            $user_soporte->celular = '11111111';
            $user_soporte->direccion = 'Super';
            $user_soporte->email = 'admin@gmail.com';
            $user_soporte->email_verified_at = '2023-05-11 22:39:30';
            $user_soporte->tipoUsuario_id = 2;
            // $user_soporte->empresa_id = 1;
            $user_soporte->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; //password
            $user_soporte->syncRoles([$role_admin]);
            $user_soporte->save();

            $user_soporte->hasAnyRole('writer', 'reader');
        }
    }
}
