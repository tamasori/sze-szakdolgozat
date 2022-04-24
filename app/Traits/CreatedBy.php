<?php

namespace App\Traits;

trait CreatedBy
{
    public static function bootCreatedBy()
    {
        self::saving(function ($model) {
            if (auth()->check()) {
                $model->created_by = auth()->id();
            }
        });
    }
}