<?php 
$admin_name=$_POST["admin_name"];
$admin_password=$_POST["password"];


if($admin_name =="admin" && $admin_password == "root")
{
    echo '<script> 
    window.location="../pages/adminpanel.php";
    </script>';
}
else
{
    echo '<script> 
    alert("Invalid credentials!");
    window.location="../admin.php";
    </script>';
}


?>