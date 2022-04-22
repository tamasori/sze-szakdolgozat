<div class="d-flex justify-content-end">
    <a class="btn btn-primary ml-2" href="{{ route("customers.edit", $model) }}"><i class="fas fa-edit"></i></a>
    @include("includes.delete-button",[
        "url" => route("customers.destroy", $model)
    ])
</div>
