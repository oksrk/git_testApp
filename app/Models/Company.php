<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    
     /**
    * @var array
    */
    protected $fillable = [
        'company_name',
        'company_name_kana',
        'post_code',
        'address',
        'tel',
        'representative_name',
        'representative_name_kana',
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];
}
