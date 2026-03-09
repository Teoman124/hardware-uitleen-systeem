<?php

namespace App\Http\Controllers;

use App\Models\HardwareItem;
use Illuminate\Http\Request;

class HardwareItemController extends Controller
{
    /**
     * US-01: Toon een lijst van beschikbare hardware-items.
     */
    public function index(Request $request)
    {
        $query = HardwareItem::where('status', 'available');

        // Zoeken op naam, merk, categorie
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('brand', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('model', 'like', "%{$search}%");
            });
        }

        // Filteren op categorie
        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }

        $items = $query->orderBy('name')->paginate(12);

        // Alle unieke categorieën voor het filter
        $categories = HardwareItem::where('status', 'available')
            ->distinct()
            ->pluck('category')
            ->filter()
            ->sort()
            ->values();

        return view('hardware.index', compact('items', 'categories'));
    }

    /**
     * US-02: Toon details van een hardware-item.
     */
    public function show(HardwareItem $hardwareItem)
    {
        return view('hardware.show', compact('hardwareItem'));
    }
}
