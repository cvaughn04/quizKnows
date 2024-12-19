<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'front',
        'back',
        'deckId',
    ];

    public function deck() {
        return $this->belongsTo(Deck::class);
    }
}
