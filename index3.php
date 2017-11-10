<?php
echo "<table style='border: solid 1px black;'>";


  class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
  } 
  $servername = "sql1.njit.edu";
  $username = "ss3598";
  $password = "owlnerZ1g";
  $dbname = "ss3598";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully <br>";
    $stmt = $conn->prepare("SELECT * FROM accounts WHERE id < 6"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    echo "<tr><th>id</th><th>email</th><th>fname</th><th>lname</th><th>phone</th><th>birthday</th><th>gender</th><th>password</th></tr>";
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
                 echo $v;
    }
  }
  catch(PDOException $e) {

    echo "Connection failed: " . $e->getMessage()."<br>";
    
  }
  $conn = null;
  echo "</table>";
?>