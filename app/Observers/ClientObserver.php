<?php

namespace App\Observers;
use Carbon\Carbon;
use App\Models\Client;
use App\Helpers\PhoneHelper;

class ClientObserver
{
    
     public function creating(Client $client): void
    {
      
        if (!$client->start_date) {
            $client->start_date = Carbon::now()->addDays(4);
        }

        if (!$client->expired_date) {
            $client->expired_date = $client->start_date->copy()->addYear();
        }


        $client->phone = PhoneHelper::formatPhone($client->phone);
       
    }
}
