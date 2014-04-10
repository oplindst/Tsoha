<!DOCTYPE HTML>
<html>
    <head>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/bootstrap-theme.css" rel="stylesheet">
        <link href="../css/main.css" rel="stylesheet">
        <title>Pokemon-tietokanta</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>

        <?php
        /* HTML-rungon keskellä on sivun sisältö, 
         * joka haetaan sopivasta näkymätiedostosta.
         * Oikean näkymän tiedostonimi on tallennettu muuttujaan $sivu.
         */
        ?>

        <?php if (!empty($data->virhe)): ?>
        <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
        <?php endif; ?>

        <?php if (!empty($_SESSION['ilmoitus'])): ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['ilmoitus']; ?>
        </div>
        <?php unset($_SESSION['ilmoitus']); ?>
        <?php endif; ?>

        <?php if (!empty($data->virheet)): ?>
           <?php foreach($data->virheet as $key => $viesti): ?>
              <div class="alert alert-danger"><?php echo $viesti; ?></div>
           <?php endforeach; ?>
        <?php endif; ?>

        <?php require 'views/'.$sivu; ?>

    </body>
</html>

