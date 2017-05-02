<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Machine extends Model
{	
	protected $fillable = [
        'ip_address', 'name', 'user_id', 'last_contact'
    ];

    public static function statusPing()
    {
    	$machine = Machine::all();
    
    	$online = array();

		foreach ($machine as $m) {
			// exec("ping -c1 ". $m->ip_address, $output, $return);
            // $m->updated_at
            if($m->last_contact == null){
                $online[$m->id] = "offline";
            }else if( Carbon::create($m->last_contact)->diffInMinutes(Carbon::now()) <= 10){
                $online[$m->id] = "online";
            }else{
                $online[$m->id] = "offline";
            }

			// $online[$m->id] = $return ? "offline" : "online";
		}

		return $online;
    }

    public static function updateContact($ip)
    {
        return Machine::where('ip_address', $ip)->update(['last_contact' => Carbon::now()->toDateTimeString()]);
    }  

    public function user()
    {
        return $this->belongsTo(User::class);
    }  
}
