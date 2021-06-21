@extends('layouts.main-layout')

@section('content')

            {{-- JT --}}
  <div class="container-content">
    <div class="margin-content">
      <div class="text-content">
        <h1>Esplora BoolBnB</h1>
      </div>
    </div>
  </div>


            {{-- PREMIUM APARTMENTS --}}
            
  <div class="container-ap">


    <div class="row">
      
      <h3>IN EVIDENZA</h3>

    </div>

    <div class="row">

      
      @foreach ($apartments as $apartment)

          <div class="mini-container">

            <img class="ap-img" src="{{ asset('/storage/images/' . $apartment -> cover_image) }}" alt="immagine principale appartamento {{ $apartment -> title }}">

            <a href="{{ route('showApartment', $apartment -> id) }}" class="prem-apart">

              <div class="white-buble">

                <h2>{{ $apartment -> title }}</h2>
    
              <div>
    
                <span>Numero di stanze:</span>
                <span>{{ $apartment -> rooms_number }}</span>
    
              </div>
            
              <div class="details">
    
               <i class="fas fa-bed"></i>
               <span>{{ $apartment -> beds_number }}</span>
      
                <i class="fas fa-toilet"></i>
                <span>{{ $apartment -> bathrooms_number }}</span>
    
              </div>
              </div>
    
            </a>

          </div>
          
      @endforeach


    </div>


  </div>

@endsection
