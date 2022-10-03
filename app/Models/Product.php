<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public $table = 'products';

    public $fillable = [
        'plu',
        'name',
        'category_id',
        'sub_category_id',
        'asmount_in_case',
        'weighted_product',
        'price',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'plu' => 'string',
        'name' => 'string',
        'category_id' => 'integer',
        'sub_category_id' => 'integer',
        'asmount_in_case' => 'decimal:2',
        'weighted_product' => 'boolean',
        'price' => 'decimal:2', 
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

}
