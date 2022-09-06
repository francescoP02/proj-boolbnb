@extends('layouts.dashboard')

@section('content')

    <div>
        <h1>Apartment name: {{$apartment->title}}</h1>

        @if ($apartment->image)
            <img src="{{ asset('storage/' . $apartment->image) }}" style="width: 70%" alt="">
        @endif

        <p>{{$apartment->address}}</p>

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

        <button class="btn btn-primary text-white" href="{{ route('admin.apartments.edit', ['apartment' => $apartment->id]) }}">Modify</button>

        <button class="btn btn-danger text-white" type="button" onclick="sureOfDelete()">Delete</button>
        
    </div>

    <div id="_deleteBox" class="_bg_wrap">
        <div class="bg-light d-inline-block p-4 fw-bold rounded position-absolute bottom-50 end-50 text-center">
            <p class="text-black">Sure you want to delete?</p>
            <div>
                <form class="d-inline-block" action="{{ route('admin.apartments.destroy', ['apartment' => $apartment->id]) }}" method="POST">
    
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger text-white" type="submit" >Delete</button>
                </form>
                <button id="_cancelButton" class="btn btn-primary text-white" onclick="sureOfDelete()">Cancel</button>
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