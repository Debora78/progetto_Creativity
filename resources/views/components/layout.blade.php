<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creativity</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playwrite+MX+Guides&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body>
    <x-navbar /> <!--richiamo il componente navbare -->

    <div class="min-vh-100">
        {{ $slot }}
    </div>

    <x-footer /> <!----richiamo il componente footer -->

    <script src="https://kit.fontawesome.com/09c4e03efc.js" crossorigin="anonymous"></script>

</body>

</html>
