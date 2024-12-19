<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Deck;

class DeckController extends Controller
{
    public function getDecksByID(Request $request)
    {
            // Fetch decks belonging to the user
        $decks = Deck::where('userId', $request->id)->get();

        // Return the decks as a JSON response
        return response()->json($decks);
    }

    public function insertDeck(Request $request) {
        $deck = Deck::create([
            'title' => $request->title,
            'description' => $request->description,
            'userId' => $request->userId,
        ]);

        return response()->json($deck);
    }
    //
}
