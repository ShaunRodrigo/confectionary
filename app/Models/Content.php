<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    public function confection()
    {
        return $this->belongsTo(Confection::class);
    }
}
