<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Log;

class Machine extends Model
{	

    /**
     * The attributes that are date time.
     *
     * @var array
     */
    protected $dates = ['last_contact', 'last_contact', 'uptime'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
        'ip_address', 'name', 'user_id', 'last_contact','last_contact', 'created_by'
    ];

    /**
     * Calculate the status from all machines
     *
     * @return array with "id" => "status" (online/offline)
     */

    public static function statusPing()
    {
    	$machine = Machine::all();
    	$online = array();

		foreach ($machine as $m) {
            if($m->last_contact == null){
                $online[$m->id] = "offline";
            }else{
                $diff = Carbon::parse($m->last_contact)->diffInMinutes(Carbon::now());
                if( $diff <= 10){
                    $online[$m->id] = "online"; 
                }else{
                    $online[$m->id] = "offline";                
                }
            }
		}

		return $online;
    }

     /**
     * Updatade last_contact for the machine with ip $ip
     *
     * @return return success or fail  (1 or 0)
     */

    //curl -X GET "http://10.9.98.189:8000/ping?name=scientific&uptime=$(uptime -s | sed 's/[-, ,:]//g')"

    public static function updateContact($data)
    {
        // dd($data);
        return Machine::where('name', $data['name'])->
                        update([
                            'last_contact' => Carbon::now()->toDateTimeString(),
                            'uptime' => Carbon::parse($data['uptime'])->toDateTimeString()
                        ]) == 1 ? "true<br\>" : "false<br\>";
    }  

     /**
     * Relationship with a user
     *
     * @return $this object
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }  
}
