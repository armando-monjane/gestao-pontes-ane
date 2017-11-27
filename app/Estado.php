<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';

    protected $fillable = [];

    public function pontes() {

        return $this->belongsToMany('App\Ponte');
    }
}
