<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Card;

class CardController extends Controller
{
    public function getCardsByDeckId(Request $request)
    {
        $cards = Card::where('deckId', $request->id)->get();
        return response()->json($cards);
    }
}
