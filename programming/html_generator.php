<?php
    include "./programming/author/author_controller.php";

    function HTML($type, $data = null) {
        if($type == "user_add") {
            echo "<div class='details w-100'>";

            echo "<form action='' method='POST'>";
            echo "<input name='id' type='text' class='form-control' id='id' placeholder='id' value='' hidden>";

            echo "<div class='mb-3'>";
            echo "<label for='username' class='form-label'>Username</label>";
            echo "<input name='username' type='username' class='form-control' id='username' placeholder='name' value=''>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='email' class='form-label'>Email address</label>";
            echo "<input name='email' type='email' class='form-control' id='email' placeholder='name@example.com' value=''>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='password' class='form-label'>Password</label>";
            echo "<input name='password' type='password' class='form-control' id='password' placeholder='password' value=''>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='gender'>Gender</label>";
            echo "<select name='gender' id='gender' class='form-select' aria-label='Default select example'>";
                echo "<option selected disabled>Choose gender...</option>";
                echo "<option value='Male'>Male</option>";
                echo "<option value='Female'>Female</option>";
            echo "</select>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='user_type'>User Type</label>";
            echo "<select name='user_type' id='user_type' class='form-select' aria-label='Default select example'>";
                echo "<option selected disabled>Choose user type...</option>";
                echo "<option value='Admin'>Admin</option>";
                echo "<option value='User'>User</option>";
            echo "</select>";
            echo "</div>";
            
            echo "<div class='d-flex col-4 mt-3'>";
            echo "<button class='btn btn-success w-50 mx-1' type='submit' name='btn_add_user'>Save</button>";
            echo "<a class='btn btn-outline-dark w-50 mx-1' href='./user.php'>Cancel</a>";
            echo "</div>";

            echo "</form>";

            echo "</div>";
        }

        else if($type == "user_edit") {
            echo "<div class='details w-100'>";

            echo "<form action='' method='POST'>";
            echo "<input name='id' type='text' class='form-control' id='id' placeholder='id' value='{$data['id']}' hidden>";

            echo "<div class='mb-3'>";
            echo "<label for='username' class='form-label'>Username</label>";
            echo "<input name='username' type='username' class='form-control' id='username' placeholder='name' value='{$data['username']}'>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='email' class='form-label'>Email address</label>";
            echo "<input name='email' type='email' class='form-control' id='email' placeholder='name@example.com' value='{$data['email']}'>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='password' class='form-label'>Password</label>";
            echo "<input name='password' type='password' class='form-control' id='password' placeholder='password' value='{$data['password']}'>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='gender'>Gender</label>";
            echo "<select name='gender' id='gender' class='form-select' aria-label='Default select example'>";
            echo "<option disabled>Choose gender...</option>";
            if($data["gender"] == "Male") {
                echo "<option value='Male' selected>Male</option>";
                echo "<option value='Female'>Female</option>";
            } else if($data["gender"] == "Female") {
                echo "<option value='Male'>Male</option>";
                echo "<option value='Female' selected>Female</option>";
            }
            echo "</select>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='user_type'>User Type</label>";
            echo "<select name='user_type' id='user_type' class='form-select' aria-label='Default select example'>";
            echo "<option disabled>Choose user type...</option>";
            if($data["user_type"] == "Admin") {
                echo "<option value='Admin' selected>Admin</option>";
                echo "<option value='User'>User</option>";
            } else if($data["user_type"] == "User") {
                echo "<option value='Admin'>Admin</option>";
                echo "<option value='User' selected>User</option>";
            }
            echo "</select>";
            echo "</div>";
            
            echo "<div class='d-flex col-4 mt-3'>";
            echo "<button class='btn btn-success w-50 mx-1' type='submit' name='btn_update_user'>Save</button>";
            echo "<a class='btn btn-outline-dark w-50 mx-1' href='./user.php'>Cancel</a>";
            echo "</div>";

            echo "</form>";

            echo "</div>";
        }

        else if($type == "user_list") {
            session_start();
            $current_id = $_SESSION['id'];
            $current_username = $_SESSION['username'];
            $current_email = $_SESSION['email'];

            echo "<tr>";
            echo "<th scope='row'>{$data['id']}</th>";
            echo "<td>{$data['username']}</td>";
            echo "<td>{$data['email']}</td>";
            echo "<td>{$data['password']}</td>";
            echo "<td>{$data['birthdate']}</td>";
            echo "<td>{$data['gender']}</td>";
            echo "<td>{$data['user_type']}</td>";
            echo "<td class='edit-btn'><button onclick='edit_user({$data['id']})'><i class='bi bi-pencil-fill'></i></button></td>";
            if($data["id"] != $current_id && $data["username"] != $current_username && $data["email"] != $current_email) {
                echo "<td class='del-btn'><button onclick='delete_user({$data['id']})'><i class='bi bi-trash-fill px-2'></i></button></td>";
            } else {
                echo "<td></td>";
            }
            echo "</tr>";
        }

        else if($type == "book_add") {
            $data['authors'] = get_authors();

            echo "<img src='data:image;base64,".base64_encode(null)."' alt='Book Cover' class='detail-image'>";
            
            echo "<div class='details'>";

            echo "<form action='' method='POST' enctype='multipart/form-data'>";
            echo "<input name='id' type='text' class='form-control' id='id' placeholder='id' value='' hidden>";

            echo "<div class='mb-3'>";
            echo "<label for='title' class='form-label'>Title</label>";
            echo "<input name='title' type='text' class='form-control' id='title' placeholder='title' value=''>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='description' class='form-label'>Description</label>";
            echo "<textarea name='description' type='text' class='form-control' id='description' placeholder='description' value=''></textarea>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='cover_image' class='form-label'>Cover Image</label>";
            echo "<input name='cover_image' type='file' class='form-control' id='cover_image'>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='author' class='form-label'>Author</label>";
            echo "<select name='author' id='author' class='form-select' aria-label='Default select example'>";
                echo "<option selected disabled>Choose author...</option>";
                foreach($data["authors"] as $author) {
                    echo "<option value='{$author['id']}'>{$author['author_name']}</option>";
                }
            echo "</select>";
            echo "</div>";


            echo "<div class='mb-3'>";
            echo "<label for='price' class='form-label'>Price</label>";
            echo "<input name='price' type='text' class='form-control' id='price' placeholder='price' value=''>";
            echo "</div>";

            echo "<label for='stock'>Quantity</label>";
            echo "<input name='stock' type='number' value='' min='1' class='quantity-input'>";
            echo "</select>";
            
            echo "<div class='d-flex col-4 mt-3'>";
            echo "<button class='btn btn-success w-50 mx-1' type='submit' name='btn_add_book'>Save</button>";
            echo "<a class='btn btn-outline-dark w-50 mx-1' href='./book.php'>Cancel</a>";
            echo "</div>";

            echo "</form>";
            
            echo "</div>";
        }

        else if($type == "book_edit") {
            $data['authors'] = get_authors();

            echo "<img src='data:image;base64,".base64_encode($data["cover_image"])."' alt='Book Cover' class='detail-image'>";
            
            echo "<div class='details'>";

            echo "<form action='' method='POST' enctype='multipart/form-data'>";
            echo "<input name='id' type='text' class='form-control' id='id' placeholder='id' value='{$data['id']}' hidden>";

            echo "<div class='mb-3'>";
            echo "<label for='title' class='form-label'>Title</label>";
            echo "<input name='title' type='text' class='form-control' id='title' placeholder='title' value='{$data['title']}'>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='description' class='form-label'>Description</label>";
            echo "<textarea name='description' type='text' class='form-control' id='description' placeholder='description' value=''>{$data['description']}</textarea>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='cover_image' class='form-label'>Cover Image</label>";
            echo "<input name='cover_image' type='file' class='form-control' id='cover_image'>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='author' class='form-label'>Author</label>";
            echo "<select name='author' id='author' class='form-select' aria-label='Default select example'>";
                echo "<option disabled>Choose author...</option>";
                foreach($data["authors"] as $author) {
                    if ($data['author_id'] == $author['id']) {
                        echo "<option value='{$author['id']}' selected>{$author['author_name']}</option>";
                    } else {
                        echo "<option value='{$author['id']}'>{$author['author_name']}</option>";
                    }
                }
            echo "</select>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='price' class='form-label'>Price</label>";
            echo "<input name='price' type='text' class='form-control' id='price' placeholder='price' value='{$data['price']}'>";
            echo "</div>";

            echo "<label for='stock'>Quantity</label>";
            echo "<input name='stock' type='number' value='{$data['stock']}' min='1' class='quantity-input'>";
            echo "</select>";
            
            echo "<div class='d-flex col-4 mt-3'>";
            echo "<button class='btn btn-success w-50 mx-1' type='submit' name='btn_update_book'>Save</button>";
            echo "<a class='btn btn-outline-dark w-50 mx-1' href='./book.php'>Cancel</a>";
            echo "</div>";

            echo "</form>";
            
            echo "</div>";
        }

        else if($type == "book_list") {
            echo "<tr>";
            echo "<th scope='row'>{$data['id']}</th>";
            echo "<td><img src='data:image;base64,".base64_encode($data['cover_image'])."' alt='No Cover Image' style='height:180px;width:180px;object-fit:contain;'></td>";
            echo "<td>{$data['title']}</td>";
            echo "<td>{$data['author_name']}</td>";
            echo "<td>{$data['price']}</td>";
            echo "<td>{$data['stock']}</td>";
            echo "<td>{$data['description']}</td>";
            echo "<td class='edit-btn'><button onclick='edit_book({$data['id']})'><i class='bi bi-pencil-fill'></i></button></td>";
            echo "<td class='del-btn'><button onclick='delete_book({$data['id']})'><i class='bi bi-trash-fill px-2'></i></button></td>";
            echo "</tr>";
        }

        else if($type == "all_books") {
                echo "<div class='col-md-3'>";

                echo "<div class='product-item'>";

                echo "<figure class='product-style'>";
                echo "<img src='data:image;base64,".base64_encode($data['cover_image'])."' class='product-item'>";
                echo "<button type='button' class='add-to-cart' data-product-tile='add-to-cart' onclick='add_to_cart({$data['id']})'>Add to Cart</button>";
                echo "</figure>";

                echo "<figcaption>";
                echo "<h3>{$data['title']}</h3>";
                echo "<span>{$data['author_name']}</span>";
                echo "<div class='item-price'>Ks. {$data['price']}</div>";
                echo "<div class='item-quantity'>Quantity. {$data['stock']}</div>";
                echo "</figcaption>";

                echo "</div>";

                echo "</div>";
        }

        else if($type == "order_list") {
            echo "<tr>";
            echo "<th scope='row'>{$data['id']}</th>";
            echo "<td>{$data['book_title']}</td>";
            echo "<td>{$data['name']}</td>";
            echo "<td>{$data['address']}</td>";
            echo "<td>{$data['email']}</td>";
            echo "<td>{$data['phone']}</td>";
            echo "<td>{$data['quantity']}</td>";
            echo "<td>{$data['order_date']}</td>";
            echo "<td>{$data['status']}</td>";
            echo "<td class='edit-btn'><button onclick='edit_order({$data['id']})'><i class='bi bi-pencil-fill'></i></button></td>";
            echo "<td class='del-btn'><button onclick='delete_order({$data['id']})'><i class='bi bi-trash-fill px-2'></i></button></td>";
            echo "</tr>";
        }

        else if($type == "order_add") {
            $data['books'] = get_books();
            
            echo "<div class='details'>";

            echo "<form action='' method='POST' enctype='multipart/form-data'>";
            echo "<input name='id' type='text' class='form-control' id='id' placeholder='id' value='' hidden>";

            echo "<div class='mb-3'>";
            echo "<label for='book_id' class='form-label'>Book</label>";
            echo "<select name='book_id' id='book_id' class='form-select' aria-label='Default select example'>";
                echo "<option selected disabled>Choose book...</option>";
                foreach($data["books"] as $book) {
                    echo "<option value='{$book['id']}'>{$book['title']}</option>";
                }
            echo "</select>";
            echo "</div>";
            
            echo "<div class='mb-3'>";
            echo "<label for='name' class='form-label'>Name</label>";
            echo "<input name='name' type='text' class='form-control' id='name' placeholder='name' value=''>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='address' class='form-label'>Address</label>";
            echo "<input name='address' type='text' class='form-control' id='address' placeholder='address' value=''>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='email' class='form-label'>Email</label>";
            echo "<input name='email' type='text' class='form-control' id='email' placeholder='email' value=''>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='phone' class='form-label'>Phone</label>";
            echo "<input name='phone' type='text' class='form-control' id='phone' placeholder='phone' value=''>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='quantity'>Quantity</label>";
            echo "<input name='quantity' type='number' value='' min='1' class='quantity-input'>";
            echo "</select>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='order_date' class='form-label'>Order Date</label>";
            echo "<input name='order_date' type='date' class='form-control' id='order_date' placeholder='order date' value=''>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='status'>Status</label>";
            echo "<select name='status' id='status' class='form-select' aria-label='Default select example'>";
                echo "<option selected disabled>Choose status...</option>";
                echo "<option value='pending'>Pending</option>";
                echo "<option value='delivered'>Delivered</option>";
            echo "</select>";
            echo "</div>";
            
            echo "<div class='d-flex col-4 mt-3'>";
            echo "<button class='btn btn-success w-50 mx-1' type='submit' name='btn_add_order'>Save</button>";
            echo "<a class='btn btn-outline-dark w-50 mx-1' href='./order.php'>Cancel</a>";
            echo "</div>";

            echo "</form>";
            
            echo "</div>";
        }

        else if($type == "order_edit") {
            $data['books'] = get_books();
            
            echo "<div class='details'>";

            echo "<form action='' method='POST' enctype='multipart/form-data'>";
            echo "<input name='id' type='text' class='form-control' id='id' placeholder='id' value='{$data['id']}' hidden>";

            echo "<div class='mb-3'>";
            echo "<label for='book_id' class='form-label'>Book</label>";
            echo "<select name='book_id' id='book_id' class='form-select' aria-label='Default select example'>";
                echo "<option disabled>Choose book...</option>";
                foreach($data["books"] as $book) {
                    if ($data['book_id'] == $book['id']) {
                        echo "<option value='{$book['id']}' selected>{$book['title']}</option>";
                    } else {
                        echo "<option value='{$book['id']}'>{$book['title']}</option>";
                    }
                }
            echo "</select>";
            echo "</div>";
            
            echo "<div class='mb-3'>";
            echo "<label for='name' class='form-label'>Name</label>";
            echo "<input name='name' type='text' class='form-control' id='name' placeholder='name' value='{$data['name']}'>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='address' class='form-label'>Address</label>";
            echo "<input name='address' type='text' class='form-control' id='address' placeholder='address' value='{$data['address']}'>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='email' class='form-label'>Email</label>";
            echo "<input name='email' type='text' class='form-control' id='email' placeholder='email' value='{$data['email']}'>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='phone' class='form-label'>Phone</label>";
            echo "<input name='phone' type='text' class='form-control' id='phone' placeholder='phone' value='{$data['phone']}'>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='quantity'>Quantity</label>";
            echo "<input name='quantity' type='number' value='{$data['quantity']}' min='1' class='quantity-input'>";
            echo "</select>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='order_date' class='form-label'>Order Date</label>";
            echo "<input name='order_date' type='date' class='form-control' id='order_date' placeholder='order date' value='{$data['order_date']}'>";
            echo "</div>";

            echo "<div class='mb-3'>";
            echo "<label for='status'>Status</label>";
            echo "<select name='status' id='status' class='form-select' aria-label='Default select example'>";
            echo "<option disabled>Choose status...</option>";
            if($data["status"] == "pending") {
                echo "<option value='pending' selected>Pending</option>";
                echo "<option value='delivered'>Delivered</option>";
            } else if($data["status"] == "delivered") {
                echo "<option value='pending'>Pending</option>";
                echo "<option value='delivered' selected>Delivered</option>";
            }
            echo "</select>";
            echo "</div>";
            
            echo "<div class='d-flex col-4 mt-3'>";
            echo "<button class='btn btn-success w-50 mx-1' type='submit' name='btn_update_order'>Save</button>";
            echo "<a class='btn btn-outline-dark w-50 mx-1' href='./order.php'>Cancel</a>";
            echo "</div>";

            echo "</form>";
            
            echo "</div>";
        }
    }
?>