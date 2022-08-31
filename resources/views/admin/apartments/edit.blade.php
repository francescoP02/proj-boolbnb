@extends('layouts.dashboard')

@section('content')
    <h1>Modify apartment</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('admin.apartments.update', ['apartment' => $apartment->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" onkeyup="controlForm()" name="title" id="title" value="{{old('title') ? old('title') : $apartment->title }}">
        </div>

        <div class="mb-3">
            <label for="image">Immagine di copertina</label>
            <input type="file" id="image" name="image">

            @if ($apartment->image)
                <h5>Immagine attuale</h5>
                <img src="{{ asset('storage/' . $apartment->image) }}" alt="">
            @endif
        </div>

        <div class="mb-3">
            <label for="rooms_number">Number of rooms:</label>
            <select class="form-select" aria-label="Default select example" name="rooms_number" id="rooms_number" onclick="controlForm()">
                <option value="null">None</option>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{$i}}" {{ (old('rooms_number', $apartment->rooms_number) == $i) ? 'selected' : '' }}>{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            <label for="beds_number">Number of beds:</label>
            <select class="form-select" aria-label="Default select example" name="beds_number" id="beds_number" onclick="controlForm()">
                <option value="null">None</option>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{$i}}" {{ (old('beds_number', $apartment->beds_number) == $i) ? 'selected' : '' }}>{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            <label for="bathroom_number">Number of bathrooms:</label>
            <select class="form-select" aria-label="Default select example" name="bathroom_number" id="bathroom_number">
                <option value="0">None</option>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{$i}}" {{ (old('bathroom_number', $apartment->bathroom_number) == $i) ? 'selected' : '' }}>{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            <label for="square_metres" class="form-label">Square metres:</label>
            <input type="number" class="form-control" name="square_metres" id="square_metres" value="{{old('square_metres') ? old('square_metres') : $apartment->square_metres }}">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <textarea type="text" class="form-control" name="address" id="address" onkeyup="controlForm()">{{ old('address') ? old('address') : $apartment->address }}</textarea>
        </div>
        <div class="my-3">
            <h4>Optionals:</h4>
            @foreach ($optionals as $optional)
            <div class="form-check">

                <input name="optionals[]" class="form-check-input" type="checkbox" value="{{$optional->id}}" id="optional-{{$optional->id}}" {{ ($apartment->optionals->contains($optional) || in_array($optional->id, old('optionals', []))) ? 'checked' : '' }}>
                <label class="form-check-label" for="optional-{{$optional->id}}">
                {{$optional->name}}
                </label>

            </div>
        @endforeach
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" name="visible" id="visible1" value="1" {{ (old('visible', $apartment->visible) == 1) ? 'checked' : '' }}>
            <label class="form-check-label" for="flexSwitchCheckChecked">Visible</label>
        </div>
        <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
    </form>
@endsection

<script>
    function controlForm() {
        let titleFlag = false;
        let roomsFlag = false;
        let bedsFlag = false;
        let addressFlag = false;

        let titleApart = document.getElementById('title').value;
        let roomsApart = document.getElementById('rooms_number').value;
        let bedsApart = document.getElementById('beds_number').value;
        let addressApart = document.getElementById('address').value;

        const button = document.getElementById('submitButton');

        if (titleApart !== "") {
            titleFlag = true;
        } else {
            titleFlag = false;
        }

        if (roomsApart !== "null") {
            roomsFlag = true;
        } else {
            roomsFlag = false;
        }

        if (bedsApart !== "null") {
            bedsFlag = true;
        } else {
            bedsFlag = false;
        }

        if (addressApart !== "") {
            addressFlag = true;
        } else {
            addressFlag = false;
        }

        if (titleFlag && roomsFlag && bedsFlag && addressFlag == true) {
            button.removeAttribute('disabled');
        } else {
            button.setAttribute('disabled', '');
        }
    }
</script>