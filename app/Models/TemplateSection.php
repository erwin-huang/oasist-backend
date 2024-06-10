<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TemplateSection extends Model
{
    use HasUuids, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'template_id',
        'name',
        'code',
        'description',
        'order',
    ];

    /**
     * Get the template associated with the template section.
     */
    public function template(): HasOne
    {
        return $this->hasOne(Template::class);
    }

    /**
     * Get the template values associated with the template section.
     */
    public function templateValues(): HasMany
    {
        return $this->hasMany(TemplateValue::class);
    }
}
