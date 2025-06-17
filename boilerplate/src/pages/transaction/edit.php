<?php

require_once __DIR__ . '/../../../config/Database.php';
require_once __DIR__ . '/../../../app/Transaction.php';

$database = new Database();
$db = $database->dbConnection();

$transaksi = new Transaction($db);

if(isset($_POST['update'])) {
    $transaksi->id = $_POST['id'];
    $transaksi->user_id = $_POST['user_id'];
    $transaksi->game_id = $_POST['game_id'];
    $transaksi->amount = $_POST['amount'];
    $transaksi->transaction_date = $_POST['transaction_date'];

    if ($transaksi->update()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal mengupdate data!";
        exit;
    }
} elseif(isset($_GET['id'])) {
    $transaksi->id = $_GET['id'];
    $stmt = $transaksi->edit();
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
                <input type="number" name="user_id" class="form-control" value="<?php echo $user_id; ?>" required>
            </div>
            <div class="form-group">
                <label for="game_id">Game ID:</label>
                <input type="number" name="game_id" class="form-control" value="<?php echo $game_id; ?>" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" name="amount" class="form-control" value="<?php echo $amount; ?>" required>
            </div>
            <div class="form-group">
                <label for="transaction_date">Transaction Date:</label>
                <input type="date" name="transaction_date" class="form-control" value="<?php echo $transaction_date; ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
