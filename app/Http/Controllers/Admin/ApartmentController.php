<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Optional;

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
        return view('admin.apartments.show', compact('apartment'));
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
        $optionals = Optional::all();
        return view('admin.apartments.edit', compact('apartment', 'optionals'));
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
        if($apartment->image) {
            Storage::delete($apartment->image);
        }
        $apartment->optionals()->sync([]);
        $apartment->delete();
        return redirect()->route('admin.apartments.index');
    }

    private function getValidationRules() {
        return [
            'title' => 'required|max:255',
            'rooms_number' => 'required|numeric',
            'beds_number' => 'required|numeric',
            'bathroom_number' => 'nullable|numeric',
            'square_metres' => 'nullable|numeric',
            'address' => 'required|max:255',
            'image' => 'nullable|image|max:512',
            'visible' => 'nullable',
        ];
    }
}
