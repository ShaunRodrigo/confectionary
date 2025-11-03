<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Content;
use App\Models\Price;

class Confection extends Model
{
    protected $fillable = ['cname', 'type', 'prizewinning'];

    protected $casts = [
        'prizewinning' => 'boolean',
    ];


    public function contents()
    {
        return $this->hasMany(Content::class, 'confid'); 
    }

    public function prices()
    {
        return $this->hasMany(Price::class, 'confid'); 
    }
}
