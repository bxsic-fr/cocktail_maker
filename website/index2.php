<?php

  require_once './functions/database_handler.php';
  require_once './functions/game_functions.php';
  require_once './functions/page_security.php';

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  if (isset($_COOKIE["cocktail_id"])) {
	$random_cocktail = get_cocktail_by_id($_COOKIE["cocktail_id"]);
  } else {
	$random_cocktail = get_random_cocktail();
	setcookie("cocktail_id", $random_cocktail["id"], time() + 3600);
  }
  $elements = getall_elements();

  if (isset($_GET['new']) && $_GET['new'] === '1') {
	$random_cocktail = get_random_cocktail();
	setcookie("cocktail_id", $random_cocktail["id"], time() + 3600);
	
	header('Location: index2.php');
}

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
	<section class="container">
		<header>
			<h1 class="cocktail-name"><?php echo $random_cocktail['name'] ?></h1> 
			<form action="index2.php?new=1" method="GET">
				<input type="hidden" name="new" value="1">
				<button type="submit">Generate new cocktail</button>
			</form>
		</header>
		<!-- Un nom de cocktail aléatoire est généré avec ses infos
		On va commencer par demander à l'utilisateur de choisir le type de verre (Highball, Rocks...) ainsi qu'une technique (Shake and strain, Build...) -->
		<!-- Une fois validé par une fonction en regardant dans $random_cocktail['addons'] si le type de verre et la technique sont présents, on affiche les ingrédients -->
		<!-- On affiche les ingrédients avec un input pour la quantité, un select pour les unités (cl, oz, dash, barspoon) et un choix pour les "fill" et "top" -->
		<?php if (!isset($_GET['step'])): ?>
		<section class="tech_n_glass-grid">
			<form action="index2.php" method="POST">
				<!-- Deux selects pour le type de verre et la technique -->
				<input type="hidden" name="cocktail_id" value="<?php echo $random_cocktail['id'] ?>">
				<input type="hidden" name="step" value="tech_n_glass">
				<select name="glass">
					<option value="Highball">Highball</option>
					<option value="Rocks">Rocks</option>
					<option value="Highball or Copper Mug">Highball or Copper Mug</option>
					<option value="Chilled martini / Coupe">Chilled martini / Coupe</option>
				</select>
				<select name="technique">
					<option value="Shake & Strain">Shake & Strain</option>
					<option value="Shake & Fine Strain">Shake & Fine Strain</option>
					<option value="Build">Build</option>
					<option value="Stir">Build & Stir</option>
					<option value="Stir & Julep Strain">Stir & Julep Strain</option>
				</select>
				<select name="icecube">
					<option value="no">No icecube</option>
					<option value="yes">Icecube</option>
				</select>
				<button type="submit">Submit</button>
			</form>
		</section>
		<?php endif; ?>

		<?php 
			if (isset($_POST['step']) && $_POST['step'] === 'tech_n_glass') {
				$glass = $_POST['glass'];
				$technique = $_POST['technique'];
				print_r($_POST);
				$icecube = $_POST['icecube'];
				# addons (db) = {"icecube":0,"glass":"Chilled martini / Coupe", "technique": "Stir & Julep Strain", "decoration": "Olive/Lemon zest"}
				$addons = $random_cocktail['addons'];
				$glass_validated = false;
				$technique_validated = false;
				$addons = json_decode($addons, true);
				if ($addons['glass'] == $glass) {
					$glass_validated = true;
				}
				if ($addons['technique'] == $technique) {
					$technique_validated = true;
				}
				if (isset($addons["icecube"])) {
					if ($addons['icecube'] == $icecube)
					{
						$icecube_validated = true;
					} else {
						$icecube_validated = false;
					}
				} else {
					$icecube_validated = true;
				}
				if ($glass_validated && $technique_validated && $icecube_validated) {
					
					header('Location: index2.php?step=elements_add&stepid=0&cocktail=' . $random_cocktail['id']);
				} else {
					echo '<p>Invalid glass or technique</p>';
					header('refresh:4;url=index2.php?new=1');
				}
			}

			?>

		<?php if (isset($_GET['step']) && ($_GET['step'] === 'elements_add')): ?>
			<section class="ingredients-grid">
				<?php
					foreach ($elements as $element) {
					echo '<div class="element">';
					echo '<button type="button" class="element-button" onclick="selectElement(\'' . $element['name'] . '\', \'' . $element['photo'] . '\')">';
					echo '<img class="elemtn-image" src="' . $element['photo'] . '" alt="' . $element['name'] . '" >';
					echo '</button>';
					echo '</div>';
					};
				?>
			</section>
			<section class="selected-elements">
				<h2>Selected elements</h2>
				<div class="selected-elements-grid">
					<div class="selected-element">
						<img src="" alt="" id="selected-element-photo" class="selected-element-photo">
						<p id="selected-element-name"></p>
					</div>
				</div>
				<script>
					function selectElement(name, photo) {
						document.getElementById('selected-element-name').innerText = name;
						document.getElementById('selected-element-input').value = name;
						var photoElement = document.getElementById('selected-element-photo');
						photoElement.src = photo;
						photoElement.style.display = 'block';
					}
				</script>
				<form action="index2.php" method="POST">
					<input type="hidden" name="step" value="elements_add">
					<input type="hidden" name="cocktail_id" value="<?php echo $random_cocktail['id'] ?>">
					<input type="hidden" name="stepid" value="<?php echo $_GET['stepid'] ?>">
					<input name="chosen_element" id="selected-element-input" type="hidden" required>
					<p>You can write 0 as quantity for "fill" and "top" method</p>
					<label>Quantity</label>
					<input type="number" name="quantity" min="0" placeholder="0 mL/Dash/Barspoon"></br></br>
					<label>Method</label>
					<select name="method">
						<option value="0">Select method</option>
						<option value="fill">Fill</option>
						<option value="top">Top</option>
						<option value="dash">Dash</option>
						<option value="fill equal parts">Fill equal parts</option>
						<option value="barspoon">Barspoon</option>
					</select>
					<button type="submit">Submit</button>
				</form>
		<?php endif; ?>

		<!-- Si post + elements_add + stepid... : StepID = proccess[StepID] (où on en est dans le cocktail)
		 On va vérifier l'élement, la quantité et la méthode. Si c'est bon, si proccess[StepID+1] existe on redirige vers index2.php?step=elements_add&stepid={stepID}&cocktail=' . $random_cocktail['id']) sinon on renvoie bravo -->

		<?php
			if (isset($_POST['step']) && $_POST['step'] === 'elements_add') {
				$chosen_element = $_POST['chosen_element'];
				$user_quantity = $_POST['quantity'];
				$user_method = $_POST['method'];
				$stepid = $_POST['stepid'];
				$proccess = $random_cocktail['process'];
				$proccess = json_decode($proccess, true);
				$element_validated = false;
				$quantity_validated = false;
				$method_validated = false;
				$element = $proccess[$stepid][0];
				if ($element == 'dashes') {
					$element = 'dash';
				}
				$quantity = $proccess[$stepid][1];
				$method = $proccess[$stepid][2];
				if ($user_method == '') {
					$user_method = '0';
				}
				if ($user_quantity == '') {
					$user_quantity = '0';
				}
				if (strtolower($element) == strtolower($chosen_element)) {
					$element_validated = true;
				}
				if ($quantity === $user_quantity) {
					$quantity_validated = true;
				}
				if (strtolower($method) == strtolower($user_method)) {
					$method_validated = true;
				}
				if ($element_validated && $quantity_validated && $method_validated) {
					if (isset($proccess[$stepid +1])) {
						header('Location: index2.php?step=elements_add&stepid=' . $stepid+1 . '&cocktail=' . $random_cocktail['id']);
					} else {
						echo '<p>Congratulations, you have successfully built the cocktail</p>';
						header('refresh:4;url=index2.php?new=1');
					}
				} else {
					echo '<p>Invalid element, quantity or method</p> Element: ' . $element . ' Quantity: ' . $quantity . ' Method: ' . $method . ' User Element: ' . $chosen_element . ' User Quantity: ' . $user_quantity . ' User Method: ' . $user_method;
					header('refresh:4;url=index2.php?new=1');
				}
			}
		?>


	</section>
</body>
</html>