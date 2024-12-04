<?php

  require_once './functions/database_handler.php';
  require_once './functions/game_functions.php';
  require_once './functions/page_security.php';

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $random_cocktail = get_random_cocktail();
?>

<!-- Merci ChatGPT -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cocktail Builder</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <header>
      <h1>Cocktail name</h1>
      <button id="generate-button">Generate new</button>
    </header>
    <main>
      <section class="ingredients-grid">
        <button>Rhum</button>
        <button>Vodka</button>
        <button>Coca Cola</button>
        <button>Orange juice</button>
        <button>Strawberry syrup</button>
        <!-- Repeat the above buttons to match the layout -->
        <!-- Use JavaScript to dynamically generate these if needed -->
      </section>
      <section class="elements">
        <h2>ELEMENTS</h2>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="0" placeholder="mL">
        <div class="methods">
          <label><input type="radio" name="method" value="fill"> Fill</label>
          <label><input type="radio" name="method" value="top"> Top</label>
          <label><input type="radio" name="method" value="sink"> Sink</label>
        </div>
      </section>
      <section class="cocktail-options">
        <h2>COCKTAIL</h2>
        <div class="ice">
          <label><input type="radio" name="ice" value="yes"> Icecube? Yes</label>
          <label><input type="radio" name="ice" value="no"> No</label>
        </div>
        <div class="method">
          <label><input type="radio" name="cocktail-method" value="shake"> Shake</label>
          <label><input type="radio" name="cocktail-method" value="shake-n-strain"> Shake n strain</label>
          <label><input type="radio" name="cocktail-method" value="build"> Build</label>
          <label><input type="radio" name="cocktail-method" value="fine-strain"> Shake n fine strain</label>
        </div>
        <div class="glass-type">
          <label><input type="radio" name="glass-type" value="rocks"> Rocks</label>
          <label><input type="radio" name="glass-type" value="highball"> Highball</label>
          <label><input type="radio" name="glass-type" value="martini"> Martini</label>
          <label><input type="radio" name="glass-type" value="chilled-martini"> Chilled martini</label>
        </div>
      </section>
    </main>
    <footer>
      <p>TUTO : <br> - For Elements part: click on the 1st element and fill the form, then submit and go to the 2nd... <br> - For Cocktail part: fill 1 time at the beginning (before Elements)</p>
    </footer>
  </div>
</body>
</html>
