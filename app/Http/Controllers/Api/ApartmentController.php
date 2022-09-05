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
        $optionals = Optional::all();
        $apartments = Apartment::where([["rooms_number", ">=", $rooms], ["beds_number", ">=", $beds]])->get();


        // $ap_with_op = [];


        // // foreach ($apartments as $apartment) {
        // //     if ($req_op) {
        // //         if ($apartment->optionals()->where("id", $req_op)->first()) {
        // //             $ap_with_op[] = $apartment;
        // //         }
        // //     } else {
        // //         $ap_with_op[] = $apartment;
        // //     }
        // //     if ($apartment->image) {
        // //         $apartment->image = url('storage/' . $apartment->image);
        // //     }
        // // }



        // foreach ($apartments as $apartment) {
        //     if ($req_op) {
        //         foreach ($req_op as $sing_op) {
        //             if ($apartment->optionals()->where("id", $sing_op)->first()) {
        //                 if (!in_array($apartment, $ap_with_op)) {
        //                     $ap_with_op[] = $apartment;
        //                 }
        //             } else {
        //                 $ap_with_op = array_diff($ap_with_op, [$apartment]);
        //             }
        //         }
        //     } else {
        //         $ap_with_op[] = $apartment;
        //     }
        //     if ($apartment->image) {
        //         $apartment->image = url('storage/' . $apartment->image);
        //     }
        // }



        $ap_with_op = $apartments;
        foreach ($apartments as $index => $apartment) {
            if ($req_op) {
                foreach ($req_op as $sing_op) {
                    if (!($apartment->optionals()->where("id", $sing_op)->first())) {
                        unset($ap_with_op[$index]);
                    }
                }
            }
        }




        return response()->json([
            'success' => true,
            'results' => [
                'apartments' => $apartments,
                'optionals' => $optionals,
            ]
        ]);
    }
}
