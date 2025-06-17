<?php
require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../app/Topup.php';

$database = new Database();
$db = $database->dbConnection();

$topup = new Topup($db);

// Cek jika parameter id ada pada URL
if(isset($_GET['id'])){
    $topup->id = $_GET['id'];

    if($topup->delete()){
        header("Location: index.php");
    }else{
        echo "Gagal menghapus kartu.";
    }
}

// Tampilkan data dari method index
$data = $topup->index();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kartu</title>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Daftar Kartu</h1>
        <a href="create.php" class="btn btn-primary mb-3">Tambah</a>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Game ID</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Topup Date</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(!empty($data)) {
                    $no = 1;
                    foreach($data as $row) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['game_id']; ?></td>
                            <td><?php echo $row['amount']; ?></td>
                            <td><?php echo $row['topup_date']; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="index.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kartu ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php } 
                } else {
                    echo "<tr><td colspan='6'>Tidak ada data yang tersedia</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
