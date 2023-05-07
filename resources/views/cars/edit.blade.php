@extends("layouts.master-with-sidebar")
@section("title",__("cars.title"))

@section("main")
    <div class="row" id="carFormPage">
        <form
            id="carForm"
            action="@if(isset($car)) {{ route("car.update", $car) }} @else {{ route("car.store") }} @endif"
            method="post"
            enctype="multipart/form-data">
            @csrf
            @if(isset($car))
                @method("PUT")
            @endif
            <div class="card">
                <div class="card-header">
                    @if(isset($car))
                        @lang("cars.update")
                    @else
                        @lang("cars.create")
                    @endif
                    @if(isset($car) && $car->getNextCar())
                        <a class="btn btn-primary float-right ml-2"
                           href="{{ route("car.edit",$car->getNextCar())}}">@lang("cars.nextCar")</a>
                    @endif
                    @if(isset($car) && $car->getPreviousCar())
                        <a class="btn btn-primary float-right ml-2"
                           href="{{ route("car.edit",$car->getPreviousCar())}}">@lang("cars.previousCar")</a>
                    @endif
                    <button type="button" class="btn btn-primary float-right"
                            @click="recalculateDryWeight">@lang("cars.recalculateDryWeight")</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label-sm p-0 m-0">@lang("cars.local_identifier")</label>
                                <input type="number" class="form-control form-control-sm" name="car[local_identifier]"
                                       value="{{ $car->local_identifier ?? \App\Models\Car::getNextLocalIdentifier() }}"
                                       autocomplete="nope"
                                >
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label
                                    class="col-form-label-sm p-0 m-0">@lang("cars.demolition_certificate_number")</label>
                                <input type="text" class="form-control form-control-sm"
                                       placeholder="@lang("cars.demolition_certificate_number")"
                                       name="car[demolition_certificate_number]"
                                       value="{{ old("car.demolition_certificate_number", $car->demolition_certificate_number ?? "") }}"
                                       autocomplete="nope"
                                >
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label-sm p-0 m-0">@lang("cars.date_of_demolition")</label>
                                <input type="date" class="form-control form-control-sm"
                                       placeholder="@lang("cars.date_of_demolition")"
                                       v-model="dateOfDemolition"
                                       name="car[date_of_demolition]"
                                       value="{{ old("car.date_of_demolition", $car->date_of_demolition ?? "") }}"
                                       autocomplete="nope"
                                >
                            </div>
                        </div>
                    </div>
                    <hr class="m-1">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label-sm p-0 m-0">@lang("cars.zip")</label>
                                <input type="text" class="form-control form-control-sm"
                                       v-model="zip"
                                       v-on:keyup="getCityFromZip()"
                                       placeholder="@lang("cars.zip")"
                                       name="car[zip]"
                                       value="{{ old("car.zip", $car->zip ?? "") }}"
                                       autocomplete="nope"
                                >
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label-sm p-0 m-0">@lang("cars.city")</label>
                                <input type="text" class="form-control form-control-sm" placeholder="@lang("cars.city")"
                                       v-model="city"
                                       name="car[city]"
                                       autocomplete="nope"
                                       value="{{ old("car.city", $car->city ?? "") }}">
                            </div>
                        </div>
                    </div>
                    <hr class="m-1">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label-sm p-0 m-0">@lang("cars.company_name")</label>
                                <vue-autosuggest
                                    :suggestions="companiesSuggestions"
                                    v-model="companyName"
                                    :input-props="{
                                                class:'autosuggest__input form-control form-control-sm',
                                                autocomplete:'nope', placeholder:'@lang('cars.company_name')',
                                                name:'car[company_name]',value:'{{ old("car.company_name", $car->company_name ?? "") }}'
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
                                <label class="col-form-label-sm p-0 m-0">@lang("cars.kuj_number")</label>
                                <input type="text" class="form-control form-control-sm"
                                       placeholder="@lang("cars.kuj_number")"
                                       name="car[kuj_number]" v-model="kujNumber"
                                       value="{{ old("car.kuj_number", $car->kuj_number ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label-sm p-0 m-0">@lang("cars.ktj_number")</label>
                                <input type="text" class="form-control form-control-sm"
                                       placeholder="@lang("cars.ktj_number")"
                                       name="car[ktj_number]" v-model="ktjNumber"
                                       value="{{ old("car.ktj_number", $car->ktj_number ?? "") }}">
                            </div>
                        </div>
                    </div>
                    <hr class="m-1">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label-sm p-0 m-0">@lang("cars.car_make")</label>
                                <vue-autosuggest
                                    :suggestions="carMakesSuggestions"
                                    v-model="carMake"
                                    :input-props="{
                                                class:'autosuggest__input form-control form-control-sm',
                                                placeholder:'@lang('cars.car_make')',
                                                required:'required', autocomplete:'nope',  name:'car_make',value:'{{ old("car_make", $car->carMake->make ?? "") }}'
                                            }"
                                    @input="onCarMakeChange"
                                    @selected="onCarMakeSelect"
                                >
                                    <template slot-scope="{suggestion}">
                                        <span class="my-suggestion-item">@{{suggestion.item}}</span>
                                    </template>
                                </vue-autosuggest>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label-sm p-0 m-0">@lang("cars.car_model")</label>
                                <vue-autosuggest
                                    :suggestions="carModelsSuggestions"
                                    v-model="carModel"
                                    :input-props="{
                                                class:'autosuggest__input form-control form-control-sm',
                                                placeholder:'@lang('cars.car_model')',
                                                required:'required', autocomplete:'nope',  name:'car_model',value:'{{ old("car_model", $car->carModel->model ?? "") }}'
                                            }"
                                    @input="onCarModelChange"
                                >
                                    <template slot-scope="{suggestion}">
                                        <span class="my-suggestion-item">@{{suggestion.item}}</span>
                                    </template>
                                </vue-autosuggest>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label-sm p-0 m-0">@lang("cars.year")</label>
                                <input type="number" class="form-control form-control-sm"
                                       placeholder="@lang("cars.year")"
                                       name="car[year]"
                                       autocomplete="nope"
                                       value="{{ old("car.year", $car->year ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label-sm p-0 m-0">@lang("cars.fuel_type_id")</label>
                                <select name="car[fuel_type_id]" class="form-control form-control-sm">
                                    <option>@lang("misc.please_select")</option>
                                    @foreach(\App\Models\FuelType::all() as $fuelType)
                                        <option value="{{ $fuelType->getKey() }}"
                                                @if(old("car.fuel_type_id", $car->fuel_type_id ?? null) == $fuelType->getKey()) selected @endif>{{ $fuelType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label-sm p-0 m-0">@lang("cars.vin")</label>
                                <input type="text" class="form-control form-control-sm" autocomplete="nope"
                                       placeholder="@lang("cars.vin")" name="car[vin]"
                                       value="{{ old("car.vin", $car->vin ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label-sm p-0 m-0">@lang("cars.engine_code")</label>
                                <input type="text" class="form-control form-control-sm" autocomplete="nope"
                                       placeholder="@lang("cars.engine_code")"
                                       name="car[engine_code]"
                                       value="{{ old("car.engine_code", $car->engine_code ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label-sm p-0 m-0">@lang("cars.engine_ccm")</label>
                                <input type="number" class="form-control form-control-sm" autocomplete="nope"
                                       placeholder="@lang("cars.engine_ccm")"
                                       name="car[engine_ccm]"
                                       value="{{ old("car.engine_ccm", $car->engine_ccm ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label-sm p-0 m-0">@lang("cars.power")</label>
                                <input type="number" class="form-control form-control-sm" autocomplete="nope"
                                       placeholder="@lang("cars.power")"
                                       name="car[power]"
                                       value="{{ old("car.power", $car->power ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label-sm p-0 m-0">@lang("cars.color_id")</label>
                                <vue-autosuggest
                                    :suggestions="colorsSuggestions"
                                    v-model="color"
                                    :input-props="{
                                                class:'autosuggest__input form-control form-control-sm',
                                                placeholder:'@lang('cars.color_id')',
                                                required:'required', name:'color',value:'{{ old("color", $car->color->name ?? "") }}'
                                            }"
                                    @input="onColorChange"
                                >
                                    <template slot-scope="{suggestion}">
                                        <span class="my-suggestion-item">@{{suggestion.item}}</span>
                                    </template>
                                </vue-autosuggest>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label-sm p-0 m-0">@lang("cars.own_weight")</label>
                                <input type="number" step="0.1" class="form-control form-control-sm" v-model="ownWeight"
                                       placeholder="@lang("cars.own_weight")"
                                       name="car[own_weight]">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label-sm p-0 m-0">@lang("cars.retrieved_weight")</label>
                                <input type="number" step="0.1" class="form-control form-control-sm"
                                       v-model="retrievedWeight" placeholder="@lang("cars.retrieved_weight")"
                                       name="car[retrieved_weight]">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label-sm p-0 m-0">@lang("cars.dry_weight")</label>
                                <input type="number" step="0.1" class="form-control form-control-sm" v-model="dryWeight"
                                       placeholder="@lang("cars.dry_weight")"
                                       name="car[dry_weight]">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label-sm p-0 m-0">@lang("cars.current_weight")</label>
                                <input type="text" class="form-control form-control-sm" v-model="currentWeight"
                                       disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label-sm p-0 m-0">@lang("cars.note")</label>
                                <textarea class="form-control form-control-sm"
                                          name="car[note]">{{ old("car.note", $car->note ?? "") }}</textarea>
                            </div>
                        </div>
                    </div>


                    <hr class="m-1">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="row pr-md-2">
                                <table class="table table-input w-100">
                                    <thead>
                                    <th>@lang("substances.date")</th>
                                    <th>@lang("substances.ewc_code")</th>
                                    <th>@lang("substances.part_name")</th>
                                    <th>@lang("substances.mass")</th>
                                    <th></th>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(substance, index) in substances" :key="substance.id">
                                        <td><input :name="`substances[${substance.id}][date]`" type="date"
                                                   v-model="substance.date"></td>
                                        <td>
                                            <select :name="`substances[${substance.id}][ewc_code_id]`"
                                                    v-model="substance.ewc_code_id">
                                                <option value="">@lang("misc.please_select")</option>
                                                @foreach(\App\Models\EwcCode::orderBy("code")->get() as $ewcCode)
                                                    <option
                                                        value="{{ $ewcCode->getKey() }}">{{ $ewcCode->code }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input :name="`substances[${substance.id}][part_name]`" type="text"
                                                   v-model="substance.part_name"></td>
                                        <td><input :name="`substances[${substance.id}][mass]`" step="0.1" type="number"
                                                   v-model="substance.mass"></td>
                                        <td>
                                            <button class="float-right btn btn-danger d-inline-block" type="button"
                                                    @click="deleteSubstance(index)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <button class="btn btn-success" type="button" @click="addSubstance">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <div class="row mt-2 ml-0">
                                <div class="row">
                                    <button class="btn btn-primary" type="button" @click="addAnyagR4Substance">
                                        @lang("cars.add_anyag_r4_substance")
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <h3>@lang("cars.add_from_preset_title")</h3>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <select class="form-control" v-model="selectedPreset">
                                                <option value="">@lang("misc.please_select")</option>
                                                <option v-for="(preset, index) in presets" :value="index" :key="index">
                                                    @{{
                                                    preset.name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <button class="btn btn-success" type="button"
                                                    @click="addSubstancesFromPreset">
                                                <i class="fas fa-plus"></i> @lang("cars.add_from_preset")
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input type="file" name="files[]" multiple>
                            @if(isset($car) && $car->hasMedia("files"))
                                <div class="row mt-2">
                                    @foreach($car->getMedia("files") as $file)
                                        <div class="col-md-12 card card-body flex-row align-items-center"
                                             id="{{ $file->uuid }}">
                                            <a href="{{ $file->getUrl() }}" target="_blank" class="d-inline-block w-75">
                                                <i class="fas fa-file"></i> {{ $file->name }}</a>
                                            <div class="d-inline-block w-25">
                                                <button class="float-right btn btn-danger d-inline-block" type="button"
                                                        @click="deleteFile({{$file->getKey()}},'{{$file->uuid}}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-danger" href="{{ route("car.index") }}">@lang("misc.back")</a>
                        <button class="btn btn-success" type="button" @click="saveForm()">@lang("misc.save")</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@php
    $oldSubstances = old("substances", null);
    if ($oldSubstances !== null){
        $oldSubstances = array_values(collect($oldSubstances)->map(function ($item,$key){
            $item['id'] = $key;
            return $item;
        })->toArray());
    }
@endphp
@push("after-scripts")
    <script>
        var carFormPage = new Vue({
            el: '#carFormPage',
            async beforeMount() {
                await this.getCarMakes();
                await this.getColors();
                await this.getEwcCodes();
                await this.getPresets();
            },
            mounted(){
                window.addEventListener('beforeunload', this.showConfirmationMessage);
            },
            beforeDestroy() {
                window.removeEventListener('beforeunload', this.showConfirmationMessage)
            },
            components: {
                VueAutosuggest
            },
            data: {
                ewcCodes: [],
                substances: {!! (json_encode($oldSubstances ? $oldSubstances : (isset($car) ? ($car->substances()->get() ?? []) : []) ))  !!},
                companyNameTimeout: null,
                companies: "",
                companyName: "{{ old("car.company_name", $car->company_name ?? "")  ?? "" }}",
                kujNumber: "{{ old("car.kuj_number", $car->kuj_number ?? "")  ?? "" }}",
                ktjNumber: "{{ old("car.ktj_number", $car->ktj_number ?? "")  ?? "" }}",
                city: "{{ old("car.city", $car->city ?? "")  ?? "" }}",
                zip: "{{ old("car.zip", $car->zip ?? "")  ?? "" }}",
                carMake: "{{ old("car_make", $car->carMake->make ?? "")  ?? "" }}",
                carModel: "{{ old("car_model", $car->carModel->model ?? "") ?? ""}}",
                color: "{{ old("color", $car->color->name ?? "")  ?? "" }}",
                ownWeight: {{ old("car.own_weight", $car->own_weight ?? 0)  ?? 0 }},
                dryWeight: {{ old("car.dry_weight", $car->dry_weight ?? 0)  ?? 0 }},
                retrievedWeight: {{ old("car.retrieved_weight", $car->retrieved_weight ?? 0)  ?? 0 }},
                dateOfDemolition: "{{ old("car.date_of_demolition", $car->date_of_demolition ?? 0) ?? 0 }}",
                carMakes: [],
                carModels: [],
                colors: [],
                presets: [],
                selectedPreset: "",
                companiesSuggestions: [{data: []}],
                carMakesSuggestions: [{data: []}],
                carModelsSuggestions: [{data: []}],
                colorsSuggestions: [{data: []}],
                ongoingSave: false,
            },
            computed: {
                currentWeight: function () {
                    let sumOfMass = this.substances.reduce(function (sum, substance) {
                        return sum + parseFloat(substance.mass);
                    }, 0);
                    return this.retrievedWeight - sumOfMass;
                }
            },
            methods: {
                async saveForm(){
                    this.ongoingSave = true;
                    await this.recalculateDryWeight();
                    document.getElementById('carForm').submit();
                },
                showConfirmationMessage(event) {
                    if(!this.ongoingSave){
                        //event.preventDefault();
                        event.returnValue = null;
                    }
                },
                addSubstance() {
                    const today = new Date();
                    this.substances.push({
                        id: s4(),
                        date: today.toISOString().split('T')[0],
                        ewc_code_id: "",
                        part_name: "",
                        mass: 0
                    });
                },
                deleteSubstance(index) {
                    this.substances.splice(index, 1);
                },
                addAnyagR4Substance() {
                    const today = new Date();
                    this.recalculateDryWeight();
                    console.log(this.ewcCodes);
                    this.substances.push({
                        id: s4(),
                        date: today.toISOString().split('T')[0],
                        ewc_code_id: this.ewcCodes.find((item) => item.code === "Anyag-R4")?.id ?? "",
                        part_name: "",
                        mass: this.dryWeight
                    });
                },
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
                async getColors() {
                    const rawResponse = await fetch("/api/v1/colors", {
                        method: 'get',
                        headers: new Headers({
                            'Authorization': 'Bearer ' + '{{ auth()->user()->getPlainTextToken()->plainTextToken }}',
                        }),
                    });
                    const response = await rawResponse.json();
                    this.colors = response.data;
                },
                async getPresets() {
                    const rawResponse = await fetch("/api/v1/presets", {
                        method: 'get',
                        headers: new Headers({
                            'Authorization': 'Bearer ' + '{{ auth()->user()->getPlainTextToken()->plainTextToken }}',
                        }),
                    });
                    const response = await rawResponse.json();
                    this.presets = response.data;
                },
                async getEwcCodes() {
                    const rawResponse = await fetch("/api/v1/ewc-codes?perPage=99", {
                        method: 'get',
                        headers: new Headers({
                            'Authorization': 'Bearer ' + '{{ auth()->user()->getPlainTextToken()->plainTextToken }}',
                        }),
                    });
                    const response = await rawResponse.json();
                    this.ewcCodes = response.data;
                },
                async getCarMakes() {
                    const rawResponse = await fetch("/api/v1/car-makes", {
                        method: 'get',
                        headers: new Headers({
                            'Authorization': 'Bearer ' + '{{ auth()->user()->getPlainTextToken()->plainTextToken }}',
                        }),
                    });
                    const response = await rawResponse.json();
                    this.carMakes = response.data;
                },
                async getCityFromZip() {
                    if (this.zip.length === 4) {
                        const rawResponse = await fetch(`{{ route("api.v1.zip.decode") }}/${this.zip}`, {
                            method: 'get',
                        });
                        const response = await rawResponse.json();
                        console.log(response);
                        this.city = response.result[0].name ?? "";
                    }
                },
                async getCarModels(carMake) {
                    const carMakeId = this.carMakes.filter(i => {
                        let make = i.make.toLowerCase();
                        return make.includes(carMake.item.toLowerCase());
                    })[0].id ?? undefined;
                    if (carMakeId !== undefined) {
                        const rawResponse = await fetch(`/api/v1/car-models/search`, {
                            method: 'post',
                            headers: new Headers({
                                'Authorization': 'Bearer ' + '{{ auth()->user()->getPlainTextToken()->plainTextToken }}',
                                'Content-Type': 'application/json'
                            }),
                            body: JSON.stringify({
                                filters: [
                                    {field: "make_id", operator: "=", value: carMakeId},
                                ]
                            })
                        });
                        const response = await rawResponse.json();
                        console.log(response);
                        this.carModels = response.data;
                        this.filterCarModelSuggestions("");
                    }
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
                onColorChange(input) {
                    this.filterColorSuggestions(input);
                },
                onCarMakeChange(input) {
                    this.carModel = "";
                    this.carModelsSuggestions = [{data: []}];
                    this.filterCarMakeSuggestions(input);
                },
                onCarModelChange(input) {
                    this.filterCarModelSuggestions(input);
                },
                onCarMakeSelect(selected) {
                    this.getCarModels(selected);
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
                filterColorSuggestions(input) {
                    this.colorsSuggestions[0].data = this.colors.filter(i => {
                        let color = i.name.toLowerCase();
                        return color.includes(input.toLowerCase());
                    }).map(i => {
                        return i.name;
                    });
                },
                filterCarMakeSuggestions(input) {
                    this.carMakesSuggestions[0].data = this.carMakes.filter(i => {
                        let make = i.make.toLowerCase();
                        return make.includes(input.toLowerCase());
                    }).map(i => {
                        return i.make;
                    });
                },
                filterCarModelSuggestions(input) {
                    this.carModelsSuggestions[0].data = this.carModels.filter(i => {
                        let model = i.model.toLowerCase();
                        return model.includes(input.toLowerCase());
                    }).map(i => {
                        return i.model;
                    });
                },
                async deleteFile(fileId, imageUUID) {
                    const response = await fetch(`/api/v1/cars/delete-file/${fileId}`, {
                        method: 'DELETE',
                        headers: new Headers({
                            'Authorization': 'Bearer ' + '{{ auth()->user()->getPlainTextToken()->plainTextToken }}',
                            'Content-Type': 'application/json'
                        }),
                    });
                    if (response.ok) {
                        const responseJson = await response.json();
                        document.getElementById(imageUUID).remove();
                        toastr.success(responseJson.message ?? "");
                    }
                },
                recalculateDryWeight() {
                    let hazardousEwcCodes = this.ewcCodes.filter(ewcCode => ewcCode.hazardous == true).map(ewcCode => ewcCode.id);
                    let sumOfHazardousMass = this.substances.reduce((sum, substance) => {
                        console.log(substance);
                        if (hazardousEwcCodes.includes(parseInt(substance.ewc_code_id))) {
                            return sum + parseFloat(substance.mass);
                        }
                        return sum;
                    }, 0);
                    console.log(sumOfHazardousMass);
                    this.dryWeight = this.retrievedWeight - sumOfHazardousMass;
                },
                addSubstancesFromPreset() {
                    let selected = this.presets[this.selectedPreset];
                    const today = new Date();
                    const date = this.dateOfDemolition ? (new Date(this.dateOfDemolition)) : today;
                    if (selected) {
                        Object.values(JSON.parse(selected.fields)).forEach(substance => {
                            this.substances.push({
                                id: s4(),
                                date: date.toISOString().split('T')[0],
                                ewc_code_id: substance.ewc_code_id,
                                part_name: substance.part_name,
                                mass: substance.mass
                            });
                        });
                    }
                }
            },
        });
    </script>
@endpush
