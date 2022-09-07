@extends('layouts.dashboard')

@section('content')

    <div>
        <h1>{{$apartment->title}}</h1>
        <p>{{$apartment->address}}</p>

        @if ($apartment->image)
            <img src="{{ asset('storage/' . $apartment->image) }}" style="width: 70%" alt="">
        @endif


        <p>{{$apartment->slug}}</p>

        <p>Number of rooms: {{$apartment->rooms_number}}</p>
        <p>Number of beds: {{$apartment->beds_number}}</p>
        <p>Number of bathrooms: {{$apartment->bathroom_number}}</p>
        <p>Square metres: {{$apartment->square_metres}} square metres</p>
        <p><strong>Optionals:</strong>

            @forelse ($apartment->optionals as $optional)
                {{$optional->name}} {{$loop->last ? '' : ', '}}
            @empty
                nessun optional
            @endforelse

        </p>

        <a class="btn btn-primary text-white" href="{{ route('admin.apartments.edit', ['apartment' => $apartment->id]) }}">Modify</a>

        <button class="btn btn-danger text-white" type="button" onclick="sureOfDelete()">Delete</i></button>

        <a class="btn btn-primary text-white" href="{{ route('admin.messages', ['apartment' => $apartment->id]) }}">Messages</a>
        
    </div>

    <div id="_deleteBox" class="_bg_wrap d-none">
        <div class="bg-light d-inline-block p-4 fw-bold rounded position-absolute bottom-50 end-50 text-center">
            <p class="text-black">Sure you want to delete?</p>
            <div>
                <button id="_cancelButton" class="btn btn-primary text-white" onclick="sureOfDelete()">Cancel</button>
                <form class="d-inline-block" action="{{ route('admin.apartments.destroy', ['apartment' => $apartment->id]) }}" method="POST">
    
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger text-white" type="submit" >Delete</i></button>
                </form>
            </div>
        </div>
    </div>
    
@endsection

<script>
    function sureOfDelete() {
        const deleteBox = document.getElementById('_deleteBox');
        deleteBox.classList.toggle('d-none');
    }

    // function cancelDelete() {
    //     const cancelButton = document.getElementById('_cancelButton');
    //     cancelButton.classList.add('d-none');
    // }
</script>