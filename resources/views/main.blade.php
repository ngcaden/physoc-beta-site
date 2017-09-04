<!DOCTYPE html>
<html lang="en">
    <head>
        @include('partials._head')
    </head>

    
    <body>
        @include('partials._nav')

        <div class='container-fluid'>        
            @include('partials._messages')
            @yield('content')
        </div>

        <div class="container-fluid" id="footer">
            @include('partials._footer')
        </div>

        @include('partials._javascript')
        @yield('javascript')
    </body>
</html>
