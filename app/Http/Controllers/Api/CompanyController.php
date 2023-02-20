<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompanyClaim;

class CompanyController extends Controller
{
    /**
    * @var Company
    * @var CompanyClaim
    */
    private Company $company;
    private CompanyClaim $companyClaim;

    /**
    * constructor function
    * @param Company $company
    */
    public function __construct(Company $company, CompanyClaim $companyClaim)
    {
        $this->company = $company;
        $this->companyClaim = $companyClaim;
    }
    
    /**
     * company_Register
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->params());
        $this->company->fill($validated)->save();

        return ['message' => 'ok',];
    }

    /**
     * company_Detail
     * @param  int $id
     * @return array
     */
    public function show(int $id)
    {
        return[
            'message' => 'ok',
            $this->company->findOrFail($id),
        ];
    }

    /**
     * company_Updata
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return array
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate($this->params());
        $this->company->findOrFail($id)->update($validated);

        return ['message' => 'ok',];
    }

    /**
     * company Delete
     * 
     * @param \Iluminate\Http\Request $request
     * @param int $id
     * @return array
     */
    public function destroy(int $id)
    {
        $this->company->findOrFail($id)->delete();

        return ['message' => 'ok',];
    }
    
    /**
     * company_And_Claim_Detail
     * @param  int $id
     * @return array
     */
    public function showclaim(int $id)
    {
        // $id = Company::with('companyClaim')->get();

        return[
            'message' => 'ok',
            // $id,
        ];
    }

    private function params()
    {
        return[
        'company_name' => ['required', 'string', 'max:255'],
        'company_name_kana'=> ['required', 'string', 'max:255'],
        'post_code'=> ['required', 'string', 'max:255'],
        'address'=> ['required', 'string', 'max:255'],
        'tel'=> ['required', 'string', 'max:255'],
        'representative_name'=> ['required', 'string', 'max:255'],
        'representative_name_kana'=> ['required', 'string', 'max:255'],
        ];
    }

    private function andparams()
    {
        return[
            'company_name' => ['required', 'string', 'max:255'],
            'company_name_kana'=> ['required', 'string', 'max:255'],
            'post_code'=> ['required', 'string', 'max:255'],
            'address'=> ['required', 'string', 'max:255'],
            'tel'=> ['required', 'string', 'max:255'],
            'representative_name'=> ['required', 'string', 'max:255'],
            'representative_name_kana'=> ['required', 'string', 'max:255'], 
            'claim_name' => ['required', 'string', 'max:255'],
            'claim_name_kana'=> ['required', 'string', 'max:255'],
            'claim_post_code'=> ['required', 'string', 'max:255'],
            'claim_address'=> ['required', 'string', 'max:255'],
            'claim_tel'=> ['required', 'string', 'max:255'],
            'claim_department_name'=> ['required', 'string', 'max:255'],
            'claim_address_name'=> ['required', 'string', 'max:255'],
            'claim_address_name_kana'=> ['required', 'string', 'max:255'],    
        ];
    }
}

