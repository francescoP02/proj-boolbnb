@extends('layouts.dashboard')

@section('content')

    <h1>Apartment name: {{$apartment->title}}</h1>
    <p>{{$apartment->slug}}</p>

    <p>Number of rooms: {{$apartment->rooms_number}}</p>
    <p>Number of beds: {{$apartment->beds_number}}</p>
    <p>Number of bathrooms: {{$apartment->bathroom_number}}</p>
    <p>Square metres: {{$apartment->square_metres}} square metres</p>
    
@endsection