<div class="d-flex justify-content-end">
    @if(empty($model->doable_at))
    <a class="btn ml-2 btn-success" href="{{ route("enquiries.set-doable", $model) }}"><i class="fas fa-play"></i></a>
    @elseif(empty($model->closed_at))
        <a class="btn ml-2 btn-danger" href="{{ route("enquiries.set-closed", $model) }}"><i class="fas fa-times-circle"></i></a>
    @endif
    <a class="btn btn-info ml-2" href="mailto:{{ $model->customer->email }}"><i class="fas fa-envelope"></i></a>
    <a class="btn btn-primary ml-2" href="{{ route("enquiries.edit", $model) }}"><i class="fas fa-edit"></i></a>
    @include("includes.delete-button",[
        "url" => route("enquiries.destroy", $model)
    ])
</div>
