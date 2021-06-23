@extends('layouts.main-layout')

@section('content')
    <main>
        <div id="search">
            <div class="search-box">

                {{-- <button v-on:click="test">
                    CLICK test
                </button> --}}

                {{-- appartamenti --}}
                <div class="my-apartments">
                    <p v-for="apartment in apartments">
                        @{{ apartment.title }}
                    </p>
                </div>

                {{-- servizi --}}
                <form action="">
                    <div v-for="service in allServices">
                    <input v-on:change="sendServices" type="checkbox" :name="service.name" :value="service.id" v-model="filterServices">
                        <label for="" style="margin-right:10px">@{{ service.name }}</label>
                    </div>
                </form>
                      
            </div>
        </div>
    </main>

    <script>
        new Vue({

            el: '#search',

            data: {

                apartments: [],
                allServices: [],
                filterServices: []
            },

            methods: {

                sendServices: function(){
                    axios.get('/api/filterApartments/' + filterServices)
                    .then(res => {

                        this.apartments = res.data;
                        // console.log(res.data);
                    });
                }
            
            },

            mounted() {

                let searchString = new URL(location.href).searchParams.get('searchString');

                console.log(searchString);

                axios.get('/api/getApartments/' + searchString)
                    .then(res => {

                        this.apartments = res.data;  // inserisco appartamenti in array x portarmeli in pagina
                        // console.log(res.data);
                    });

                axios.get('/api/getServices/')
                    .then(res => {

                        this.allServices = res.data;   // inserisco servizi in array x portarmeli in pagina
                        // console.log(res.data);
                    });
            }
        });
    </script>
@endsection
