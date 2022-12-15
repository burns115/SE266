<?php

    include (__DIR__ . '/db.php');

    function getPatients($fName, $lName, $married){
        global $db;

        $sql = "SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthDate FROM patients WHERE 0=0";

        $results = [];

        $binds = [];

        if ($fName != ""){
            $sql .= " AND patientFirstName LIKE :bfName";
            $binds['bfName'] = '%' . $fName . '%'; 
            
        }
        if ($lName != ""){
            $sql .= " AND patientLastName LIKE :blName";
            $binds['blName'] = '%' . $lName . '%';

        }
        switch ($married){
            case "1":
                $sql .= " AND patientMarried = 1";
                break;

            case "0":
                $sql .= " AND patientMarried = 0";
                break;
        }

        $stmt = $db->prepare($sql);

        if ($stmt->execute($binds) && $stmt->rowCount() > 0 ){
            $results = $stmt->fetchall(PDO::FETCH_ASSOC);
        }

        return ($results);
    }

    function addPatient($fName, $lName, $married, $birth){

        global $db;
        $stmt = $db->prepare("INSERT INTO patients SET patientFirstName = :bFirst, patientLastName = :bLast, patientMarried = :bMarried, patientBirthDate = :bBirthday");

        $binds = array(
            ":bFirst" => $fName,
            ":bLast" => $lName,
            ":bMarried" => $married,
            ":bBirthday" => $birth
        );

        if ($stmt->execute($binds) && $stmt->rowCount() > 0 ){
            $results = "Data added.";
        }

        return ($results);
    }

    function editPatient($id, $fName, $lName, $married, $birth){
        global $db;

        $results = "";

        $stmt = $db->prepare("UPDATE patients SET patientFirstName = :bFirst, patientLastName = :bLast, patientMarried = :bMarried, patientBirthDate = :bBirthday WHERE id = :bID");

        $binds = array(
            ":bID" => $id,
            ":bFirst" => $fName,
            ":bLast" => $lName,
            ":bMarried" => $married,
            ":bBirthday" => $birth
        );

        if ($stmt->execute($binds) AND $stmt->rowCount() > 0){
            $results = "Data updated";
        }

        return ($results);
    }

    function deletePatient ($id) {
        global $db;
        
        $results = "Data was not deleted";
        $stmt = $db->prepare("DELETE FROM patients WHERE id=:bID");
        
        $binds = array(
            ":bID" => $id
        );
        
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = 'Data Deleted';
        }
        
        return ($results);
    }

    function getAPatient($id){
        global $db;

        $result = [];
        $stmt = $db->prepare("SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthDate FROM patients WHERE id=:bID");

        $binds = array(
            ":bID" => $id
        );

        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return($results);
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

        } else{
            $results = "No user found.";
        }

        return($results); 
    }