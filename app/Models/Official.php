<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Official extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_date',
        'end_date',
        'user_id',
        'vinvulation_type_id',
        'regime_level_grade_id',
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
            'user_id' => 'integer',
            'vinvulation_type_id' => 'integer',
            'regime_level_grade_id' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vinvulationType(): BelongsTo
    {
        return $this->belongsTo(VinvulationType::class);
    }

    public function regimeLevelGrade(): BelongsTo
    {
        return $this->belongsTo(RegimeLevelGrade::class);
    }
}
