<?php 
    session_start();
    include "datacon.php";
    if (isset($_POST['RegisterDepartment'])) {

        $Username = mysqli_real_escape_string($conn,$_POST['Username']);
        $FullName = mysqli_real_escape_string($conn,$_POST['FullName']);
        $Email = mysqli_real_escape_string($conn,$_POST['Email']);
        $Telephone = mysqli_real_escape_string($conn,$_POST['Telephone']);
        $passwordhash = mysqli_real_escape_string($conn,$_POST['Password']);
        $Pass_Word = password_hash($passwordhash, PASSWORD_BCRYPT);
        $Address = mysqli_real_escape_string($conn,$_POST['Address']);
        $Number_of_Houses = mysqli_real_escape_string($conn,$_POST['Number_of_Houses']);

        $sql = "INSERT INTO `Landlord_Details` (`Username`, `Full_Name`, `Email`, `Telephone`, `Password`, `Address`, `Number_of_Houses`) VALUES ('$Username', '$FullName', '$Email', '$Telephone', '$Pass_Word', '$Address', '$Number_of_Houses')";
        $result = mysqli_query($conn, $sql);

        if(!$result){
            echo(" <script>alert('Please check your inputs and try again');window.location:'../Dashboard</script>");
        } else {
            echo(" <script>alert('Department Added Successfully');</script>");
        }
        echo "<script> window.location='Dashboard'; </script>";
    }?>