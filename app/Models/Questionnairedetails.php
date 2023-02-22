<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Questionnairedetails
 * @package App\Models
 * @version February 22, 2023, 8:53 am UTC
 *
 * @property integer $questionnaire_id
 * @property string $name
 * @property integer $detailtype_id
 * @property integer $required
 * @property integer $readonly
 * @property integer $long
 * @property integer $rowcount
 * @property string $description
 */
class Questionnairedetails extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'questionnairedetails';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'questionnaire_id',
        'name',
        'detailtype_id',
        'required',
        'readonly',
        'long',
        'rowcount',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'questionnaire_id' => 'integer',
        'name' => 'string',
        'detailtype_id' => 'integer',
        'required' => 'integer',
        'readonly' => 'integer',
        'long' => 'integer',
        'rowcount' => 'integer',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'questionnaire_id' => 'required|integer',
        'name' => 'required|string|max:200',
        'detailtype_id' => 'required|integer',
        'required' => 'required|integer',
        'readonly' => 'required|integer',
        'long' => 'nullable|integer',
        'rowcount' => 'nullable|integer',
        'description' => 'nullable|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function questionnaire() {
        return $this->belongsTo(Questionnaires::class);
    }

    public function detailtype() {
        return $this->belongsTo(DetailTypes::class);
    }

}