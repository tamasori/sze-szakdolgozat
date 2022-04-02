@extends("layouts.master-with-sidebar")
@section("title",__("logbook-entries.title"))

@section("main")
    <form
        action="@if(isset($logbookEntry)) {{ route("logbook-entry.update", $logbookEntry) }} @else {{ route("logbook-entry.store") }} @endif"
        method="post">
        @csrf
        @if(isset($logbookEntry))
            @method("PUT")
        @endif
        <div class="row">
            <div class="card">
                <div class="card-header">
                    @if(isset($logbookEntry)) @lang("logbook-entries.update") @else @lang("logbook-entries.create") @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang("logbook-entries.date")</label>
                                <input type="date" class="form-control" placeholder="@lang("logbook-entries.date")" name="date"
                                       value="{{ old("date", $logbookEntry->date ?? "") }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang("logbook-entries.log_type")</label>
                                <select class="form-control" name="log_type">
                                    <option value="">@lang("misc.please_select")</option>
                                    @foreach(\App\Models\LogbookEntry::LOG_TYPES as $logType)
                                        <option value="{{ $logType }}"
                                                @if(old("log_type", $logbookEntry->log_type ?? "") == $logType) selected @endif>@lang("logbook-entries.log_types.{$logType}")</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang("logbook-entries.check_type")</label>
                                <select class="form-control" name="check_type">
                                    <option value="">@lang("misc.please_select")</option>
                                    @foreach(\App\Models\LogbookEntry::CHECK_TYPES as $checkType)
                                        <option value="{{ $checkType }}"
                                                @if(old("check_type", $logbookEntry->check_type ?? "") == $checkType) selected @endif>@lang("logbook-entries.check_types.{$checkType}")</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang("logbook-entries.description")</label>
                                <textarea class="form-control" name="description">{{ old("description", $logbookEntry->description ?? "") }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang("logbook-entries.result")</label>
                                <textarea class="form-control" name="result">{{ old("result", $logbookEntry->result ?? "") }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-danger" href="{{ route("logbook-entry.index") }}">@lang("misc.back")</a>
                        <button class="btn btn-success" type="submit">@lang("misc.save")</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
