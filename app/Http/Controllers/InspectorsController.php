<?php

namespace App\Http\Controllers;

use App\Models\Inspector;
use App\Models\WorkshopMachinery;
use App\Http\Requests\EwcCodeStoreRequest;
use App\Http\Requests\PresetStoreRequest;
use App\Models\EwcCode;
use App\Models\Preset;
use Illuminate\Http\Request;
use App\Http\Requests\MachinesStoreRequest;
use App\Http\Requests\InspectorsStoreRequest;

class InspectorsController extends Controller
{
    public function index()
    {
        return view("inspectors.index");
    }

    public function create()
    {
        return view("inspectors.edit");
    }

    public function store(InspectorsStoreRequest $request)
    {
        $inspector = Inspector::create($request->validated());
        return redirect()->route("inspector.index")
            ->with("successes",[__("messages.save_success")]);
    }

    public function edit(Inspector $inspector)
    {
        return view("inspectors.edit")
            ->with('inspector', $inspector);
    }

    public function update(InspectorsStoreRequest $request, Inspector $inspector)
    {
        $inspector->update($request->validated());
        return redirect()->route("inspector.index")
                         ->with("successes",[__("messages.save_success")]);
    }

    public function show(Inspector $inspector)
    {
        return view("inspectors.show")
            ->with("inspector",$inspector);
    }

    public function destroy(Inspector $inspector)
    {
        $inspector->delete();
        return redirect()->back()->with("successes",[__("messages.delete_success")]);
    }
}
