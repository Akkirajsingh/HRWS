<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

//Requests
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

//Models
use App\Models\Countries;
use App\Models\States;
use App\Models\Cities;


class GenericController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //List of countries
    public function getCountries()
    {
        $countries = Countries::pluck("name", "id");
        return $countries;
    }

    //List of states based on country_id
    public function getStateList(Request $request)
    {
        $states = States::where("country_id", $request->country_id)->pluck("name","id");
        return response()->json($states);
    }

    //List of cities based on state_id
    public function getCityList(Request $request)
    {
        $cities = Cities::where("state_id", $request->state_id)->pluck("name","id");
        return response()->json($cities);
    }
    

}
