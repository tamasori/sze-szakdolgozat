<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EwcCode extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function yearlyStarters()
    {
        return $this->hasMany(YearlyStarter::class);
    }

    public function getYearlyStarterForYear($year)
    {
        return $this->yearlyStarters()->where('year', $year)->first()->mass ?? 0;
    }

    public function isDeletable() : bool
    {
        return $this->can_be_deleted;
    }
}
