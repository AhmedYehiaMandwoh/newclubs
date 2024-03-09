<?php

namespace App\Models;

use App\Traits\ModelDateTextTrait;
use App\Traits\SearchTrait;

/**
 * @property int $id
 */
class Role extends \Silber\Bouncer\Database\Role
{
    use SearchTrait, ModelDateTextTrait;

    protected $appends = ['created_at_text'];
}
