<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PredefinedAnswer;
use App\Http\Requests\PredefinedAnswerStoreRequest;

class PredefinedAnswersController extends Controller
{
    public function index()
    {
        return view("predefined-answers.index");
    }

    public function store(PredefinedAnswerStoreRequest $request)
    {
        PredefinedAnswer::create($request->validated());

        return redirect()->route("predefined-answer.index")
                         ->with("successes",[__("messages.save_success")]);
    }

    public function destroy(PredefinedAnswer $predefinedAnswer)
    {
        $predefinedAnswer->delete();

        return redirect()->back()->with("successes",[__("messages.delete_success")]);
    }

}
