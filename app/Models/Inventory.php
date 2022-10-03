<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public $table = 'inventory';

    public $fillable = [
        'updated_by',
        'product_id',
        'inventory_date',
        'front_quantity',
        'back_quantity',
        'front_perpetual',
        'back_perpetual',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'updated_by' => 'integer',
        'product_id' => 'integer',
        'inventory_date' => 'date',
        'front_quantity' => 'decimal:2',
        'back_quantity' => 'decimal:2',
        'front_perpetual' => 'boolean',
        'back_perpetual' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];
}
