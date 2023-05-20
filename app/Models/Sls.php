<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sls extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'sls';
    public $timestamps = false;

    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id');
    }

    public function subdistrict()
    {
        return $this->village->subdistrict();
    }
    public function fullname()
    {
        return $this->subdistrict->name . ", " . $this->village->name . ", " . $this->name;
    }
}
