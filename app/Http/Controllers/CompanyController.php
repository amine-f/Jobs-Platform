<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CompanyController extends Controller
{
    public function create()
    {
        if (auth()->user()->company) {
            Alert::toast('You already have a company!', 'info');
            return $this->edit();
        }
        $categories = CompanyCategory::all();
        return view('company.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validateCompany($request);

        $company = new Company();
        if ($this->companySave($company, $request)) {
            Alert::toast('Company created! Now you can add posts.', 'success');
            return redirect()->route('account.authorSection');
        }
        Alert::toast('Failed!', 'error');
        return redirect()->route('account.authorSection');
    }

    public function edit()
    {
        $company = auth()->user()->company;
        $categories = CompanyCategory::all();
        return view('company.edit', compact('company', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validateCompanyUpdate($request);

        $company = auth()->user()->company;
        if ($this->companyUpdate($company, $request)) {
            Alert::toast('Company updated!', 'success');
            return redirect()->route('account.authorSection');
        }
        Alert::toast('Failed!', 'error');
        return redirect()->route('account.authorSection');
    }

    protected function validateCompany(Request $request)
    {
        return $request->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:5',
            'logo' => 'required|image|max:2999',
            'category' => 'required',
            'website' => 'required|string',
            'cover_img' => 'sometimes|image|max:3999'
        ]);
    }

    protected function validateCompanyUpdate(Request $request)
    {
        return $request->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:5',
            'logo' => 'sometimes|image|max:2999',
            'category' => 'required',
            'website' => 'required|string',
            'cover_img' => 'sometimes|image|max:3999'
        ]);
    }

    protected function companySave(Company $company, Request $request)
    {
        $company->user_id = auth()->user()->id;
        $company->title = $request->title;
        $company->description = $request->description;
        $company->company_category_id = $request->category;
        $company->website = $request->website;

        // Save logo
        $company->logo = $this->storeFile($request->file('logo'), 'public/companies/logos', $company->logo);

        // Save cover image if exists
        $company->cover_img = $request->hasFile('cover_img')
            ? $this->storeFile($request->file('cover_img'), 'public/companies/cover', $company->cover_img)
            : $company->cover_img;

        return $company->save();
    }

    protected function companyUpdate(Company $company, Request $request)
    {
        $company->user_id = auth()->user()->id;
        $company->title = $request->title;
        $company->description = $request->description;
        $company->company_category_id = $request->category;
        $company->website = $request->website;

        // Update logo if uploaded
        if ($request->hasFile('logo')) {
            $company->logo = $this->storeFile($request->file('logo'), 'public/companies/logos', $company->logo);
        }

        // Update cover image if uploaded
        if ($request->hasFile('cover_img')) {
            $company->cover_img = $this->storeFile($request->file('cover_img'), 'public/companies/cover', $company->cover_img);
        }

        return $company->save();
    }

    protected function storeFile($file, $path, $existingFile = null)
    {
        // Generate unique filename
        $fileNameToStore = time() . '_' . $file->getClientOriginalName();
        // Store file
        $filePath = $file->storeAs($path, $fileNameToStore);

        // Delete old file if exists
        if ($existingFile) {
            Storage::delete($existingFile);
        }

        return 'storage/' . str_replace('public/', '', $filePath);
    }

    public function destroy()
    {
        $company = auth()->user()->company;
        if ($company) {
            // Delete logo
            Storage::delete('public/companies/logos/' . basename($company->logo));
            // Delete cover image if exists
            if ($company->cover_img !== 'nocover') {
                Storage::delete('public/companies/cover/' . basename($company->cover_img));
            }

            if ($company->delete()) {
                return redirect()->route('account.authorSection');
            }
        }
        return redirect()->route('account.authorSection');
    }
}
