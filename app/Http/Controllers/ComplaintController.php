<?php

namespace App\Http\Controllers;

use App\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complaint = Complaint::where('user_id',Auth::user()->id)->get();
        return view('complaints', array(
                'complaint'=> $complaint
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
        $complaint = new Complaint();
        $complaint->user_id = Auth::user()->id;
        $complaint->patient_id =$request->patient;
        $complaint->name = $request->name;
        $complaint->save();
        return redirect()->action(
            'ComplaintController@index'
        )->with('status', 'Complaint Added Successfully !');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function show(Complaint $complaint)
    {
        $complaint = Complaint::where(
           array(
               'user_id'=>Auth::user()->id,
               'id'=>$complaint->id,
           )
        )->get();
        return view('complaints', array(
                'complaint'=> $complaint
            )
        );
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function edit(Complaint $complaint)
    {
        $complaint = Complaint::find($complaint->id);
           // dd($complaint);
        return view('editcomplaint', array(
                'complaint' => $complaint
            )
        );
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Complaint $complaint)
    {

        $complaint = Complaint::where('id', $complaint->id)
            ->update(
                [
                    'patient_id' => $request->patient,
                    'name' => $request->name
                ]);
        return redirect()->action(
            'ComplaintController@index'
        )->with('status', 'Complaint Edited Successfully !');

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complaint $complaint)
    {
        $complaint = Complaint::find($complaint->id);
        $complaint->delete();
        return response()->json(['status' => 'success']);
        //
    }
}
