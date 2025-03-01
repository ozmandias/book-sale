<?php

    function addauthor()
    {
        global $connection;
        $authorname=$_POST['authorname'];
        //empty
        if($authorname=="")
        {
            echo "<script>window.alert('Please Enter Author Name')</script>";
        }
        //Duplicate
        elseif($authorname!="")
        {
            $query="Select * from author where author_name='$authorname'";
            $ch_query=mysqli_query($connection,$query);
            $count=mysqli_num_rows($ch_query);
            if($count>0)
            {
                echo "<script>window.alert('Already exist')</script>";
            }
            else
            {
                $query="insert into author(author_name)values('$authorname')";
                $go_query=mysqli_query($connection,$query);
                if(!$go_query)
                {
                    die("QUERY FAILED".mysqli_error($connection));
                }
                else
                {
                    echo "<script>window.alert('Successfully inserted')</script>";
                }
            }
        } 
    }
    function delauthor()
    {
        global $connection;
        $authorid=$_GET['aid'];
        $query="Delete from author where id='$authorid'";
        $go_query=mysqli_query($connection,$query);
        header("location:author.php");
    }
    function updateauthor()
    {
        global $connection;
        $authorname=$_POST['updateauthorname'];//category name from Update Category Form
        $authorid=$_GET['aid'];//category id from category List
        $query="Update author set author_name='$authorname' where id='$authorid'";
        $go_query=mysqli_query($connection,$query);
        if(!$go_query)
        {
            die("QUERY FAILED: ".mysqli_error($connection));
        }
        header("location:author.php");
    }

    function addcategory()
    {
        global $connection;
        $catname=$_POST['catname'];
        //empty
        if($catname=="")
        {
            echo "<script>window.alert('Please Enter Category Name')</script>";
        }
        //Duplicate
        elseif($catname!="")
        {
            $query="Select * from category where category_name='$catname'";
            $ch_query=mysqli_query($connection,$query);
            $count=mysqli_num_rows($ch_query);
            if($count>0)
            {
                echo "<script>window.alert('Already exist')</script>";
            }
            else
            {
                $query="insert into category(category_name)values('$catname')";
                $go_query=mysqli_query($connection,$query);
                if(!$go_query)
                {
                    die("QUERY FAILED".mysqli_error($connection));
                }
                else
                {
                    echo "<script>window.alert('Successfully inserted')</script>";
                }
            }
        }
    }
    function delcategory()
    {
        global $connection;
        $catid=$_GET['cid'];
        $query="Delete from category where id='$catid'";
        $go_query=mysqli_query($connection,$query);
        header("location:category.php");
    }
    function updatecategory()
    {
        global $connection;
        $catname=$_POST['updatecatname'];//category name from Update Category Form
        $catid=$_GET['cid'];//category id from category List
        $query="Update category set category_name='$catname' where id='$catid'";
        $go_query=mysqli_query($connection,$query);
        if(!$go_query)
        {
            die("QUERY FAILED: ".mysqli_error($connection));
        }
        header("location:category.php");
    }

    function adduser()
    {
        global $connection;
        $username=$_POST['txtusername'];//user name
        $password=$_POST['txtpassword'];//password 
        $cpassword=$_POST['txtcpassword'];//confirm password

        //match
        if($password!=$cpassword)
        {
            echo "<script>window.alert('Password and Confirm Password are must be same')</script>";
        }
        //Duplicate
        elseif($password!="" && $username!="")
        {
            $query="Select * from user where username='$username' and password='$password'";
            $ch_query =mysqli_query($connection,$query);
            $count=mysqli_num_rows($ch_query);
            if($count>0)
            {
                echo "<script>window.alert('Already Exists')</script>";
            }
            else
            {
                $hashvalue=md5($password);
                $usertype=$_POST['usertype'];
                $query="insert into user(username,password,role) values ('$username','$hashvalue','$usertype')";
                $ch_query=mysqli_query($connection,$query);
                if(!$ch_query)
                    {
                        die("QUERY FAILED: ".mysqli_error($connection));
                    }
                    header("location:userlist.php");
            }
        }
    }
    function deluser()
    {
        global $connection;
        $userid=$_GET['uid'];//2
        $query="Delete from user where userid='$userid'";
        $go_query=mysqli_query($connection,$query);
        header("location:userlist.php");
    }

    function admin_login()
    {
        global $connection;

        $username=$_POST['username'];//Shwe Yee
        $password=$_POST['password'];//123456
        $hpass=md5($password);//e10adc3949ba59abbe56e057f20f883e
        $query="Select * from user";
        $go_query=mysqli_query($connection,$query);
        //db_fieldname(username)==text box, db_fieldname(password)==text box,db_fieldname(role)=='admin'
        while($out=mysqli_fetch_array($go_query))
        {
            $db_user_name=$out['username'];
            $db_password=$out['password'];
            $db_user_role=$out['role'];
            
            if($db_user_name==$username && $db_password==$hpass && $db_user_role=='admin')
            {
                $_SESSION['admin']=$username;//Shwe Yee
                header('location:dashboard.php');
            }
            else
            {
                echo "<script>window.alert('Invalid Admin and Password')</script>";
                echo "<script>window.location.href='index.php'</script>";
            }
        }
    }

    function addproduct()
    {
        global $connection;
        $productname=$_POST['txtproductname'];
        $catid=$_POST['catname'];
        $price=$_POST['txtprice'];
        $qty=$_POST['txtqty'];
        $photo=$_FILES['photo']['name'];

        //condition

        if(is_numeric($price)==false)
        {
            echo "<script>window.alert('Enter Product Price is numeric value')</script>";
        }
        elseif(is_numeric($qty)==false)
        {
            echo "<script>window.alert('Enter Product Qty is numeric value')</script>";
        }
        elseif($photo=="")
        {
            echo "<script>window.alert('Choose Product Image')</script>";
        }
        //duplicate
        elseif($productname!="" && $photo!="")
        {
            $query="Select * from product where productname='$productname'";
            $ch_query=mysqli_query($connection,$query);
            $count=mysqli_num_rows($ch_query);
            if($count>0)
            {
                echo "<script>window.alert('This Product is already exist')</script>";   
            }
            else
            {
                $query="insert into product(productname,catid,price,qty,photo)";
                $query.="values('$productname','$catid','$price','$qty','$photo')";
                $go_query=mysqli_query($connection,$query);
                if(!$go_query)
                {
                    die("QUERY FAILED ".mysqli_error($connection));
                }
                //move image file
                else
                {
                    move_uploaded_file($_FILES['photo']['tmp_name'],'../photo/'.$photo);
                    header("location:productlist.php");
                }
            }
        }
    }
    function delproduct()
    {
        global $connection;
        $productid=$_GET['pid'];
        $query="Delete from product where productid ='$productid'";
        $go_query=mysqli_query($connection,$query);
        header("location:productlist.php");
    }
    function updateProduct()
    {
        global $connection;
        $productid=$_GET['pid'];
        $productname=$_POST['txtproductname'];
        $catid=$_POST['catname'];
        $price=$_POST['txtprice'];
        $qty=$_POST['txtqty'];
        $photo=$_FILES['photo']['name'];

        //no change photo
        if(!$photo)
        {
            $query="update product set productname='$productname',catid='$catid',
            price='$price',qty='$qty' where productid='$productid'";
        }
        else
        {
            $query="update product set productname='$productname',catid='$catid',
            price='$price',qty='$qty',photo='$photo' where productid='$productid'";
        }
        $go_query=mysqli_query($connection,$query);
        if(!$go_query)
        {
            die("QUERY FAILED ".mysqli_error($connection));
        }
        else
        {
            move_uploaded_file($_FILES['photo']['tmp_name'],'../photo/'.$photo);
        }
        header("location:productlist.php");

    }
    
    function delfeedback()
    {
        global $connection;
        $fid=$_GET['fid'];//2
        $query="Delete from feedback where id='$fid'";
        $go_query=mysqli_query($connection,$query);
        header("location:feedbacklist.php");
    }
?>