<?php
        $servername="stanswebshop";
        $dbUsername ="root";
        $dbPassword="s3dU31kPgclT7VKC";
        $database="mydb";

    $conn = mysqli_connect($servername,$dbUsername,$dbPassword,$database);

    if(!$conn){
        die("Connection failed: ". mysqli_connect_error());
    }
