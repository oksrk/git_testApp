<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
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
     * companyClaim_Register
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return array
     */
    public function store(Request $request, int $id)
    {
        $validated = $request->validate($this->paramsClaim());

        $companyId = $this->company->findOrFail($id);
        $companyId->companyClaim()->create($validated);

        return [
            'message' => 'ok',
            $companyId->load('companyclaim'),
        ];
    }

    /**
     * companyClaim_Detail
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
     * companyClaim_Updata
     * 
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return array
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate($this->paramsClaim());
        $this->companyClaim->findOrFail($id)->update($validated);

        return ['message' => 'ok'];
    }

    /**
     * companyClaim_Delete
     * 
     * @param \Iluminate\Http\Request $request
     * @param int $id
     * @return array
     */
    public function destroy(int $id)
    {
        $this->companyClaim->findOrFail($id)->delete();

        return ['message' => 'ok'];
    }

    private function paramsClaim()
    {
        return[
        'claim_name' => ['required', 'string', 'max:255'],
        'claim_name_kana'=> ['required', 'string', 'max:255'],
        'post_code'=> ['required', 'string', 'max:255'],
        'address'=> ['required', 'string', 'max:255'],
        'tel'=> ['required', 'string', 'max:255'],
        'claim_department_name'=> ['required', 'string', 'max:255'],
        'claim_address_name'=> ['required', 'string', 'max:255'],
        'claim_address_name_kana'=> ['required', 'string', 'max:255'],
        ];
    }
}
