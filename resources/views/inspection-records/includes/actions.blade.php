<div class="d-flex justify-content-end">
    <a class="btn btn-success ml-2" href="{{ route("inspection-record.show", $model) }}"><i class="fas fa-eye"></i></a>
    <a class="btn btn-primary ml-2" href="{{ route("inspection-record.edit", $model) }}"><i class="fas fa-edit"></i></a>
    @include("includes.delete-button",[
        "url" => route("inspection-record.destroy", $model)
    ])
</div>
