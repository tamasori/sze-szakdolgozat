@extends("layouts.master-with-sidebar")
@section("title",__("machines.title"))

@section("main")
    <form
        action="@if(isset($machine)) {{ route("machines.update", $machine) }} @else {{ route("machines.store") }} @endif"
        method="post">
        @csrf
        @if(isset($machine))
            @method("PUT")
        @endif
        <div class="row">
            <div class="card">
                <div class="card-header">
                    @if(isset($machine)) @lang("machines.update",["name" => $machine->name]) @else @lang("machines.create") @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang("machines.name")</label>
                                <input type="text" class="form-control" placeholder="@lang("machines.name")" name="name"
                                       value="{{ old("name", $machine->name ?? "") }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang("machines.local_identifier")</label>
                                <input type="text" class="form-control" placeholder="@lang("machines.local_identifier")" name="local_identifier"
                                       value="{{ old("local_identifier", $machine->local_identifier ?? "") }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-danger" href="{{ route("machines.index") }}">@lang("misc.back")</a>
                        <button class="btn btn-success" type="submit">@lang("misc.save")</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
