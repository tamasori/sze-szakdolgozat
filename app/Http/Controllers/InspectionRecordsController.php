<?php

namespace App\Http\Controllers;

use App\Models\Inspector;
use App\Models\InspectionRecord;
use App\Models\WorkshopMachinery;
use App\Http\Requests\EwcCodeStoreRequest;
use App\Http\Requests\PresetStoreRequest;
use App\Models\EwcCode;
use App\Models\Preset;
use Illuminate\Http\Request;
use App\Http\Requests\MachinesStoreRequest;
use App\Http\Requests\InspectorsStoreRequest;
use App\Http\Requests\InspectonRecordsStoreRequest;

class InspectionRecordsController extends Controller
{
    public function index()
    {
        return view("inspection-records.index");
    }

    public function create()
    {
        return view("inspection-records.edit");
    }

    public function store(InspectonRecordsStoreRequest $request)
    {
        $inspectionRecord = InspectionRecord::create($request->validated());
        return redirect()->route("inspection-record.index")
            ->with("successes",[__("messages.save_success")]);
    }

    public function edit(InspectionRecord $inspectionRecord)
    {
        return view("inspection-records.edit")
            ->with('inspectionRecord', $inspectionRecord);
    }

    public function update(InspectonRecordsStoreRequest $request, InspectionRecord $inspectionRecord)
    {
        $inspectionRecord->update($request->validated());
        return redirect()->route("inspection-record.index")
                         ->with("successes",[__("messages.save_success")]);
    }

    public function show(InspectionRecord $inspectionRecord)
    {
        return view("inspection-records.show")
            ->with("inspectionRecord",$inspectionRecord);
    }

    public function destroy(InspectionRecord $inspectionRecord)
    {
        $inspectionRecord->delete();
        return redirect()->back()->with("successes",[__("messages.delete_success")]);
    }
}
