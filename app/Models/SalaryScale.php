<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryScale extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'year',
        'active',
        'base_salary',
        'regime_level_grade_id',
        'salary_scale_decree_id',
        'user_id',
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
            'active' => 'boolean',
            'base_salary' => 'double',
            'regime_level_grade_id' => 'integer',
            'salary_scale_decree_id' => 'integer',
            'user_id' => 'integer',
        ];
    }

    public function regimeLevelGrade(): BelongsTo
    {
        return $this->belongsTo(RegimeLevelGrade::class);
    }

    public function salaryScaleDecree(): BelongsTo
    {
        return $this->belongsTo(SalaryScaleDecree::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
