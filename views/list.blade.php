@extends('index')

@section('content')
    <!-- Call to Action-->
    <div class="card text-white bg-secondary my-5 py-4 text-center">
        <div class="card-body"><p class="text-white m-0">List of our insurance products!</p></div>
    </div>
    <div class="row gx-4 gx-lg-5">
        @foreach ($data as $key => $item)
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title">{{ ucfirst($key) }}</h2>
                    <p class="card-text">{{ $item }}</p>
                </div>
                <div class="card-footer"><a class="btn btn-primary btn-sm" href="/details/{{ $key }}">More Info</a></div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
