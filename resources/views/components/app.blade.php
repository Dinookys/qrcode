<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="bg-gray-100 flex items-stretch h-screen" >
    <div class="w-11/12 md:w-4/5 mx-auto p-5 bg-white my-5 rounded border overflow-y-auto">{{ $slot ?? '' }}</div>
</body>

</html>