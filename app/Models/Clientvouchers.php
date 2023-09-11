<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kirschbaum\PowerJoins\PowerJoins;
use Yajra\DataTables\Html\Editor\Fields\BelongsTo;

/**
 * Class Clientvouchers
 * @package App\Models
 * @version February 24, 2023, 6:51 am UTC
 *
 * @property integer $client_id
 * @property integer $voucher_id
 * @property string $posted
 * @property string $used
 * @property string $description
 */
class Clientvouchers extends Model
{
    use SoftDeletes, HasFactory, PowerJoins;

    public $table = 'clientvouchers';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'client_id',
        'voucher_id',
        'posted',
        'used',
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
        'voucher_id' => 'integer',
        'posted' => 'date',
        'used' => 'integer',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'client_id' => 'required|integer',
        'voucher_id' => 'required|integer',
        'posted' => 'nullable',
        'used' => 'nullable',
        'description' => 'nullable|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function voucher(): string|BelongsTo
    {
        return $this->belongsTo(Vouchers::class, 'voucher_id');
    }

    public function client(): string|BelongsTo
    {
        return $this->belongsTo(Clients::class, 'client_id');
    }

    public function clientvoucherused(): string|HasMany
    {
        return $this->hasMany(Clientvoucherused::class, 'clientvoucher_id');
    }
}
