@extends('layouts.main-layout')

@section('content')
    <div class="main-box">
        <div class="row">
            <div class="box-side">
                {{-- left side --}}
                <div class="left-side">
                    <p>Dettagli utente:</p>
                <a href="{{ route('index')}}"> <-- Back To Home</a>
                </div>
                {{-- right side --}}
                <div class="right-side">
                    <div class="box-title">
                        <p>I miei appartamenti</p>
                    </div>
                    <div class="box-content">
                        @foreach ($apartments as $apartment)
                            <p>
                                <i class="fas fa-home"></i>
                                {{ $apartment -> title}} - {{ $apartment -> address}} - {{ $apartment -> city}}
                            <a href="{{ route('editApartment', $apartment -> id) }}">Edit</a>
                            <a href="{{ route('destroyApartment', $apartment -> id) }}">Delete</a>
                            </p>
                        @endforeach
                    </div>
                    <div class="box-apart">
                        <p>Inserisci un nuovo appartamrto <a href="{{ route('createApartment') }}">Nuovo appartamento</a></p>
                    </div>
                </div>
                {{-- statistiche --}}
                <div class="stat-side">
                    <p>Statistiche</p>
                </div>
            </div>
        </div>
    </div>
@endsection
