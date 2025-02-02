<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
	die("Error: requets method is not post");
}
$email = htmlspecialchars($_POST["email"]);
$password = htmlspecialchars($_POST["password"]);
$conn = new mysqli("localhost", "first_user", "g;bV$9LNq[Zo<.}tSrl|");
if ($conn->connect_error) {
	die("Error: connection failed");
}
$conn->query("use first_site");
if ($result = $conn->query("select name, password from users where email = '$email'")) {
	$row = $result->fetch_assoc();
	if (password_verify($password, $row["password"])) {
		$name = $row["name"];
		echo "Здравствуйте, $name! Вы успешно вошли";
	} else {
		echo "Неправильный пароль или email";
	}
}
?>