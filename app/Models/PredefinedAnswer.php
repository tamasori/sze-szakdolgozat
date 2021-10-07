<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orion\Concerns\DisableAuthorization;

class PredefinedAnswer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public $timestamps = false;
}
