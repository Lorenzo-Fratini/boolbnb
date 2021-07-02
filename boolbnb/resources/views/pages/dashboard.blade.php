@extends('layouts.main-layout')

@section('content')
    <main>
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
    
    
                                    <i class="fas fa-home"></i>
                                    <span>{{ $apartment->title }} - {{ $apartment->address }} -
                                        {{ $apartment->city }}</span>
                                    <div class="dash-row-buttons">
    
                                        <a href="{{ route('myApartment', $apartment->id) }}">Dettagli</a>
                                        <a href="{{ route('editApartment', $apartment->id) }}">Modifica</a>
    
                                        @if (count($apartment->sponsorships) == 0)
                                            <a href="{{ route('sponsorshipPayment', $apartment->id) }}">Sponsorizza</a>
                                        @endif
    
                                        @foreach ($apartment->sponsorships as $apartRel)
                                            @if ($currentDate < $apartRel->pivot->end_date)
                                                <a class="sponsor-alreadysponsored">Sponsorizzato! <i
                                                        class="fas fa-star"></i></a>
                                            @break
                                        @endif
                                        @if ($loop->last)
    
                                            @if ($currentDate > $apartRel->pivot->end_date)
                                                <a href="{{ route('sponsorshipPayment', $apartment->id) }}">Sponsorizza</a>
                                            @endif
    
                                        @endif
                            @endforeach
    
                            <a href="{{ route('destroyApartment', $apartment->id) }}">Elimina</a>
    
                        </div>
    
    
    
                    </div>
                    @endforeach {{-- E' indentato male per colpa di Code ma funziona ed è giusto così --}}
                </div>
            </div>
        </div>
        </div>
        </div>
    </main>
@endsection
