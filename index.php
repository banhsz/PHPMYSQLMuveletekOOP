<!-- Az adatbázist (pelda_adatbazis.db) importáljuk a tesztelés előtt! -->
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Felhasználók</title>
</head>
<body>
    <?php
    class Adatbazis
	{
		private $servername;
		private $username;
		private $password;
		private $dbname;
		private $conn;
		private $sql;
		private $result;
		private $row;

		function __construct()
		{
            //ide írjuk az adatbázis nevét és a kapcsolódási adatokat
			$this->servername = "localhost";
			$this->username = "root";
			$this->password = "";
			$this->dbname = "pelda_adatbazis";
		}
		//Adatbázis kapcsoloat nyitása
		function kapcsolatNyitasa()
		{
			$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
			if ($this->conn->connect_error)
			{
		  		die("Connection failed: " . $this->conn->connect_error);
			}
        }
        //Adatbázis kapcsolat bontás
		function kapcsolatBontasa()
		{

			$this->conn->close();
		}
    }
    ?>
</body>
</html>