<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceCategory extends Model
{
    use HasFactory;

    protected $table = 'finance_categories';

    protected $guarded = [
        //
    ];

     /**
     * 
     *  Relations
     * 
     */
    public function financeRecords()
    {
        return $this->hasMany(FinanceRecord::class, 'category_id', 'id');
    }
}
