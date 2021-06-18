@extends('layouts.main-layout')

@section('content')
    <main>
        <div style="margin-top: 100px;">
            @foreach ($apartments as $apartment)
                <p>{{ $apartment -> title }}</p>
                <p>{{ $apartment -> city }}</p>
            @endforeach
        </div>
    </main>
@endsection
