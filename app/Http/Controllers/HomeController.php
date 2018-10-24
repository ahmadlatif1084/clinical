<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Patient;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patient = Patient::where('user_id',Auth::user()->id)->get();
        return view('home', array(
                'patient'=> $patient
            )
        );
    }

    public function sidebar()
    {

        return view('sidebar');
    }

    public function setting()
    {

        $User= User::where('id',Auth::user()->id)->get();
        $locale = App::getLocale();
//        die($locale);
        return view('setting', array(
                'user'=> $User
            )
        );
    }

    public function update(Request $request, User $user)
    {
            $User=User::where('id', $request->id)
                ->update(
                    [
                        'name' =>$request->name,
                        'email' => $request->email,
                        'password' =>bcrypt($request->pass2)
                    ]);
            return redirect()->action(
                'HomeController@setting'
            )->with('status', 'User Edited Successfully !');
        }

        public function dashboard(){
            $User= User::all()->count();
            $Patient= Patient::all()->count();
            $Appointment = Appointment::all()->count();
            $today = date('Y-m-d' . ' 00:00:00', time());
            $appointmentsdetails = Appointment::whereDate('start_time', $today)->get();
            return view('dashobardsection', array(
                    'user'=> $User,
                    'patient'=> $Patient,
                    'appointment'=> $Appointment,
                    'appointmentsdetails'=> $appointmentsdetails,
                )
            );
        }


}
