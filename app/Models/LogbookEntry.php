<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogbookEntry extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public const LOG_TYPES = [
        "WASTE_MANAGEMENT",
        "WASTE_STORAGE",
        "WASTE_COLLECTION_POINT",
    ];

    public const CHECK_TYPES = [
        "NORMAL",
        "EXTRAORDINARY",
    ];
}
