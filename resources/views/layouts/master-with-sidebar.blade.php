@extends("layouts.master")
@section("content")

    <div class="wrapper">
        @include("layouts.includes.navbar")
        @include("layouts.includes.sidebar")

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield("title","")</h1>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                           @yield("main")
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>V</b> {{ config("app.version") }}
            </div>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
    </div>

@endsection
