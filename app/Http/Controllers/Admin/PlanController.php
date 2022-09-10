<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Plan;
use Illuminate\Support\Facades\Gate;

class PlanController extends Controller
{
    public function index($id){
        $apartment = Apartment::findOrFail($id);
        $plans = Plan::all();

        $response = Gate::inspect('view', $apartment);

        if ($response->allowed()) {
            return view('admin.sponsored.index',compact('apartment','plans'));
        } else {
            return view('admin.policy', compact('response'));
        }
    }


    public function store($id,Request $request){
        $apartment = Apartment::findOrFail($id);
        $request->validate($this->getValidationRules());
        $data = $request->all();



        $purchase = strtotime("now");
    
        if ($data['duration'] == 24) {

            $expiration = strtotime("+1 day");
            
        } else if ($data['duration'] == 72) {

            $expiration = strtotime("+3 day");
            
        } else {

            $expiration = strtotime("+6 day");
            
        }

        
        $data_plan = [
            'plan_id' => $data['plan_id'],
            'date_of_purchase'=>date('Y-m-d', $purchase),
            'date_of_expiration'=>date('Y-m-d', $expiration),
        ];
        
        $date_of_expiration= date('Y-m-d', $expiration);
        
        // dd($data_plan);
        // $data_sent = {
        //     'plan_id'
        // };

        // dd($data);

        // $apartment->plans()->attach($data['plan_id']);
        $apartment->plans()->attach([$data_plan]);

        return redirect()->route('admin.apartments.show', ['apartment' => $apartment->id]);
    }
    
    


    private function getValidationRules()
    {
        return [
            'plan_id' => 'required|numeric',
            'name'=> 'required|max:255',
            'price'=> 'required|numeric',
            'duration'=> 'required|numeric',
        ];
    }
}
