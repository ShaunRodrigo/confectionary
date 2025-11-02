<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    public function confection()
    {
        // the foreign key in the prices table is `confid` (not confection_id)
        return $this->belongsTo(Confection::class, 'confid');
    }
}
