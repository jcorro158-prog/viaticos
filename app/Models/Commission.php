<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commission extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'objetive',
        'start_date',
        'end_date',
        'abroad',
        'destination',
        'training_expenses',
        'budget_id',
        'user_id',
        'commission_status_id',
        'dependency_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'start_date' => 'date',
            'end_date' => 'date',
            'abroad' => 'boolean',
            'training_expenses' => 'double',
            'budget_id' => 'integer',
            'user_id' => 'integer',
            'commission_status_id' => 'integer',
            'dependency_id' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function commissionStatus(): BelongsTo
    {
        return $this->belongsTo(CommissionStatus::class);
    }

    public function dependency(): BelongsTo
    {
        return $this->belongsTo(Dependency::class);
    }

    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budget::class);
    }

    public function resolutions(): HasMany
    {
        return $this->hasMany(Resolution::class);
    }
}
