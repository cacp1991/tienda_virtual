<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\User\CreateUserRequest;


class UserController extends Controller
{

    //guardamos role

    public function createUser(CreateUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = new User($request->all());
            $user->save();
            $user->assignRole($request->role); // asignar role
            DB::commit();
            if ($request->ajax()) return response()->json($user, 201);
            return back()->with('success', 'User created');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function UpdateUsers( User $user, UpdateUserRequest $request  )
    {
        try {
            DB::beginTransaction();
            $allrequest = $request->all();
            if (isset($allrequest['password'])) {
                if (!$allrequest['password']) unset($allrequest['password']);
            }
            $user->update($request->all());
            DB::commit();

            if ($request->ajax()) return response()->json(['user' => $user->refresh()], 201);
            return back()->with('success', 'usuario editado');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }


    // traemos roles

    public function getAllRoles()  //api
    {
        $roles = Role::all()->pluck('name');
        return response()->json(['roles' => $roles], 200);
    }

    //blade roles
    public function showCreateUser()
    {
        $roles = $this->getAllRoles()->original['roles'];
        return view('CrudUsers.index.create', compact('roles'));
    }

    public function showEditUser(User $user)
    {
        $user->load('roles');
        $roles = $this->getAllRoles()->original['roles'];
        return view('CrudUsers.index.edit', compact('user', 'roles'));
    }

    //cuando esta el usuario logeado y selecciona del desplegable un modal esta ruta sigue como ejemplo users

    public function showUsers()
    {
        return view('CrudUsers.index');
    }

    //todo esto es para mostrar en el home
    public function showAllUsers()
    {
        $users = $this->getAllUsers()->original['users'];
        return view('CrudUsers.index', compact('users'));
    }

    public function getAllUsers()
    {
        $users = User::get();
        return response()->json(['users' => $users], 200);
    }


    public function getUser(User $user)
    {
        return response()->json(['user' => $user], 200);
    }




    // para guardar usuarios
    public function saveUser( CreateUserRequest $request)
    {
        $user = new User($request->all());
        $user->save();
        $user->assignRole($request->role);
        return response()->json(['users' => $user], 201);
    }

    //actualizar usuarios

    public function updateUser(User $user, CreateUserRequest $request)
    {
        $requestAll = $request->all();  //tomamos request
        $user->update($requestAll);
        $user->syncRoles([$request->role]);
        return response()->json(['user' => $user->refresh()], 201);
        // ->load('rol_id')
    }


    //eliminar usuario

    public function deleteUser(User $user)
    {
        $user->delete();
        return response()->noContent();
    }

    public function getAllUsersForDataTable()
    {
        $users = User::get();
        return DataTables::of($users)
            ->addColumn('actions', function ($row) {
                return "<a
				href='#'
				onclick='event.preventDefault();'
				data-id='{$row->id}'
				role='edit'
				class='btn btn-warning btn-sm'>Editar</a>
				<a

				onclick='event.preventDefault();'
				data-id='{$row->id}'
				role='delete'
				class='btn btn-danger btn-sm'>Eliminar</a>";
            })
            ->rawColumns(['actions'])
            ->make();
    }
}
