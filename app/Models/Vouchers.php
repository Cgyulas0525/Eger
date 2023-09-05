<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kirschbaum\PowerJoins\PowerJoins;

/**
 * Class Vouchers
 * @package App\Models
 * @version February 20, 2023, 2:16 pm UTC
 *
 * @property string $name
 * @property integer $vouchertype_id
 * @property integer $partner_id
 * @property string $content
 * @property string $validityfrom
 * @property string $validityto
 * @property string $qrcode
 * @property integer $discount
 * @property integer $discountpercent
 * @property integer $usednumber
 * @property integer $active
 */
class Vouchers extends Model
{
    use SoftDeletes, HasFactory, PowerJoins;

    public $table = 'vouchers';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'vouchertype_id',
        'partner_id',
        'content',
        'validityfrom',
        'validityto',
        'qrcode',
        'discount',
        'discountpercent',
        'usednumber',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'vouchertype_id' => 'integer',
        'partner_id' => 'integer',
        'content' => 'string',
        'validityfrom' => 'date',
        'validityto' => 'date',
        'qrcode' => 'string',
        'discount' => 'integer',
        'discountpercent' => 'integer',
        'usednumber' => 'integer',
        'active' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:200',
        'vouchertype_id' => 'required|integer',
        'partner_id' => 'required|integer',
        'content' => 'nullable|string|max:500',
        'validityfrom' => 'required',
        'validityto' => 'nullable',
        'qrcode' => 'nullable|string|max:500',
        'discount' => 'required|integer',
        'discountpercent' => 'required|integer',
        'usednumber' => 'required|integer',
        'active' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function partner() {
        return $this->belongsTo(Partners::class, 'partner_id');
    }

    public function vouchertype() {
        return $this->belongsTo(Vouchertypes::class, 'vouchertype_id');
    }

    public function clientvouchers() {
        return $this->hasMany(Clientvouchers::class, 'voucher_id');
    }


}
