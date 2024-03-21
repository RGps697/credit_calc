<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// 1. pobranie parametrów

$x = $_REQUEST ['x'];
$y = $_REQUEST ['y'];
$z = $_REQUEST ['z'];

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

// sprawdzenie, czy parametry zostały przekazane
if ( ! (isset($x) && isset($y) && isset($z))) {
	//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
	$messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

// sprawdzenie, czy potrzebne wartości zostały przekazane
if ( $x == "") {
	$messages [] = 'Nie podano kwoty';
}
if ( $y == "") {
	$messages [] = 'Nie podano miesięcy';
}
if ( $z == "") {
	$messages [] = 'Nie podano oprocentowania';
}

$x = intval($x);
$y = intval($y);
$z = intval($z);

if ( $x <= 0) {
	$messages [] = 'Wartość kwoty musi być większa od 0';
}
if ( $y <= 0) {
	$messages [] = 'Wartość miesięcy musi być większa od 0';
}
if ( $z <= 0) {
	$messages [] = 'Wartość oprocentowania musi być większa od 0';
}

// 3. wykonaj zadanie jeśli wszystko w porządku

if (empty ( $messages )) { // gdy brak błędów
		
	$result = ($x / $y) * (1 + ($z / 100));
}

// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$x,$y,$operation,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_credit_view.php';