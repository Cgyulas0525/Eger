<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kirschbaum\PowerJoins\PowerJoins;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Validpostcodes
 * @package App\Models
 * @version February 13, 2023, 9:58 am UTC
 *
 * @property integer $settlement_id
 * @property integer $postcode
 * @property integer $active
 * @property string $description
 */
class Validpostcodes extends Model
{
    use SoftDeletes, HasFactory, PowerJoins;

    public $table = 'validpostcodes';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'settlement_id',
        'postcode',
        'active',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'settlement_id' => 'integer',
        'postcode' => 'integer',
        'active' => 'integer',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'settlement_id' => 'required|integer',
        'postcode' => 'required|integer',
        'active' => 'required|integer',
        'description' => 'nullable|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function settlement(): string|BelongsTo
    {
        return $this->belongsTo(Settlements::class, 'settlement_id');
    }
}
