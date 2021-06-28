@extends('layouts.main-layout')

@section('content')
    <div class="main-box">
        <div class="row">
            <div class="box-side">
                {{-- left side --}}
                <div class="left-side">
                    <h3>Dettagli utente:</h3>
                <a href="{{ route('index')}}"> <-- Back To Home</a>
                </div>
                {{-- right side --}}
                <div class="right-side">
                    <div class="box-apart">
                        <p>Inserisci un nuovo appartamento <a href="{{ route('createApartment') }}">Nuovo appartamento</a></p>
                    </div>
                    <div class="box-title">
                        <h3>I miei appartamenti</h3>
                    </div>
                    <div class="box-content">
                        @foreach ($apartments as $apartment)
                            <p>
                                <i class="fas fa-home"></i>
                                {{ $apartment -> title}} - {{ $apartment -> address}} - {{ $apartment -> city}}
                                <a href="{{ route('myApartment', encrypt($apartment -> id)) }}">Dettagli</a>
                                <a href="{{ route('editApartment', encrypt($apartment -> id)) }}">Modifica</a>
                                <a href="{{ route('sponsorshipPayment', encrypt($apartment -> id))}}">Sponsorizza</a>
                                <a href="{{ route('destroyApartment', encrypt($apartment -> id)) }}">Elimina</a>
                            </p>
                        @endforeach
                    </div>
                </div>
                {{-- statistiche --}}
                <div class="stat-side">
                    <h3>Statistiche</h3>
                    <p>work in progress...</p>
                </div>
            </div>
        </div>
    </div>
@endsection
