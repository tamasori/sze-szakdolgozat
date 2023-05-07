@extends("layouts.master-with-sidebar")
@section("title",__("menu.yearly.matter_exports", ["year" => $year]))

@section("main")
    <form
        action="@if(isset($substance)) {{ route("matter-export.update", [$year, $substance]) }} @else {{ route("matter-export.store", $year) }} @endif"
        method="post">
        @csrf
        @if(isset($substance))
            @method("PUT")
        @endif
        <div class="row">
            <div class="card">
                <div class="card-header">
                    @if(isset($substance)) @lang("matter-exports.update") @else @lang("matter-exports.create") @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group form-group-lg">
                                <label>@lang("substances.in_material_balance")</label>
                                <div class="form-check">
                                    <input type="hidden" name="in_material_balance" value="0">
                                    <input class="form-check-input" type="checkbox" name="in_material_balance"
                                           value="1" {{ old("in_material_balance", $substance->in_material_balance ?? "") ? "checked" : "" }}>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>@lang("cars.date_of_demolition")</label>
                                <input type="date" class="form-control" placeholder="@lang("substances.date")"
                                       name="date"
                                       value="{{ old("date", $substance->date ?? "") }}"
                                       autocomplete="nope"
                                >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>@lang("substances.ewc_code")</label>
                                <select name="ewc_code_id" class="form-control">
                                    <option value="">@lang("misc.please_select")</option>
                                    @foreach(\App\Models\EwcCode::orderBy("code")->get() as $ewcCode)
                                        <option value="{{ $ewcCode->getKey() }}" @if(old("ewc_code_id", $substance->ewc_code_id ?? "") == $ewcCode->getKey()) selected @endif>{{ $ewcCode->code }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead>
                                    <th>@lang("substances.mass")</th>
                                    <th>@lang("substances.pretreatment_mass")</th>
                                    <th>@lang("substances.collector_mass")</th>
                                    <th>@lang("substances.disposal_mass")</th>
                                    <th>@lang("substances.export_mass")</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" name="mass" class="form-control"
                                                       value="{{ old("mass", $substance->mass ?? "") }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" name="pretreatment_mass" class="form-control"
                                                       value="{{ old("pretreatment_mass", $substance->pretreatment_mass ?? "") }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" name="collector_mass" class="form-control"
                                                       value="{{ old("collector_mass", $substance->collector_mass ?? "") }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" name="disposal_mass" class="form-control"
                                                       value="{{ old("disposal_mass", $substance->disposal_mass ?? "") }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" name="export_mass" class="form-control"
                                                       value="{{ old("export_mass", $substance->export_mass ?? "") }}">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row" id="companySelector">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>@lang("substances.company_name")</label>
                                <vue-autosuggest
                                    :suggestions="companiesSuggestions"
                                    v-model="companyName"
                                    :input-props="{
                                                class:'autosuggest__input form-control',
                                                autocomplete:'nope', placeholder:'@lang('substances.company_name')',
                                                name:'company_name',value:'{{ old("company_name", $substance->company_name ?? "") }}'
                                            }"
                                    @input="onCompanyNameChange"
                                    @selected="onCompanyNameSelect"
                                >
                                    <template slot-scope="{suggestion}">
                                        <span class="my-suggestion-item">@{{suggestion.item}}</span>
                                    </template>
                                </vue-autosuggest>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>@lang("substances.kuj_number")</label>
                                <input type="text" class="form-control" placeholder="@lang("substances.kuj_number")"
                                       name="kuj_number" v-model="kujNumber"
                                       value="{{ old("kuj_number", $substance->kuj_number ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>@lang("substances.ktj_number")</label>
                                <input type="text" class="form-control" placeholder="@lang("substances.ktj_number")"
                                       name="ktj_number" v-model="ktjNumber"
                                       value="{{ old("ktj_number", $substance->ktj_number ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>@lang("substances.treatment_code")</label>
                                <input type="text" class="form-control" placeholder="@lang("substances.treatment_code")"
                                       name="treatment_code"
                                       value="{{ old("treatment_code", $substance->treatment_code ?? "") }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <duv class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("substances.delivery_note")</label>
                                <textarea class="form-control"
                                          name="delivery_note"
                                          rows="1">{{ old("delivery_note", $substance->delivery_note ?? "") }}</textarea>
                            </div>
                        </duv>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-danger" href="{{ route("matter-export.index",$year) }}">@lang("misc.back")</a>
                        <button class="btn btn-success" type="submit">@lang("misc.save")</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push("after-scripts")
    <script>
        var companySelector = new Vue({
            el: '#companySelector',
            components: {
                VueAutosuggest
            },
            data: {
                companyNameTimeout: null,
                companies: "",
                companyName: "{{ old("company_name", $substance->company_name ?? "") }}",
                kujNumber: "{{ old("kuj_number", $substance->kuj_number ?? "") }}",
                ktjNumber: "{{ old("ktj_number", $substance->ktj_number ?? "") }}",
                companiesSuggestions: [{data: []}],
            },
            methods: {
                async getCompanies() {
                    const rawResponse = await fetch(`/api/v1/kuj-decoder/${this.companyName}`, {
                        method: 'get',
                    });
                    const response = await rawResponse.json();
                    this.companies = response.myData;
                },
                async getCompanyDetails(kuj) {
                    const rawResponse = await fetch(`/api/v1/kuj-decoder/details/${kuj}`, {
                        method: 'get',
                    });
                    const response = await rawResponse.json();
                    return response.KUJ_KTJ;
                },
                async onCompanyNameChange(input) {
                    if (this.companyNameTimeout) clearTimeout(this.companyNameTimeout);
                    this.companyNameTimeout = setTimeout(async () => {
                        await this.getCompanies();
                        this.filterCompanySuggestions(input);
                    }, 400);
                },
                getKujFromSelectedName(selected) {
                    console.log(this.companies, selected);
                    return this.companies.filter((item) => item.MEGNEVEZES === selected)[0].KUJ ?? undefined;
                },
                async onCompanyNameSelect(selected) {
                    let kuj = this.getKujFromSelectedName(selected.item);
                    if (kuj) {
                        let details = await this.getCompanyDetails(kuj);
                        this.kujNumber = kuj;
                        this.ktjNumber = details[0].KTJ ?? "";
                    }
                },
                filterCompanySuggestions(input) {
                    this.companiesSuggestions[0].data = this.companies.map(i => {
                        return i.MEGNEVEZES;
                    });
                },
            },
        });
    </script>
@endpush
