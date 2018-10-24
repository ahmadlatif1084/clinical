<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Url;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patient = Patient::where('user_id', Auth::user()->id)->get();
        $visits=0;
        return view('home', array(
                'patient' => $patient,
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imageName = $request->file('filebutton-normal')->getClientOriginalName();
        $request->file('filebutton-normal')->move(
            base_path() . '/public/uploads/', $imageName
        );
        $patient = new Patient;
        $patient->user_id = Auth::user()->id;
        $patient->name = $request->name;
        $patient->age = $request->age;
        $patient->gender = $request->gender;
        $patient->address = $request->address;
        $patient->phone = $request->phone;
        $patient->mobile = $request->mobile;
        $patient->paidamount = $request->paidamount;
        $patient->remainingamount = $request->remainingamount;
        $patient->isdeleted = '0';
        $patient->image_url = $imageName;
        $patient->save();
        return redirect()->action(
            'PatientController@index'
        )->with('status', 'Patient Added Successfully !');


        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        dd($patient);

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        $patient = Patient::find($patient->id);
        return view('editpatient', array(
                'patient' => $patient
            )
        );
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $file = $request->file('filebutton-normal');
        if ($file) {
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path() . '/uploads/';
            $file->move($destinationPath, $fileName);
            $patient = Patient::where('id', $patient->id)
                ->update(
                    [
                        'name' => $request->name,
                        'age' => $request->age,
                        'gender' => $request->gender,
                        'address' => $request->address,
                        'phone' => $request->phone,
                        'mobile' => $request->mobile,
                        'paidamount' => $request->paidamount,
                        'remainingamount' => $request->remainingamount,
                        'isdeleted' => '0',
                        'image_url' => $fileName
                    ]);
            return redirect()->action(
                'PatientController@index'
            )->with('status', 'Patient Edited Successfully !');
        } else {
            $patient = Patient::where('id', $patient->id)
                ->update(
                    [
                        'name' => $request->name,
                        'age' => $request->age,
                        'gender' => $request->gender,
                        'address' => $request->address,
                        'phone' => $request->phone,
                        'mobile' => $request->mobile,
                        'paidamount' => $request->paidamount,
                        'remainingamount' => $request->remainingamount,
                        'isdeleted' => '0'
                    ]);
            return redirect()->action(
                'PatientController@index'
            )->with('status', 'Patient Edited Successfully !');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient = Patient::find($patient->id);
        $patient->delete();
        return response()->json(['status' => 'success']);

        //
    }

    public function search(Request $request)

    {
        if ($request->ajax()) {
            $output = "";
            $patient = Patient::where('name', 'LIKE', '%' . $request->search . "%")->get();
            if ($patient) {
                $output .='<ul class="patient-ul">';
                foreach ($patient as $key => $patient) {
                    $output .= '<li class="patient-li"><a class="patient-a"href="search/'.$patient->id .'">'
                         . $patient->name .
                        '</a></li>';
                }
                $output .='</ul>';
                return Response($output);
            }
        }
    }

    public function searchbyid(Request $request){
        $patient = Patient::where('id', $request->id)->first();
        $visits=0;
        if(count($patient->multipleappointment)>0){
            $visits=count($patient->multipleappointment);
        }
        //dd($count);
        return view('patientview', array(
                'patient' => $patient,
                'visits' => $visits
            )
        );
    }

}

