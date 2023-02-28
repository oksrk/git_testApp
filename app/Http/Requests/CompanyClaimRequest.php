<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyClaimRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
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
