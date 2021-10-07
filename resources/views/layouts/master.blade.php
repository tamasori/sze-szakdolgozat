<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title","Menedzsment") | BontóManager</title>

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
</head>
<body class="hold-transition">

@yield("content")

<script src="{{ asset("js/app.js") }}"></script>
<script>
    const errors = {!! json_encode($errors->all() ?? [])  !!};
    const infos = {!! json_encode(isset($infos) ? $infos : [])  !!};
    const successes = {!! json_encode(isset($successes) ? $successes : [])  !!};
    for (const error in errors){
        toastr.error(errors[error]);
    }
    for (const info in infos){
        toastr.info(infos[info]);
    }
    for (const success in successes){
        toastr.success(successes[success]);
    }
</script>
</body>
</html>
