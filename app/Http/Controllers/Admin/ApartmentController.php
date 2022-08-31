<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Apartment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Optional;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Gate;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $apartments=$user->apartments;
        // $apartments->user_id = $user->id;
        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $optionals = Optional::all();
        return view('admin.apartments.create', compact('optionals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate($this->getValidationRules());

        $data = $request->all();
        if (isset($data['image'])) {
            $image_path = Storage::put('apartment_images', $data['image']);
            $data['image'] = $image_path;
        }
        $apartment = new Apartment();
        $apartment->fill($data);
        $apartment->slug = Apartment::generateApartmentSlugFromTitle($apartment->title);
        // // $geoCode = Http::get("https://api.tomtom.com/search/2/geocode/Via%20Giuseppe%20Fanelli.json?typeahead=false&limit=10&ofs=0&view=Unified&key=Rdcw2GVNiNQGXTWrgewGKq9cwtVYNPRw")->json();

        // // $indirizzo = $data['address'];
        // // $geo = Http::get("https://api.tomtom.com/search/2/geocode/{$indirizzo}.json", [
        // //     'key' => 'Rdcw2GVNiNQGXTWrgewGKq9cwtVYNPRw',
        // //     'countrySet' => 'IT'
        // // ]);

        // // $geo_json = json_decode($geo);

        // $apiQuery = str_replace(' ', '-', $data['address']);
        // $response = file_get_contents('https://api.tomtom.com/search/2/geocode/' . $apiQuery . '.json?key=Rdcw2GVNiNQGXTWrgewGKq9cwtVYNPRw');
        // $response = json_decode($response);

        // dd($response);

        // // dd($response);

        // // $apartment->latitude = $response->results[0]->position->lat;
        // // $apartment->longitude = $response->results[0]->position->lon;

        $apartment->user_id = $user->id;
        $apartment->save();

        if (isset($data['optionals'])) {
            $apartment->optionals()->sync($data['optionals']);
        }

        return redirect()->route('admin.apartments.show', ['apartment' => $apartment->id]);
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    
    {   
        $apartment = Apartment::findOrFail($id);
        $response = Gate::inspect('view', $apartment);
 
        if ($response->allowed()) {
            return view('admin.apartments.show', compact('apartment'));
        } else {
            return view('admin.policy',compact('response'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $apartment = Apartment::findOrFail($id);

        $response = Gate::inspect('update', $apartment);

        if ($response->allowed()) {
            $optionals = Optional::all();
            return view('admin.apartments.edit', compact('apartment', 'optionals'));
        } else {
            return view('admin.policy',compact("response"));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $request->validate($this->getValidationRules());
        
        $data = $request->all();
        
        $apartment = Apartment::findOrFail($id);

        if (isset($data['image'])) {
            if ($apartment->image) {
                Storage::delete($apartment->image);
            }
            $image_path = Storage::put('apartment_images', $data['image']);
            $data['image'] = $image_path;
        }

        // if (isset($data['address'])) {

        //     $apiQuery = str_replace(' ', '-', $data['address']);
        //     $response = file_get_contents('https://api.tomtom.com/search/2/geocode/' . $apiQuery . '.json?key=Rdcw2GVNiNQGXTWrgewGKq9cwtVYNPRw');
        //     $response = json_decode($response);

        //     // dd($response);

        //     $apartment->latitude = $response->results[0]->position->lat;
        //     $apartment->longitude = $response->results[0]->position->lon;
            
        // }

        $apartment->update($data);
        $apartment->slug = Apartment::generateApartmentSlugFromTitle($apartment->title);
        $apartment->save();

        if (isset($data['optionals'])) {
            $apartment->optionals()->sync($data['optionals']);
        } else {
            $apartment->optionals()->sync([]);
        }

        return redirect()->route('admin.apartments.show', ['apartment' => $apartment->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apartment = Apartment::findOrFail($id);

        $response = Gate::inspect('update', $apartment);

        if ($response->allowed()) {
            if($apartment->image) {
                Storage::delete($apartment->image);
            }
            $apartment->optionals()->sync([]);
            $apartment->delete();
            return redirect()->route('admin.apartments.index');
        } else {
            return view('admin.policy',compact("response"));
        }

    }

    private function getValidationRules() {
        return [
            'title' => 'required|max:255',
            'rooms_number' => 'required|numeric|between:1,10',
            'beds_number' => 'required|numeric|between:1,10',
            'bathroom_number' => 'nullable|numeric|between:0,10',
            'square_metres' => 'nullable|numeric',
            'address' => 'required|max:255',
            'latitude' => 'required|numeric|between:-180,180',
            'longitude' => 'required|numeric|between:-90,90',
            'image' => 'nullable|image|max:512',
            'visible' => 'nullable',
        ];
    }
}
