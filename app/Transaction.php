<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    protected $guarded=[];

    public function client()
    {
       return  $this->belongsTo(Client::class, "client_id");
    }
}
