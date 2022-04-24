<?php

namespace App\Http\Controllers;

use App\Http\Requests\EwcCodeStoreRequest;
use App\Models\EwcCode;
use Illuminate\Http\Request;

class EwcCodesController extends Controller
{
    public function index()
    {
        return view("ewcCodes.index");
    }

    public function create()
    {
        return view("ewcCodes.edit");
    }

    public function store(EwcCodeStoreRequest $request)
    {
        $ewc = EwcCode::create($request->validated());
        return redirect()->route("ewc-code.index")
            ->with("successes",[__("messages.save_success")]);
    }

    public function edit(EwcCode $ewcCode)
    {
        return view("ewcCodes.edit")
            ->with('ewc', $ewcCode);
    }

    public function update(EwcCodeStoreRequest $request, EwcCode $ewcCode)
    {
        $ewcCode->update($request->validated());
        return redirect()->route("ewc-code.index")
                         ->with("successes",[__("messages.save_success")]);
    }

    public function show(EwcCode $ewcCode)
    {
        return view("ewcCodes.show")
            ->with("ewc",$ewcCode);
    }

    public function destroy(EwcCode $ewcCode)
    {
        if ( ! $ewcCode->isDeletable()) {
            return redirect()->back()->withErrors(__("messages.delete_failed"));
        }
        $ewcCode->delete();
        return redirect()->back()->with("successes",[__("messages.delete_success")]);
    }
}
