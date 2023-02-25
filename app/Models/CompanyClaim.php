<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CompanyClaim extends Model
{
    use HasFactory;
    
     /**
    * @var array
    */
    protected $fillable = [
        'company_id',
        'claim_name',
        'claim_name_kana',
        'post_code',
        'address',
        'tel',
        'claim_department_name',
        'claim_address_name',
        'claim_address_name_kana',
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
