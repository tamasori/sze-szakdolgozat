@extends("layouts.master-with-sidebar")
@section("title",__("enquiries.title"))

@section("main")
    <form
        action="@if(isset($enquiry)) {{ route("enquiries.update", $enquiry) }} @else {{ route("enquiries.store") }} @endif"
        method="post"
        id="enquiryPage"
    >
        @csrf
        @if(isset($enquiry))
            @method("PUT")
        @endif
        <div class="row">
            <div class="card w-100">
                <div class="card-header">
                    @if(isset($enquiry)) @lang("enquiries.update") @else @lang("enquiries.create") @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("enquiries.part")</label>
                                <select class="form-control" name="part_id" required>
                                    @foreach($parts as $id => $name)
                                        <option value="{{ $id }}" @if(old("part_id", $enquiry->part_id ?? null)) selected @endif>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("enquiries.customer")</label>
                                <select class="form-control" name="customer_id" required>
                                    @foreach($customers as $id => $name)
                                        <option value="{{ $id }}" @if(old("customer_id", $enquiry->customer_id ?? null)) selected @endif>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label-sm p-0 m-0">@lang("enquiries.car_make")</label>
                                <vue-autosuggest
                                    :suggestions="carMakesSuggestions"
                                    v-model="carMake"
                                    :input-props="{
                                                class:'autosuggest__input form-control form-control-sm',
                                                placeholder:'@lang('enquiries.car_make')',
                                                required:'required', autocomplete:'nope',  name:'car_make',value:'{{ old("car_make", $enquiry->carModel->carMake->make ?? "") }}'
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
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label-sm p-0 m-0">@lang("enquiries.car_model")</label>
                                <vue-autosuggest
                                    :suggestions="carModelsSuggestions"
                                    v-model="carModel"
                                    :input-props="{
                                                class:'autosuggest__input form-control form-control-sm',
                                                placeholder:'@lang('enquiries.car_model')',
                                                required:'required', autocomplete:'nope',  name:'car_model',value:'{{ old("car_model", $enquiry->carModel->model ?? "") }}'
                                            }"
                                    @input="onCarModelChange"
                                >
                                    <template slot-scope="{suggestion}">
                                        <span class="my-suggestion-item">@{{suggestion.item}}</span>
                                    </template>
                                </vue-autosuggest>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang("enquiries.car_year")</label>
                                <input type="number" class="form-control" placeholder="@lang("enquiries.car_year")"
                                       name="car_year"
                                       value="{{ old("car_year", $enquiry->car_year ?? "") }}">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>@lang("enquiries.note")</label>
                                <textarea class="form-control" placeholder="@lang("enquiries.note")" name="note">{{ old("note", $enquiry->note ?? "") }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-danger" href="{{ route("enquiries.index") }}">@lang("misc.back")</a>
                        <button class="btn btn-success" type="submit">@lang("misc.save")</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push("after-scripts")
    <script>
        var enquiryPage = new Vue({
            el: '#enquiryPage',
            async beforeMount() {
                await this.getCarMakes();
            },
            components: {
                VueAutosuggest
            },
            data: {
                carMake: "{{ old("car_make", $enquiry->carModel->carMake->make ?? "") }}",
                carModel: "{{ old("car_model", $enquiry->carModel->model ?? "") }}",
                carMakes: [],
                carModels: [],
                carMakesSuggestions: [{data: []}],
                carModelsSuggestions: [{data: []}],
            },
            methods: {
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
            },
        });
    </script>
@endpush()
