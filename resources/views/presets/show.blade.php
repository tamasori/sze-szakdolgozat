@extends("layouts.master-with-sidebar")
@section("title", __("presets.title"))

@section("main")
<div class="row">
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            <h2>{{ $preset->name }}</h2>
            {!! \App\Helpers\UIHelper::getPresetSubstanceList($preset) !!}
        </div>
    </div>
</div>
@endsection
