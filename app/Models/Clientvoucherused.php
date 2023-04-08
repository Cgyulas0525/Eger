<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kirschbaum\PowerJoins\PowerJoins;

/**
 * Class Clientvoucherused
 * @package App\Models
 * @version March 14, 2023, 4:17 pm UTC
 *
 * @property integer $clientvoucher_id
 * @property string|\Carbon\Carbon $usedtime
 */
class Clientvoucherused extends Model
{
    use SoftDeletes, HasFactory, PowerJoins;

    public $table = 'clientvoucherused';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'clientvoucher_id',
        'usedtime'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'clientvoucher_id' => 'integer',
        'usedtime' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'clientvoucher_id' => 'required|integer',
        'usedtime' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function clientvoucher() {
        return $this->belongsTo(Clientvouchers::class);
    }

}
