<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Claim extends Model
{
    use HasFactory;

    protected $primaryKey = 'patsep';
    public $incrementing = false;
    protected $guarded = [];
    protected $with = [
        'submission'
    ];

    public function submission(): HasOne
    {
        return $this->hasOne(Submission::class, 'patsep', 'patsep');
    }
}
