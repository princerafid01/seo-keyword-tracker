<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankingKeyword extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'meta' => 'array',
    ];

    public function location()
    {
        return $this->hasOne(RankingLocation::class,'id','location_id');
    }

}
