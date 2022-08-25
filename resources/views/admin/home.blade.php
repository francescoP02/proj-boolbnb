@extends('layouts.dashboard')

@section('content')
    <h2>Ciao @if ($user->name)
        {{$user->name}}
    @endif Questa è la pagina home di back office</h2>
@endsection