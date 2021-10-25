<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'image', 'slug', 'category_id'];

    public function getFormattedDate($column, $format = 'd-m-Y H:i:s') {
        return Carbon::create($this->$column)->format($format);
    }

    //dopo aver relazionato le tabelle nel DB, metto in connessione i Modelli
    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    //relazione con Tag
    public function tags() {
        return $this->belongsToMany('App\Models\Tag');
    }
}
