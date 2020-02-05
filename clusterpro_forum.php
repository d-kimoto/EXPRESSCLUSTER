<?php

$server = "localhost";
$userName = "forum_user";
$password = "clusterpro";
$dbName = "clusterpro_forum";

$mysqli = new mysqli($server, $userName, $password,$dbName);

if ($mysqli->connect_error){
        echo $mysqli->connect_error;
        exit();
}else{
        $mysqli->set_charset("utf-8");
}

$sql = "SELECT * FROM user";

$result = $mysqli -> query($sql);

if(!$result) {
        echo $mysqli->error;
        exit();
}

$row_count = $result->num_rows;

while($row = $result->fetch_array(MYSQLI_ASSOC)){
        $rows[] = $row;
}

$result->free();

$mysqli->close();

?>

<!DOCTYPE html>
<html>
<head>
<title>CLUSTERPRO FORUM 2020</title>
<meta charset="utf-8">
</head>
<body>
<h1> Mysql Database Check </h1>


<table border='1'>
<tr><th>id</th><th>name</th></tr>

<?php
foreach($rows as $row){
?>
<tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['name'],ENT_QUOTES,'UTF-8'); ?></td>
</tr>
<?php
}
?>

</table>

</body>
</html>
