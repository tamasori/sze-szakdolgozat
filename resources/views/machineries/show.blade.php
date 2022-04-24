@extends("layouts.master-with-sidebar")
@section("title", __("machines.title"))

@section("main")
<div class="row">
    <div class="card">
        <div class="card-header">
            <h2>{{ $machine->name }} - {{ $machine->local_identifier }}</h2>
        </div>
        <div class="card-body">
            @livewire("tables.inspection-records-table", ["machineId" => $machine->getKey()])
        </div>
    </div>
</div>
@endsection
