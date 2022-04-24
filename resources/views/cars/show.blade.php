@extends("layouts.master-with-sidebar")
@section("title", "EWC" . $ewc->code)

@section("main")
<div class="row">
    <div class="card">
        <div class="card-header">
            @if($ewc->hazardous) <i class="fas fa-exclamation-triangle"></i> @endif EWC {{ $ewc->code }} - {{ $ewc->short_name }}
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped table-bordered">
                <tr>
                    <td><strong>@lang("ewc-codes.code")</strong></td>
                    <td>{{ $ewc->code }}</td>
                </tr>
                <tr>
                    <td><strong>@lang("ewc-codes.name")</strong></td>
                    <td>{{ $ewc->name }}</td>
                </tr>
                <tr>
                    <td><strong>@lang("ewc-codes.short_name")</strong></td>
                    <td>{{ $ewc->short_name }}</td>
                </tr>
                <tr>
                    <td><strong>@lang("ewc-codes.physical_form")</strong></td>
                    <td>{{ $ewc->physical_form }}</td>
                </tr>
                <tr>
                    <td><strong>@lang("ewc-codes.packaging_method")</strong></td>
                    <td>{{ $ewc->packaging_method }}</td>
                </tr>
                <tr>
                    <td><strong>@lang("ewc-codes.expected_delivery_frequency")</strong></td>
                    <td>{{ $ewc->expected_delivery_frequency }}</td>
                </tr>
                <tr>
                    <td><strong>@lang("ewc-codes.h_property")</strong></td>
                    <td>{{ $ewc->h_property }}</td>
                </tr>
                <tr>
                    <td><strong>@lang("ewc-codes.chemical_name_of_parts")</strong></td>
                    <td>{{ $ewc->chemical_name_of_parts }}</td>
                </tr>
                <tr>
                    <td><strong>@lang("ewc-codes.hazardous")</strong></td>
                    <td>{!! \App\Helpers\UIHelper::getBooleanDisplay($ewc->hazardous) !!}</td>
                </tr>
                <tr>
                    <td><strong>@lang("ewc-codes.type_of_hazard")</strong></td>
                    <td>{{ $ewc->type_of_hazard }}</td>
                </tr>
                <tr>
                    <td><strong>@lang("ewc-codes.origin")</strong></td>
                    <td>{{ $ewc->origin }}</td>
                </tr>
                <tr>
                    <td><strong>@lang("ewc-codes.technology_identifier_number")</strong></td>
                    <td>{{ $ewc->technology_identifier_number }}</td>
                </tr>
                <tr>
                    <td><strong>@lang("ewc-codes.teaor_codes")</strong></td>
                    <td>{{ $ewc->teaor_codes }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
