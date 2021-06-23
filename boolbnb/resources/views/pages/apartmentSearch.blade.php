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
                    <p v-for="apartment in currentApartments">
                        @{{ apartment.title }}
                    </p>
                </div>

                {{-- servizi --}}
                <div v-for="service in allServices">
                <input v-on:change="sendServices" type="checkbox" :name="service.name" :value="service.id" v-model="filterServices">
                    <label for="" style="margin-right:10px">@{{ service.name }}</label>
                </div>
                      
            </div>
        </div>
    </main>

    <script>
        new Vue({

            el: '#search',

            data: {

                allApartments: [],
                currentApartments: [],
                allServices: [],
                filterServices: [],
            },

            methods: {

                sendServices: function(){
                    axios.post('/api/filterApartments/' + allApartments + '/' + currentApartments + '/' + filterServices, {
                        allApartments: JSON.stringify(this.allApartments),
                        currentApartments: JSON.stringify(this.currentApartments),
                        filterServices: JSON.stringify(this.filterServices)
                    })
                    .then(res => {

                        this.currentApartments = res.data;
                        // console.log(res.data);
                    });
                }
            
            },

            mounted() {

                let searchString = new URL(location.href).searchParams.get('searchString');

                console.log(searchString);

                axios.get('/api/getApartments/' + searchString)
                    .then(res => {

                        this.allApartments = res.data;  // inserisco appartamenti in array x portarmeli in pagina
                        this.currentApartments = this.allApartments;
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
