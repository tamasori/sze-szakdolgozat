<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ExcludeSpecialEwcCodeFromSubstancesScope;

class Substance extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope(new ExcludeSpecialEwcCodeFromSubstancesScope());
    }

    public function car()
    {
        return $this->belongsTo(Car::class, "car_id", "id");
    }

    public function ewcCode()
    {
        return $this->belongsTo(EwcCode::class, "ewc_code_id", "id");
    }

    public function scopeHazardous(Builder $query)
    {
        return $query->with("ewcCode")->whereRelation('ewcCode', "hazardous", "=",true);
    }

    public function scopeNonHazardous(Builder $query)
    {
        return $query->with("ewcCode")->whereRelation('ewcCode', "hazardous", "=",false);
    }

    public function sumExport(){
        return $this->export_mass + $this->pretreatment_mass + $this->collector_mass + $this->disposal_mass + $this->on_site_transfer_mass;
    }
}
