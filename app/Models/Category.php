<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['namer', 'color', 'slug'];

    //dopo aver relazionato le tabelle nel DB, metto in connessione i Modelli
    public function posts() {
        return $this->hasMany('App\Models\Post');
    }
}
