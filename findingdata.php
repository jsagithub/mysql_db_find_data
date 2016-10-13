<?php

// DATABASE CONNECTION
echo "<b>-------CONNECTION TO DATABASE -------</b><br>";
$database_name="DATA BASE";
$mysqli = mysqli_connect("127.0.0.1", "USER_DATABASE", "PASSW_DATABASE", $database_name);

if (!$mysqli) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
echo "Host information: " . mysqli_get_host_info($mysqli) . PHP_EOL."<br>";
//END DATABASE CONNECTION

// TABLES
echo "<br><b>------TABLES-----</b><br>";
$result = $mysqli->query("SHOW TABLES");

while($row = $result->fetch_array())
{
	echo $row[0]."<br>";
}
//END TABLES

// SEARCH ON TABLES
echo "<br><b>------SEARCH FOR VALUE ALL DATABASE-----</b><br>";
	$search="Joust Duffle Bag";
    $out = "";

    $sql = "show tables";
    $rs = $mysqli->query($sql);
    if($rs->num_rows > 0){
        while($r = $rs->fetch_array()){
            $table = $r[0];
            $out .= "<br>TABLE-> ".$table.";";
            $sql_search = "select * from ".$table." where ";
            $sql_search_fields = Array();
            $sql2 = "SHOW COLUMNS FROM ".$table;
            $rs2 = $mysqli->query($sql2);
            if($rs2->num_rows > 0){
                while($r2 = $rs2->fetch_array()){
                    $colum = $r2[0];
                    $sql_search_fields[] = $colum." like('%".$search."%')";
                }
                $rs2->close();
            }
            $sql_search .= implode(" OR ", $sql_search_fields);
            $rs3 = $mysqli->query($sql_search);
            $out .= "NUM OF ROWS ->".$rs3->num_rows."<br>";
            if($rs3->num_rows > 0){
                $rs3->close();
            }
        }
        $rs->close();
    }
    echo $out;
// END SEARCH TABLES
mysqli_close($mysqli);
?>
