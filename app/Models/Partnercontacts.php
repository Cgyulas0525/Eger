<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kirschbaum\PowerJoins\PowerJoins;

/**
 * Class Partnercontacts
 * @package App\Models
 * @version February 15, 2023, 2:53 pm UTC
 *
 * @property integer $partner_id
 * @property string $name
 * @property string $password
 * @property string $email
 * @property string $phonenumber
 * @property integer $active
 * @property string $description
 */
class Partnercontacts extends Model
{
    use SoftDeletes, HasFactory, PowerJoins;

    public $table = 'partnercontacts';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'partner_id',
        'name',
        'password',
        'email',
        'phonenumber',
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
        'partner_id' => 'integer',
        'name' => 'string',
        'password' => 'string',
        'email' => 'string',
        'phonenumber' => 'string',
        'active' => 'integer',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'partner_id' => 'required|integer',
        'name' => 'required|string|max:100',
        'password' => 'required|string|max:200',
        'email' => 'required|string|max:100',
        'phonenumber' => 'nullable|string|max:25',
        'active' => 'required|integer',
        'description' => 'nullable|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function partner() {
        return $this->belongsTo(Partners::class, 'partner_id');
    }

}
