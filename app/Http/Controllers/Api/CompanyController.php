<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\CompanyClaim;
use Illuminate\Support\Facades\DB;

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
    public function __construct(Company $company,CompanyClaim $companyClaim)
    {
        $this->company = $company;
        $this->companyClaim = $companyClaim;

    }
    
    /**
     * companyRegister
     *
     * @param App\Http\Requests\CompanyRequest
     * @return array
     */
    public function store(CompanyRequest $request)
    {
        // dd($request);exit;
        $validated = $request->validated();
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
     * @param App\Http\Requests\CompanyRequest
     * @param int $id
     * @return array
     */
    public function update(CompanyRequest $request, int $id)
    {
        $validated = $request->validated();
        $this->company->findOrFail($id)->update($validated);

        return ['message' => 'ok',];
    }

    /**
     * companyDelete
     * 
     * @param int $id
     * @return array
     */
    public function destroy(int $id)
    {
        $this->company->findOrFail($id)->delete();
        
        return ['message' => 'ok',];
    }

        /**
     * companyAndClaimDelete
     * 
     * @param int $id
     * @return array
     */
    public function withDestroyClaim(int $id)
    {
        $companyWithClaim = DB::transaction(function()use($id){
            $companyWithClaim =$this->company->with('claim')->findOrFail($id);
            $companyWithClaim->claim()->delete();
            $companyWithClaim->delete();
        });

        return [
            'message' => 'ok',
            'company_with_claim' =>$companyWithClaim,
        ];
    }

    /**
     * companyAndClaimDetail
     * 
     * @param int $id
     * @return array
     */
    public function withClaim(int $id)
    {
        $companyWithClaim = $this->company
            ->with('claim')
            ->findOrFail($id);

        return [
            'message' => 'ok',
            'company_with_claim' => $companyWithClaim,
        ];
    }
}

