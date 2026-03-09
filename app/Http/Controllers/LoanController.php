<?php

namespace App\Http\Controllers;

use App\Models\HardwareItem;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /**
     * US-03: Uitleenverzoek indienen voor een hardware-item.
     */
    public function create(HardwareItem $hardwareItem)
    {
        if (!$hardwareItem->isAvailable()) {
            return redirect()->route('hardware.show', $hardwareItem)
                ->with('error', 'Dit item is momenteel niet beschikbaar voor uitleen.');
        }

        // Controleer of gebruiker al een actief verzoek heeft voor dit item
        $existingLoan = Loan::where('user_id', Auth::id())
            ->where('hardware_item_id', $hardwareItem->id)
            ->whereIn('status', ['pending', 'approved', 'borrowed'])
            ->first();

        if ($existingLoan) {
            return redirect()->route('hardware.show', $hardwareItem)
                ->with('error', 'Je hebt al een actief verzoek voor dit item.');
        }

        return view('loans.create', compact('hardwareItem'));
    }

    /**
     * US-03: Sla het uitleenverzoek op.
     */
    public function store(Request $request, HardwareItem $hardwareItem)
    {
        if (!$hardwareItem->isAvailable()) {
            return redirect()->route('hardware.show', $hardwareItem)
                ->with('error', 'Dit item is momenteel niet beschikbaar voor uitleen.');
        }

        // Controleer dubbel verzoek
        $existingLoan = Loan::where('user_id', Auth::id())
            ->where('hardware_item_id', $hardwareItem->id)
            ->whereIn('status', ['pending', 'approved', 'borrowed'])
            ->first();

        if ($existingLoan) {
            return redirect()->route('hardware.show', $hardwareItem)
                ->with('error', 'Je hebt al een actief verzoek voor dit item.');
        }

        $validated = $request->validate([
            'expected_return_date' => ['required', 'date', 'after:today'],
        ]);

        Loan::create([
            'user_id' => Auth::id(),
            'hardware_item_id' => $hardwareItem->id,
            'status' => 'pending',
            'requested_at' => now(),
            'expected_return_date' => $validated['expected_return_date'],
        ]);

        return redirect()->route('hardware.show', $hardwareItem)
            ->with('success', 'Je uitleenverzoek is ingediend en wacht op goedkeuring.');
    }
}
