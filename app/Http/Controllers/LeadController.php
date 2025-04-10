<?php

namespace App\Http\Controllers;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::all();
        return view('leads.index', compact('leads'));
    }

    public function create()
    {
        return view('leads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'contact_name' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:20',
            'email' => 'nullable|email',
            'lead_type' => 'required|array',
        ]);

        $lead = new Lead($request->all());

        // Auto-generate Lead Number
        $latestId = Lead::max('id') + 1;
        $lead->lead_number = 'Lead/CRM/2025-26/' . str_pad($latestId, 3, '0', STR_PAD_LEFT);

        // Store products as comma-separated string if needed
        if ($request->has('products_enquired')) {
            $lead->products_enquired = implode(',', $request->products_enquired);
        }

        $lead->lead_type = implode(',', $request->lead_type);
        $lead->save();

        return redirect()->route('leads.index')->with('success', 'Lead created successfully.');
    }


    public function show(Lead $lead)
    {
        return view('leads.show', compact('lead'));
    }

    public function edit(Lead $lead)
    {
        return view('leads.edit', compact('lead'));
    }


    public function update(Request $request, Lead $lead)
    {
        $request->validate([
            'contact_name' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:20',
            'email' => 'nullable|email',
            'lead_type' => 'required|array',
        ]);

        $data = $request->all();

        if ($request->has('products_enquired')) {
            $data['products_enquired'] = implode(',', $request->products_enquired);
        }

        $data['lead_type'] = implode(',', $request->lead_type);

        $lead->update($data);

        return redirect()->route('leads.index')->with('success', 'Lead updated successfully.');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully.');
    }
}
