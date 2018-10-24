
<?php
if (! function_exists('getPatient')) {
function getPatient() {

    $patient = \App\Patient::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->get();
    return $patient;
    // ...
}
}

if (! function_exists('getPatientbyid')) {
    function getPatientbyid($id) {
        $patient = \App\Patient::where(
            array(
                'id'=> $id,
                'user_id'=>\Illuminate\Support\Facades\Auth::user()->id
            )
        )->first();

        return $patient->name;
        // ...
    }
    }

    if (! function_exists('getMedication')) {
        function getMedication()
        {
            $medication = \App\Medication::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->get();
            return $medication;
        }
            // ...
        }

if (! function_exists('getDiagnose')) {
    function getDiagnose()
    {
        $diagnose = \App\Diagnose::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->get();
        return $diagnose;
    }
    // ...
}

?>