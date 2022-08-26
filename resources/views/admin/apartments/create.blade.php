@extends('layouts.dashboard')

@section('content')

    <h1>Create a new apartment</h1>

    <form action="{{ route('admin.apartments.store') }}" method="POST">
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
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" name="title" id="title">
        </div>
        <div class="mb-3">
            <label for="rooms_number">Number of rooms:</label>
            <select class="form-select" aria-label="Default select example" name="rooms_number" id="rooms_number">
                <option selected>Open this select menu</option>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            <label for="beds_number">Number of beds:</label>
            <select class="form-select" aria-label="Default select example" name="beds_number" id="beds_number">
                <option selected>Open this select menu</option>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            <label for="bathroom_number">Number of bathrooms:</label>
            <select class="form-select" aria-label="Default select example" name="bathroom_number" id="bathroom_number">
                <option selected>Open this select menu</option>
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
            <label for="address" class="form-label">Address:</label>
            <textarea type="text" class="form-control" name="address" id="address"></textarea>
        </div>
        {{-- <div class="form-check">
            <input class="form-check-input" type="radio" name="visible" id="visible1" checked value="1">
            <label class="form-check-label" for="visible1">
              Default radio
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="visible" id="visible2" value="0">
            <label class="form-check-label" for="visible2">
              Default checked radio
            </label>
        </div> --}}
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" checked  name="visible" id="visible1" value="1">
            <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    
@endsection