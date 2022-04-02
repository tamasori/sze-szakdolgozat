<div class="d-flex justify-content-end">
    <a class="btn btn-success ml-2" href="{{ route("machines.show", $model) }}"><i class="fas fa-eye"></i></a>
    <a class="btn btn-primary ml-2" href="{{ route("machines.edit", $model) }}"><i class="fas fa-edit"></i></a>
    @include("includes.delete-button",[
        "url" => route("machines.destroy", $model)
    ])
</div>
