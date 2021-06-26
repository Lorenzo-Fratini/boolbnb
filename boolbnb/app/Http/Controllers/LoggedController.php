<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use Braintree;

use App\Apartment;
use App\User;
use App\Service;
use App\Message;
use App\Statistic;
use Auth;

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
            'rooms_number' => 'required|integer',
            'beds_number' => 'required|integer',
            'bathrooms_number' => 'required|integer',
            'area' => 'required|integer',
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
            'rooms_number' => 'required|integer',
            'beds_number' => 'required|integer',
            'bathrooms_number' => 'required|integer',
            'area' => 'required|integer',
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

        $messages = Message::where('apartment_id', 'LIKE', $id) -> orderBy('created_at') -> get();
        $statistics = Statistic::where('apartment_id', 'LIKE', $id) -> orderBy('created_at') -> get();
        $services = $apartment -> services() -> wherePivot('apartment_id', '=', $id) -> get();

        return view('pages.myApartment', compact('apartment', 'messages', 'statistics', 'services'));
    }

    public function sponsorshipPayment() {

        //        $apartment = Apartment::findOrFail($id);
        
        $gateway = $this -> braintree();
        $token = $gateway->ClientToken()->generate();


        return view('pages.sponsorshipPayment', compact('token'));
    }

    public function paymentCheckout(Request $request) {

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
        // se è andato a buon fine cambio lo status dell'ordine da false a true e ritorno alla pagina checkout
        if ($result->success) {
            $transaction = $result->transaction;

            return back()->with('success_message', 'Transazione riuscita' . ' ' .  $transaction -> id);
        // se non è andato a buon fine lo statu ordine rimane a false e ritorno in pagina checkout con un errore 
        } else {
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            $error = $result -> message;
            
            return back()->withErrors('an error occured with the message' . $result -> message);
            // return back() -> withErrors('An error occured with the message:' . $result -> message);
        }
    }
}
