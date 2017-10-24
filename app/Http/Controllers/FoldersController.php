<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Folders;
class FoldersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $folders = Folders::all();
        return response()->json([$folders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 400);
        }

        $folder = Folders::create($request->all());

        if ($folder) {
            return response()->json(['success'=>true, 'msg' => 'New Folder Succesfully Added'], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $folder = Folder::find($id);
        return response()->json([$folder]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $validator = \Validator::make($request->all(), [
                'code' => 'required',
                'name' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()], 400);
            }

            $folder = Folders::find($id);
            $folder->code = $request->get('code');
            $folder->name = $request->get('name');

            if ($folder->save()) {
                return response()->json(['success'=>true, 'msg' => 'Folder Succesfully Updated'], 200);
            }
        } catch (Exception $e) {
            return response()->json(['success'=>false, 'msg' => 'Folder not found'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $folder = Folders::find($id);
        if(isset($folder)){
            if ($folder->delete()) {
                return response()->json(['success'=>true, 'msg' => 'Folder Succesfully Deleted'], 200);
            }            
        }else{
            return response()->json(['success'=>false, 'msg' => 'Folder not found'], 400);
        }
    }

    public function get_all_papers($id)
    { 
        $folder = Folders::find($id);
        if(isset($folder)){
            return response()->json([$folder->papers]);
        }else{
            return response()->json(['success'=>false, 'msg' => 'Folder not found'], 400);
        }
    }
}
