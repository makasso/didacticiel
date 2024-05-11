<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::latest()->get();
        confirmDelete('Supprimer Société', 'Voulez-vous vraiment supprimer cette société?');

        return view('admin.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required',
        ]);

        Company::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.company.index')->withToastSuccess('Société crée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::find($id);

        return view('admin.company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::find($id);

        return view('admin.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' =>'string|required',
        ]);

        $company = Company::find($id);

        $company->name = $request->name;

        $company->save();

        return redirect()->route('admin.company.index')->withToastSuccess('Société modifiée avec succès');  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::find($id);

        $company->delete();

        return redirect()->route('admin.company.index')->withToastSuccess('Société supprimée avec succès');
    }
}
