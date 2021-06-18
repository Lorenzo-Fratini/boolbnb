@extends('layouts.main-layout')

@section('content')

<div class="container-flat">

    <div class="flat-description margins">
        <h1>Nome {{ $apartment -> title }}</h1>
        <h2>Posizione hotel/appartamento</h2>
    </div>

    <div class="flat-block margins">

        <div class="flat-img">
            {{-- <span>Qui dentro ci va l'immagine principale</span> --}}
            <img src="http://lorempixel.com/output/nature-q-g-1920-1080-10.jpg" alt="">
        </div>

        <div class="container-text">
            <div class="flat-text">
                <h2>Descrizione</h2>
                <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto molestiae distinctio modi, quasi maxime, at ex repellendus suscipit sed aut ad non, iste vitae cumque illo ea similique et inventore.</span>
                <h4>Stanze:</h4>
                <h4>Letti:</h4>
                <h4>Bagni:</h4>
                <h4>Metratura:</h4>
            </div>
            <div class="flat-form">
                <h3>Desideri maggiori informazioni? <br> Contatta {nome posto}</h3>
                {{-- <form action="">

                    <input type="email" placeholder="La tua email">
                    <br>
                    <textarea class="textarea" type="textarea" placeholder="Inserisci la tua richiesta"></textarea>
                    <br>
                    <button>
                        Invia richiesta
                    </button>

                </form> --}}

                <form method="POST" action="{{ route('storeMessage') }}">
            
                    @csrf
                    @method('POST')
            
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                        <input id="email" type="text" class="form-control" name="email" value="" required>
                    </div>
            
                    <div class="form-group row">
                        <label for="text" class="col-md-4 col-form-label text-md-right">Text</label>
                        <input id="text" type="textarea" class="form-control" name="text" value="" required>
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

@endsection