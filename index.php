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
        //Adatbázis osztály definíciója (adattagok+függvények)
        class Adatbazis
        {
            //Adattagok
            private $servername;
            private $username;
            private $password;
            private $dbname;
            private $conn;
            private $sql;
            private $result;
            private $row;

            //Konstruktor
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

            //SELECT utasítás
            function select()
            {
                $this->sql =
                    "
                    SELECT `id`, `felhasznalonev`, `jelszo`, `e-mail`, `jogosultsag`, `aktiv` 
                    FROM `felhasznalok`
                    ";
                $this->result = $this->conn->query($this->sql);

                if ($this->result->num_rows > 0) 
                {
                    while($this->row = $this->result->fetch_assoc()) 
                    {                                                    
                        echo "ID: ".$this->row["id"]."<br>";
                        echo "Felhasználónév: ".$this->row["felhasznalonev"]."<br>";
                        echo "Jelszó: ".$this->row["jelszo"]."<br>";
                        echo "E-mail: ".$this->row["e-mail"]."<br>";
                        echo "Jogosultság: ".$this->row["jogosultsag"]."<br>";
                        echo "Aktivitás: ".$this->row["aktiv"]."<br><br>";
                    }
                } 
                else 
                {
                    echo "0 results";
                }
            }				
            
            //INSERT utasítás
            //Fontos, hogy a szöveg típusu mezőknél a szintakszis:'".$valtozoNeve."' míg a szám típusuaknál:".$valtozoNeve."
            function insert($felhasznalonev,$jelszo,$email,$jogosultsag,$aktivitas)
            {
                $this->sql = 
                    "
                    INSERT INTO felhasznalok (`felhasznalonev`, `jelszo`, `e-mail`,`jogosultsag`, `aktiv`)
                    VALUES 
                    (
                    '".$felhasznalonev."', 
                    '".$jelszo."', 
                    '".$email."',
                    '".$jogosultsag."',
                    ".$aktivitas."
                    )
                    ";
                
                if ($this->conn->query($this->sql) === TRUE) 
                {
                    echo "Sikeres regisztráció!<br>";
                } 
                else 
                {
                    echo "Sikertelen regisztráció!<br>";
                }
            }

            //DELETE utasítás
            function delete($id)
            {
                $this->sql =
                    "
                    DELETE FROM felhasznalok 
                    WHERE id = ".$id."
                    ";

                if ($this->conn->query($this->sql) === TRUE) 
                {
                  echo "Sikeres törlés!</br>";
                } 
                else 
                {
                  echo "Sikertelen törlés!</br>";
                }
            }

        }
    ?>

    
    <?php
        //Az adatbázis példányosítása és függvények hívása. külön php blokkba tettem, hogy jobban átláthatóbb legyen
        //Példányosítás
        $peldaAdatbazis = new Adatbazis();

        //
        //DELETE
        //
        //Kapcsolódás
        $peldaAdatbazis->kapcsolatNyitasa();
        //Delete utasítás
            //1. lépés: Adjuk meg, hogy hanyas ID-jű felhasználót szeretnénk törölni!
            $id = 4;
            //2. lépés: Töröljük a kommentet a lenti függvény elől, hogy a törlés megtörténjen!
            //$peldaAdatbazis->delete($id);
        //Kapcsolat bontása
        $peldaAdatbazis->kapcsolatBontasa();

        //
        //INSERT
        //
        //Kapcsolódás
        $peldaAdatbazis->kapcsolatNyitasa();
        //Insert utasítás
            //1. lépés: Irjunk be példa adatokat a lenti változókba!
            $felhasznalonev = "István";
            $jelszo = "isti99";
            $email = "istvan99@gmail.com";
            $jogosultsag = "felhasználó";
            $aktivitas = 1;
            //2. lépés: Távolítsuk el a kommentet a lenti függvény elől, hogy a beszúrás megtörténjen!
            //$peldaAdatbazis->insert($felhasznalonev,$jelszo,$email,$jogosultsag,$aktivitas);
        //Kapcsolat bontása
        $peldaAdatbazis->kapcsolatBontasa();

        //
        //SELECT
        //
        //Kapcsolódás
        $peldaAdatbazis->kapcsolatNyitasa();
        //Select utasítás
        $peldaAdatbazis->select();
        //Kapcsolat bontása
        $peldaAdatbazis->kapcsolatBontasa();

    ?>
</body>
</html>