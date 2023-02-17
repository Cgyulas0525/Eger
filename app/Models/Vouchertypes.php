<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Vouchertypes
 * @package App\Models
 * @version February 16, 2023, 10:06 am UTC
 *
 * @property string $name
 * @property integer $local
 * @property integer $localfund
 * @property integer $localreplay
 * @property integer $otherfund
 * @property integer $otherreplay
 * @property string $description
 */
class Vouchertypes extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'vouchertypes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'local',
        'localfund',
        'localreplay',
        'otherfund',
        'otherreplay',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'local' => 'integer',
        'localfund' => 'integer',
        'localreplay' => 'integer',
        'otherfund' => 'integer',
        'otherreplay' => 'integer',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:200',
        'local' => 'required|integer',
        'localfund' => 'required|integer',
        'localreplay' => 'required|integer',
        'otherfund' => 'required|integer',
        'otherreplay' => 'required|integer',
        'description' => 'nullable|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
