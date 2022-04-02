<?php

namespace App\Models;

use App\Traits\CreatedBy;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionRecord extends Model
{
    use HasFactory, SoftDeletes, CreatedBy;
    protected $guarded = [];

    public function workshopMachinery()
    {
        return $this->belongsTo(WorkshopMachinery::class, "workshop_machinery_id","id");
    }

    public function inspector()
    {
        return $this->belongsTo(Inspector::class, "inspector_id", "id");
    }

}
