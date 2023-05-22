<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'subdistrict';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function villages()
    {
        return $this->hasMany(Village::class);
    }
}
