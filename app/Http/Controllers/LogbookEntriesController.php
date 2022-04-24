<?php

namespace App\Http\Controllers;

use App\Models\Inspector;
use App\Models\LogbookEntry;
use App\Models\WorkshopMachinery;
use App\Http\Requests\EwcCodeStoreRequest;
use App\Http\Requests\PresetStoreRequest;
use App\Models\EwcCode;
use App\Models\Preset;
use Illuminate\Http\Request;
use App\Http\Requests\MachinesStoreRequest;
use App\Http\Requests\InspectorsStoreRequest;
use App\Http\Requests\LogbookEntriesStoreRequest;

class LogbookEntriesController extends Controller
{
    public function index()
    {
        return view("logbook-entries.index");
    }

    public function create()
    {
        return view("logbook-entries.edit");
    }

    public function store(LogbookEntriesStoreRequest $request)
    {
        $logbookEntry = LogbookEntry::create($request->validated());
        return redirect()->route("logbook-entry.index")
            ->with("successes",[__("messages.save_success")]);
    }

    public function edit(LogbookEntry $logbookEntry)
    {
        return view("logbook-entries.edit")
            ->with('logbookEntry', $logbookEntry);
    }

    public function update(LogbookEntriesStoreRequest $request, LogbookEntry $logbookEntry)
    {
        $logbookEntry->update($request->validated());
        return redirect()->route("logbook-entry.index")
                         ->with("successes",[__("messages.save_success")]);
    }

    public function destroy(LogbookEntry $logbookEntry)
    {
        $logbookEntry->delete();
        return redirect()->back()->with("successes",[__("messages.delete_success")]);
    }
}
