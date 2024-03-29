<?php

namespace App\Repositories;

use App\Models\Users;
use App\Repositories\BaseRepository;

/**
 * Class UsersRepository
 * @package App\Repositories
 * @version January 25, 2023, 9:24 am UTC
*/

class UsersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'username',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'image_url',
        'usertypes_id',
        'commit'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Users::class;
    }
}
