<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    public function confection()
    {
        // the foreign key in the contents table is `confid` (not confection_id)
        return $this->belongsTo(Confection::class, 'confid');
    }
}
