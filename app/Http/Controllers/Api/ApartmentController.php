<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Apartment;
use App\Optional;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        $rooms = $request->rooms;
        $beds = $request->beds;
        $req_op = $request->optionals;
        $og_lat = $request->lat;
        $og_lon = $request->lon;
        $distance = $request->dist;
        $optionals = Optional::all();
        $apartments = Apartment::where([["rooms_number", ">=", $rooms], ["beds_number", ">=", $beds]])->get();

        $ap_with_op = $apartments;
        foreach ($apartments as $index => $apartment) {
            if ($req_op) {
                foreach ($req_op as $sing_op) {
                    if (!($apartment->optionals()->where("id", $sing_op)->first())) {
                        unset($ap_with_op[$index]);
                    }
                }
            }

            if ($apartment->image) {
                $apartment->image = url('storage/' . $apartment->image);
            }

            $R = 6371; // km 
            $dLat = ($apartment->latitude - $og_lat) * pi() / 180; 
            $dLon = ($apartment->longitude - $og_lon) * pi() / 180; 
            $lat1 = ($og_lat) * pi() / 180; 
            $lat2 = ($apartment->latitude) * pi() / 180; 
            $a = sin($dLat/2) * sin($dLat/2) +sin($dLon/2) * sin($dLon/2) * cos($lat1) * cos($lat2); 
            $c = 2 * atan2(sqrt($a), sqrt(1-$a)); 
            $d = $R * $c;

            if ($d > $distance){
                unset($ap_with_op[$index]);
            };
        };


        // $prova = calcCrow(12, 22, 11, 21);

        // function calcCrow($lat1, $lon1, $lat2, $lon2){ 
        //     $R = 6371; // km 
        //     $dLat = toRad($lat2-$lat1); 
        //     $dLon = toRad($lon2-$lon1); 
        //     $lat1 = toRad($lat1); 
        //     $lat2 = toRad($lat2); 
        //     $a = sin($dLat/2) * sin($dLat/2) +sin($dLon/2) * sin($dLon/2) * cos($lat1) * cos($lat2); 
        //     $c = 2 * atan2(sqrt($a), sqrt(1-$a)); 
        //     $d = $R * $c;
        //     return $d; 
        // };
    
        // Converts numbersc degrees to radians 
        // function toRad($Value) { 
        //     return $Value * pi() / 180; 
        // }

        return response()->json([
            'success' => true,
            'results' => [
                'apartments' => $ap_with_op,
                'optionals' => $optionals,
            ]
        ]);
        
    }

}
