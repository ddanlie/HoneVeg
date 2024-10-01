<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/general.css') }}">
    <script src="https://unpkg.com/vue@3"></script><!--/dist/vue.min.js - append to path in release-->
    <title>HoneVeg</title>
  </head>
  
  <body>
    <div>
      {{$slot}}
    </div>
  </body>
  
</html>