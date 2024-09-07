<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<?php
session_start();
include('config.php');


if (isset($_GET['action']) && $_GET['action'] == "add") {
    $id = $_GET['id'];

    
    $query = "SELECT * FROM `prod` WHERE `id` = $id";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_array($result);

    if (isset($_SESSION['card'][$id])) {
        $_SESSION['card'][$id]['quantity'] += 1;
    } else {
        $_SESSION['card'][$id] = [
            "name" => $product['name'],
            "price" => $product['price'],
            "quantity" => 1
        ];
    }

    header("Location: card.php");
    exit;
}


if (isset($_GET['action']) && $_GET['action'] == "remove") {
    $id = $_GET['id'];
    unset($_SESSION['card'][$id]);
    header("Location: card.php");
    exit;
}

if (isset($_GET['action']) && $_GET['action'] == "clear") {
    unset($_SESSION['card']);
    header("Location: card.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card - Online Store</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Online Store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="card.php">Shopping Cart</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="container mt-5">
        <h2 class="text-center mb-4">Your Card</h2>

        <?php
        if (isset($_SESSION['card']) && !empty($_SESSION['card'])) {
            echo '
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';

            $total = 0;

            foreach ($_SESSION['card'] as $id => $product) {
                $total += $product['price'] * $product['quantity'];
                echo '
                <tr>
                    <td>' . $product['name'] . '</td>
                    <td>$' . $product['price'] . '</td>
                    <td>' . $product['quantity'] . '</td>
                    <td>$' . ($product['price'] * $product['quantity']) . '</td>
                    <td>
                        <a href="card.php?action=remove&id=' . $id . '" class="btn btn-danger">Remove</a>
                    </td>
                </tr>';
            }

            echo '
                <tr>
                    <td colspan="3" class="text-right">Total</td>
                    <td colspan="2">$' . $total . '</td>
                </tr>
                </tbody>
            </table>
            <a href="card.php?action=clear" class="btn btn-danger">Clear Card</a>';
        } else {
            echo '<p class="text-center">Your card is empty.</p>';
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>