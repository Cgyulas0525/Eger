<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kirschbaum\PowerJoins\PowerJoins;

/**
 * Class Questionnaires
 * @package App\Models
 * @version February 21, 2023, 10:20 am UTC
 *
 * @property string $name
 * @property string $validityfrom
 * @property string $validitato
 * @property integer $active
 * @property integer $basicpackage
 * @property string $description
 */
class Questionnaires extends Model
{
    use SoftDeletes, HasFactory, PowerJoins;

    public $table = 'questionnaires';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'validityfrom',
        'validityto',
        'active',
        'basicpackage',
        'qrcode',
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
        'validityfrom' => 'date',
        'validityto' => 'date',
        'active' => 'integer',
        'basicpackage' => 'integer',
        'qrcode' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:200',
        'validityfrom' => 'required',
        'validityto' => 'nullable',
        'active' => 'required|integer',
        'basicpackage' => 'required|integer',
        'qrcode' => 'nullable|string|max:500',
        'description' => 'nullable|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function questionnairedetail() {
        return $this->hasMany(Questionnairedetails::class);
    }

    public function clientquestionnarie() {
        return $this->hasMany(Clientquestionnaries::class);
    }

    public function partnerquestionnarie() {
        return $this->hasMany(Partnerquestionnaries::class);
    }

}
