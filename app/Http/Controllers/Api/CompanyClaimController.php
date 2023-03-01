<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyClaimRequest;
use App\Models\Company;
use App\Models\CompanyClaim;

class CompanyClaimController extends Controller
{
    /**
    * @var CompanyClaim
    */
    private CompanyClaim $companyClaim;
    private Company $company;

    /**
    * constructor function

    * @param CompanyClaim $companyClaim
    * @param Company $company

    */
    public function __construct(CompanyClaim $companyClaim, Company $company)
    {
        $this->companyClaim = $companyClaim;
        $this->company = $company;
    }
    
    /**
     * companyClaimRegister
     *
     * @param  \App\Http\Requests\CompanyClaimRequest $request
     * @param int $id
     * @return array
     */
    public function store(CompanyClaimRequest $request, int $id)
    {
        $validated = $request->validated();

        $companyId = $this->company->findOrFail($id);
        $companyId->claim()->create($validated);

        return [
            'message' => 'ok',
            $companyId->load('claim'),
        ];
    }

    /**
     * companyClaimDetail
     * 
     * @param  int $id
     * @return array
     */
    public function show(int $id)
    {
        return[
            'message' => 'ok',
            $this->companyClaim->findOrFail($id),
        ];
    }

    /**
     * companyClaimUpdata
     * 
     * @param  \App\Http\Requests\CompanyClaimRequest $request
     * @param  int $id
     * @return array
     */
    public function update(CompanyClaimRequest $request, int $id)
    {
        $validated = $request->validated();
        $this->companyClaim->findOrFail($id)->update($validated);

        return ['message' => 'ok'];
    }

    /**
     * companyClaimDelete
     * 
     * @param int $id
     * @return array
     */
    public function destroy(int $id)
    {
        $this->companyClaim->findOrFail($id)->delete();

        return ['message' => 'ok'];
    }
}
