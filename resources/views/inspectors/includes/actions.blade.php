<div class="d-flex justify-content-end">
    <a class="btn btn-primary ml-2" href="{{ route("inspector.edit", $model) }}"><i class="fas fa-edit"></i></a>
    @include("includes.delete-button",[
        "url" => route("inspector.destroy", $model)
    ])
</div>
