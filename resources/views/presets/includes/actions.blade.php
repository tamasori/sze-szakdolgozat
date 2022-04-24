<div class="d-flex justify-content-end">
    <a class="btn btn-success ml-2" href="{{ route("preset.show", $model) }}"><i class="fas fa-eye"></i></a>
    <a class="btn btn-primary ml-2" href="{{ route("preset.edit", $model) }}"><i class="fas fa-edit"></i></a>
    @include("includes.delete-button",[
        "url" => route("preset.destroy", $model)
    ])
</div>
