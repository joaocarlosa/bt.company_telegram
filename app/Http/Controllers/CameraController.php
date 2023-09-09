<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use Illuminate\Http\Request;

class CameraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cameras = Camera::all();        
        return view('cameras.cadastrar', ['cameras' => $cameras]);

    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Camera $camera)
    {
        return view('cameras.show', compact('camera'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cameras.cadastrar');

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
            'rtsp_link' => 'required',
            'area_name' => 'required',
            'camera_name' => 'required',
        ]);

        Camera::create($request->all());
        return redirect()->route('cameras.cadastrar');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Camera $camera)
    {
        return view('cameras.edit', compact('camera'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Camera $camera)
    {
        $camera->update($request->all());
        return redirect()->route('cameras.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $camera = Camera::findOrFail($id);        
        $camera->delete();
        return redirect()->route('cameras.cadastrar')->with('message', 'Câmera apagada com sucesso!');
    }


}
