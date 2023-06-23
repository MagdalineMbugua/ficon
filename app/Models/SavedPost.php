<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SavedPost extends Pivot
{
    protected $table = 'saved_posts';
    use HasFactory;
}
