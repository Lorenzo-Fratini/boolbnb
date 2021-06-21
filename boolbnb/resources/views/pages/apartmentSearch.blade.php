@extends('layouts.main-layout')

@section('content')
    <main>
        <div id="search">
            <div style="margin-top: 100px;">
                @foreach ($apartments as $apartment)
                    <p>{{ $apartment -> title }}</p>
                    <p>{{ $apartment -> city }}</p>
                @endforeach
            </div>
    
            {{-- ricerca avanzata Vue --}}
            <div>
                <search-component></search-component>
            </div>
        </div>
    </main>
@endsection
