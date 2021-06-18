@extends('layouts.main-layout')

    @section('content')

        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h1>Edit Apartment:</h1>
                </div>
            </div>
        </div>
        <form method="POST" action="#">

            @csrf
            @method('POST')

            {{-- name --}}
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Firstname</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $apartment -> name }}">
                </div>
            </div>
          
            {{-- BUTTON --}}
            <div class="form-group row">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">
                        UPDATE
                    </button>
                </div>
            </div>
        </form>
    @endsection
