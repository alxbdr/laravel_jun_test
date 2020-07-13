<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Code extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['code'];

    /**
     * Get the user that owns the code
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Insert random codes in DB
     * 
     * @param String $chars 
     * @param Integer $quantity 
     * 
     * @return boolean
     */
    public function generate_codes ($chars, int $quantity) {
        $i=0;
        $codes_array = [];
        while($i < $quantity) {
            $random = substr(str_shuffle($chars), 0, 10);
            if(!$this->where('code', $random)->exists()) {
                $codes_array[] = [
                    'code' => $random,
                    'created_at' => now(),
                    'user_id' => Auth::user()->id,
                ];
                $i++;
            }      
        }

        return $this->insert($codes_array);
    }

}
