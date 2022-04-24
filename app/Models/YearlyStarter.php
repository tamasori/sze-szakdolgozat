<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class YearlyStarter extends Pivot
{
    protected $table = 'yearly_starters';
    protected $guarded = [];

    public function ewcCode(){
        return $this->belongsTo(EwcCode::class);
    }
}
