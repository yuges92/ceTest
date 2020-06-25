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
       return  $this->hasMany(Transaction::class,"client_id");
    }


    public function getFullname(){
        return "$this->firstName $this->lastName";
    }
}
