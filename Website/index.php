<h1>Hello, I'm<?php echo "World!";?></h1>

<?php
//$serverName = "db.changelogger.org"; //serverName\instanceName, portNumber (default is 1433)
//$connectionInfo = array( "DB_NAME"=>"changelogger", "DB_USER"=>"root", "DB_PASSWD"=>"SDDchangeloggerDB");
//$conn2 = sqlsrv_connect( $serverName, $connectionInfo);

//$servername="db.changelogger.org";
//$username="root";
//$password="SDDchangeloggerDB";
include '../config.php';
$conn1 = new mysqli($servername, $username, $password);
if( $conn1 ) {
    echo "Connection established.<br />";
}else{
    echo "Connection could not be established.<br />";
    die( print_r( sqlsrv_errors(), true));
}
?>