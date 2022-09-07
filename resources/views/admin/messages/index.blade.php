@extends('layouts.dashboard')

@section('content')

<div class="p-3">
    <div class="container">
        <h1 class="mb-4 text-center">Apartment messages:</h1>
        @if (count($messages) !== 0)
            <ul class="list-group mb-4">
                @foreach ($messages as $message)
                
                <li class="list-group-item">
                    <h3>From: {{$message->email}}</h3>
                    <p>{{$message->name}} {{$message->surname}}</p>
                    <p>{{$message->text}}</p>
                    <span>{{$message->created_at}}</span>
                </li>
                    
                @endforeach
            </ul>
        @else 
            <h3 class="text-center my-4">No messages received</h3>
        @endif
        <a class="btn btn-primary" href="/admin/apartments">Return to apartments</a>
    </div>
</div>
    
@endsection