@extends('layouts.main-layout')
@section('content')
    
<main>
    <div id="container-payment">
        @if (session('success_message'))
            {{ session('success_message') }}
        @endif
        {{-- @if (count($errors > 0))
            <ul>
                @foreach ($errors -> all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            
        @endif --}}
        <form method="get" id="payment-form" action="{{'paymentCheckout'}}">
            
            @csrf
            @method('GET')

            <section>
                <label for="amount">
                    <span class="input-label">Amount</span>
                    <div class="input-wrapper amount-wrapper">
                        <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="10">
                    </div>
                </label>

                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin"></div>
                </div>
            </section>

            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <button class="button" type="submit" v-on:click="dropinRequestPaymentMethod"><span>Test Transaction</span></button>
        </form>
    </div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        let form = document.querySelector('#payment-form');
        let client_token = "{{ $token }}";

        braintree.dropin.create({
        authorization: client_token,
        selector: '#bt-dropin',
        
        }, function (createErr, instance) {
            if (createErr) {
                console.log('Create Error', createErr);
                return;
            }
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                instance.requestPaymentMethod(function (err, payload) {
                if (err) {
                    console.log('Request Payment Method Error', err);
                    return;
                }

                // Add the nonce to the form and submit
                document.querySelector('#nonce').value = payload.nonce;
                form.submit();
                });
            });
        });
    });
</script>
@endsection