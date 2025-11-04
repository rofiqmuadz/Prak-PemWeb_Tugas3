<?php 

if(strtolower($_SERVER["REQUEST_METHOD"]) == "post") {
    require (__DIR__.'/db.php');

    $nim = $_POST["nim"];
    $nama = $_POST["nama"];
    $jk = $_POST["jenis_kelamin"];

    $sql = "INSERT INTO mahasiswa (nim, nama, jenis_kelamin) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nim, $nama, $jk);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Speda - Tambah Mahasiswa</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Speda</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link active" href="create.php">Tambah Mahasiswa</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <h4>Tambah Mahasiswa</h4>
  <form method="POST" action="create.php">
    <div class="mb-3">
      <label for="nim" class="form-label">NIM</label>
      <input id="nim" name="nim" type="text" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input id="nama" name="nama" type="text" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Jenis Kelamin</label><br>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="lk" name="jenis_kelamin" value="Laki Laki" required>
        <label class="form-check-label" for="lk">Laki Laki</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="pr" name="jenis_kelamin" value="Perempuan" required>
        <label class="form-check-label" for="pr">Perempuan</label>
      </div>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
