<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Recipe extends Model
{
    use HasFactory;
    use SoftDeletes;

    /** @return BelongsTo<Team, $this> */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /** @return BelongsTo<self, $this> */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /** @return HasMany<Recipe, $this> */
    public function remixes(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function isSourceUrl(): bool
    {
        return filter_var($this->source, FILTER_VALIDATE_URL) !== false;
    }

    public function shortenedSource(): ?string
    {
        if (! $this->source) {
            return null;
        }

        if ($this->isSourceUrl()) {
            $host = parse_url($this->source, PHP_URL_HOST);

            return str_replace('www.', '', $host ?? $this->source);
        }

        return Str::limit($this->source, 30);
    }

    /** @return array<string, mixed> */
    protected function casts(): array
    {
        return [
            'tags' => 'array',
        ];
    }

    protected function truncatedDescription(): Attribute
    {
        return Attribute::make(
            get: fn () => Str::limit($this->description, 75),
        );
    }
}
