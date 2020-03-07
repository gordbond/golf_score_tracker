<?php
    
    include "connection.php";

    //----------------------GET STARTING LOCATIONS---------------------//
    if($_REQUEST['act'] == "getOGLocations")
    {
        $command = "SELECT * FROM start_loc";
        $stmt = $dbh->prepare($command);
        $success = $stmt->execute($params);

        
        if($success){
            $startLocations = array();
            while($row = $stmt->fetch()){
                 $startLocations[$row['course_id']-1] = array( 
                    "course_name" => $row['course_name'],
                    'address' => $row['course_address'],
                    'website' => $row['website'],
                    'latitude' => $row['latitude'],
                    'longitude' => $row['longitude']
                 );
            }
            echo json_encode($startLocations);
        }else{
            $error = array();
            $error['test'] = "DIDN'T WORK";
            echo json_encode($error);
        }
    }
    //----------------------GET COURSE DATA--------------------//

    else if($_REQUEST['act'] == "getScores")
    {
        $course = $_REQUEST['course'];
        $command = "SELECT s.score_id, g.fname, g.lname, s.score, s.date, c.course_name 
        FROM score s
        JOIN golfer g 
        ON g.golfer_id = s.golfer_id 
        JOIN course c
        ON c.course_id = s.course_id
        WHERE c.course_name = ?";
        $stmt = $dbh->prepare($command);
        $params = [$course];
        $success = $stmt->execute($params);

        
        if($success){
            $scores = array();
            while($row = $stmt->fetch()){
                 $scores[$row['score_id']-1] = array(
                     "fname" => $row["fname"],
                     "lname" => $row["lname"],
                     "course_name" => $row["course_name"],
                     "score" => $row["score"],
                     "date" => $row["date"]
                 );
            }
            echo json_encode($scores);
        //ERROR
        }else{
            $error = array();
            $error['test'] = "DIDN'T WORK";
            echo json_encode($error);
        }
    }


    //----------------------ERROR--------------------//
    else
    {
        $error = array();
        $error['test'] = "DIDN'T WORK";
        echo json_encode($error);
    }

?>