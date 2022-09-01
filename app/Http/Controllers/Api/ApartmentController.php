<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index() {
        $apartments = Apartment::all();
        return response()->json([
            'success' => true,
            'results' => $apartments,
        ]);
    }
}
