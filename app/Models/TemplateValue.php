<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TemplateValue extends Model
{
    use HasUuids, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'template_section_id',
        'name',
        'code',
        'type',
        'value',
    ];

    /**
     * Get the template section associated with the template value.
     */
    public function templateSection(): BelongsTo
    {
        return $this->belongsTo(TemplateSection::class);
    }
}
