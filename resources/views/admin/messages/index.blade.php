@extends('layouts.dashboard')

@section('content')

    <div id="messagesSection" class="p-3">
        <div class="container">
            @if (count($messages) !== 0)
                <ul class="list-group mb-4">
                    {{-- @php
                    $result = $messages::orderBy('created_at')
                @endphp --}}

                    @foreach ($messages as $message)
                        <li class="list-group-item my-3">
                            <h3>From: <span class="fw-bold">{{ $message->email }}</span></h3>
                            <div class="d-flex">
                                <div class="fw-bold">{{ $message->name }}</div>
                                <p class="ps-2">{{ $message->text }}
                                </p>
                            </div>
                            <span class="date-time">{{ $message->created_at }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <h3 class="text-center my-4">No messages received</h3>
            @endif
            <div class="text-center">
                <a class="btn text-light " href="/admin/apartments" style="background-color: #ff5a5f;">Return to
                    apartments</a>
            </div>
        </div>
    </div>

@endsection
