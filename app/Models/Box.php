<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'box';

    public function batchings()
    {
        return $this->hasMany(Batching::class);
    }
}
