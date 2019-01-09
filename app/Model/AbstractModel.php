<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractModel
 * @package App\Model
 */
class AbstractModel extends Model
{
    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';
}