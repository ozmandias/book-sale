<?php
    include './programming/admin/connection.php';
    include './programming/admin/admin_controller.php';
    if(isset($_GET['action']) && $_GET['action']=='delete')
    {
        delauthor();
    }
    if(isset($_POST['btnupauthor']))
    {
        updateauthor();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author</title>
    <link rel="stylesheet" href="./css/author.css" />

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

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6">
                <h3>
                    Author <span style="color: #757575;">DATA</span>
                </h3>
            </div>
            <div class="col-md-6">
                <a href="./dashboard.php" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover me-2">Dashboard</a>
            </div>
        </div>
        <?php
        if(isset($_POST['btnaddauthor']))
        {
            //function call
            addauthor();
        }
        ?>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-center text-white">New Author Form</div>
                    <div class="card-body">
                        <form action="" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Author Name</label>
                            <input type="text" name="authorname" id="" class="form-control">
                        </div>
                        <div class="d-grid">
                            <input type="submit" value="Add Author" name="btnaddauthor" class="btn btn-outline-info">
                        </div>
                        </form>
                    </div>
                </div>
                <hr>
                <?php
                if(isset($_GET['action'])&&$_GET['action']=='edit')
                {
                    $authorid=$_GET['aid'];
                    $query="Select * from author where id='$authorid'";
                    $go_query=mysqli_query($connection,$query);
                    while($row=mysqli_fetch_array($go_query))
                    {
                        $authorname=$row['author_name'];
                    
                ?>
                <!-- Update Category Form Start -->
                <div class="card">
                    <div class="card-header bg-info text-center text-white">Update Author Form</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="" class="form-label">Author Name</label>
                                <input type="text" name="updateauthorname" id="" class="form-control" value="<?php echo $authorname ?>">
                            </div>
                            <div class="d-grid">
                                <input type="submit" value="Update Author" name="btnupauthor" class="btn btn-outline-info">
                            </div>
                        </form>
                    </div>
                </div>
            <!-- Update Category Form End  -->
            <?php
                    }
                }
            ?>
            </div>
            <div class="col-md-6">
                <table class="table table-stripe table-info">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        $query="Select * from author";
                        $go_query=mysqli_query($connection,$query);
                        while($row=mysqli_fetch_array($go_query))
                        {
                            $aut_id=$row['id'];
                            $aut_name=$row['author_name'];
                            echo"<tr>";
                            echo"<td>{$aut_id}</td>";//1
                            echo"<td>{$aut_name}</td>";//
                            echo"<td>
                                <a href='author.php?action=delete&aid={$aut_id}' class='btn btn-outline-danger btn-sm'>X</a>
                                <a href='author.php?action=edit&aid={$aut_id}' class='btn btn-outline-primary btn-sm'>Edit</a>
                            </td>";
                            echo"</tr>";
                        }
                        ?>
                    <!-- Dynamic Data 
                    <tr>
                        <td>1</td>
                        <td>Computer</td>
                        <td>X</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Phone</td>
                        <td>X</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Accessories</td>
                        <td>X</td>
                    </tr>
                    -->
                </table>
            </div>
        </div>
    </div>
</body>
</html>