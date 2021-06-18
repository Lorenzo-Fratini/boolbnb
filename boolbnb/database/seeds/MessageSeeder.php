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
                'email' => 'Luca Neri',
                'text' => 'Sarei interessato ad affitare questo appartamento, quali sono le date disponibili?',
                'apartment_id' => '1'
            ],
            [
                'email' => 'Marco Rossi',
                'text' => 'Sarei interessato ad affitare questo appartamento, quali sono le date disponibili?',
                'apartment_id' => '2'
            ],
            [
                'email' => 'Francesca Bianchi',
                'text' => 'Sarei interessata ad affitare questo appartamento, quali sono le date disponibili?',
                'apartment_id' => '3'
            ],
            [
                'email' => 'Guybrush Threepwood',
                'text' => 'Sarei interessato ad affitare questo appartamento, quali sono le date disponibili?',
                'apartment_id' => '4'
            ],
            [
                'email' => 'Simone Icardi',
                'text' => 'Sarei interessato ad affitare questo appartamento, quali sono le date disponibili?',
                'apartment_id' => '5'
            ],
        ];
        
        foreach ($messages as $key => $message) {
            
            Message::create($message);
        }
    }
}
