<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kirschbaum\PowerJoins\PowerJoins;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Questionnairedetailitems
 * @package App\Models
 * @version February 23, 2023, 9:30 am UTC
 *
 * @property integer $questionnariedetail_id
 * @property string $value
 */
class Questionnairedetailitems extends Model
{
    use SoftDeletes, HasFactory, PowerJoins;

    public $table = 'questionnairedetailitems';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'questionnariedetail_id',
        'value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'questionnariedetail_id' => 'integer',
        'value' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'questionnariedetail_id' => 'required|integer',
        'value' => 'required|string|max:200',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function questionnairedetail(): string|BelongsTo
    {
        return $this->belongsTo(Questionnairedetails::class, 'questionnariedetail_id');
    }
}
