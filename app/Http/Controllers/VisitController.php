<?php

namespace App\Http\Controllers;

use App\DiagnoseMedication;
use App\DiagnoseVisit;
use App\MedicationVisit;
use App\Visit;
use App\VisitDiagnose;
use App\VisitMedication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $visit = Visit::where('user_id',Auth::user()->id)->get();
//       $visit = Visit::where('user_id',Auth::user()->id)->first();
//        dd($visit->medication);
        return view('visit', array(
                'visit'=> $visit
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
        $visit = new Visit;
        $visit->user_id = Auth::user()->id;
        $visit->patient_id = $request->patient;
        $visit->visit_date = $request->visit_date;
        $visit->next_visit_date = $request->next_visit_date;
        $visit->visit_details = $request->visit_details;
        $visit->save();

        $cntmedication=count($request->medication);
        for ($i=0;$i<$cntmedication;$i++){
            $visitmedicine=new MedicationVisit();
            $visitmedicine->visit_id = $visit->id;
            $visitmedicine->medication_id = $request->medication[$i];
            $visitmedicine->save();
        }

        $cntdiagnose=count($request->diagnose);
        for ($i=0;$i<$cntdiagnose;$i++){
            $visitdiagnose=new DiagnoseVisit;
            $visitdiagnose->visit_id = $visit->id;
            $visitdiagnose->diagnose_id = $request->diagnose[$i];
            $visitdiagnose->save();
        }

        return redirect()->action(
            'VisitController@index'
        )->with('status', 'Visit Added Successfully !');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function show(Visit $visit)
    {

        $visit = Visit::where(
            array(
                'user_id'=>Auth::user()->id,
                'id'=>$visit->id,
            )
        )->get();
        return view('visit', array(
                'visit'=> $visit
            )
        );
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function edit(Visit $visit)
    {
        $visit = Visit::find($visit->id);
        // dd($complaint);
        return view('editvisit', array(
                'visit' => $visit
            )
        );
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visit $visit)
    {
        $id=$visit->id;
      $visit = Visit::where('id', $id)
            ->update(
                [
                    'patient_id' => $request->patient,
                    'visit_date' => $request->visit_date,
                    'next_visit_date' => $request->next_visit_date,
                    'visit_details' => $request->visit_details,
                ]);
        $medicine = MedicationVisit::where('visit_id',$id)->delete();
        $Diagnosevisit = DiagnoseVisit::where('visit_id',$id)->delete();
        if($medicine && $Diagnosevisit) {
            $cntmedication = count($request->medication);
            for ($i = 0; $i < $cntmedication; $i++) {
                $visitmedicine = new MedicationVisit();
                $visitmedicine->visit_id = $id;
                $visitmedicine->medication_id = $request->medication[$i];
                $visitmedicine->save();
            }

            $cntdiagnose = count($request->diagnose);
            for ($i = 0; $i < $cntdiagnose; $i++) {
                $visitdiagnose = new DiagnoseVisit;
                $visitdiagnose->visit_id = $id;
                $visitdiagnose->diagnose_id = $request->diagnose[$i];
                $visitdiagnose->save();
            }
        }
        return redirect()->action(
            'VisitController@index'
        )->with('status', 'Visit Edited Successfully !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visit $visit)
    {
        $medicine = MedicationVisit::where('visit_id', $visit->id)->delete();
        $Diagnosevisit = DiagnoseVisit::where('visit_id', $visit->id)->delete();
        $visit = Visit::find($visit->id)->delete();
        return response()->json(['status' => 'success']);
        //
    }

    public function searchbyid(Request $request){
     //   return response()->json(['status' => 'success']);
        $medicine = MedicationVisit::where('visit_id', $request->id)->get();
        $Diagnosevisit = DiagnoseVisit::where('visit_id', $request->id)->get();
       return response()->json(['status' => 'success','medicine'=>$medicine,'Diagnosevisit'=>$Diagnosevisit]);
    }
}
