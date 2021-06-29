@extends('layouts.main-layout')

@section('content')
    <div class="main-box">
        <div class="row">
            <div class="box-side">
                <div class="right-side">
                    <div class="box-apart">
                        <a href="{{ route('createApartment') }}">Inserisci un nuovo appartamento</a>
                    </div>
                    <div class="box-title">
                        <h3>I miei appartamenti</h3>
                    </div>
                    <div class="box-content">
                        @foreach ($apartments as $apartment)
                            <div class="apartment-row">
                                <p>
                                    <i class="fas fa-home"></i>
                                    {{ $apartment->title }} - {{ $apartment->address }} - {{ $apartment->city }}
                                <div>
                                    <a href="{{ route('myApartment', encrypt($apartment->id)) }}">Dettagli</a>
                                    <a href="{{ route('editApartment', encrypt($apartment->id)) }}">Modifica</a>
                                    <a href="{{ route('sponsorshipPayment', encrypt($apartment->id)) }}">Sponsorizza</a>
                                    <a href="{{ route('destroyApartment', encrypt($apartment->id)) }}">Elimina</a>
                                </div>
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
