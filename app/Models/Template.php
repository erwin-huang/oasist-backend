<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Template extends Model
{
    use HasUuids, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cover_url',
        'name',
        'code',
        'description',
    ];

    /**
     * Get the user template sections associated with the template.
     */
    public function templateSections(): HasMany
    {
        return $this->hasMany(TemplateSection::class);
    }
}
