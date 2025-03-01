<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include './programming/feedback/connection.php';
require_once './programming/feedback/feedback_controller.php';

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete' && isset($_GET['fid'])) {
        delfeedback($_GET['fid']);
    } elseif ($_GET['action'] == 'edit' && isset($_GET['fid'])) {
        $fid = intval($_GET['fid']);
        $query = "SELECT * FROM feedback WHERE id = $fid";
        $go_query = mysqli_query($connection, $query);
        $feedback = mysqli_fetch_assoc($go_query);
    }
}

// Handle adding feedback
if (isset($_POST['add_feedback'])) {
    addfeedback();
}

// Handle updating feedback
if (isset($_POST['update_feedback'])) {
    updatefeedback();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Feedback</title>

    <style>
        body {
            background-color: #ADD8E6;
            color: white;
        }
        .container {
            max-width: 1680px;
            height: 100vh;
        }
        .card {
            background-color: white;
        }
        .table {
            background-color: white;
        }
        .table td, .table th {
            color: black;
        }
        .table th {
            background-color: #0056b3;
            color: white;
        }
        .navbar {
            background-color: #f3f2ec;
            padding-left: 4rem;
            padding-right: 4rem;
        }
        ul.navbar-nav.mx-auto.mb-2.mb-lg-0 {
            margin-right: 10% !important;
        }
        .nav-item {
            padding-left: 20px;
            font-size: 18px;
            font-weight: 600;
        }
        
        .nav-link {
            color: #fff;
            font-size: 18px;
        }
        
        .nav-link.active,
        .nav-link:hover {
            color: #47b2e4 !important;
        }

        .btn-primary{
            background-color: #47b2e4 !important;
            border-color: #47b2e4 !important;
        }

        .add-book-btn, .add-user-btn{
            box-shadow: 0 3px 8px black;
        }
    </style>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
</head>
<body>
    <nav class="navbar navbar-expand-lg pt-3 pb-3">
        <div class="container-fluid ms-4">
            <a class="logo" href="#">
                <div class="col-md-2">
                    <div class="main-logo">
                        <a href="index.php"><img src="images/B.png" alt="logo"></a>
                    </div>
                </div>
            </a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="./index.php"
                    >Home</a
                >
                </li>
                <li class="nav-item">
                <a class="nav-link" href="./book.php">Books</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="./user.php">Users</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="./order.php">Orders</a>
                </li>

                <li class="nav-item">
                <a class="nav-link" href="./logout.php"
                    ><i class="bi bi-person-fill"></i>Log Out</a
                >
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="m-5">
            <div class=" d-flex justify-content-end me-5">
                <div class="btns">
                    <a href="./dashboard.php" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover me-2">Dashboard</a>
                    <a href="./book.php" class="btn add-book-btn btn-primary me-2">
                    <i class="bi bi-book pe-2"></i>Books
                    </a>
                    <a href="./user.php" class="btn add-user-btn btn-primary me-2">
                    <i class="bi bi-person-lines-fill pe-2"></i>Users
                    </a>
                    <a href="./order.php" class="btn add-user-btn btn-primary">
                    <i class="bi bi-box-seam pe-2"></i>Orders
                    </a>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center text-white" style="background-color: #17A2B8;">
                        <h4>Customer Feedback</h4>
                    </div>
                    <div class="card-body">
                        <!-- Feedback Form -->
                        <form method="POST" action="feedback.php">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" 
                                    value="<?php echo isset($feedback) ? htmlspecialchars($feedback['name']) : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email"
                                    value="<?php echo isset($feedback) ? htmlspecialchars($feedback['email']) : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone"
                                    value="<?php echo isset($feedback) ? htmlspecialchars($feedback['phone']) : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <textarea class="form-control" name="message" required><?php echo isset($feedback) ? htmlspecialchars($feedback['message']) : ''; ?></textarea>
                            </div>
                            <?php if (isset($feedback)) { ?>
                                <input type="hidden" name="fid" value="<?php echo $feedback['id']; ?>">
                                <button type="submit" name="update_feedback" class="btn btn-warning">Update Feedback</button>
                            <?php } else { ?>
                                <button type="submit" name="add_feedback" class="btn btn-success">Submit Feedback</button>
                            <?php } ?>
                        </form>

                        <!-- Feedback List -->
                        <table class="table table-striped table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Message</th>
                                    <th>Order ID</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM feedback ORDER BY id ASC";
                                $go_query = mysqli_query($connection, $query);

                                while ($row = mysqli_fetch_assoc($go_query)) {
                                    echo "<tr>";
                                    echo "<td>{$row['id']}</td>";
                                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['order_id']) . "</td>";
                                    echo "<td>
                                            <a href='feedback.php?action=edit&fid={$row['id']}' class='btn btn-outline-primary btn-sm'>Edit</a>
                                            <a href='feedback.php?action=delete&fid={$row['id']}' class='btn btn-outline-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                        </td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>