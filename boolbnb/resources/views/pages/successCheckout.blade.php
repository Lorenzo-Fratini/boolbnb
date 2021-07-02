@extends('layouts.main-layout')

@section('content')

    <main>
        <h1>{{ $apartment -> title }}</h1>
        <h3>Pacchetto: {{ $sponsorship -> duration }}h - {{ $sponsorship -> price }}€</h3>
        <p>Data inizio: {{ $startDate }} | Data fine: {{ $endDate }}</p>
    
        <a href="{{ route('dashboard', $apartment -> user_id) }}">Dashboard</a>
    </main>


@endsection
