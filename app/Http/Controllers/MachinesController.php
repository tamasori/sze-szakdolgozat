<?php

namespace App\Http\Controllers;

use App\Models\WorkshopMachinery;
use App\Http\Requests\EwcCodeStoreRequest;
use App\Http\Requests\PresetStoreRequest;
use App\Models\EwcCode;
use App\Models\Preset;
use Illuminate\Http\Request;
use App\Http\Requests\MachinesStoreRequest;

class MachinesController extends Controller
{
    public function index()
    {
        return view("machineries.index");
    }

    public function create()
    {
        return view("machineries.edit");
    }

    public function store(MachinesStoreRequest $request)
    {
        $machine = WorkshopMachinery::create($request->validated());
        return redirect()->route("machines.index")
            ->with("successes",[__("messages.save_success")]);
    }

    public function edit(WorkshopMachinery $machine)
    {
        return view("machineries.edit")
            ->with('machine', $machine);
    }

    public function update(MachinesStoreRequest $request, WorkshopMachinery $machine)
    {
        $machine->update($request->validated());
        return redirect()->route("machines.index")
                         ->with("successes",[__("messages.save_success")]);
    }

    public function show(WorkshopMachinery $machine)
    {
        return view("machineries.show")
            ->with("machine",$machine);
    }

    public function destroy(WorkshopMachinery $machine)
    {
        $machine->delete();
        return redirect()->back()->with("successes",[__("messages.delete_success")]);
    }
}
