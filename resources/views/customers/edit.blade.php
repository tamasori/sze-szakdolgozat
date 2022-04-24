@extends("layouts.master-with-sidebar")
@section("title",__("customers.title"))

@section("main")
    <form
        action="@if(isset($customer)) {{ route("customers.update", $customer) }} @else {{ route("customers.store") }} @endif"
        method="post">
        @csrf
        @if(isset($customer))
            @method("PUT")
        @endif
        <div class="row">
            <div class="card">
                <div class="card-header">
                    @if(isset($customer)) @lang("customers.update") @else @lang("customers.create") @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("customers.company")</label>
                                <input type="text" class="form-control" placeholder="@lang("customers.company")" name="company"
                                       value="{{ old("company", $customer->company ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("customers.company_registration_number")</label>
                                <input type="text" class="form-control" placeholder="@lang("customers.company_registration_number")" name="company_registration_number"
                                       value="{{ old("company_registration_number", $customer->company_registration_number ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("customers.name")</label>
                                <input type="text" class="form-control" placeholder="@lang("customers.name")" name="name"
                                       value="{{ old("name", $customer->name ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("customers.email")</label>
                                <input type="email" class="form-control" placeholder="@lang("customers.email")"
                                       name="email"
                                       value="{{ old("email", $customer->email ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("customers.phone_number")</label>
                                <input type="text" class="form-control" placeholder="@lang("customers.phone_number")"
                                       name="phone_number"
                                       value="{{ old("phone_number", $customer->phone_number ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("customers.vat_number")</label>
                                <input type="text" class="form-control" placeholder="@lang("customers.vat_number")"
                                       name="vat_number"
                                       value="{{ old("vat_number", $customer->vat_number ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("customers.city")</label>
                                <input type="text" class="form-control" placeholder="@lang("customers.city")" name="city"
                                       value="{{ old("city", $customer->city ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("customers.street")</label>
                                <input type="text" class="form-control" placeholder="@lang("customers.street")"
                                       name="street"
                                       value="{{ old("street", $customer->street ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("customers.house_number")</label>
                                <input type="text" class="form-control" placeholder="@lang("customers.house_number")"
                                       name="house_number"
                                       value="{{ old("house_number", $customer->house_number ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>@lang("customers.note")</label>
                                <textarea class="form-control" placeholder="@lang("customers.note")" name="note">{{ old("note", $customer->note ?? "") }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-danger" href="{{ route("customers.index") }}">@lang("misc.back")</a>
                        <button class="btn btn-success" type="submit">@lang("misc.save")</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
