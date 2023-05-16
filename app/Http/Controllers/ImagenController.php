<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request -> hasFile('file')){
            $file=$request->file('file');

            $filename = $file->getClientOriginalName();
            $filename = pathinfo($filename,PATHINFO_FILENAME);

            $name_file = str_replace(" ","_",$filename);

            $extension = $file->getClientOriginalExtension();

            $picture = $name_file.'.'.$extension;
            $file->move('C:\xampp\htdocs\react-bar\public\img',$picture);

            return[
                'message'=>'Imagen cargada',
            ];
        }else{
            return[
                'message'=>'No se guardó la imagen',
            ];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
