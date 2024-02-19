<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Year extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    use HasFactory;

    public function semesters(): HasMany
    {
        return $this->hasMany(Semester::class);
    }
}
