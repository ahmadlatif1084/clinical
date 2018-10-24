<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App;
use Lang;

class LanguageController extends Controller
{
    //

    public function changeLanguage(Request $request){
        $request->session()->put('locale', $request->local);
        $request->session()->flash('alert-success',('app.Locale_Change_Success'));
//        return $request;
//      return  $request;
//        if($request->ajax){
//            $request->session()->put('locale', $request->local);
//            $request->session()->flash('alert-success',('app.Locale_Change_Success'));
//            return  $request->local;
//        }
    }
}
