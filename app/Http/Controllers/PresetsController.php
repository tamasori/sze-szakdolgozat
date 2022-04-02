<?php

namespace App\Http\Controllers;

use App\Http\Requests\EwcCodeStoreRequest;
use App\Http\Requests\PresetStoreRequest;
use App\Models\EwcCode;
use App\Models\Preset;
use Illuminate\Http\Request;

class PresetsController extends Controller
{
    public function index()
    {
        return view("presets.index");
    }

    public function create()
    {
        return view("presets.edit");
    }

    public function store(PresetStoreRequest $request)
    {
        $preset = Preset::create(array_merge($request->only("name"), ["fields" => json_encode(array_values($request->substances))]));
        return redirect()->route("preset.index")
            ->with("successes",[__("messages.save_success")]);
    }

    public function edit(Preset $preset)
    {
        return view("presets.edit")
            ->with('preset', $preset);
    }

    public function update(PresetStoreRequest $request, Preset $preset)
    {
        $preset->update(array_merge($request->only("name"), ["fields" => json_encode($request->substances)]));
        return redirect()->route("preset.index")
                         ->with("successes",[__("messages.save_success")]);
    }

    public function show(Preset $preset)
    {
        return view("presets.show")
            ->with("preset",$preset);
    }

    public function destroy(Preset $preset)
    {
        $preset->delete();
        return redirect()->back()->with("successes",[__("messages.delete_success")]);
    }
}
