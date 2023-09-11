<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kirschbaum\PowerJoins\PowerJoins;

/**
 * Class DetailTypes
 * @package App\Models
 * @version February 12, 2023, 8:44 am UTC
 *
 * @property string $name
 * @property integer $listing
 * @property string $description
 */
class DetailTypes extends Model
{
    use SoftDeletes, HasFactory, PowerJoins;

    public $table = 'detailtypes';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'listing',
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
        'listing' => 'integer',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:100',
        'listing' => 'required|integer',
        'description' => 'nullable|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    protected $append = ['listingName'];

    public function getListingNameAttribute(): string
    {
        return $this->listing == 1 ? 'Igen' : 'Nem';
    }

    public function questionnairedetails(): string|HasMany
    {
        return $this->hasMany(Questionnairedetails::class, 'detailtype_id');
    }
}
