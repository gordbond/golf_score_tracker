<!-- 
TO-DO LIST:
- Data validation check score
- Required keyword?



 -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <title>Golf Score Tracker</title>
</head>
<body>
    <!-- NAV HEADER -->
    <Container id='header'>
        <div id='logoContainer' style="width:200px;" class="img-fluid mx-auto d-block">
            <img src="img/logo.jpg" class="img-fluid" alt='Logo'>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #fff;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a id="searchButton" class="nav-link active" href="#" onclick="return toggleMainView();">Search Courses</a>
                    </li>
                    <li class="nav-item">
                    <a id="listButton" class="nav-link" href="#" onclick="return toggleListView();">List Scores</a>
                    </li>
                </ul>
            </div>
        </nav>
    </Container>
    <!-- MAIN CONTENT -->
    <Container id='mainContainer' class="row container-fluid mx-auto" style="width:96%">
                <div id='map' class="col-12 col-m-6 mx-auto" 
                    style='
                    max-width: 620px; 
                    width:40%; 
                    height:500px; 
                    border:solid green 6px; 
                    padding: 15px 30px;
                    margin-bottom: 20px;'>
                    <div id='myMap'style='width:100%; height:70%; margin: auto;'>
                        
                    </div>
                    <form style="margin-top: 10px;">
                        <div class="form-group">
                            <label for="locationLookUp">Enter course or location</label>
                            <input type="text" class="form-control" id="locationLookUp" aria-describedby="locSearch">
                            <!-- <small id="locSearch" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        
                        <button type="submit" class="btn btn-primary" style="background-color: green; border:none;" onclick="return submitClicked(event);">Search</button>
                    </form>
                </div>
            
            
                <div id='scores' class="col-12 col-m-6 mx-auto" 
                    style='
                    max-width: 620px; 
                    width:40%; 
                    height:500px; 
                    border:solid green 6px; 
                    padding: 15px 30px;'>
                    <div id='scoreContent'style='width:100%; height:100%;'>
                        <h1 class="text-center" style="border-bottom: solid 1px black; padding: 10px 5px;">Scores</h1>
                        <h3 id="courseTitle">Search for a course to see your scores</h3>
                        <button id="addScoreButton" type="submit" class="btn btn-primary" style="background-color: green; border:none; margin-bottom: 10px;" onclick="return addScore(event);">Add a score</button>
                        <button id="addGolferButton" type="submit" class="btn btn-primary" style="background-color: green; border:none; margin-bottom: 10px;" onclick="return addGolfer(event);" >Add a golfer</button>
                        <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" >  
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Score</th>
                                        <th scope="col">Date</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    </Container>
    <Container id="listScoresPage" style="display: none;">
        <div id='allScores' class="col-12 col-m-6 mx-auto" 
                    style='
                    max-width: 1000px; 
                    width:80%; 
                    height:500px; 
                    border:solid green 6px; 
                    padding: 15px 30px;'>
                    <div id='allScoreContent'style='width:100%; height:100%;'>
                        <h1 class="text-center" style="border-bottom: solid 1px black; padding: 10px 5px;">Scores</h1>
                        <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" >  
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col"><a onclick="return sortScores('name')">Name</a></th>
                                        <th scope="col"><a onclick="return sortScores('score')">Score</a></th>
                                        <th scope="col"><a onclick="return sortScores('course')">Course</a></th>
                                        <th scope="col"><a onclick="return sortScores('date')">Date</a></th>
                                    </tr>
                                </thead>
                                <tbody id="tableBodyAllScores">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    </Container>
    <script type="text/javascript">

        var map;
        var infobox;
        var currentLat;
        var currentLong;
        var directionsManager;
        var searchManager;
        var retrievedLocation;

        function loadMapScenario() {
            $("#addScoreButton").prop('disabled', true);
            $("#addGolferButton").prop('disabled', true);
            
            //-----------------CREATE MAP------------------------//
            map = new Microsoft.Maps.Map(document.getElementById('myMap'), {
                center: new
                Microsoft.Maps.Location(36.56964874267578, -121.94976043701172)
            });

            //--------GET DATA FROM OG LOCATIONS------//
            getOGLocations();
            //getScores('Pebble Beach Golf Links');
            
            infobox = new Microsoft.Maps.Infobox(map.getCenter(), {
                visible: false
            });
            infobox.setMap(map);
        }

        //-----------------TOGGLE LIST VIEW------------------------//
        function toggleListView(){
                $('#mainContainer').hide();
                $('#listScoresPage').show();
            
            $("#searchButton").removeClass("active");
            $("#listButton").addClass("active");
            
            getAllScores();
        }

        //-----------------TOGGLE MAIN VIEW------------------------//
        function toggleMainView(){
                $('#mainContainer').show();
                $('#listScoresPage').hide();
            
            $("#listButton").removeClass("active");
            $("#searchButton").addClass("active");
            
        }


        //-----------------GET ALLLLLLLLL SCORES------------------------//
        function getAllScores(){
            $.post('php/functions.php', {
                act: 'getAllScores'
                }, function(data){
                    $('#tableBodyAllScores').html("");
                    for(i=0; i<data.length; i++){
                        //Add all the scores
                        $('#tableBodyAllScores').prepend(
                            `<tr>
                                <th scope="row">${data[i]['golfer_name']}</th>
                                <td>${data[i]['score']}</td>
                                <td>${data[i]['course_name']}</td>
                                <td>${data[i]['date']}</td>
                            </tr>`
                        );
                    }
                }, 'json');
        }

        //-----------------SORT SCORES------------------------//
        function sortScores(key){
            $.post('php/functions.php', {
                act: 'sortScores',
                key: key
                }, function(data){
                    $('#tableBodyAllScores').html("");
                    for(i=0; i<data.length; i++){
                        //Add all the scores
                        $('#tableBodyAllScores').prepend(
                            `<tr>
                                <th scope="row">${data[i]['golfer_name']}</th>
                                <td>${data[i]['score']}</td>
                                <td>${data[i]['course_name']}</td>
                                <td>${data[i]['date']}</td>
                            </tr>`
                        );
                    }
                }, 'json');
        }



        //---------------------------CREATE A COURSE-----------------------//
        async function createCourse(course_name){
            //use course name to get course data from API
            let latitude, longitude;

            let unencodedLoc = course_name;
            let loc = encodeURI(unencodedLoc);
            let url = `http://dev.virtualearth.net/REST/v1/Locations/${loc}%20golf%20course?o=&key=Ai65CY4gKwZno3n8tBErzqZzy5J3HlkcgrxXbsw5mWJnLel2CiKSlmzal-lAhL50`;
                //First call to get the co-ordinates of the location
            console.log('encoded url '+ url);
            await $.get(url, 
                function (data) {
                    latitude = data.resourceSets[0].resources[0].geocodePoints[0].coordinates[0];
                    longitude = data.resourceSets[0].resources[0].geocodePoints[0].coordinates[1];
            });

            $.post('php/functions.php', {
                act: 'createCourse',
                name: course_name,
                latitude: latitude,
                longitude: longitude

                }, function(data){
                    console.log(data);
                }, 'json');

        }

        //Get Scores - populate the table
        

        async function getScores(course_name){
            $("#addScoreButton").prop('disabled', false);
            $("#addGolferButton").prop('disabled', false);
            console.log(course_name);
            createCourse(course_name);
            await $.post('php/functions.php', {
                act: 'getScores', 
                course: course_name
                }, function(data){
                    console.log(data);
                    console.log(data.length);
                    $('#courseTitle').html(course_name);
                    $('#tableBody').html("");
                    
                    for(i=0; i<data.length; i++){
                        //Add all the scores
                        let golfer_name = "'"+data[i]['golfer_name']+"'";
                        console.log("ARGUMENT: "+golfer_name);
                        $('#tableBody').prepend(
                            `<tr>
                                <th scope="row">${data[i]['golfer_name']}</th>
                                <td>${data[i]['score']}</td>
                                
                                <td>${data[i]['date']}</td>
                                <td>
                                    <a onclick="return editScore(${data[i]['score_id']}, '${data[i]['golfer_name']}' );">Edit</a>
                                </td>
                                <td>
                                    <a style="color:red;" onclick="deleteScore(${data[i]['score_id']});">Delete</a>
                                </td>
                            </tr>`
                        );
                    }
                }, 'json');
        }




        //Add new golfer
        function addGolfer(event){
            event.preventDefault();
            $("#addScoreButton").prop('disabled', true);
            $("#addGolferButton").prop('disabled', true);
            
            $('#tableBody').prepend(
                `<tr>
                    <th scope="row" > <input id="nameInput" style="min-width:130px;" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" ></th>
                    <td></td>
                    <td></td>
                    <td>
                        <a style="color:green;"  
                        onclick="return submitName($('#nameInput').val());"
                        
                        >Add</a>
                    </td>
                    <td><a onclick="return cancel();">
                        Cancel</a>
                    </td>
                </tr>`
            );  
        }

        //Submit new golfer
        async function submitName(name){
            // event.preventDefault();
            console.log("IS THIS THING WORKING? " + name);
            await $.post('php/functions.php', {
                act: 'setGolferName', 
                name: name
                }, function(data){
                    console.log(data);
                }, 'json');
            $("#addScoreButton").prop('disabled', false);
            $("#addGolferButton").prop('disabled', false);
            getScores($("#courseTitle").html());
        }
        //CANCEL operation
        function cancel(){
            $("#addScoreButton").prop('disabled', false);
            $("#addGolferButton").prop('disabled', false);
            getScores($("#courseTitle").html());
        }


        //---------------ADD SCORE-----------------//




        //Add New Score
        async function addScore(event){
            event.preventDefault();
            $("#addScoreButton").prop('disabled', true);
            $("#addGolferButton").prop('disabled', true);
            let options;

            await $.post('php/functions.php', {
                act: 'getGolfers'
                }, function(data){
                    console.log(data);
                    for(i=0; i<data.length; i++){
                        //Add all the scores
                        console.log(data[i]);
                        options += 
                            "<option value='" + data[i]['id'] + " '>" + data[i]['name'] + "</option>";
                    }

                }, 'json');

            $('#tableBody').prepend(
                `<tr>
                    <th scope="row" >
                    <select class="form-control" id="nameList" style="width:150px;">
                        ${options}
                    </select>
                    </th>
                        
                    
                    <td> <input id="scoreInput" style="min-width:20px;" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"></td>
                    <td> <input id="dateInput" style="width:150px;"  type="date" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"></td>
                    <td>
                        <a style="color:green;"  
                        onclick="submitScore($('#nameList').val(), $('#scoreInput').val(), $('#dateInput').val())"
                        >Add</a>
                    </td>
                    <td><a onclick="return cancel();">
                        Cancel</a>
                    </td>
                </tr>`
            );
            
        }

        //Submit New Score
        async function submitScore(id, score, date){
            console.log(id + 'TESTING');
            await $.post('php/functions.php', {
                act: 'setScore', 
                id: id,
                score: score,
                date: date,
                course_name: $("#courseTitle").html()
                }, function(data){
                    console.log(data);
                    
                }, 'json');
            $("#addScoreButton").prop('disabled', false);
            $("#addGolferButton").prop('disabled', false);
            getScores($("#courseTitle").html());
        }




        //--------------------DELETE SCORE---------------------//

        function deleteScore(id){
            $.post('php/functions.php', {
                act: 'deleteScore',
                id: id 
                }, function(data){                   
                }, 'json');
            getScores($("#courseTitle").html());
        }


        //--------------------EDIT SCORE---------------------//



        async function editScore(id, name){
            console.log(name);
            let options;

            await $.post('php/functions.php', {
                act: 'getGolfers'
                }, function(data){
                    console.log(data);
                    for(i=0; i<data.length; i++){
                        //Add all the scores
                        console.log("Name: "+data[i]["name"] + ' ');
                        if(data[i]["name"] == name){
                            
                            options += 
                                "<option value='" + data[i]['id'] + " ' selected>" + data[i]['name'] + "</option>";
                        }else{
                            options += 
                                "<option value='" + data[i]['id'] + " '>" + data[i]['name'] + "</option>";
                        }
                    }

                }, 'json');

            await $.post('php/functions.php', {
                act: 'getScores', 
                course: $('#courseTitle').html()
                }, function(data){
                    console.log(data);
                    console.log(data.length);
                    $('#tableBody').html("");
                    console.log("ID " + id);
                    for(i=0; i<data.length; i++){
                        //Add all the scores
                        console.log(data[i]['score_id']);
                        if(data[i]['score_id'] == id){
                            $('#tableBody').prepend(
                                `<tr>
                                    <th scope="row" >
                                    <select class="form-control" id="nameList" style="width:150px;">
                                        ${options}
                                    </select>
                                    </th>
                                        
                                    
                                    <td> <input id="scoreInput" value="${data[i]['score']}" style="min-width:20px;" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"></td>
                                    <td> <input id="dateInput" value="${data[i]['date']}"style="width:150px;"  type="date" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"></td>
                                    <td>
                                        <a style="color:green;"  
                                        onclick="return submitEdit(${data[i]['score_id']}, $('#nameList').val(), $('#scoreInput').val(), $('#dateInput').val());"
                                        >Save</a>
                                    </td>
                                    <td><a onclick="return cancel();">
                                        Cancel</a>
                                    </td>
                                </tr>`
                            );
                        }else{
                            $('#tableBody').prepend(
                                
                                `<tr>
                                    <th scope="row">${data[i]['golfer_name']}</th>
                                    <td>${data[i]['score']}</td>
                                    <td>${data[i]['date']}</td>
                                    <td>
                                        <a onclick="return editScore(${data[i]['score_id']}, '${data[i]['golfer_name']}' );">Edit</a>
                                    </td>
                                    <td>
                                        <a style="color:red;" onclick="return deleteScore(${data[i]['score_id']});">Delete</a>
                                    </td>
                                </tr>`
                            );
                        }
                    }
                }, 'json');

            
        }


        function submitEdit(score_id, golfer_id, score, date){
            // deleteScore(score_id);
            // submitScore(golfer_id, score, date);
            $.post('php/functions.php', {
                act: 'editScore',
                score_id: score_id,
                golfer_id: golfer_id,
                score: score,
                date: date,
                course_name: $("#courseTitle").html()
                }, function(data){                   
                }, 'json');
            getScores($("#courseTitle").html());
        }


        //Retrieve first 10 course locations
        function getOGLocations(){
            $.post('php/functions.php', {
                act: 'getOGLocations' 
                }, function(data){
                    console.log(data);
                    for(i=0; i<data.length; i++){
                        console.log(data[i]);
                        let lat = parseFloat(data[i]["latitude"]);
                        let long = parseFloat(data[i]["longitude"]);
                        let location = new Microsoft.Maps.Location(lat, long);
                        console.log(`<a onclick="getScores('${data[i]['course_name']}')}"> `);
                        let pin = new Microsoft.Maps.Pushpin(location, {title: data[i]['course_name']});
                        pin.metadata = {
                            description: `<a style='color:blue;' onclick="getScores('${data[i]['course_name']}')"> ${data[i]['course_name']} </a> 
                            <br> ${data[i]['address']} <br> <a href='${data[i]['website']}' target='_blank'>Visit their website</a>`
                            
                        };
                        Microsoft.Maps.Events.addHandler(pin, 'click', pushpinClicked);
                        map.entities.push(pin);
                        
                    }

                }, 'json');
                
        }


            //Search for courses

            function submitClicked(event){
                event.preventDefault()
                let unencodedLoc = document.getElementById("locationLookUp").value;
                let loc = encodeURI(unencodedLoc);
                let url1 = `http://dev.virtualearth.net/REST/v1/Locations/${loc}%20golf%20course?o=&key=Ai65CY4gKwZno3n8tBErzqZzy5J3HlkcgrxXbsw5mWJnLel2CiKSlmzal-lAhL50`;
                //First call to get the co-ordinates of the location
                $.get(url1, 
                    function (data) {
                        console.log(data.resourceSets[0]);
                        let latitude = data.resourceSets[0].resources[0].geocodePoints[0].coordinates[0];
                        let longitude = data.resourceSets[0].resources[0].geocodePoints[0].coordinates[1];
                        var location = new Microsoft.Maps.Location(
                            latitude,
                            longitude
                        );
                        //Center Map at new location
                        map.setView({
                            center: location
                        });
                        //Get local golf courses
                        let url2 = `https://dev.virtualearth.net/REST/v1/LocalSearch/?query=golf&userLocation=${latitude},${longitude}&key=Ai65CY4gKwZno3n8tBErzqZzy5J3HlkcgrxXbsw5mWJnLel2CiKSlmzal-lAhL50`;
                        $.get(url2, 
                            function (data2) {
                                let ds = data2.resourceSets[0];
                        
                                for(i=0; i<ds.resources.length;i++){
                                    console.log(ds.resources[i]);
                                    let latitude2 = ds.resources[i].geocodePoints[0].coordinates[0];
                                    let longitude2 = ds.resources[i].geocodePoints[0].coordinates[1];
                                    var location2 = new Microsoft.Maps.Location(
                                        latitude2,
                                        longitude2
                                    );
                                    var pin = new Microsoft.Maps.Pushpin(location2, {title: ds.resources[i].name});

                                    pin.metadata = {
                                        description: `<a id="course_name" style='color:blue;' onclick="getScores('${ds.resources[i].name}')"> ${ds.resources[i].name} </a> 
                                        <br> ${ds.resources[i].Address.formattedAddress}  <br>  <a href='${ds.resources[i].Website}' target='_blank'>Visit their website</a>`
                                        
                                    };

                                    Microsoft.Maps.Events.addHandler(pin, 'click', pushpinClicked);
                                    map.entities.push(pin);
                                }
                            }, 'json');
                        }
                , 'json');

            }

            //-------------------------PUSHPIN CLICKED-----------------------------//
            function pushpinClicked(e) {
                if (e.target.metadata) {
                    infobox.setOptions({
                        description: e.target.metadata.description,
                        location: e.target.getLocation(),
                        visible: true
                    });
                    console.log(e.target.metadata.description);
                    let directionsLink = document.getElementsByClassName("directions");
                }
                map.setView({
                    center: e.target.getLocation()
                });

            }
            //-------------------------------NEW GEOCODE QUERY-----------------------//


            let geocodeQuery = (query) => {
            //Check to see if search manager exists
            if (!searchManager) {
                Microsoft.Maps.loadModule('Microsoft.Maps.Search', () => {
                    searchManager = new Microsoft.Maps.Search.SearchManager(map);
                    geocodeQuery(query);
                })
            } else {
                var searchRequest = {
                    where: query,
                    callback: (r) => {
                        //Add the first result to the map and zoom into it.
                        if (r && r.results && r.results.length > 0) {

                            // add a pushpin to the map at the location supplied
                            // in the results
                            console.log("BEST VIEW: " + r.results[0].bestView);
                            this.retrievedLocation = r.results[0].location;
                            var pin = new Microsoft.Maps.Pushpin(r.results[0].location);
                            map.entities.push(pin);

                            // set the view of the map to the best view based 
                            // on the result
                            map.setView({
                                bounds: r.results[0].bestView
                            });
                        }
                    },
                    errorCallback: (e) => {
                        alert("No results found.");
                    }
                };
                //Make the geocode request.
                searchManager.geocode(searchRequest);
            }
            console.log( query);
        }
    </script>
    <script type='text/javascript'
        src='https://www.bing.com/api/maps/mapcontrol?key=Ai65CY4gKwZno3n8tBErzqZzy5J3HlkcgrxXbsw5mWJnLel2CiKSlmzal-lAhL50&callback=loadMapScenario'
        async defer>
    </script>
    
</body>
</html>
