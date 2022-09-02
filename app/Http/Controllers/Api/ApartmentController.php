<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index(Request $request) {
        $rooms = $request->rooms;
        $beds = $request->beds;
        $apartments = Apartment::where("rooms_number", ">=", $rooms)->where("beds_number", ">=", $beds)->paginate(12);
        foreach ($apartments as $apartment) {
            if($apartment->image) {
                $apartment->image = url('storage/' . $apartment->image);
            } 
        }
        return response()->json([
            'success' => true,
            'results' => $apartments,
        ]);
    }

}
