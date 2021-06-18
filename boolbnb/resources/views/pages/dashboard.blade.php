@extends('layouts.main-layout')
@section('content')

    <style>
        h1{
            margin-top: 100px;
        }
    </style>
    <main class="mt-5">
        <h1>Hello World</h1>
        @foreach ($apartments as $apartment)
            {{ $apartment -> title }}
            {{ $apartment -> description }}
            ciao
        @endforeach
    </main>
@endsection