<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB;
class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
        $users = DB::collection('car')->get();
       

        

       

         return response()->json($users);
    }

    public function Cars()
    {
        //
        $users = DB::collection('car')->get();
       

        

       

         return response()->json($users);
    }

    public function DistanceTraveled()
    {
        //

        $imei = Input::get('tracker');

        $start = DB::collection('spot')->where('imei',$imei)->orderBy('time', 'asc')->first(); // For Start Point
        
        
        

        $stop = DB::collection('spot')->where('imei',$imei)->orderBy('time', 'desc')->first(); // For End Point
        
        // It looks like some data has lat lng attribute and some has loc array with lat lng inside it... 
        // so we will use lat lng from loc when it is available... I don't know how it is implemented in your applicaiton

        if(isset($start['loc']))
        {
            $start['lat']=$start['loc'][0];
            $start['lng']=$start['loc'][1];
        }

        if(isset($stop['loc']))
        {
            $stop['lat']=$stop['loc'][0];
            $stop['lng']=$stop['loc'][1];
        }




        // IN ral Application, I think we will calculate distance between each adjacent spots stored in db and then add them UP. 
        // For this test task I am just ysing only the start and end point and caculate distance...


        $googleAPIUrl="http://maps.googleapis.com/maps/api/distancematrix/json?origins=".$start['lat'].",".$start['lng']."&destinations=".$stop['lat'].",".$stop['lng']."&mode=driving&language=en";

        //echo $googleAPIUrl;
        $ch = curl_init($googleAPIUrl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);      
        curl_close($ch);
        

        $output=json_decode($output);
        
        $distance = $output->rows[0]->elements[0]->distance;

         return response()->json($distance);
    }


  
}
