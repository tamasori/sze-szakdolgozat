@extends("layouts.master-with-sidebar")
@section("title",__("yearly-starters.title",["year"=>$year]))

@section("main")
    <form
        action="{{ route("yearly-starters.store",[$year]) }}"
        method="post">
        @csrf
        <div class="row">
            <div class="card">
                <div class="card-header">
                    @lang("yearly-starters.edit",["year"=>$year])
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach(\App\Models\EwcCode::all() as $ewcCode)
                            <div class="col-12">
                                <div class="form-group">
                                    <label>EWC{{ $ewcCode->code }}</label>
                                    <input type="number" step="0.01" class="form-control" placeholder="EWC{{ $ewcCode->code }}" name="ewc[{{ $ewcCode->id }}]" value="{{ old("ewc.".$ewcCode->id, $ewcCode->getYearlyStarterForYear($year)) }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-success" type="submit">@lang("misc.save")</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
