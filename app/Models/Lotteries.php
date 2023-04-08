<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kirschbaum\PowerJoins\PowerJoins;

/**
 * Class Lotteries
 * @package App\Models
 * @version February 21, 2023, 11:17 am UTC
 *
 * @property string $name
 * @property string $lotteriedate
 * @property string $content
 * @property string $description
 * @property integer $active
 */
class Lotteries extends Model
{
    use SoftDeletes, HasFactory, PowerJoins;

    public $table = 'lotteries';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'lotteriedate',
        'content',
        'description',
        'active',
        'validityfrom',
        'validityto',

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'lotteriedate' => 'date',
        'content' => 'string',
        'description' => 'string',
        'active' => 'integer',
        'validityfrom' => 'date',
        'validityto' => 'date'

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:200',
        'lotteriedate' => 'required',
        'content' => 'nullable|string|max:500',
        'description' => 'nullable|string|max:500',
        'active' => 'required|integer',
        'validityfrom' => 'required',
        'validityto' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


}
