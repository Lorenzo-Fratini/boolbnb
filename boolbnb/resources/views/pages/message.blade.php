@extends('layouts.main-layout')
@section('content')

    <main class="mt-5">
        
        <form method="POST" action="{{ route('storeMessage', $apartment -> id) }}">
            @csrf
            @method('POST')
    
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                <input id="email" type="text" class="form-control" name="email" value="" required>
            </div>
    
            <div class="form-group row">
                <label for="text" class="col-md-4 col-form-label text-md-right">Text</label>
                <input id="text" type="text" class="form-control" name="text" value="" required>
            </div>
    
            <div class="form-group row">
                <label for="date" class="col-md-4 col-form-label text-md-right">date</label>
                <input id="date" type="date" class="form-control" name="date" value="" required>
            </div>
    
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
    </main>
    

@endsection