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
                                <a href="{{ route('myApartment', $apartment -> id) }}">Dettagli</a>
                                <a href="{{ route('editApartment', $apartment -> id) }}">Modifica</a>

                                @if (count($apartment -> sponsorships) == 0)
                                    <a href="{{ route('sponsorshipPayment', $apartment -> id)}}">Sponsorizza</a>
                                @endif
                                
                                @foreach ($apartment -> sponsorships as $apartRel) 
                                    @if ($currentDate < $apartRel -> pivot -> end_date)
                                        <span>Sponsorizzato</span>
                                        @break
                                    @endif
                                    @if ($loop -> last )
                                        
                                        @if ($currentDate > $apartRel -> pivot -> end_date)
                                            <a href="{{ route('sponsorshipPayment', $apartment -> id)}}">Sponsorizza</a>
                                        @endif

                                    @endif
                                @endforeach

                                <a href="{{ route('destroyApartment', $apartment -> id) }}">Elimina</a>
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
