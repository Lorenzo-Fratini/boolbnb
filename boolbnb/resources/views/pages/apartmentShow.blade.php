@extends('layouts.main-layout')

@section('content')

<div class="container-flat">

    <div class="flat-description margins">
        <h1> {{ $apartment -> title }} </h1>
        <h2> {{ $apartment -> address}} | {{ $apartment -> city}}</h2>
    </div>

    <div class="flat-block margins">

        <div class="flat-img">
            {{-- <span>Qui dentro ci va l'immagine principale</span> --}}
            <img src="http://lorempixel.com/output/nature-q-g-1920-1080-10.jpg" alt="">
        </div>

        <div class="container-text">
            <div class="flat-text" id="flat-text-id">
                <h2>Descrizione</h2>
                {{-- <span> {{ $apartment -> description}} </span> --}}
                <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto molestiae distinctio modi, quasi maxime, at ex repellendus suscipit sed aut ad non, iste vitae cumque illo ea similique et inventore.</span>
                
                <ul>
                    <li>
                        <span>Stanze:</span> {{ $apartment -> rooms_number }}
                    </li>
                    <li>
                        <span>Letti:</span> {{ $apartment -> beds_number }}
                    </li>
                    <li>
                        <span>Bagni:</span> {{ $apartment -> bathrooms_number }}
                    </li>
                    <li>
                        <span>mq:</span> {{ $apartment -> area }}
                    </li>
                </ul>

                <h2 class="servizi">Servizi:</h2>
                <ul>

                    <li>
                        Altri servizi da implementare tipo WIFI FERRO DA STIRO BLABLA
                    </li>

                </ul>
                
                {{-- <h4>Stanze:</h4>
                <h4>Letti:</h4>
                <h4>Bagni:</h4>
                <h4>Metratura:</h4> --}}
            </div>
            <div class="flat-form">
                <h3>Desideri maggiori informazioni? <br> Contatta {{ $apartment -> title }}</h3>
                
                <form method="POST" action="{{ route('storeMessage') }}">
            
                    @csrf
                    @method('POST')
            
                    <div class="form-group row">
                        <input id="email" type="text" class="form-control" name="email" value="" required placeholder="Inserisci qui la tua email">
                    </div>
            
                    <div class="form-group row">
                        <textarea id="text" class="form-control" name="text" value="" required placeholder="Inserisci qui la tua richiesta..."></textarea>
                    </div>
        
                    <input type="hidden" name="apartment_id" value="{{ $apartment -> id }}">
            
                    <button type="submit">Submit</button>
        
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

</div>
