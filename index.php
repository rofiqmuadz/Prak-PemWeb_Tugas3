<?php 
require (__DIR__.'/db.php');?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Speda</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Speda</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="create.php">Tambah Mahasiswa</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <h4>Daftar Mahasiswa</h4>

  <form class="input-group mb-3" method="GET" action="index.php">
    <input type="text" name="cari" class="form-control"
      placeholder="Cari Mahasiswa..." autocomplete="off"
      value="<?= $_GET['cari'] ?? '' ?>">
    <button class="btn btn-outline-secondary" type="submit">Cari</button>
  </form>

  <table class="table table-dark table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
<?php
$no = 1;
$cari = $_GET['cari'] ?? "";

$sql = "SELECT * FROM mahasiswa";
if ($cari !== "") {
    $sql .= " WHERE nama LIKE '%$cari%'";
}
$sql .= " ORDER BY id ASC";

$res = mysqli_query($conn, $sql);

if (!$res || mysqli_num_rows($res) == 0) {
    echo "<tr><td colspan='5' class='text-center'>Tidak ada data.</td></tr>";
} else {
    while ($row = mysqli_fetch_assoc($res)) {
        $id = $row['id'];
        $nim = $row['nim'];
        $nama = $row['nama'];
        $jk = $row['jenis_kelamin'];

        echo "
        <tr>
          <td>{$no}</td>
          <td>{$nim}</td>
          <td>{$nama}</td>
          <td>{$jk}</td>
          <td>
            <a href='update.php?id={$id}' class='btn btn-primary btn-sm'>Update</a>
            <button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteModal{$id}'>Delete</button>
          </td>
        </tr>

        <div class='modal fade' id='deleteModal{$id}' tabindex='-1'>
          <div class='modal-dialog'>
            <div class='modal-content'>
              <div class='modal-header'>
                <h5 class='modal-title'>Hapus Data</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
              </div>
              <div class='modal-body'>
                Yakin ingin menghapus <b>{$nama}</b>?
              </div>
              <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Batal</button>
                <a href='delete.php?id={$id}' class='btn btn-danger'>Hapus</a>
              </div>
            </div>
          </div>
        </div>";
        $no++;
    }
}
?>
    </tbody>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
