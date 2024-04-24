  <?php
   require "init.php";
   
   $smerovac = new SmerovacKontroler();
   $smerovac->zpracuj(array($_SERVER["REQUEST_URI"]));
   $smerovac->vypisPohled();
?>