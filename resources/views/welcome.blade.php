<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.head')
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12" id="app">

                </div>
            </div>
        </div>
        @include('includes.script-libraries')
    </body>
</html>
