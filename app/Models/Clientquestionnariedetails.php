<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kirschbaum\PowerJoins\PowerJoins;

/**
 * Class Clientquestionnariedetails
 * @package App\Models
 * @version March 16, 2023, 8:58 am UTC
 *
 * @property integer $clientquestionnarie_id
 * @property integer $questionnariedetail_id
 * @property string $reply
 * @property string $description
 */
class Clientquestionnariedetails extends Model
{
    use SoftDeletes, HasFactory, PowerJoins;

    public $table = 'clientquestionnariedetails';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'clientquestionnarie_id',
        'questionnariedetail_id',
        'reply',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'clientquestionnarie_id' => 'integer',
        'questionnariedetail_id' => 'integer',
        'reply' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'clientquestionnarie_id' => 'required|integer',
        'questionnariedetail_id' => 'required|integer',
        'reply' => 'nullable|string|max:500',
        'description' => 'nullable|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function clientquestionnarie() {
        return $this->belongsTo(Clientquestionnaries::class, 'clientquestionnarie_id');
    }

    public function questionnariedetail() {
        return $this->belongsTo(Questionnairedetails::class, 'questionnariedetail_id');
    }

}
