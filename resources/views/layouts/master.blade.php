<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title","Menedzsment") | BontóManager</title>
    @stack("before-styles")
    @livewireStyles
    @powerGridStyles
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset(mix("css/app.css")) }}">
    @stack("after-styles")

</head>
<body class="hold-transition">

@yield("content")
@stack("before-scripts")

<script src="{{ asset(mix("js/app.js")) }}"></script>
<script>
    const errors = {!! json_encode($errors->all() ?? [])  !!};
    const infos = {!! json_encode(session()->has("infos") ? session()->get("infos") : [])  !!};
    const successes = {!! json_encode(session()->has("successes") ? session()->get("successes") : [])  !!};
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
<script src="//unpkg.com/alpinejs" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
@livewireScripts
@powerGridScripts
@stack("after-scripts")
</body>
</html>
