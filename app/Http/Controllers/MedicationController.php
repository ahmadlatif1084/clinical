<?php

namespace App\Http\Controllers;

use App\Medication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medication = Medication::where('user_id',Auth::user()->id)->get();
        return view('medication', array(
                'medication'=> $medication
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
        $medication = new Medication;
        $medication->user_id = Auth::user()->id;
        $medication->name = $request->name;
        $medication->save();
        return redirect()->action(
            'MedicationController@index'
        )->with('status', 'Medication Added Successfully !');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medication  $medication
     * @return \Illuminate\Http\Response
     */
    public function show(Medication $medication)
    {

        $medication = Medication::where(
            array(
                'user_id'=>Auth::user()->id,
                'id'=>$medication->id,
            )
        )->get();
        return view('medication', array(
                'medication'=> $medication
            )
        );
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medication  $medication
     * @return \Illuminate\Http\Response
     */
    public function edit(Medication $medication)
    {
        $medication = Medication::find($medication->id);
        // dd($complaint);
        return view('editmedication', array(
                'medication' => $medication
            )
        );
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medication  $medication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medication $medication)
    {
        $medication = Medication::where('id', $medication->id)
            ->update(
                [
                    'name' => $request->name
                ]);
        return redirect()->action(
            'MedicationController@index'
        )->with('status', 'Medication Edited Successfully !');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medication  $medication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medication $medication)
    {
        $medication = Medication::find($medication->id);
        $medication->delete();
        return response()->json(['status' => 'success']);
        //
    }
}
