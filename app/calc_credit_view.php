<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Kalkulator</title>
</head>
<body>

<form action="<?php print(_APP_URL);?>/app/calc_credit.php" method="post">
	<label for="id_x">Kwota </label>
	<input id="id_x" type="text" name="x" value="<?php if (isset($x)) print($x); ?>" /><br />
	<label for="id_op">Miesiące </label>
	<input id="id_x" type="text" name="y" value="<?php if (isset($y)) print($y); ?>" /><br />
	<label for="id_y">Oprocentowanie </label>
	<input id="id_y" type="text" name="z" value="<?php if (isset($z)) print($z); ?>" /><br />
	<input type="submit" value="Oblicz" />
</form>	

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	if (count ( $messages ) > 0) {
		echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:400px;">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($result)){ ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:400px;">
<?php echo 'Miesięczna rata: '.$result; ?>
</div>
<?php } ?>

</body>
</html>