<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kirschbaum\PowerJoins\PowerJoins;

/**
 * Class Clientquestionnaries
 * @package App\Models
 * @version March 1, 2023, 8:43 am UTC
 *
 * @property integer $client_id
 * @property integer $questionnarie_id
 * @property string $posted
 * @property string $retrieved
 * @property string $description
 */
class Clientquestionnaries extends Model
{
    use SoftDeletes, HasFactory, PowerJoins;

    public $table = 'clientquestionnaries';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'client_id',
        'questionnarie_id',
        'posted',
        'retrieved',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'client_id' => 'integer',
        'questionnarie_id' => 'integer',
        'posted' => 'date',
        'retrieved' => 'date',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'client_id' => 'required|integer',
        'questionnarie_id' => 'required|integer',
        'posted' => 'nullable',
        'retrieved' => 'nullable',
        'description' => 'nullable|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function questionnarie() {
        return $this->belongsTo(Questionnaires::class, 'questionnarie_id');
    }

    public function client() {
        return $this->belongsTo(Clients::class, 'client_id');
    }

    public function clientquestionnariedetails() {
        return $this->hasMany(Clientquestionnariedetails::class, 'clientquestionnarie_id');
    }

}
