<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">

  <style>

    body {
      font-family: Comic Sans MS, arial;
      font-size: 1.2em;
      background-color: cornsilk
    }

  </style>

</head>

<body>
  <h2>Prise de contact sur mon beau site</h2>
  <p>Réception d'une prise de contact avec les éléments suivants :</p>
  <ul>
    <li><strong>Nom</strong> : {{ $contact['nom'] }}</li>
    <li><strong>Email</strong> : {{ $contact['email'] }}</li>
    <li><strong>Message</strong> : {{ $contact['message'] }}</li>
  </ul>

</body>
</html>