<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointment = Appointment::where('user_id',Auth::user()->id)->get();
        return view('appointment', array(
                'appointment'=> $appointment
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
        $appointment = new Appointment ;
        $appointment->user_id=Auth::user()->id;
        $appointment->patient_id=$request->patient_id;
        $appointment->start_time = $request->start_time;
        $appointment->end_time = $request->end_time;
        $appointment->save();
        return redirect()->action(
            'AppointmentController@index'
        )->with('status', 'Appointment Added Successfully !');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        $appointment = Appointment::find($appointment->id);
        return view('editappointment', array(
                'appointment'=> $appointment
            )
        );
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {

        $appointment=Appointment::where('id', $appointment->id)
            ->update(
                [
                    'start_time' =>$request->start_time,
                    'end_time' => $request->end_time
                ]);
        return redirect()->action(
            'AppointmentController@index'
        )->with('status', 'Appointment Edited Successfully !');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointmentt=Appointment::find($appointment->id);
        $appointmentt->delete();
        return response()->json(['status' => 'success']);
        //
    }
}
