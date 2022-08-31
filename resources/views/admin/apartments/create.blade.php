@extends('layouts.dashboard')

@section('content')

    <h1>Create a new apartment</h1>

    <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data">
        @method('POST')
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label for="title" class="form-label">Title(*):</label>
            <input type="text" class="form-control" name="title" id="title" onkeyup="controlForm()">
        </div>

        <div>
            <label for="image">Immagine:</label>
            <input type="file" id="image" name="image">
        </div>
        
        <div class="mb-3">
            <label for="rooms_number">Number of rooms(*):</label>
            <select class="form-select" aria-label="Default select example" name="rooms_number" id="rooms_number" onkeyup="controlForm()" onclick="controlForm()">
                <option value="null" selected>Open this select menu</option>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            <label for="beds_number">Number of beds(*):</label>
            <select class="form-select" aria-label="Default select example" name="beds_number" id="beds_number" onkeyup="controlForm()" onclick="controlForm()">
                <option value="null" selected>Open this select menu</option>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            <label for="bathroom_number">Number of bathrooms:</label>
            <select class="form-select" aria-label="Default select example" name="bathroom_number" id="bathroom_number">
                <option value="0" selected>Open this select menu</option>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            <label for="square_metres" class="form-label">Square metres:</label>
            <input type="number" class="form-control" name="square_metres" id="square_metres">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address(*):</label>
            <textarea type="text" class="form-control" name="address" id="address" onkeyup="controlForm()"></textarea>
        </div>
        <div class="my-3">
            <h4>Optionals:</h4>
            @foreach ($optionals as $optional)
            <div class="form-check">

                <input name="optionals[]" class="form-check-input" type="checkbox" value="{{$optional->id}}" id="optional-{{$optional->id}}" {{ in_array($optional->id, old('optionals', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="optional-{{$optional->id}}">
                {{$optional->name}}
                </label>

            </div>
        @endforeach
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" checked  name="visible" id="visible1" value="1">
            <label class="form-check-label" for="flexSwitchCheckChecked">Visible</label>
        </div>
        <button type="submit" class="btn btn-primary" disabled id="submitButton">Submit</button>
    </form>

    <p class="text-center">* Questi campi sono obbligatori</p>
    
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