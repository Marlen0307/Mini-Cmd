<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManageCompanies extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('admin', $request->user());
        $companies = Company::paginate(10);
        return view("admin.Company.manage")->with('companies', $companies );
    }


    public function create(Request $request)
    {
        $this->authorize('admin', $request->user());
        return view("admin.Company.add");
    }

    public function store(StoreCompanyRequest $request)
    {
        $request->authorize();

        //validate the request
        $request->validated();

        //store the img in the public disk and get the img path
        $imgpath = $request->file('logo')->store('companyLogos','public');

        //insert the company in the companies table
        Company::create([
            'name'=> $request->name,
            'email' => $request->email,
            'logo' => $imgpath,
            'website' => $request->website
        ]);

        return redirect()->route("companies.create")->with('status', 'Company registered successfully');
    }

    public function edit(Request $request,Company $company)
    {
        $this->authorize('admin', $request->user());
        return view('admin.Company.edit')->with('company', $company);
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        //authorize the request
        $request->authorize();

        //validatet the request
        $request->validated();

        //update the company
        $company->name = $request->name;
        $company->email = $request->email;
        if ($request->logo){

            //if any logo was submited we will delete the old one and save the new one
            Storage::disk('public')->delete($company->logo);
            $imgpath = $request->file('logo')->store('companyLogos','public');
            $company->logo = $imgpath;
        }
        $company->website = $request->website;
        $company->save();

        return redirect()->route('companies.edit', $company)->with('status', "$company->name updated successfully");
    }

    public function destroy(Company $company, Request $request)
    {
        $this->authorize('admin', $request->user());
        //delete the company logo from the public disk
        Storage::disk('public')->delete($company->logo);

        //delete the company
        $company->delete();

        return redirect()->route('companies.index');
    }
}
