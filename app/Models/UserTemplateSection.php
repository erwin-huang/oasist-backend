<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserTemplateSection extends Model
{
    use HasUuids, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'template_section_id',
        'user_template_id',
        'order',
    ];

    /**
     * Get the user template associated with the user template section.
     */
    public function userTemplate(): HasOne
    {
        return $this->hasOne(UserTemplate::class);
    }

    /**
     * Get the user template values associated with the user template section.
     */
    public function userTemplateValues(): HasMany
    {
        return $this->hasMany(UserTemplateValue::class);
    }
}
