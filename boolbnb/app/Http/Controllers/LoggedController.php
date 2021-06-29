<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use Braintree;

use Auth;
use App\Apartment;
use App\Message;
use App\Service;
use App\Sponsorship;
use App\Statistic;
use App\User;

class LoggedController extends Controller {
    
    public function __construct() {
        
        $this->middleware('auth');
    }

    private function braintree(){
        $gateway = new Braintree\Gateway([
            'environment' => env('BT_ENVIRONMENT'),
            'merchantId' => env('BT_MERCHANT_ID'),
            'publicKey' => env('BT_PUBLIC_KEY'),
            'privateKey' => env('BT_PRIVATE_KEY')
        ]);

        return $gateway;
    }

    public function dashboard($id) {

        $id = Crypt::decrypt($id);

        $user = User::findOrFail($id);
        $apartments = Apartment::where('user_id', 'LIKE', $id) -> orderBy('city') -> get();
    
        return view('pages.dashboard', compact('user', 'apartments'));
    }
    
    public function createApartment() {

        $services = Service::all();

        return view('pages.apartmentCreate', compact('services'));
    }
    public function storeApartment(Request $request) {

        $validation = $request -> validate([
            'title' => 'required|string|max:256',
            'cover_image' => 'required|mimes:jpeg,png,jpg',
            'description' => 'required|string',
            'rooms_number' => 'required|integer|min:1',
            'beds_number' => 'required|integer|min:1',
            'bathrooms_number' => 'required|integer|min:1',
            'area' => 'required|integer|min:1',
            'address' => 'required|string|min:1',
            'city' => 'required|string|min:1',
            'country' => 'required|string|min:1',
            'postal_code' => 'required|string|min:5|max:5',
            'user_id' => 'required|exists:App\User,id|integer',
            'service_id.*' => 'required_if:current,1|distinct|exists:App\Service,id|integer'       
        ]);

        $user = User::findOrFail($request -> get('user_id'));

        $img = $request -> file('cover_image');
        $imgExt = $img -> getClientOriginalExtension();

        $imgNewName = time() . rand(0, 1000) . '.' . $imgExt;
        $folder = '/images/';

        $imgFile = $img -> storeAs($folder, $imgNewName, 'public');

        $apartment = Apartment::make($validation);
        $apartment -> user() -> associate($user);
        $apartment -> cover_image = $imgNewName;
        $apartment -> save();

        $apartment -> services() -> attach($request -> get('service_id'));
        $apartment -> save();

        return redirect() -> route('dashboard', Crypt::encrypt(['id' => $user -> id]));
    }

    public function editApartment($id) {

        $apartment = Apartment::findOrFail(Crypt::decrypt($id));
            
        $user = User::findOrFail($apartment -> user_id);
        $services = Service::all();

        return view('pages.apartmentEdit', compact('apartment', 'user', 'services'));
    }
    public function updateApartment(Request $request, $id) {

        $validation = $request -> validate([
            'title' => 'required|string|max:256',
            'cover_image' => 'mimes:jpeg,png,jpg',
            'description' => 'required|string',
            'rooms_number' => 'required|integer|min:1',
            'beds_number' => 'required|integer|min:1',
            'bathrooms_number' => 'required|integer|min:1',
            'area' => 'required|integer|min:1',
            'address' => 'required|string|min:1',
            'city' => 'required|string|min:1',
            'country' => 'required|string|min:1',
            'postal_code' => 'required|string|min:5|max:5',
            'user_id' => 'required|exists:App\User,id|integer',
            'service_id.*' => 'required_if:current,1|distinct|exists:App\Service,id|integer'       
        ]);

        $user = User::findOrFail($request -> get('user_id'));

        $apartment = Apartment::findOrFail($id);
        $apartment -> update($validation);

        $apartment -> user() -> associate($user);

        if ($request -> file('cover_image')) {
            
            $img = $request -> file('cover_image');
            $imgExt = $img -> getClientOriginalExtension();

            $imgNewName = time() . rand(0, 1000) . '.' . $imgExt;
            $folder = '/images/';

            $imgFile = $img -> storeAs($folder, $imgNewName, 'public');

            $apartment -> cover_image = $imgNewName;
        }

        $apartment -> save();

        $apartment -> services() -> sync($request -> get('service_id'));

        return redirect() -> route('dashboard', Crypt::encrypt(['id' => $user -> id]));
    }

    public function destroyApartment($id) {

        $apartment = Apartment::findOrFail(Crypt::decrypt($id));

        $userId = $apartment -> user_id;
        $apartment -> delete();
        $apartment -> save();

        return redirect() -> route('dashboard', Crypt::encrypt(['id' => $userId]));
    }

    public function myApartment($id) {

        $apartment = Apartment::findOrFail(Crypt::decrypt($id));

        $messages = Message::where('apartment_id', 'LIKE', Crypt::decrypt($id)) -> orderBy('created_at') -> get();
        $statistics = Statistic::where('apartment_id', 'LIKE', Crypt::decrypt($id)) -> orderBy('created_at') -> get();
        $services = $apartment -> services() -> wherePivot('apartment_id', '=', Crypt::decrypt($id)) -> get();

        return view('pages.myApartment', compact('apartment', 'messages', 'statistics', 'services'));
    }

    public function sponsorshipPayment($id) {

        $apartment = Apartment::findOrFail(Crypt::decrypt($id));
       
        $gateway = $this -> braintree();
        $token = $gateway->ClientToken()->generate();

        $sponsorships = Sponsorship::all();

        return view('pages.sponsorshipPayment', compact('token', 'sponsorships', 'apartment'));
    }

    public function paymentCheckout(Request $request, $id) {

        $gateway = $this -> braintree();
        $amount = $request -> amount;
        $nonce = $request -> payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        $sponsorship = Sponsorship::where('price', 'LIKE', $request -> amount);

        $apartment = Apartment::findOrFail($id);

        if ($result->success) {

            $transaction = $result->transaction;

            $getSponsorship = Sponsorship::where('price', 'LIKE', $request -> amount) -> get();

            $sponsorship = $getSponsorship[0];

            date_default_timezone_set('Europe/Rome');
            $startDate = date('Y-m-d H:i:s', time());

            if ($sponsorship -> id == 1) {
        
                $endDate = date("Y-m-d H:i:s", strtotime('+24 hours', strtotime($startDate)));
            } else if ($sponsorship -> id == 2) {

                $endDate = date("Y-m-d H:i:s", strtotime('+48 hours', strtotime($startDate)));
            } else {

                $endDate = date("Y-m-d H:i:s", strtotime('+144 hours', strtotime($startDate)));
            }

            $apartment -> sponsorships() -> attach($sponsorship, ['start_date' => $startDate, 'end_date' => $endDate]);
            $apartment -> save();


            return back()->with('success_message', 'Transazione riuscita' . ' ' .  $transaction -> id);
        } /* else {

            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            $error = $result -> message;
            
            return back()->withErrors('an error occured with the message' . $result -> message);
        } */
    }
}
