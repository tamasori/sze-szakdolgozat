<?php

namespace App\Scopes;

use App\Models\EwcCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ExcludeSpecialEwcCodeFromSubstancesScope implements \Illuminate\Database\Eloquent\Scope
{

    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model)
    {
        return $builder->whereNotIn("ewc_code_id", EwcCode::select("id")->whereIn("code", ["160104","160106", "Anyag-R4"])->get()->toArray());
    }
}
