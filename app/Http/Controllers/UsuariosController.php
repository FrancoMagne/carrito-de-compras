<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsuariosController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:usuarios');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $usuarios = User::doesntHave('roles')->get();

        if($usuarios) {
            foreach($usuarios as $usuario) {
                $usuario->assignRole($usuario->rol);
            }
        }

        $usuarios = User::all()->where('rol', '!=', 'admin');

        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $roles = Role::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6']
        ]);

        $usuario = new User();
        $usuario->name = explode('@',$request->get('email'))[0];
        $usuario->email = $request->get('email');
        $usuario->password = Hash::make($request->get('password'));
        $usuario->rol = $request->get('rol');
        $usuario->assignRole($request->get('rol'));

        $usuario->save();

        emailRegister($usuario, $request->get('password'), true);

        return redirect('usuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        return view('admin.usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {
        $usuario->enabled = 1;
        
        $usuario->update();

        return redirect('usuarios')->with('actualizado', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        $usuario->enabled = 0;

        $usuario->update();

        return redirect('usuarios')->with('actualizado', 'ok');
    }
}
