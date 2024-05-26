<?php 
//step1 : create connect to DB 
$server='localhost'; 
$user='root'; //default user 
$password=''; 
$database='experpsy';  

$conn= mysqli_connect($server, $user, $password, $database);  

if($conn===False){     
    die('Database connection failed'. mysqli_connect_error($conn)); 
}

if (isset($_GET['Loginbtn'])){
    $AdminEmail=$_GET['mail'];
    $AdminPassword=$_GET['lock-closed'];
    $Adminquery = "SELECT * FROM admin WHERE Email='$AdminEmail' AND Password='$AdminPassword'";

    $AdminMatchResult=mysqli_query($conn, $Adminquery);
    if (mysqli_num_rows($AdminMatchResult)==1){
        $row = mysqli_fetch_assoc($AdminMatchResult);
        echo 'Record Found!';
        $_SESSION['Name'] = $row['Name'];
        header('Location: HomeExperPsy.html');
    } else {
        echo 'Enter Wrong Email or Password';
        header('Location: LoginRegistration.html');
    }
}

