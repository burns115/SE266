<?php

    include (__DIR__ . '/db.php');

    function getRecord($songTitle, $artistName, $recordCom, $genre, $released){ //aquires the records values
        global $db;

        $sql = "SELECT musicID, songTitle, artistName, releaseDate, recordCom, genre, songDuration, released FROM music WHERE 0=0";//selects the values from the patients table and sets it as a variable

        $results = [];

        $binds = [];

        if ($songTitle != ""){// if song title value is not empty then add the values
            $sql .= " AND songTitle LIKE :bTitle";
            $binds['bTitle'] = '%' . $songTitle . '%'; 
            
        }
        if ($artistName != ""){// if name value is not empty then add the values
            $sql .= " AND artistName LIKE :bArtist";
            $binds['bArtist'] = '%' . $artistName . '%';

        }
        if ($recordCom != ""){// if record company value is not empty then add the values
            $sql .= " AND recordCom LIKE :bCom";
            $binds['bCom'] = '%' . $recordCom . '%';
        }
        if ($genre != ""){// if genre value is not empty then add the values
            $sql .= " AND genre LIKE :bGenre";
            $binds['bGenre'] = '%' . $genre . '%';

        }
        switch ($released){//changes the value of released depending on the input
            case "1":
                $sql .= " AND released = 1";
                break;

            case "0":
                $sql .= " AND released = 0";
                break;
        }

        $stmt = $db->prepare($sql);

        if ($stmt->execute($binds) && $stmt->rowCount() > 0 ){
            $results = $stmt->fetchall(PDO::FETCH_ASSOC);//adds search results in variable $results
        }

        return ($results);//returns search results
    }

    function addRecord($songTitle, $artistName, $releaseDate, $recordCom, $genre, $songDuration, $released){//this function is used to add music into the table

        global $db;
        $stmt = $db->prepare("INSERT INTO music SET songTitle = :bTitle, artistName = :bArtist, releaseDate = :bDate, recordCom = :bCom, genre = :bGenre, songDuration = :bDuration, released = :bReleased");

        $binds = array(//places values into an array
            ":bTitle" => $songTitle,
            ":bArtist" => $artistName,
            ":bDate" => $releaseDate,
            ":bCom" => $recordCom,
            ":bGenre" => $genre,
            ":bDuration" => $songDuration,
            ":bReleased" => $released
        );

        if ($stmt->execute($binds) && $stmt->rowCount() > 0 ){
            $results = "Data added.";
        }

        return ($results);//returns results
    }

    function editRecord($musicID, $songTitle, $artistName, $releaseDate, $recordCom, $genre, $songDuration, $released){//function used to update/edit music info
        global $db;

        $results = "";//set results to an empty string

        $stmt = $db->prepare("UPDATE music SET songTitle = :bTitle, artistName = :bArtist, releaseDate = :bDate, recordCom = :bCom, genre = :bGenre, songDuration = :bDuration, released = :bReleased WHERE musicID = :bID");

        $binds = array(//places new values into the array
            ":bID" => $musicID,
            ":bTitle" => $songTitle,
            ":bArtist" => $artistName,
            ":bDate" => $releaseDate,
            ":bCom" => $recordCom,
            ":bGenre" => $genre,
            ":bDuration" => $songDuration,
            ":bReleased" => $released
        );

        if ($stmt->execute($binds) AND $stmt->rowCount() > 0){
            $results = "Data updated";
        }

        return ($results);//returns updated values
    }

    function deleteRecord ($musicID) {//deletes music from the table
        global $db;
        
        $results = "Data was not deleted";
        $stmt = $db->prepare("DELETE FROM music WHERE musicID=:bID");
        
        $binds = array(
            ":bID" => $musicID
        );
        
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = 'Data Deleted';
        }
        
        return ($results);//returns table results
    }

    function getARecord($musicID){//gets a specific record from the table
        global $db;

        $result = [];
        $stmt = $db->prepare("SELECT musicID, songTitle, artistName, releaseDate, recordCom, genre, songDuration, released FROM music WHERE musicID=:bID");

        $binds = array(//adds the music id into an array
            ":bID" => $musicID
        );

        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return($results);//returns results of search
    }

    function getAUser($uname){//used to verify a user

        global $db;

        $result = [];

        $stmt = $db->prepare("SELECT userID, uname, encPword, salt FROM musers WHERE uname=:bUN");

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