<?php
session_start();

$u_id = $_POST["u_id"];
$pwd = $_POST["pwd"];
// echo "ID : ".$u_id." / PW : ".$pwd;

include "../inc/dbcon.php";

$sql = "select idx, u_name, u_id, pwd from members where u_id='$u_id';";
// echo $sql;

$result = mysqli_query($dbcon, $sql);

// mysqli_fetch_row
// mysqli_fetch_array
// mysqli_num_rows
$num = mysqli_num_rows($result);
// echo

if(!$num){
    echo "
        <script type=\"text/javascript\">
            alert(\"ID does not exist.\");
            history.back();
        </script>
    ";
    exit;
} else{ 
    $array = mysqli_fetch_array($result);
    // $g_idx = $array["idx"];
    // $g_u_name = $array["u_name"];
    // $g_u_id = $array["u_id"];
    $g_pwd = $array["pwd"];

    if($pwd != $g_pwd){
        echo "
            <script type=\"text/javascript\">
                alert(\"password does not match\");
                history.back();
            </script>
        ";
    exit;
    } else{
        $_SESSION["s_idx"] = $array["idx"];
        $_SESSION["s_name"] = $array["u_name"];
        $_SESSION["s_id"] = $array["u_id"];
        // echo "idx : ".$_SESSION["s_idx"]." / "."NAME : ".$_SESSION["s_name"]." / "."ID : ".$_SESSION["s_id"];

        mysqli_close($dbcon);

        echo "
            <script type=\"text/javascript\">
                location.href = \"../index.php\";
            </script>
        ";
    };
};

?>