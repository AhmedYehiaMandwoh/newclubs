<?php

namespace App\Models;

use App\Traits\ModelDateTextTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use ModelDateTextTrait;
    use SearchTrait;
}
