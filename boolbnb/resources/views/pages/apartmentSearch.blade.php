@extends('layouts.main-layout')

@section('content')
    <main>
        <div id="search">

            {{-- servizi --}}
            <div class="box-service">
                <div style="display:flex">
                    <div v-for="service in allServices" class="my-services">
                        <input v-on:change="sendServices" type="checkbox" :name="service.name" :value="service.id" v-model="filterServices">
                        <label for="" style="margin-right:10px">@{{ service.name }}</label>
                    </div>
                </div>
            </div>

{{--             <a :href="gethref">aaaaaaa</a>
 --}}
            {{-- appartamenti --}}
            <div class="box-app-map">
                <div class="my-apartments">
                    <p v-for="apartment in currentApartments" style="margin: 20px 0 0 0">
                        @{{ apartment.title }} - [@{{ apartment.id }}]
                        <br>
                        @{{ apartment.address}}
                    </p>
                </div>
                {{-- tom tom --}}
                <div id="map" class="box-map">
                    <div id="mymap">
                        Tom Tom Map
                    </div>
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
                filterData: [],
                testtomtomapi: [],
                coord: [],
                lat: 0,
                lon: 0,
            },

            methods: {

                /* sendServices: function(){

                    var token = document.head.querySelector('meta[name="csrf-token"]');
                    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content

                    const test = {
                        allApartments: this.allApartments,
                        currentApartments: this.currentApartments,
                        filterServices: this.filterServices
                    }

                    const currentApartments = {
                        
                    }

                    const filterServices = {
                        
                    }

                    axios({
                        url: 'http://localhost:8000/api/filterApartments/',
                        method: 'post',
                        data: test
                    })
                    .then(res => {

                        this.currentApartments = res.data;
                        console.log(res);
                    });
                    /*  allApartments: JSON.stringify(this.allApartments),
                        currentApartments: JSON.stringify(this.currentApartments),
                        filterServices: JSON.stringify(this.filterServices)
                } */

                sendServices: function() {
                console.log(this.filterServices);

                    let searchString = new URL(location.href).searchParams.get('searchString');

                    // console.log(this.filterServices);

                    /* this.filterData = [
                        {
                            'allApartments' : this.allApartments
                        },
                        {
                            'filterServices' : this.filterServices
                        }
                    ]; */

                    // console.log(this.filterData);
                        // axios.post('https://api.tomtom.com/search/2/geocode/%20' +  + '%20it%2095065.JSON?key=bgD25FbOtXSk9OKpc08kQd51ll2aCVCK') 
                        // .then(res => {
    
                        //     this.currentApartments = res.data;
                        // });
                    if (this.filterServices.length > 0) {

                        axios.post('/api/filterApartments/' + searchString + '/' + this.filterServices) 
                        .then(res => {
    
                            this.currentApartments = res.data;
                        });


                    } else {

                        this.currentApartments = this.allApartments;
                        console.log(this.currentApartments);
                    }
                }
            },

            mounted() {
                

                let searchString = new URL(location.href).searchParams.get('searchString');

                axios.get('/api/getApartments/' + searchString)
                    .then(res => {

                        this.allApartments = res.data;
                        this.currentApartments = this.allApartments;
                        // console.log(this.currentApartments, this.allApartments);
                    });

                axios.get('/api/getServices/')
                    .then(res => {

                        this.allServices = res.data;
                });

                axios.get('https://api.tomtom.com/search/2/geocode/%20' + searchString + '%20it.JSON?key=e221oCcENGoXZRDyweSTg7PnYGiEXO82', {headers: ''})
                    .then(res => {

                        this.testtomtomapi = res.data.results[0];

                        this.lat = this.testtomtomapi.position.lat;
                        this.lon = this.testtomtomapi.position.lon;

                        console.log(this.lat, this.lon);

                        this.coord.push(this.testtomtomapi.position.lon, this.testtomtomapi.position.lat)

                        // this.testtomtomapi.push(res.data.results[0]);

                        // console.log(this.testtomtomapi);
                        
                        // Tom Tom Map

                        console.log(this.lat, this.lon);

                        var APIKEY = "XPOiPra9khmu2grECjX15gw5Cdy98fSX"
                        // var lon = 
                        // var lat =
                        // var CITY = [9.18812, 45.46362]
                        var CITY = [this.lon, this.lat] // [longitudine, latitudine]

                        // console.log(CITY);

                        var map = tt.map({
                            key: APIKEY,
                            container: 'mymap',
                            //center: MADRID,
                            center: CITY,
                            zoom: 10,
                            style: 'tomtom://vector/1/basic-main'
                        });

                });

                

            },

            /* computed: {

                gethref: function() {
                    return '/apartment/' + this.filterServices
                }
            }, */
            
        });

                
        

        

    </script>

@endsection
