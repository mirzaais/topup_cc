<?php
require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../app/Topup.php';


$database = new Database();
$db = $database->dbConnection();

$topup = new Topup($db);

if(isset($_POST['update'])) {
    $topup->id = $_POST['id'];
    $topup->user_id = $_POST['user_id'];
    $topup->game_id = $_POST['game_id'];
    $topup->amount = $_POST['amount'];
    $topup->topup_date = $_POST['topup_date'];

    if ($topup->update()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal mengupdate data!";
        exit;
    }
} elseif(isset($_GET['id'])) {
    $topup->id = $_GET['id'];
    $stmt = $topup->edit();
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
                <label for="user_id">User ID:</label>
                <input type="text" name="user_id" class="form-control" value="<?php echo $user_id; ?>" required>
            </div>
            <div class="form-group">
                <label for="game_id">Game ID:</label>
                <input type="text" name="game_id" class="form-control" value="<?php echo $game_id; ?>" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" name="amount" class="form-control" value="<?php echo $amount; ?>" required>
            </div>
            <div class="form-group">
                <label for="topup_date">Topup Date:</label>
                <input type="date" name="topup_date" class="form-control" value="<?php echo $topup_date; ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
