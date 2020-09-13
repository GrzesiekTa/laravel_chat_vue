<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="{{ url('css/app.css') }}" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"></head>

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>.load-container{width: 100%;height: 100vh;position: relative;position: fixed;background:rgba(0, 0, 0, 0.8) top left repeat;z-index: 10000;display: none;}  .top-50 {position: relative;top: 50%;top: calc(50% - 30px);}
          .start-load-container{background:white top left repeat;display: block;}  .load-container .loadersmall {border: 5px solid #f3f3f3;border-top: 5px solid transparent;-webkit-animation: spin 2s linear infinite;animation: spin 2s linear infinite;border-radius: 50%;width: 60px;height: 60px;margin: auto;}  @keyframes  spin { 0% { transform: rotate(0deg); } 40% { transform: rotate(100deg); } 70% { transform: rotate(300deg); } 100% { transform: rotate(720deg); } }  .start-load-container .loadersmall{border: 5px solid #f3f3f3;border-top: 5px solid #333;}</style>
    </head>
    <body>
      
      <div id="app">
            <app></app>
      </div>
      
      <footer class="page-footer font-small white" style="background-color:#cc3b3b;color:white">
        <div class="footer-copyright text-center py-3">© 2020 Copyright:</div>
      </footer>

      <script src="{{ url('js/app.js') }}" type="text/javascript"></script>
    </body>
</html>
