@extends("layouts.master-with-sidebar")
@section("title",__("inspection-records.title"))

@section("main")
    <form
        action="@if(isset($inspectionRecord)) {{ route("inspection-record.update", $inspectionRecord) }} @else {{ route("inspection-record.store") }} @endif"
        method="post">
        @csrf
        @if(isset($inspectionRecord))
            @method("PUT")
        @endif
        <div class="row">
            <div class="card">
                <div class="card-header">
                    @if(isset($inspectionRecord)) @lang("inspection-records.update",["name" => $inspectionRecord->name]) @else @lang("inspection-records.create") @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang("inspection-records.date")</label>
                                <input type="date" class="form-control" placeholder="@lang("inspection-records.date")" name="date"
                                       value="{{ old("date", $inspectionRecord->date ?? "") }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang("inspection-records.workshop_machinery_id")</label>
                                <select name="workshop_machinery_id" class="form-control">
                                    <option value="">@lang("misc.please_select")</option>
                                    @foreach(\App\Models\WorkshopMachinery::pluck("name", "id") as $id => $name)
                                        <option value="{{ $id }}" @if($id == old("workshop_machinery_id", $inspectionRecord->workshop_machinery_id ?? "")) selected @endif>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang("inspection-records.inspector_id")</label>
                                <select name="inspector_id" class="form-control">
                                    <option value="">@lang("misc.please_select")</option>
                                    @foreach(\App\Models\Inspector::select(["name","company","id"])->get() as $inspector)
                                        <option value="{{ $inspector->id }}" @if($inspector->getKey() == old("inspector_id", $inspectionRecord->inspector_id ?? "")) selected @endif>{{ $inspector->name }} ({{ $inspector->company }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang("inspection-records.valid_till")</label>
                                <input type="date" class="form-control" placeholder="@lang("inspection-records.valid_till")" name="valid_till"
                                       value="{{ old("valid_till", $inspectionRecord->valid_till ?? "") }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang("inspection-records.result")</label>
                                <input type="text" class="form-control" placeholder="@lang("inspection-records.result")" name="result"
                                       value="{{ old("result", $inspectionRecord->result ?? "") }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang("inspection-records.note")</label>
                                <textarea name="note" class="form-control">
                                    {{ old("note", $inspectionRecord->note ?? "") }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-danger" href="{{ route("inspection-record.index") }}">@lang("misc.back")</a>
                        <button class="btn btn-success" type="submit">@lang("misc.save")</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
