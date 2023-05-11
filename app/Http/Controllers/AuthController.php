<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistroRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegistroRequest $request){
        //Validar registro
         $data=$request -> validated();

         //Crear el usuario
         $user = User::create([
            'codigo'=>$data['codigo'],
            'name' => $data['name'],
            'email' => $data['email'],
            'role'=> $data['role'],
            'password' =>bcrypt($data['password']),
         ]);

         //Retornar una respuesta
         return[
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
         ];
    }

    public function login(LoginRequest $request){
        
        $data = $request->validated();

        //Revisar el password
        if(!Auth::attempt($data)){
            return response([
               
               'errors' => ['Email o Contraseña incorrectos']
               
            ],422);
        }

        $user = Auth::user();
        return[
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
         ];

    }

    public function logout(Request $request){
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return[
            'user'=>null,
        ];
    }
    
    public function update(Request $request, User $usuario){

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->role = $request->role;
        
        $usuario->save();
    }




}
