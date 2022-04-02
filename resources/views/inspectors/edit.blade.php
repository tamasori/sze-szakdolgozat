@extends("layouts.master-with-sidebar")
@section("title",__("inspectors.title"))

@section("main")
    <form
        action="@if(isset($inspector)) {{ route("inspector.update", $inspector) }} @else {{ route("inspector.store") }} @endif"
        method="post">
        @csrf
        @if(isset($inspector))
            @method("PUT")
        @endif
        <div class="row">
            <div class="card">
                <div class="card-header">
                    @if(isset($inspector)) @lang("inspectors.update",["name" => $inspector->name]) @else @lang("inspectors.create") @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang("inspectors.company")</label>
                                <input type="text" class="form-control" placeholder="@lang("inspectors.company")" name="company"
                                       value="{{ old("company", $inspector->company ?? "") }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang("inspectors.company_registration_number")</label>
                                <input type="text" class="form-control" placeholder="@lang("inspectors.company_registration_number")" name="company_registration_number"
                                       value="{{ old("company_registration_number", $inspector->company_registration_number ?? "") }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang("inspectors.name")</label>
                                <input type="text" class="form-control" placeholder="@lang("inspectors.name")" name="name"
                                       value="{{ old("name", $inspector->name ?? "") }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang("inspectors.email")</label>
                                <input type="email" class="form-control" placeholder="@lang("inspectors.email")" name="email"
                                       value="{{ old("email", $inspector->email ?? "") }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang("inspectors.phone_number")</label>
                                <input type="text" class="form-control" placeholder="@lang("inspectors.phone_number")" name="phone_number"
                                       value="{{ old("phone_number", $inspector->phone_number ?? "") }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang("inspectors.city")</label>
                                <input type="text" class="form-control" placeholder="@lang("inspectors.city")" name="city"
                                       value="{{ old("city", $inspector->city ?? "") }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang("inspectors.street")</label>
                                <input type="text" class="form-control" placeholder="@lang("inspectors.street")" name="street"
                                       value="{{ old("street", $inspector->street ?? "") }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang("inspectors.house_number")</label>
                                <input type="text" class="form-control" placeholder="@lang("inspectors.house_number")" name="house_number"
                                       value="{{ old("house_number", $inspector->house_number ?? "") }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang("inspectors.vat_number")</label>
                                <input type="text" class="form-control" placeholder="@lang("inspectors.vat_number")" name="vat_number"
                                       value="{{ old("vat_number", $inspector->vat_number ?? "") }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang("inspectors.public_identifier_numbers")</label>
                                <input type="text" class="form-control" placeholder="@lang("inspectors.public_identifier_numbers")" name="public_identifier_numbers"
                                       value="{{ old("public_identifier_numbers", $inspector->public_identifier_numbers ?? "") }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang("inspectors.note")</label>
                                <textarea class="form-control" name="note">{{ old("note", $inspector->note ?? "") }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-danger" href="{{ route("inspector.index") }}">@lang("misc.back")</a>
                        <button class="btn btn-success" type="submit">@lang("misc.save")</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
