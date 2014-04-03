<?php
  require_once 'libs/functions.php';
  
    if ($_SESSION['kirjautunut']) {
        header('Location: etusivu.php');
    }

  naytaNakyma('login.php');