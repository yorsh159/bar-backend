<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsuarioCollection;
use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new UsuarioCollection(User::where('estado','1')->orderBy('name','asc')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(User $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $usuario)
    {   
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->role = $request->role;
        $password = $request->password;
        $pass=bcrypt($password);
        $usuario->password=$pass;
        $usuario->save();
        
        return [
           'usuario'=> $usuario,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,User $usuario)
    {
        //
        $usuario->estado = 0;
        $usuario->save();

        return[
            'usuario'=>$usuario,
        ];
    }
}
