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
        $command = "SELECT s.score_id, g.golfer_name, s.score, s.date, c.course_name 
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
            $counter =0;
            while($row = $stmt->fetch()){
                 $scores[$counter] = array(
                     "golfer_name" => $row["golfer_name"],
                     "course_name" => $row["course_name"],
                     "score" => $row["score"],
                     "date" => $row["date"],
                     "score_id" => $row["score_id"]
                 );
                 $counter++;
            }
            echo json_encode($scores);
        //ERROR
        }else{
            $error = array();
            $error['test'] = "DIDN'T WORK";
            echo json_encode($error);
        }
    }

    //SET GOLFER NAME
    else if($_REQUEST['act'] == 'setGolferName'){
        $name = $_REQUEST['name'];
        //check if name exists
        $command = "SELECT `golfer_name` FROM `golfer` WHERE golfer_name = ?";
        $stmt = $dbh->prepare($command);
        $params = [$name];
        $success = $stmt->execute($params);
        if($success){
            $result = $stmt->fetchAll();
            if(count($result) > 0){
                $error = array();
                $error['test'] = "Name already exists";
                echo json_encode($error);
            } 
            //If no rows of name then insert a new name
            else{
                $command = "INSERT INTO golfer (`golfer_id`, `golfer_name`) VALUES (NULL, ?)";
                $stmt = $dbh->prepare($command);
                $params = [$name];
                $success = $stmt->execute($params);
                
            }
            
        }else{
            $error = array();
            $error['test'] = "DIDN'T WORK";
            echo json_encode($error);
        }

    }


    //GET GOLFERS
    else if($_REQUEST['act'] == "getGolfers"){
        $command = "SELECT * FROM `golfer`";
        $stmt = $dbh->prepare($command);
        $success = $stmt->execute();

        if($success){
            $golfers = array();
            while($row = $stmt->fetch()){
                array_push($golfers, array(
                    'id' => $row['golfer_id'], 
                    'name' => $row['golfer_name']));
            }
            echo json_encode($golfers);
        }
        else
        {
            $error = array();
            $error['test'] = "DIDN'T WORK get golfer";
            echo json_encode($error);
        }
    }


    //SET A NEW SCORE
    else if($_REQUEST['act'] == "setScore"){
        $golfer_id = (int)$_REQUEST['id'];
        $score = (int)$_REQUEST['score'];
        $date = $_REQUEST['date'];
        $course_name = $_REQUEST['course_name'];
        $course_id;

        //Get course id
        $command = "SELECT course_id FROM course WHERE course_name = ?";
        $stmt = $dbh->prepare($command);
        $params = [$_REQUEST['course_name']];
        $success = $stmt->execute($params);
        
        if($success){
            while($row=$stmt->fetch()){
                $course_id= $row['course_id'];
            }
        }

        //insert new score
        $command = "INSERT INTO `score`(`score_id`, `golfer_id`, `course_id`, `score`, `date`) VALUES (NULL,?,?,?,?)";
        $stmt = $dbh->prepare($command);
        $params = [$golfer_id, $course_id, $score, $date];
        $success = $stmt->execute($params);

        //output message
        $output = array();
        $output['state'] = $course_id;
        echo json_encode($output);

    }

    //CREATE COURSE
    else if($_REQUEST['act'] == 'createCourse'){
        $course_name = $_REQUEST['name'];
        $latitude = $_REQUEST['latitude'];
        $longitude = $_REQUEST['longitude'];


        //check if course exists
        $command = "SELECT * FROM course WHERE course_name = ?";
        $stmt = $dbh->prepare($command);
        $params = [$_REQUEST['name']];
        $success = $stmt->execute($params);

        if($success){
            $result = $stmt->fetchAll();
            if(count($result) > 0){
                $output = array();
                $output['state'] = "Course already exists";
                echo json_encode($output);
            }else{
                $command = "INSERT INTO `course`(`course_id`, `course_name`, `latitute`, `longitude`) 
                VALUES (NULL,?,?,?)";
                $stmt = $dbh->prepare($command);
                $params = [$course_name, $latitude, $longitude];
                $success = $stmt->execute($params);
                $output = array();
                echo json_encode($output);
            }
        } else{
            $output = array();
            $output['state'] = "Course add didn't work";
            echo json_encode($output);
        }

        
       
    }


    //----------------------ERROR--------------------//
    else
    {
        $error = array();
        $error['test'] = "DIDN'T WORK (MAIN)";
        echo json_encode($error);
    }

?>