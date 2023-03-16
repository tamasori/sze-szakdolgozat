@extends("layouts.master-with-sidebar")
@section("title",__("presets.title"))

@section("main")
    <form
        action="@if(isset($preset)) {{ route("preset.update", $preset) }} @else {{ route("preset.store") }} @endif"
        method="post">
        @csrf
        @if(isset($preset))
            @method("PUT")
        @endif
        <div class="row">
            <div class="card">
                <div class="card-header">
                    @if(isset($preset)) @lang("presets.update",["name" => $preset->name]) @else @lang("presets.create") @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang("presets.name")</label>
                                <input type="text" class="form-control" placeholder="@lang("presets.name")" name="name"
                                       value="{{ old("name", $preset->name ?? "") }}">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="presetsPage">
                        <div class="col-12">
                            <div class="row pr-md-2">
                                <table class="table table-input w-100">
                                    <thead>
                                    <th>@lang("substances.ewc_code")</th>
                                    <th>@lang("substances.part_name")</th>
                                    <th>@lang("substances.mass")</th>
                                    <th></th>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(substance, index) in substances" :key="substance.id">
                                        <td>
                                            <select :name="`substances[${substance.id}][ewc_code_id]`" v-model="substance.ewc_code_id">
                                                <option value="">@lang("misc.please_select")</option>
                                                @foreach(\App\Models\EwcCode::orderBy("code")->get() as $ewcCode)
                                                    <option value="{{ $ewcCode->getKey() }}">{{ $ewcCode->code }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input :name="`substances[${substance.id}][part_name]`" type="text" v-model="substance.part_name"></td>
                                        <td><input :name="`substances[${substance.id}][mass]`" step="0.1" type="number" v-model="substance.mass"></td>
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
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-danger" href="{{ route("preset.index") }}">@lang("misc.back")</a>
                        <button class="btn btn-success" type="submit">@lang("misc.save")</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push("after-scripts")
    <script>
        var presetsPage = new Vue({
            el: '#presetsPage',
            async beforeMount() {
                await this.getEwcCodes();
            },
            components: {
                VueAutosuggest
            },
            data: {
                ewcCodes: [],
                substances: {!! (json_encode(old("substances", isset($preset) ? $preset->convertFieldsToArray() : []))) !!},
            },
            methods: {
                addSubstance(){
                    console.log(this.substances);
                    this.substances.push({
                        id: s4(),
                        ewc_code_id: "",
                        part_name:"",
                        mass: 0
                    });
                },
                deleteSubstance(index){
                    this.substances.splice(index,1);
                },
                async getEwcCodes() {
                    const rawResponse = await fetch("/api/v1/ewc-codes", {
                        method: 'get',
                        headers: new Headers({
                            'Authorization': 'Bearer ' + '{{ auth()->user()->getPlainTextToken()->plainTextToken }}',
                        }),
                    });
                    const response = await rawResponse.json();
                    this.ewcCodes = response.data;
                },
            },
        });
    </script>
@endpush
