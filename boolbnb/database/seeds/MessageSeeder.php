<?php

use Illuminate\Database\Seeder;

use App\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        $messages = [
            [
                'title' => 'Richiesta Prenotazione',
                'sender' => 'Luca Neri',
                'text' => 'Sarei interessato ad affitare questo appartamento, quali sono le date disponibili?',
                'date' => '2021-06-12',
                'apartment_id' => '1'
            ],
            [
                'title' => 'Richiesta Prenotazione',
                'sender' => 'Marco Rossi',
                'text' => 'Sarei interessato ad affitare questo appartamento, quali sono le date disponibili?',
                'date' => '2021-06-09',
                'apartment_id' => '2'
            ],
            [
                'title' => 'Richiesta Prenotazione',
                'sender' => 'Francesca Bianchi',
                'text' => 'Sarei interessata ad affitare questo appartamento, quali sono le date disponibili?',
                'date' => '2021-05-21',
                'apartment_id' => '3'
            ],
            [
                'title' => 'Richiesta Prenotazione',
                'sender' => 'Guybrush Threepwood',
                'text' => 'Sarei interessato ad affitare questo appartamento, quali sono le date disponibili?',
                'date' => '2021-04-15',
                'apartment_id' => '4'
            ],
            [
                'title' => 'Richiesta Prenotazione',
                'sender' => 'Simone Icardi',
                'text' => 'Sarei interessato ad affitare questo appartamento, quali sono le date disponibili?',
                'date' => '2021-04-08',
                'apartment_id' => '5'
            ],
        ];
        
        foreach ($messages as $key => $message) {
            
            Message::create($message);
        }
    }
}
