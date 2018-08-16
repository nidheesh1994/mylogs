<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;

class MyLog extends Model
{
    //
    protected $fillable = ['userId', 'log', 'date'];

    //Log create
    public function create($data){
        try{
            $this->userId = $data['userId'];
            $this->log = $data['log'];
            $this->date = $data['date'];
            $this->save();
            return 1;
        }
        catch (Exception $e){
            echo 'Error : ' .$e->getMessage();
        }

    }
}
