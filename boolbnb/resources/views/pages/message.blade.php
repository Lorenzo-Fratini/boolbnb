@extends('layouts.main-layout')
@section('content')

    <main style="margin:100px 0 0 0">
        
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
    </main>
    

@endsection