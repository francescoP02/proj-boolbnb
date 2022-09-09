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
            <label for="image">Cover image</label>
            <input type="file" id="image" name="image">

            @if ($apartment->image)
                <h5>Actual image</h5>
                <img src="{{ asset('storage/' . $apartment->image) }}"  style="width: 70%" alt="">
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
            <label for="address">Number of bathrooms:</label>
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
            <label for="addressSearch" class="form-label">Address(*):</label>
            <input type="text" class="form-control" name="addressSearch" id="addressSearch" onkeyup="addressApartment(); controlForm()" value="{{old('address') ? old('address') : $apartment->address }}">
            <div class="d-none" id="containerAddress">
                <select name="address" id="address" class="form-select" onclick="controlForm()">
                    {{-- {{old('address') ? old('address') : <option value="$apartment->address" selected></option> }} --}}
                    <option value="{{$apartment->address}}" {{ (old('address', $apartment->address) == $i) ? 'selected' : ''}}></option>
                </select>
            </div>
        </div>

        <div class="my-3">
            <h4>Optionals(*):</h4>
            <p>Select at least one</p>
            @foreach ($optionals as $optional)
            <div class="form-check">

                <input name="optionals[]" class="form-check-input opt" onclick="controlForm()" type="checkbox" value="{{$optional->id}}" id="optional-{{$optional->id}}" {{ ($apartment->optionals->contains($optional) || in_array($optional->id, old('optionals', []))) ? 'checked' : '' }}>
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
        <div class="d-none">
            <input id="latApart" name="latitude" readonly value="{{ old('latitude') ? old('latitude') : $apartment->latitude}}">
            <input id="lonApart" name="longitude" readonly value="{{ old('longitude') ? old('longitude') : $apartment->longitude}}">
        </div>
        <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection

<script>
    function controlForm() {
        let titleFlag = false;
        let roomsFlag = false;
        let bedsFlag = false;
        let bathroomFlag = false;
        let squareFlag = false;
        let addressFlag = false;
        let optionalsFlag = false;

        let titleApart = document.getElementById('title').value;
        let roomsApart = document.getElementById('rooms_number').value;
        let bedsApart = document.getElementById('beds_number').value;
        let bathroomApart = document.getElementById('bathroom_number').value;
        let squareApart = document.getElementById('square_metres').value;
        let addressApart = document.getElementById('addressSearch').value;
        let selAddressApart = document.getElementById('address').value;
        let optionalsApart = document.getElementsByClassName('opt');
            
        // console.log(addressApart);
        const button = document.getElementById('submitButton');

        let i = 0;
        do {
            if(optionalsApart[i].checked){
                optionalsFlag = true;
            } else {
               optionalsFlag =false; 
            }
            i++;
        } while (i < optionalsApart.length && !optionalsFlag);


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
        
        if (bathroomApart !== "null") {
            bathroomFlag = true;
        } else {
            bathroomFlag = false;
        }

        if (squareApart) {
            squareFlag = true;
        } else {
            squareFlag = false;
        }

        console.log(addressApart);

        if (addressApart  && addressApart.length >= 3 && selAddressApart ) {
            addressFlag = true;
        } else {
            addressFlag = false;
        }

        if (titleFlag && roomsFlag && bedsFlag && bathroomFlag && squareFlag && addressFlag && optionalsFlag) {
            button.removeAttribute('disabled');
        } else {
            button.setAttribute('disabled', '');
        }
    }

    function addressApartment() {

        document.getElementById('address').value ="";

        let addressLength = document.getElementById('addressSearch').value.length;

        if (addressLength >= 3) {

            divContainer = document.getElementById('containerAddress');
            
            divContainer.classList.remove('d-none');
            
            let addressApart = document.getElementById('addressSearch').value;
            const linkApi = `https://api.tomtom.com/search/2/geocode/${addressApart}.json?key=Rdcw2GVNiNQGXTWrgewGKq9cwtVYNPRw`;

            axios.get(linkApi).then(resp => {
                
                const response = resp.data.results;

                document.getElementById('address').innerHTML = "";
                
                if (response.length == 0) {
                    const nullElement = document.createElement('option');
                        nullElement.innerHTML = "No location found";
                        // nullElement.value = "";
                        nullElement.setAttribute("disabled","");
                        document.getElementById('address').setAttribute("size","2");
                        document.getElementById('address').append(nullElement);
                } else {
                    response.forEach(element => {
                        
                        const addressElement = document.createElement('option');
                        document.getElementById('address').append(addressElement);
                        document.getElementById('address').setAttribute("size","5");
                        addressElement.classList.add('address-result');
                        addressElement.innerHTML = element.address.freeformAddress;
                        addressElement.value = element.address.freeformAddress;
        
                        addressElement.addEventListener('click', function() {
                            divContainer.classList.add('d-none');
                            document.getElementById('latApart').value = element.position.lat;
                            document.getElementById('lonApart').value = element.position.lon;
                            document.getElementById('addressSearch').value = element.address.freeformAddress;
                        })
                    })

                }
                
            })
        }   
    }
</script>