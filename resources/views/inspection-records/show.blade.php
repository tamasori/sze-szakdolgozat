@extends("layouts.master-with-sidebar")
@section("title", __("inspection-records.title"))

@section("main")
<div class="row">
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <tr>
                    <td>@lang("inspection-records.date")</td>
                    <td>{{ $inspectionRecord->date }}</td>
                </tr>
                <tr>
                    <td>@lang("inspection-records.workshop_machinery_id")</td>
                    <td>{{ $inspectionRecord->workshopMachinery->name }}</td>
                </tr>
                <tr>
                    <td>@lang("inspection-records.inspector_id")</td>
                    <td>{{ $inspectionRecord->inspector->name }} ({{ $inspectionRecord->inspector->company }})</td>
                </tr>
                <tr>
                    <td>@lang("inspection-records.valid_till")</td>
                    <td>{{ $inspectionRecord->valid_till }}</td>
                </tr>
                <tr>
                    <td>@lang("inspection-records.result")</td>
                    <td>{{ $inspectionRecord->result }}</td>
                </tr>
                <tr>
                    <td>@lang("inspection-records.note")</td>
                    <td>{{ $inspectionRecord->note }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
