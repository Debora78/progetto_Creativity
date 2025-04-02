<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- In questa vista non possiamo utilizzare i componenti e Bootstrap, possiamo solo inserire CSS e JS inline o embedded, quindi utilizziamo un semplice template HTML con del semplice testo per visualizzare le informazioni che l'utente ha inserito nel form --}}
    <h1>E' arrivata una richiesta per il ruolo di {{$info['role']}}</h1>
    <p>Ricevuta da {{$info['email']}}</p>
    <h4>Messaggio :</h4>
    <p>{{$info['message']}}</p>
</body>
</html>