<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreYearlyStartersRequest;
use App\Models\YearlyStarter;

class YearlyStartersController
{
    public function index($year)
    {
        return view('yearlyStarters.index')
            ->with("year", $year);
    }

    public function store(StoreYearlyStartersRequest $request, $year)
    {
        foreach ($request->ewc as $key => $value) {
            YearlyStarter::updateOrCreate([
                "year"        => $year,
                "ewc_code_id" => $key,
            ], [
                "mass" => $value,
            ]);
        }
        return redirect()->route('yearly-starters.index', $year)
            ->with("successes",[ __("messages.save_success")]);
    }
}
