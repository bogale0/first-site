<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
	die("Error: requets method is not post");
}
$name = htmlspecialchars($_POST["name"]);
$email = htmlspecialchars($_POST["email"]);
$password = htmlspecialchars($_POST["password"]);
if (htmlspecialchars($_POST["confirm-password"]) != $password) {
	die("Пароли не совпадают");
}
$password = password_hash($password, PASSWORD_BCRYPT);
$conn = new mysqli("localhost", "first_user", "g;bV$9LNq[Zo<.}tSrl|");
if ($conn->connect_error) {
	die("Error: connection failed");
}
$conn->query("use first_site");
if ($result = $conn->query("select count(*) as cnt from users where email = '$email'")) {
	$row = $result->fetch_assoc();
	if ($row["cnt"] != 0) {
		die("Существует пользователь с таким email");
	}
}
if ($conn->query("insert into users values (null, '$name', '$email', '$password')")) {
	echo "Успешная регистрация";
} else {
	die("Error: bad query");
}
?>