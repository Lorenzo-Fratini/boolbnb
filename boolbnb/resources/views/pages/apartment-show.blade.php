@extends('layouts.main-layout')

@section('content')
    <div class="container text-center">
        <div class="row">
            <div class="col-12">
                <h1>APARTMENT:</h1>
                <p>{{ $apartment -> title }}</p>
                <p>{{ $apartment -> cover_image }}</p>
                <p>{{ $apartment -> rooms_number }}</p>
                <p>{{ $apartment -> beds_number }}</p>
                <p>{{ $apartment -> bathrooms_number }}</p>
                <p>{{ $apartment -> rooms_number }}</p>
                <p>{{ $apartment -> area }}</p>
                <p>{{ $apartment -> address }}</p>
                <p>{{ $apartment -> city }}</p>
                <p>{{ $apartment -> country }}</p>
                <p>{{ $apartment -> postal_code }}</p>
                <p>{{ $apartment -> latitude }}</p>
                <p>{{ $apartment -> longitude }}</p>
            </div>
        </div>
    </div>
@endsection