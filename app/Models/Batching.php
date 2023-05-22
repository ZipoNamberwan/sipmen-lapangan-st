<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batching extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'batching';

    public function box()
    {
        return $this->belongsTo(Box::class, 'box_id');
    }
    public function receiving()
    {
        return $this->belongsTo(Receiving::class, 'receiving_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
