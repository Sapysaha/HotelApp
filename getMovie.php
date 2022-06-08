<?php
    require_once("./includes/connection.php");
    header("Content-Type:application/json");
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Methods:POST");
    header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With");
    $data = json_decode(file_get_contents("php://input"),true);
    if(!empty($data['movieId']))
    {
        $movieId = $data['movieId'];
        $sql = "SELECT movies.name,movies.year,movies.description,movies.rating,movies.imageUrl,movies.director,genre.genre_name FROM movies inner join genre ON movies.genre = genre.genre_id WHERE movie_id = $movieId;";
        $result = mysqli_query($conn,$sql) or die("Error while querying the database");
        if(mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
            echo json_encode(array("flg"=>1,"movie"=>$row));
        }
        else
        {
            echo json_encode(array("flg"=>-2));
        }
    }
    else
    {
        echo json_encode(array("flg"=>-1));
    }
?>