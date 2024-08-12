<?php
function register($uname, $email, $password, $con_password)
{
    $file_path = "database/";
    $file = $file_path . $uname . ".txt";
    
    if (empty($uname) || empty($email) || empty($password) || empty($con_password)) {
        echo '<p style = "color: red;"> Please ensure to fill all the fields </p>';
        echo '<a href="./templates/register.html">Back</a>';
        return;
    }

    // Password validation
    if ($password != $con_password) {
        header("location: ./templates/register.php?error=passworddoesnotmatch");
        exit();
    }

    //Check if the directory exists and is writable
    if (!is_dir($file_path)) {
        mkdir($file_path, 0777, true);
    }

    if (!is_writable($file_path)) {
        echo '<p style = "color: red;"> Cannot write in this directory </p>';
        echo '<a href="./templates/register.html">Back</a>';
        return;
    }

    //Create the file
    if (!file_exists($file)) {
        $file_create = fopen($file, "w");

        //Storing the details
        fwrite($file_create, "Username: " . $uname . "\n");
        fwrite($file_create, "Email: " . $email . "\n");
        fwrite($file_create, "Password: " . $password . "\n");
        fclose($file_create);

        echo '<p style = "color: green;"> User Created Successfully </p>';
        echo '<a href="./templates/login.html">Proceed to login</a>';
    } else {
        echo '<p style = "color: red;"> Username already exists </p>';
        echo '<a href="./templates/register.html">Back</a>';
    }
}

function login($uname, $password)
{
    $file_name = $uname . ".txt";
    $file_path = "database/" . $file_name;

    if (file_exists($file_path)) {
        $file_handle = fopen($file_path, "r");
        $file_contents = fread($file_handle, filesize($file_path));
        fclose($file_handle);

        //check if the password match
        $file_password = explode("\n", $file_contents)[2];
        $file_password = trim(substr($file_password, 9));

        if ($file_password == $password) {
            echo '<p style = "color: green;"> Login Successful </p>';
        echo '<a href="./templates/login.html">Back</a>';
        } else {
            echo '<p style = "color: red;"> Incorrect password </p>';
            echo '<a href="./templates/login.html">Back</a>';
        }
        
    } else {
        echo '<p style = "color: red;"> User does not exists </p>';
        echo '<a href="./templates/login.html">Back</a>';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["register"])) {
        $uname = $_POST["uname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $con_password = $_POST["con_password"];

        register($uname, $email, $password, $con_password);
    } elseif (isset($_POST["login"])) {
        $uname = $_POST["uname"];
        $password = $_POST["password"];

        login($uname, $password);
    }
}
