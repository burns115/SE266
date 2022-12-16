<?php

include (__DIR__ . '/db.php');

function insertSchools($fname) {
    global $db; 

    $i = 0;
   
    if (!file_exists($fname)) return false;

    deleteSchools();
    $file = fopen ($fname, 'rb');
    $row = fgetcsv($file);
    
    while (!feof($file) && $i++ < 10000) {
        $row = fgetcsv($file);

        $school = str_replace("'", "''", htmlspecialchars ($row[0]));

        $city = str_replace("'", "''", htmlspecialchars ($row[1]));

        $state = str_replace("'", "''", htmlspecialchars ($row[2]));

        $sql[] = "('" . $school . "' , '" . $city . "' , '" . $state. "')";

        if ($i % 1000 == 0) {
            $db->query('INSERT INTO schools (sclName, sclCity, sclState) VALUES '.implode(',', $sql));
            $sql = array();
        }
    }
    if (count($sql)) {
        $db->query('INSERT INTO schools (sclName, sclCity, sclState) VALUES '.implode(',', $sql));
    }

    return(true);
}


function deleteSchools () {
   global $db;
   
   $stmt = $db->query("DELETE FROM schools;");
   return 0;
}


function getSchoolAmount() {
   global $db;

   $stmt = $db->query("SELECT COUNT(*) AS schoolAmount FROM schools");
   $results = $stmt->fetch(PDO::FETCH_ASSOC);   
   return($results['schoolAmount']);
}

function getSchools ($name, $city, $state) {
   global $db;
   
   $binds = array();

   $sql = "SELECT sclID, sclName, sclCity, sclState FROM schools WHERE 0=0 ";

   if ($name != "") {
        $sql .= " AND sclName LIKE :sclName";
        $binds['sclName'] = '%'.$name.'%';
   }

   if ($city != "") {
       $sql .= " AND sclCity LIKE :city";
       $binds['city'] = '%'.$city.'%';
   }

   if ($state != "") {
       $sql .= " AND sclState LIKE :state";
       $binds['state'] = '%'.$state.'%';
   }
   
   $stmt = $db->prepare($sql);
  
    $results = array();
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return ($results);
}

function getAUser($uname){

    global $db;

    $result = [];

    $stmt = $db->prepare("SELECT userID, uname, encPword, salt FROM users WHERE uname=:bUN");

    $binds = array(
        ":bUN" => $uname
    );

    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    else{
        $results = "No user with that name found.";
    }

    return($results); 
}