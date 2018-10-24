<?php

namespace App\Http\Controllers;

use App\Diagnose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiagnoseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diagnose = Diagnose::where('user_id',Auth::user()->id)->get();
        return view('diagnose', array(
                'diagnose'=> $diagnose
            )
        );
        //
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
        $diagnose = new Diagnose;
        $diagnose->user_id = Auth::user()->id;
        $diagnose->name = $request->name;
        $diagnose->save();
        return redirect()->action(
            'DiagnoseController@index'
        )->with('status', 'Diagnose Added Successfully !');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Diagnose  $diagnose
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnose $diagnose)
    {
        $diagnose = Diagnose::where(
            array(
                'user_id'=>Auth::user()->id,
                'id'=>$diagnose->id,
            )
        )->get();
        return view('diagnose', array(
                'diagnose'=> $diagnose
            )
        );
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Diagnose  $diagnose
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagnose $diagnose)
    {
        $diagnose = Diagnose::find($diagnose->id);
        // dd($complaint);
        return view('editdiagnose', array(
                'diagnose' => $diagnose
            )
        );
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Diagnose  $diagnose
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diagnose $diagnose)
    {
        $diagnose = Diagnose::where('id', $diagnose->id)
            ->update(
                [
                    'name' => $request->name
                ]);
        return redirect()->action(
            'DiagnoseController@index'
        )->with('status', 'Diagnose Edited Successfully !');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Diagnose  $diagnose
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnose $diagnose)
    {
        $diagnose = Diagnose::find($diagnose->id);
        $diagnose->delete();
        return response()->json(['status' => 'success']);
        //
    }
}
