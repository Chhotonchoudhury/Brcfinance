<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketCode;
use App\Models\RdInterestSlab;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    //

    public function Marketindex(Request $request)
    {
        $search = $request->input('search', '');
        $marketCodes = MarketCode::when($search, function ($query, $search) {
            $query->where('code', 'like', "%{$search}%")
                  ->orWhere('area_name', 'like', "%{$search}%");
        })->paginate(50);

        return view('marketcode.index', compact('marketCodes', 'search'));
    }

    public function Marketform($id = null)
    {
        $marketCode = $id ? MarketCode::findOrFail($id) : null;
        return view('marketcode.form', compact('marketCode'));
    }

    public function MarketstoreOrUpdate(Request $request, $id = null)
    {
        // If updating, find the existing model
        $marketCode = $id ? MarketCode::findOrFail($id) : new MarketCode();

        // Validate input
        $validated = $request->validate([
            'code' => [
                'required',
                'string',
                Rule::unique('market_codes', 'code')->ignore($id, 'id'), // Explicitly pass the primary key column
            ],
            'area_name' => 'required|string|max:255',
            'pincode' => 'required|string|max:10',
            'district' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'status' => 'required|boolean',
        ]);

        // Fill and save
        $marketCode->fill($validated);
        $marketCode->save();

        $message = $id ? 'Market code updated successfully' : 'Market code created successfully';
        return redirect()->route('marketcode.index')->with('success', $message);
    }
    
     public function RdInSlabindex(Request $request)
    {
        $search = $request->input('search', '');
        $marketCodes = RdInterestSlab::when($search, function ($query, $search) {
            $query->where('remarks', 'like', "%{$search}%");
        })->paginate(50);

        return view('RdInterestSlab.index', compact('marketCodes', 'search'));
    }

    public function RdInSlabform($id = null)
    {
        $rdInterestSlab = $id ? RdInterestSlab::findOrFail($id) : null;
        return view('RdInterestSlab.form', compact('rdInterestSlab'));
    }

    public function RdInSlabstoreOrUpdate(Request $request, $id = null)
    {
        // If updating, find the existing model
        $marketCode = $id ? RdInterestSlab::findOrFail($id) : new RdInterestSlab();

        $validated = $request->validate([
            'min_days' => 'required|integer',
            'max_days' => 'required|integer',
            'percentage' => 'required|numeric',
            'remarks' => 'required|string',
            'status' => 'required|boolean',
        ]);
    
        $marketCode->fill($validated);
        $marketCode->save();

        $message = $id ? 'RD Interest slab updated successfully' : 'RD Interest slab created successfully';
        return redirect()->route('rd-interest-slab.index')->with('success', $message);
    }


}
