<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserTemplateValue extends Model
{
    use HasUuids, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'template_value_id',
        'user_template_section_id',
        'value',
    ];

    /**
     * Get the user template section associated with the user template value.
     */
    public function userTemplateSection(): HasOne
    {
        return $this->hasOne(UserTemplateSection::class);
    }
}
