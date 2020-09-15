<?php
include "connect.php";
$conn = Connect::conectar();

$_POST = json_decode(file_get_contents("php://input"), true);

$option = (isset($_POST['option'])) ? $_POST['option']: "";

$id = (isset($_POST['id'])) ? $_POST['id']: "";
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre']: "";
$dueno = (isset($_POST['dueno'])) ? $_POST['dueno']: "";
$estado = (isset($_POST['estado'])) ? $_POST['estado']: "";

switch ($option) {
	//CREATE
	case 1:
		$sql = "INSERT INTO libros (nombre, dueno, estado) VALUES (:nombre, :dueno, :estado)";
		$query = $conn->prepare($sql);
		$query->bindValue(':nombre', $nombre);
		$query->bindValue(':dueno', $dueno);
		$query->bindValue(':estado', $estado);
		$query->execute();
		break;
	//READ
	case 2:
		$sql = "SELECT * FROM libros ORDER BY id ASC";
		$query = $conn->prepare($sql);
		$query->execute();
		$libros = $query->fetchAll(PDO::FETCH_ASSOC);
		break;
	//UPDATE
	case 3:
		$sql = "UPDATE libros SET nombre = :nombre, dueno = :dueno, estado = :estado WHERE id = :id";
		$query = $conn->prepare($sql);
		$query->bindValue(':nombre', $nombre);
		$query->bindValue(':dueno', $dueno);
		$query->bindValue(':estado', $estado);
		$query->bindValue(':id', $id);
		$query->execute();
		break;
	//DELETE
	case 4:
		$sql = "DELETE FROM libros WHERE id = :id";
		$query = $conn->prepare($sql);
		$query->bindValue(':id', $id);
		$query->execute();
		break;
	//SEARCH
	case 5:
		$sql = "SELECT * FROM libros WHERE nombre LIKE '%' :nombre '%'";
		$query = $conn->prepare($sql);
		$query->bindValue(':nombre', $nombre);
		$query->execute();
		$libros = $query->fetchAll(PDO::FETCH_ASSOC);
		break;

}

print json_encode($libros, JSON_UNESCAPED_UNICODE);
$conn = NULL;