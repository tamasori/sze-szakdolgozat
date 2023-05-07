<table class="table table-bordered text-center table-hover">
    <tbody>
        <tr class="text-bold">
            <td colspan="2">&nbsp;</td>
            <td colspan="4">@lang("exports.ewc.normal.table.headers.export_masses")</td>
            <td colspan="5">@lang("exports.ewc.normal.table.headers.rec_data")</td>
            <td>&nbsp;</td>
        </tr>
        <tr class="text-bold">
            <td>@lang("exports.ewc.normal.table.headers.date")</td>
            <td>@lang("exports.ewc.normal.table.headers.mass")</td>
            <td>@lang("exports.ewc.normal.table.headers.pretreatment")</td>
            <td>@lang("exports.ewc.normal.table.headers.collector")</td>
            <td>@lang("exports.ewc.normal.table.headers.disposal")</td>
            <td>@lang("exports.ewc.normal.table.headers.export")</td>
            <td>@lang("exports.ewc.normal.table.headers.rec_name")</td>
            <td>@lang("exports.ewc.normal.table.headers.rec_kuj_number")</td>
            <td>@lang("exports.ewc.normal.table.headers.rec_ktj_number")</td>
            <td>@lang("exports.ewc.normal.table.headers.rec_treatment_code")</td>
            <td>@lang("exports.ewc.normal.table.headers.sz_ticket_number")</td>
            <td>@lang("exports.ewc.normal.table.headers.rolling_mass")</td>
        </tr>
        <tr class="text-bold">
            <td colspan="12" class="text-left">@lang("exports.ewc.normal.table.headers.yearly_starter"): {{ $ewcCode->getYearlyStarterForYear($year) }}kg</td>
        </tr>
        @php $rollingMass = $ewcCode->getYearlyStarterForYear($year); @endphp
        @foreach($substances as $substance)
            @php $rollingMass += \App\Services\NormalEwcCalculationsService::calculateRollingMassAddage($substance) @endphp
            <tr>
                <td>{{ $substance->date }}</td>
                <td>{{ $substance->mass }}</td>
                <td>{{ $substance->pretreatment_mass ?? 0 }}</td>
                <td>{{ $substance->collector_mass ?? 0 }}</td>
                <td>{{ $substance->disposal_mass ?? 0 }}</td>
                <td>{{ $substance->export_mass ?? 0 }}</td>
                <td>{{ $substance->company_name }}</td>
                <td>{{ $substance->kuj_number }}</td>
                <td>{{ $substance->ktj_number }}</td>
                <td>{{ $substance->treatment_code }}</td>
                <td>{{ $substance->delivery_note }}</td>
                <td>
                    <a class="btn btn-danger btn-sm" href="{{ route('ewc-export.delete',[$ewcCode->code, $year, $substance->id]) }}">Törlés</a><br>
                    {{ $rollingMass }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<form action="{{ route("ewc-export.store", [$ewcCode->code, $year]) }}" method="post">
    @csrf
    <input type="hidden" name="ewc_code_id" value="{{$ewcCode->id}}">
<table>
    <tr id="companySelector">

            <td>
                <div class="form-group">
                    <input type="date" class="form-control" placeholder="@lang("substances.date")"
                           name="date"
                           value="{{ old("date", "") }}"
                           autocomplete="nope"
                    >
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="number" name="mass" class="form-control" step="0.001"
                           value="{{ old("mass", "") }}">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="number" name="pretreatment_mass" class="form-control" step="0.001"
                           value="{{ old("pretreatment_mass", "") }}">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="number" name="collector_mass" class="form-control" step="0.001"
                           value="{{ old("collector_mass", "") }}">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="number" name="disposal_mass" class="form-control" step="0.001"
                           value="{{ old("disposal_mass", "") }}">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="number" name="export_mass" class="form-control" step="0.001"
                           value="{{ old("export_mass", "") }}">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <vue-autosuggest
                        :suggestions="companiesSuggestions"
                        v-model="companyName"
                        :input-props="{
                                                class:'autosuggest__input form-control',
                                                autocomplete:'nope', placeholder:'@lang('substances.company_name')',
                                                name:'company_name',value:'{{ old("company_name", "") }}'
                                            }"
                        @input="onCompanyNameChange"
                        @selected="onCompanyNameSelect"
                    >
                        <template slot-scope="{suggestion}">
                            <span class="my-suggestion-item">@{{suggestion.item}}</span>
                        </template>
                    </vue-autosuggest>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="@lang("substances.kuj_number")"
                           name="kuj_number" v-model="kujNumber"
                           value="{{ old("kuj_number", "") }}">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="@lang("substances.ktj_number")"
                           name="ktj_number" v-model="ktjNumber"
                           value="{{ old("ktj_number", "") }}">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="@lang("substances.treatment_code")"
                           name="treatment_code"
                           value="{{ old("treatment_code", "") }}">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <textarea class="form-control"
                              name="delivery_note"
                              rows="1">{{ old("delivery_note", "") }}</textarea>
                </div>
            </td>
            <td>
                <button class="btn btn-success" type="submit">@lang('misc.save')</button>
            </td>

    </tr>
</table>
</form>
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
