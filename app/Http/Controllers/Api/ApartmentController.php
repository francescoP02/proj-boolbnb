<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Apartment;
use App\Optional;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ApartmentController extends Controller
{
    public function index(Request $request) {
        $rooms = $request->rooms;
        $beds = $request->beds;
        $req_optionals = $request->optionals;
        $optionals = Optional::all();
        $apartments = Apartment::where([["rooms_number", ">=", $rooms],["beds_number", ">=", $beds]])->with("optionals")->paginate(12);
        // $apartments = Apartment::where("rooms_number", ">=", $rooms)->where("beds_number", ">=", $beds)->wherePivot('optional_id', 1)->paginate(12);
        foreach ($apartments as $apartment) {
            if($apartment->image) {
                $apartment->image = url('storage/' . $apartment->image);
            }
        }
        return response()->json([
            'success' => true,
            'results' => [
                'apartments'=>$apartments,
                'optionals' =>$optionals,
            ]
        ]);
    }

}
