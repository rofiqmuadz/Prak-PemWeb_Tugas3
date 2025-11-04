<?php
require_once(__DIR__ . "/db.php");


$id = $_GET['id'] ?? '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim  = $_POST['nim'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $jk   = $_POST['jenis_kelamin'] ?? '';

    $sql = "UPDATE mahasiswa SET nim = ?, nama = ?, jenis_kelamin = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nim, $nama, $jk, $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: index.php");
    exit;
}

    $sql = "SELECT id, nim, nama, jenis_kelamin FROM mahasiswa WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Update Mahasiswa</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Speda</a>
  </div>
</nav>

<div class="container mt-4">
  <h4>Update Mahasiswa</h4>
  <form method="POST" action="update.php?id=<?= ($row['id']); ?>">
    <div class="mb-3">
      <label class="form-label">NIM</label>
      <input type="text" name="nim" class="form-control" value="<?= ($row['nim']); ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input type="text" name="nama" class="form-control" value="<?= ($row['nama']); ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Jenis Kelamin</label><br>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki Laki"
          <?= $row['jenis_kelamin'] == 'Laki Laki' ? 'checked' : ''; ?>>
        <label class="form-check-label">Laki Laki</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan"
          <?= $row['jenis_kelamin'] == 'Perempuan' ? 'checked' : ''; ?>>
        <label class="form-check-label">Perempuan</label>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
