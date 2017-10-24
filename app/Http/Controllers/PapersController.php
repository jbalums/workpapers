<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Folders;
use App\Papers;

class PapersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $papers = Papers::all();
        return response()->json([$papers]);
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
            'reference_code' => 'required',
            'title' => 'required', 
            'context' => 'required', 
            'folder_id' => 'required|exists:folders,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 400);
        }

        $workPaper = Papers::create($request->all());

        if ($workPaper) {
            return response()->json(['success'=>true, 'msg' => 'Working Paper Succesfully Added'], 200);
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
        //
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
        $validator = \Validator::make($request->all(), [
            'title' => 'required', 
            'reference_code' => 'required',
            'context' => 'required', 
            'folder_id' => 'required|exists:folders,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 400);
        }

        $working_paper = Papers::find($id);
        $working_paper->title = $request->get('title');
        $working_paper->reference_code = $request->get('reference_code');
        $working_paper->context = $request->get('context');
        $working_paper->folder_id = $request->get('folder_id');

        if ($working_paper->save()) {
            return response()->json(['success'=>true, 'msg' => 'Working Paper Succesfully Updated'], 200);
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
        $paper = Papers::find($id);
        if(isset($paper)){
            if ($paper->delete()) {
                return response()->json(['success'=>true, 'msg' => 'Working Paper Succesfully Deleted'], 200);
            }            
        }else{
            return response()->json(['success'=>false, 'msg' => 'Working Paper not found'], 400);
        }
    }

}
