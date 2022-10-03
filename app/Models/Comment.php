<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $table = 'comments';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'user_id',
        'product_id',
        'inventory_id',
        'content',
        'deleted',
        'edited',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'product_id' => 'integer',
        'inventory_id' => 'integer',
        'content' => 'string',
        'deleted' => 'boolean',
        'edited' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];
}
