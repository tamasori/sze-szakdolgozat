@extends("layouts.master-with-sidebar")
@section("title",__("ewc-codes.title"))

@section("main")
    <form
        action="@if(isset($ewc)) {{ route("ewc-code.update", $ewc) }} @else {{ route("ewc-code.store") }} @endif"
        method="post">
        @csrf
        @if(isset($ewc))
            @method("PUT")
        @endif
        <div class="row">
            <div class="card">
                <div class="card-header">
                    @if(isset($ewc)) @lang("ewc-codes.update",["ewc" => $ewc->code]) @else @lang("ewc-codes.create") @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("ewc-codes.code")</label>
                                <input type="text" class="form-control" placeholder="@lang("ewc-codes.code")" name="code"
                                       value="{{ old("code", $ewc->code ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("ewc-codes.name")</label>
                                <input type="text" class="form-control" placeholder="@lang("ewc-codes.name")" name="name"
                                       value="{{ old("name", $ewc->name ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("ewc-codes.short_name")</label>
                                <input type="text" class="form-control" placeholder="@lang("ewc-codes.short_name")" name="short_name"
                                       value="{{ old("short_name", $ewc->short_name ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("ewc-codes.physical_form")</label>
                                <input type="text" class="form-control" placeholder="@lang("ewc-codes.physical_form")"
                                       name="physical_form"
                                       value="{{ old("physical_form", $ewc->physical_form ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("ewc-codes.packaging_method")</label>
                                <input type="text" class="form-control" placeholder="@lang("ewc-codes.packaging_method")"
                                       name="packaging_method"
                                       value="{{ old("packaging_method", $ewc->packaging_method ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("ewc-codes.expected_delivery_frequency")</label>
                                <input type="text" class="form-control" placeholder="@lang("ewc-codes.expected_delivery_frequency")"
                                       name="expected_delivery_frequency"
                                       value="{{ old("expected_delivery_frequency", $ewc->expected_delivery_frequency ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("ewc-codes.h_property")</label>
                                <input type="text" class="form-control" placeholder="@lang("ewc-codes.h_property")" name="h_property"
                                       value="{{ old("h_property", $ewc->h_property ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("ewc-codes.chemical_name_of_parts")</label>
                                <input type="text" class="form-control" placeholder="@lang("ewc-codes.chemical_name_of_parts")"
                                       name="chemical_name_of_parts"
                                       value="{{ old("chemical_name_of_parts", $ewc->chemical_name_of_parts ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="hidden" name="hazardous" value="0">
                                    <input class="form-check-input" type="checkbox" name="hazardous"
                                           value="1" {{ old("hazardous", $ewc->hazardous ?? "") ? "checked" : "" }}>
                                    <label class="form-check-label">@lang("ewc-codes.hazardous")</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("ewc-codes.type_of_hazard")</label>
                                <input type="text" class="form-control" placeholder="@lang("ewc-codes.type_of_hazard")"
                                       name="type_of_hazard"
                                       value="{{ old("type_of_hazard", $ewc->type_of_hazard ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("ewc-codes.hazardous_reactions")</label>
                                <input type="text" class="form-control" placeholder="@lang("ewc-codes.hazardous_reactions")"
                                       name="hazardous_reactions"
                                       value="{{ old("hazardous_reactions", $ewc->hazardous_reactions ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("ewc-codes.c_components")</label>
                                <input type="text" class="form-control" placeholder="@lang("ewc-codes.c_components")"
                                       name="c_components"
                                       value="{{ old("c_components", $ewc->c_components ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("ewc-codes.r_sentences")</label>
                                <input type="text" class="form-control" placeholder="@lang("ewc-codes.r_sentences")"
                                       name="r_sentences"
                                       value="{{ old("r_sentences", $ewc->r_sentences ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("ewc-codes.origin")</label>
                                <input type="text" class="form-control" placeholder="@lang("ewc-codes.origin")" name="origin"
                                       value="{{ old("origin", $ewc->origin ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("ewc-codes.technology_identifier_number")</label>
                                <input type="text" class="form-control" placeholder="@lang("ewc-codes.technology_identifier_number")"
                                       name="technology_identifier_number"
                                       value="{{ old("technology_identifier_number", $ewc->technology_identifier_number ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("ewc-codes.teaor_codes")</label>
                                <input type="text" class="form-control" placeholder="@lang("ewc-codes.teaor_codes")" name="teaor_codes"
                                       value="{{ old("teaor_codes", $ewc->teaor_codes ?? "") }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-danger" href="{{ route("ewc-code.index") }}">@lang("misc.back")</a>
                        <button class="btn btn-success" type="submit">@lang("misc.save")</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
