<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiving extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'receiving';

    public function sls()
    {
        return $this->belongsTo(Sls::class, 'sls_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
