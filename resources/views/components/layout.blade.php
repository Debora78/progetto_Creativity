<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creativity</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-navbar />  <!--richiamo il componente navbare -->

    <div class="min-vh-100">
        {{ $slot }}
    </div>

    <x-footer/> <!----richiamo il componente footer -->

    <script src="https://kit.fontawesome.com/09c4e03efc.js" crossorigin="anonymous"></script>

</body>
</html>