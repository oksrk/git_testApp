<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyClaim;

class CompanyClaimController extends Controller
{
    /**
    * @var CompanyClaim
    */
    private CompanyClaim $companyclaim;

    /**
    * constructor function
    * @param CompanyClaim $companyClaim
    */
    public function __construct(CompanyClaim $companyclaim)
    {
        $this->companyclaim = $companyclaim;
    }
    
    /**
     * companyClaim_Register
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->params_Claim());
        $this->companyclaim->fill($validated)->save();

        return ['message' => 'ok'];
    }

    /**
     * companyClaim_Detail
     * @param  int $id
     * @return array
     */
    public function show(int $id)
    {
        return[
            'message' => 'ok',
            $this->companyclaim->findOrFail($id),
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
        $validated = $request->validate($this->params_Claim());
        $this->companyclaim->findOrFail($id)->update($validated);

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
        $this->companyclaim->findOrFail($id)->delete();
        return ['message' => 'ok'];
    }

    private function params_Claim()
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
