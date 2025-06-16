<?php
require_once '../../../config/Database.php';
require_once '../../../app/Games.php';

$database = new Database();
$db = $database->dbConnection();

$games = new Games($db);

if(isset($_POST['update'])) {
    $games->id = $_POST['id'];
    $games->name = $_POST['name'];
    $games->platform = $_POST['platform'];

    if ($games->update()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal mengupdate data!";
        exit;
    }
} elseif(isset($_GET['id'])) {
    $games->id = $_GET['id'];
    $stmt = $games->edit();
    $num = $stmt->rowCount();

    if($num > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Data</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Data</h1>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required>
            </div>
            <div class="form-group">
                <label for="platform">Platform:</label>
                <input type="text" name="platform" class="form-control" value="<?php echo $platform; ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
