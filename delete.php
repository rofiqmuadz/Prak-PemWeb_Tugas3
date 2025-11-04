<?php 

require_once(__DIR__."/db.php");

$id = $_GET['id'];

$sql = "DELETE FROM mahasiswa WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

$stmt->execute();
$stmt->close();
$conn->close();

header("Location: index.php");
exit;
?>
