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
     * companyRegister
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->getCompanyValidationRule());
        $this->company->fill($validated)->save();

        return ['message' => 'ok',];
    }

    /**
     * companyDetail
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
     * companyUpdata
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return array
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate($this->getCompanyValidationRule());
        $this->company->findOrFail($id)->update($validated);

        return ['message' => 'ok',];
    }

    /**
     * companyDelete
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
     * companyAndClaimDetail
     * @param int $id
     * @return array
     */
    public function showClaim(int $id)
    {
        $companyData = $this->company
            ->findOrFail($id)
            ->join('company_claims', 'companies.id', '=', 'company_claims.company_id')
            ->get();

        return [
            'message' => 'ok',
            'company_data' => $companyData,
        ];
    }

    private function getCompanyValidationRule()
    {
        return [
            'company_name' => ['required', 'string', 'max:255'],
            'company_name_kana'=> ['required', 'string', 'max:255'],
            'post_code'=> ['required', 'string', 'max:255'],
            'address'=> ['required', 'string', 'max:255'],
            'tel'=> ['required', 'string', 'max:255'],
            'representative_name'=> ['required', 'string', 'max:255'],
            'representative_name_kana'=> ['required', 'string', 'max:255'],
        ];
    }

}

