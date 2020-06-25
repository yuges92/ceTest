<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{


    protected $fillable = [
        'firstName',
        'lastName',
        'avatar',
        'email',
    ];

    public function transactions(){
        $this->hasMany(Transaction::class,"client_id");
    }


}
