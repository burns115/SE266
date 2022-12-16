<?php

    include (__DIR__ . '/db.php');

    function getPatients($fName, $lName, $married){ //aquires the patients values
        global $db;

        $sql = "SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthDate FROM patients WHERE 0=0";//selects the values from the patients table and sets it as a variable

        $results = [];

        $binds = [];

        if ($fName != ""){// if first name value is not empty then add the values
            $sql .= " AND patientFirstName LIKE :bfName";
            $binds['bfName'] = '%' . $fName . '%'; 
            
        }
        if ($lName != ""){// if last name value is not empty then add the values
            $sql .= " AND patientLastName LIKE :blName";
            $binds['blName'] = '%' . $lName . '%';

        }
        switch ($married){//changes the value of patientMarried depending on the input
            case "1":
                $sql .= " AND patientMarried = 1";
                break;

            case "0":
                $sql .= " AND patientMarried = 0";
                break;
        }

        $stmt = $db->prepare($sql);

        if ($stmt->execute($binds) && $stmt->rowCount() > 0 ){
            $results = $stmt->fetchall(PDO::FETCH_ASSOC);//adds search results in variable $results
        }

        return ($results);//returns search results
    }

    function addPatient($fName, $lName, $married, $birth){//this function is used to add patients into the table

        global $db;
        $stmt = $db->prepare("INSERT INTO patients SET patientFirstName = :bFirst, patientLastName = :bLast, patientMarried = :bMarried, patientBirthDate = :bBirthday");

        $binds = array(//places values into an array
            ":bFirst" => $fName,
            ":bLast" => $lName,
            ":bMarried" => $married,
            ":bBirthday" => $birth
        );

        if ($stmt->execute($binds) && $stmt->rowCount() > 0 ){
            $results = "Data added.";
        }

        return ($results);//returns results
    }

    function editPatient($id, $fName, $lName, $married, $birth){//function used to update/edit patients info
        global $db;

        $results = "";//set results to an empty string

        $stmt = $db->prepare("UPDATE patients SET patientFirstName = :bFirst, patientLastName = :bLast, patientMarried = :bMarried, patientBirthDate = :bBirthday WHERE id = :bID");

        $binds = array(//places new values into the array
            ":bID" => $id,
            ":bFirst" => $fName,
            ":bLast" => $lName,
            ":bMarried" => $married,
            ":bBirthday" => $birth
        );

        if ($stmt->execute($binds) AND $stmt->rowCount() > 0){
            $results = "Data updated";
        }

        return ($results);//returns updated values
    }

    function deletePatient ($id) {//deletes patients from the table
        global $db;
        
        $results = "Data was not deleted";
        $stmt = $db->prepare("DELETE FROM patients WHERE id=:bID");
        
        $binds = array(
            ":bID" => $id
        );
        
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = 'Data Deleted';
        }
        
        return ($results);//returns table results
    }

    function getAPatient($id){//gets a specific patient from the table
        global $db;

        $result = [];
        $stmt = $db->prepare("SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthDate FROM patients WHERE id=:bID");

        $binds = array(//adds the patient id into an array
            ":bID" => $id
        );

        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return($results);//returns results of search
    }

    function getAUser($uname){//used to verify a user

        global $db;

        $result = [];

        $stmt = $db->prepare("SELECT userID, uname, encPword, salt FROM users WHERE uname=:bUN");

        $binds = array(//places the username into an array
            ":bUN" => $uname
        );

        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {//if the username is active then it will allow login
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

        } else{
            $results = "No user found.";//if username is not valid it will prompt an error
        }

        return($results); //returns the result
    }