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
               
                    <div v-for="service in allServices">
                    <input v-on:click="test" type="checkbox" name="services_id" value="@{{ service.id }}">
                        <label for="">@{{ service.name }}</label>
                    </div>
                      
            </div>
        </div>
    </main>

    <script>
        new Vue({

            el: '#search',

            data: {

                apartments: [],
                allServices: [],
                filterServices:[]
            },

            methods: {

                test: function(){
                    console.log('test ciao');
                } 
                
              // aggiungi il servizio solo se non è presente nell'array:
            //   addService: function(){

            //     if (!this.filterServices.includes(service.name)) {
            //                     this.filterServices.push(service.name);
            //                 }
            //    },
               

            
            
                // submit: function(){
                 
                //     console.log('hello');

                //     axios.post('/api/', { services: JSON.stringify(services){ // posto nella rotta (vedi web.php), mando servizi (transformo in oggetto (JSON, codifico) in formato stringa(stringify)
                                                                        
                //          .then(res => {
                //              // qui codice x tornare alla pag.
                //         })
        
                //      .catch(err => console.log(err));
                //         devo poi decodificare (nel controller)
                // }
            
            },


            mounted() {

                let searchString = new URL(location.href).searchParams.get('searchString');

                console.log(searchString);

                axios.get('/api/getApartments/' + searchString)
                    .then(data => {

                        this.apartments = data.data;  // inserisco appartamenti in array x portarmeli in pagina
                        console.log(data.data);
                    });

                axios.get('/api/getServices/')
                    .then(data => {

                        this.allServices = data.data;   // inserisco servizi in array x portarmeli in pagina
                        console.log(data.data);
                    });
            }
        });
    </script>
@endsection
