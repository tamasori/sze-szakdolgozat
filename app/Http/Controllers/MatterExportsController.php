<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatterExportStoreRequest;
use App\Models\Substance;

class MatterExportsController
{
    public function __construct()
    {
        \View::share("year", \Route::current() ? \Route::current()->parameter('year') : null);
    }

    public function index($year)
    {
        return view("matterExports.index");
    }

    public function create($year)
    {
        return view("matterExports.edit");
    }

    public function store(MatterExportStoreRequest $request, $year)
    {
        $substance = Substance::create(array_merge($request->validated(), ["from_export" => true]));
        return redirect()->route("matter-export.index", [$year])
                         ->with("successes",[__("messages.save_success")]);
    }

    public function edit($year, Substance $substance)
    {
        return view("matterExports.edit")
            ->with('substance', $substance);
    }

    public function update(MatterExportStoreRequest $request, $year ,Substance $substance)
    {
        $substance->update(array_merge($request->validated(), ["from_export" => true]));
        return redirect()->route("matter-export.index",[$year])
                         ->with("successes",[__("messages.save_success")]);
    }

    public function destroy($year, Substance $substance)
    {
        $substance->delete();
        return redirect()->back()->with("successes",[__("messages.delete_success")]);
    }
}
