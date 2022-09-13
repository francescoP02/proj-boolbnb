@extends('layouts.dashboard')

@section('content')
    <h1 class="text-center mb-4">Select your sponsorship plan for <b>{{ $apartment->title }}</b></h1>

    <div class="row justify-content-around">

        @foreach ($plans as $plan)
            <div class="card text-center col-3 ">
                <div class="card-body">
                    <h5 class="card-title">{{ $plan->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $plan->price }} €</h6>
                    <p class="card-text">This plan is for {{ $plan->duration }} hours.</p>
                    <form action="{{ route('admin.sponsored.store', ['apartment' => $apartment->id]) }}" method="POST">
                        @method('POST')
                        @csrf
                        <input type="text" id="plan_id" name="plan_id" readonly value="{{ $plan->id }}">
                        <input type="text" id="name" name="name" readonly value="{{ $plan->name }}">
                        <input type="text" id="price" name="price" readonly value="{{ $plan->price }}">
                        <input type="text" id="duration" name="duration" readonly value="{{ $plan->duration }}">
                        <button id="_sponsored_btn" class="btn text-light" type="submit">Select this one</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection

<style scoped>
    input {
        display: none;
    }

    #_sponsored_btn {
        background-color: var(--secondary-color);
    }
</style>
