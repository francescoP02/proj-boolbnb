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
        $optionals = Optional::all();
        $apartments = Apartment::where([["rooms_number", ">=", $rooms], ["beds_number", ">=", $beds]])->get();

        // $apartments->optionals()->where("id", 1)->get();

        $ap_with_op = [];
        foreach ($apartments as $apartment) {
            if ($apartment->optionals()->where("id", 1)->first() && $apartment->optionals()->where("id", 2)->first() && $apartment->optionals()->where("id", 3)->first()) {
                $ap_with_op[] = $apartment;
            }
            if ($apartment->image) {
                $apartment->image = url('storage/' . $apartment->image);
            }
        }

        // foreach ($ap_with_op as $apartment) {
        //     if ($apartment->image) {
        //         $apartment->image = url('storage/' . $apartment->image);
        //     }
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
