@extends("layouts.master-with-sidebar")
@section("title",__("predefined-answers.title"))

@section("main")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang("predefined-answers.title")</h3>
            </div>
            <div class="card-body">
                @livewire("tables.predefined-answers-table")
                <hr>
                <div class="row">
                    <form action="{{ route("predefined-answer.store") }}" method="post" class="w-100">
                        @csrf
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="answer">@lang("predefined-answers.answer")</label>
                                    <input type="text" class="form-control" id="answer" name="answer" placeholder="@lang("predefined-answers.answer")">
                                </div>
                                <button type="submit" class="btn btn-success">@lang('misc.save')</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
