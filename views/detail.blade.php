@extends('index')

@section('content')
    <!-- Call to Action-->
    <div class="card text-white bg-secondary my-5 py-4">
        <div class="card-body">
            <p class="text-white m-0">
                <div class="mb-5">
                    <div class="">
                        <h2 class="card-title">{{ $data['name'] }}</h2>
                        <p class="card-text">{{ $data['description'] }}</p>
                        @if(array_key_exists('type'))
                            <p class="card-text">Type: {{ ucfirst($data['type']) }}</p>
                        @endif
                        <p class="card-text">Suppliers</p>
                        <ul>
                            @if(array_key_exists('suppliers', $data))
                            @foreach(explode('|', $data['suppliers']) as $sup)
                                <li>{{ $sup }}</li>
                            @endforeach
                            @else
                                <li>No supplier for this product!</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </p>
        </div>
    </div>
    <div class="row gx-4 gx-lg-5">

    </div>
@endsection
