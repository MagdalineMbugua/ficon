<?php

namespace App\Models;

use Elastic\ScoutDriverPlus\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    use Searchable;

    protected $guarded=[];

    public function shouldBeSearchable(): bool
    {
        return count($this->toSearchableArray()) > 0;
    }
}
