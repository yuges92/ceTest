<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    protected $guarded=[];

    public function client()
    {
        $this->belongsTo(Client::class, "client_id");
    }
}
