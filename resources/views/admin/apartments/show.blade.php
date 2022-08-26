@extends('layouts.dashboard')

@section('content')

    <h1>Apartment name: {{$apartment->title}}</h1>
    <p>{{$apartment->slug}}</p>

    <p>Number of rooms: {{$apartment->rooms_number}}</p>
    <p>Number of beds: {{$apartment->beds_number}}</p>
    <p>Number of bathrooms: {{$apartment->bathroom_number}}</p>
    <p>Square metres: {{$apartment->square_metres}} square metres</p>

    <a class="btn btn-primary" href="{{ route('admin.apartments.edit', ['apartment' => $apartment->id]) }}">Modify</a>

    <form class="d-inline-block" action="{{ route('admin.apartments.destroy', ['apartment' => $apartment->id]) }}" onClick="return confirm('Confirm delete');" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">Delete</button>
    </form>
    
@endsection