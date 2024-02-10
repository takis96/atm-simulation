<?php

namespace App\Http\Controllers;

use App\Models\AtmNote;
use Illuminate\Http\Request;

class AtmNoteController extends Controller
{

    public function initializeAtm(Request $request)
    {
        $request->validate([
            'note_value' => 'required|in:20,50',
            'quantity' => 'required|integer|min:0',
        ]);

        $noteValue = $request->input('note_value');
        $quantity = $request->input('quantity');

        $note = AtmNote::where('note_value', $noteValue)->first();

        if ($note) {
            $note->quantity += $quantity;
            $note->save();
        } else {
            AtmNote::create([
                'note_value' => $noteValue,
                'quantity' => $quantity,
            ]);
        }

        return response()->json(['message' => 'ATMinitialized successfully']);
    }

    public function getAvailableNotes()
    {
        $notes = AtmNote::all(['note_value', 'quantity'])->toArray();
        return response()->json(['notes' => $notes]);
    }


    public function dispenseMoney(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer|min:20',
        ]);

        $amount = $request->input('amount');

        // Check if the amount can be divided by 50
        $num50s = intval($amount / 50);
        $remainingAmount = $amount % 50;

        $notes50 = AtmNote::where('note_value', 50)->first();

        if ($notes50 && $notes50->quantity >= $num50s) {
            // Check if the amount can be divided by 20 with the remaining amount
            $num20s = intval($remainingAmount / 20);
            $remainingAmount %= 20;

            $notes20 = AtmNote::where('note_value', 20)->first();

            if ($notes20 && $notes20->quantity >= $num20s && $remainingAmount == 0) {
                // Dispense money and update quantities
                $notes50->quantity -= $num50s;
                $notes50->save();

                $notes20->quantity -= $num20s;
                $notes20->save();

                return response()->json(['message' => 'Money dispensed successfully']);
            }
        }

        return response()->json(['error' => 'Unable to dispense this amount with available notes']);
    }



}
