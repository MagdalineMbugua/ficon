<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as ModelsRole;
use Spatie\Permission\Traits\HasPermissions;

class Role extends ModelsRole
{
    use HasFactory;
    use HasPermissions;

    protected $with = ['permissions'];
}
