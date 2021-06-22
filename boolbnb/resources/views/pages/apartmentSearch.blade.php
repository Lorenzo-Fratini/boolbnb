@extends('layouts.main-layout')

@section('content')
    <main>
        <div id="search">
            {{-- ricerca avanzata Vue --}}
        </div>
    </main>

    <script>
        new Vue({
            el: '#search',

            mounted() {

                let searchString = new URL(location.href).searchParams.get('searchString');

                console.log(searchString);

                axios.get('/api/getApartments/' + searchString)
                    .then(data => {
                        console.log(data.data);
                    });

                axios.get('/api/getServices/')
                    .then(data => {
                        console.log(data.data);
                    });
            }
        });
    </script>
@endsection
