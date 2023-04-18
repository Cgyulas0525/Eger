<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kirschbaum\PowerJoins\PowerJoins;

/**
 * Class Partners
 * @package App\Models
 * @version February 13, 2023, 4:53 pm UTC
 *
 * @property integer $id
 * @property string $name
 * @property integer $partnertype_id
 * @property string $taxnumber
 * @property string $bankaccount
 * @property integer $postcode
 * @property integer $settlement_id
 * @property string $address
 * @property string $email
 * @property string $phonenumber
 * @property string $description
 * @property integer $active
 * @property string $logourl
 */
class Partners extends Model
{
    use SoftDeletes, HasFactory, PowerJoins;

    public $table = 'partners';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id',
        'name',
        'partnertype_id',
        'taxnumber',
        'bankaccount',
        'postcode',
        'settlement_id',
        'address',
        'email',
        'phonenumber',
        'description',
        'active',
        'logourl'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'partnertype_id' => 'integer',
        'taxnumber' => 'string',
        'bankaccount' => 'string',
        'postcode' => 'integer',
        'settlement_id' => 'integer',
        'address' => 'string',
        'email' => 'string',
        'phonenumber' => 'string',
        'description' => 'string',
        'active' => 'integer',
        'logourl' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:100',
        'partnertype_id' => 'required|integer',
        'taxnumber' => 'nullable|string|max:15',
        'bankaccount' => 'nullable|string|max:30',
        'postcode' => 'nullable|integer',
        'settlement_id' => 'nullable|integer',
        'address' => 'nullable|string|max:100',
        'email' => 'nullable|string|max:50',
        'phonenumber' => 'nullable|string|max:20',
        'description' => 'nullable|string|max:500',
        'active' => 'required|integer',
        'logourl' => 'nullable|string|max:200',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    protected $appends = ['fullAddress'];

    public function settlement() {
        return $this->belongsTo(Settlements::class, 'settlement_id');
    }

    public function partnertype() {
        return $this->belongsTo(PartnerTypes::class, 'partnertype_id');
    }

    public function getFullAddressAttribute() {
        return ((!empty($this->postcode) ? $this->postcode : "") . " " .
            (!empty($this->settlement_id) ? $this->settlement->name : ""). " " .
            (!empty($this->address) ? $this->address : ""));
    }

    public function partnercontact() {
        return $this->hasMany(Partnercontacts::class, 'partner_id');
    }

    public function voucher() {
        return $this->hasMany(Vouchers::class, 'partner_id');
    }

    public function partnerquestionnarie() {
        return $this->hasMany(Partnerquestionnaries::class, 'partner_id');
    }

}
