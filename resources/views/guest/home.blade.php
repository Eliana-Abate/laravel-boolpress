<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Boolpress</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}" type="text/css">

        
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <div class="text-right container-fluid pt-3 pb-5">
                            <a href="{{ route('login') }}" class="h4 mr-3">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="h4">Register</a>
                            @endif
                        </div>
                    @endauth
                </div>
            @endif

            <div id="root">
                
            </div>
        </div>

        <script src="{{asset('js/front.js')}}"></script>
    </body>
</html>
