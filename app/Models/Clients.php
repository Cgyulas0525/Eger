<?php

namespace App\Models;

use App\Classes\ToolsClass;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kirschbaum\PowerJoins\PowerJoins;
use App\Enums\YesNoEnum;
use App\Enums\GenderEnum;
use Yajra\DataTables\Html\Editor\Fields\BelongsTo;

/**
 * Class Clients
 * @package App\Models
 * @version February 16, 2023, 3:05 pm UTC
 *
 * @property string $name
 * @property string $email
 * @property string $phonenumber
 * @property string $birthday
 * @property string $password
 * @property integer $postcode
 * @property integer $settlement_id
 * @property string $address
 * @property string $addresscardnumber
 * @property string $addresscardurl
 * @property integer $validated
 * @property integer $active
 * @property integer $local
 * @property string $description
 * @property integer $gender
 * @property string $facebookid
 * @property string $facebookname
 * @property string $facebookemail
 * @property string $gmailid
 * @property string $gmailname
 * @property string $gmailemail
 */
class Clients extends Model
{
    use SoftDeletes, HasFactory, PowerJoins;

    public $table = 'clients';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'email',
        'phonenumber',
        'birthday',
        'password',
        'postcode',
        'settlement_id',
        'address',
        'addresscardnumber',
        'addresscardurl',
        'validated',
        'active',
        'local',
        'description',
        'gender',
        'facebookid',
        'facebookname',
        'facebookemail',
        'gmailid',
        'gmailname',
        'gmailemail'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'phonenumber' => 'string',
        'birthday' => 'date',
        'password' => 'string',
        'postcode' => 'integer',
        'settlement_id' => 'integer',
        'address' => 'string',
        'addresscardnumber' => 'string',
        'addresscardurl' => 'string',
        'validated' => 'integer',
        'active' => 'integer',
        'local' => 'integer',
        'description' => 'string',
        'gender' => 'integer',
        'facebookid' => 'string',
        'facebookname' => 'string',
        'facebookemail' => 'string',
        'gmailid' => 'string',
        'gmailname' => 'string',
        'gmailemail' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:100',
        'email' => 'required|string|max:100',
        'phonenumber' => 'nullable|string|max:25',
        'birthday' => 'required',
        'password' => 'required|string|max:191',
        'postcode' => 'required|integer',
        'settlement_id' => 'required|integer',
        'address' => 'required|string|max:200',
        'addresscardnumber' => 'nullable|string|max:20',
        'addresscardurl' => 'nullable|string|max:100',
        'validated' => 'required|integer',
        'active' => 'required|integer',
        'local' => 'required|integer',
        'description' => 'nullable|string|max:500',
        'gender' => 'nullable|integer',
        'facebookid' => 'nullable|string|max:50',
        'facebookname' => 'nullable|string|max:200',
        'facebookemail' => 'nullable|string|max:200',
        'gmailid' => 'nullable|string|max:50',
        'gmailname' => 'nullable|string|max:200',
        'gmailemail' => 'nullable|string|max:200',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    protected $appends = ['fullAddress', 'genderName', 'activeName', 'localName', 'validatedName'];

    public function settlement(): string|BelongsTo
    {
        return $this->belongsTo(Settlements::class, 'settlement_id');
    }

    public function clientvouchers(): string|HasMany
    {
        return $this->hasMany(Clientvouchers::class, 'client_id');
    }

    public function clientquestionnaries(): string|HasMany
    {
        return $this->hasMany(Clientquestionnaries::class, 'client_id');
    }


    public function getFullAddressAttribute(): string
    {
        return ((!empty($this->postcode) ? $this->postcode : "") . " " .
            (!empty($this->settlement_id) ? $this->settlement->name : "") . " " .
            (!empty($this->address) ? $this->address : ""));
    }

    public function getGenderNameAttribute(): string
    {
        return !empty($this->gender) ? GenderEnum::getValue($this->gender) : "";
    }

    public function getActiveNameAttribute(): string
    {
        return YesNoEnum::getValue($this->active);
    }

    public function getLocalNameAttribute(): string
    {
        return YesNoEnum::getValue($this->local);
    }

    public function getValidatedNameAttribute(): string
    {
        return !empty($this->validated) ? YesNoEnum::getValue($this->validated) : "";
    }
}
