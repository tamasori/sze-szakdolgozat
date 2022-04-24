<div class="d-flex justify-content-end">
    <a class="btn btn-primary ml-2" href="{{ route("matter-export.edit", [$year,$model]) }}"><i class="fas fa-edit"></i></a>
    @include("includes.delete-button",[
        "url" => route("matter-export.destroy", [$year,$model])
    ])
</div>
