<?php

  require_once './functions/database_handler.php';
  require_once './functions/game_functions.php';
  require_once './functions/page_security.php';

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $random_cocktail = get_random_cocktail();
  $elements = getall_elements();
  
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
        <?php
            foreach ($elements as $element) {
            echo '<div class="element">';
            echo '<button type="button" class="element-button" onclick="selectElement(\'' . $element['name'] . '\', \'' . $element['photo'] . '\')">';
            echo '<img src="' . $element['photo'] . '" alt="' . $element['name'] . '" style="width: 80%; height: auto;">';
            echo '</button>';
            echo '</div>';
            };
        ?>
        <div id="selected-element" style="margin-top: 20px;">
          <h3>Selected Element:</h3>
          <p id="selected-element-name">None</p>
          <img id="selected-element-photo" src="" alt="" style="width: 40%; height: auto; display: none;">
        </div>
        <script>
          function selectElement(name, photo) {
            document.getElementById('selected-element-name').innerText = name;
            var photoElement = document.getElementById('selected-element-photo');
            photoElement.src = photo;
            photoElement.style.display = 'block';
          }
        </script>
      </section>
      <section class="elements">
        <h2>ELEMENTS</h2>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="0" placeholder="mL">
        <div class="methods">
          <label><input type="radio" name="method" value="fill"> Fill</label>
          <label><input type="radio" name="method" value="top"> Top</label>
            <label>Dash 
            <button type="button" onclick="changeDash(-1)">-</button>
            <input type="number" id="dash-quantity" name="method" value="0" min="0">
            <button type="button" onclick="changeDash(1)">+</button>
            </label>
            <script>
            function changeDash(amount) {
            var input = document.getElementById('dash-quantity');
            var currentValue = parseInt(input.value);
            if (!isNaN(currentValue)) {
            input.value = Math.max(0, currentValue + amount);
            }
            }
            </script>
          <label>Barspoon 
          <button type="button" onclick="changeBarspoon(-1)">-</button>
          <input type="number" id="barspoon-quantity" name="method" value="0" min="0">
          <button type="button" onclick="changeBarspoon(1)">+</button>
          </label>
          <script>
          function changeBarspoon(amount) {
            var input = document.getElementById('barspoon-quantity');
            var currentValue = parseInt(input.value);
            if (!isNaN(currentValue)) {
            input.value = Math.max(0, currentValue + amount);
            }
          }
          </script>
        </div>
      </section>
      <section class="cocktail-options">
        <h2>COCKTAIL</h2>
        <div class="ice">
          <label> Icecube: <input type="radio" name="ice" value="yes">Yes</label>
          <label><input type="radio" name="ice" value="no"> No</label>
        </div>
        <div class="method">
          <label> Technique: <input type="radio" name="cocktail-method" value="shake"> Shake</label>
          <label><input type="radio" name="cocktail-method" value="shake-n-strain"> Shake n strain</label>
          <label><input type="radio" name="cocktail-method" value="build"> Build</label>
          <label><input type="radio" name="cocktail-method" value="fine-strain"> Shake n fine strain</label>
          <label><input type="radio" name="cocktail-method" value="fine-strain"> Shake n julep strain</label>
        </div>
        <div class="glass-type">
          <label> Glass: <input type="radio" name="glass-type" value="rocks"> Rocks</label>
          <label><input type="radio" name="glass-type" value="highball"> Highball</label>
          <label><input type="radio" name="glass-type" value="martini"> Martini</label>
          <label><input type="radio" name="glass-type" value="chilled-martini"> Chilled martini / Coupe</label>
        </div>
      </section>
    </main>
    <footer>
      <p>TUTO : <br> - For Elements part: click on the 1st element and fill the form, then submit and go to the 2nd... <br> - For Cocktail part: fill 1 time at the beginning (before Elements)</p>
    </footer>
  </div>
</body>
</html>
