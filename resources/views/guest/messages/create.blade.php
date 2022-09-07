@section('content')

<div>
    <h1>SONO IL FOTTUTISSMO CONTACT BLADE</h1>
    <form class="row g-3" method="POST" enctype="multipart/form-data" action="{{route('messages.store')}}">

        @method('POST')
        @csrf
        <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
        <div class="col-md-6">
            <label class="form-label" for="name">Name(*):</label>
            <input class="form-control" type="text" id="name" name="name">
        </div>
        <div class="col-md-6">
            <label class="form-label" for="surname">Surname(*):</label>
            <input class="form-control" type="text" id="surname" name="surname">
        </div>
        <div class="col-md-12">
            <label class="form-label" for="email">Email(*):</label>
            <input class="form-control" type="email" id="email" name="email">
        </div>
        <div class="col-md-12">
            <label class="form-label" for="message">Message(*):</label>
            <textarea class="form-control" name="message" id="message" cols="30" rows="10"></textarea>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
    </form>
</div>

@endsection