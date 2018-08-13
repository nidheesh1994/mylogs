<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //
    protected $fillable = ['userId', 'log'];

    //Log create
    public function createLog($data){
        $this->userId = $data['userId'];
        $this->log = $data['log'];
        $this->save();
        return 1;
    }
}
