<?php

    //Put session handling here
    if(!isset($_SESSION['shoppingCart'])){
        $_SESSION['shoppingCart'] = array();
    }
    
    
    //Put database handling here
    $vacation_master_db = getDatabaseConnection("vacationMaster");
    
    function getDatabaseConnection($dbName) 
    {
        //checks whether the URL contains "herokuapp" (using Heroku)
        if(strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
           $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
           $host = $url["host"];
           $dbname = substr($url["path"], 1);
           $username = $url["user"];
           $password = $url["pass"];
        }
        else
        {
            $host = "localhost";
            $username = "web_user";
            $password = "s3cr3t";
        }
        
        $dbConn = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
        $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $dbConn;
    
    }
    
    function getCodeResults($code, $database)
    {
        $result = $database->prepare($code);
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return($result);
    }
    
    function displayCategories($conn)
    {
        $sql = "SELECT * FROM `category`";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($records);
        
        foreach ($records as $record) {
            
            echo "<option value='".$record["category_name"]."' >" . $record["category_name"] . "</option>";
            
        }
        
    }
    
    $everything = "SELECT * 
                FROM event 
                NATURAL JOIN package  
                NATURAL JOIN activity 
                NATURAL JOIN lodge
                NATURAL JOIN category;";
                
    $everything = getCodeResults($everything, $vacation_master_db);
    
    if(isset($_GET['add']))
    {
        array_push($_SESSION['shoppingCart'], $_GET['add']);
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title> -------- Catalog </title>
        <style type="text/css">
            @import url("styles.css");
        </style>
    </head>
    <body>
        
        <header>
            
        </header>
        
        <main>
            
            <?php
            
                if(empty($_GET))//begining of if statement, allows form to be hidden when showing further info
                {
            
            ?>
            <div id="criteria">
                <!-- Put the form and search criteria here -->
                <form method = "GET">
                <h4> Filter days wanted: </h4>
                Mininmum:<input type = "number" min = "1" max = "10" name = "minDays"/> Maximum: <input type ="number" min = "1" max = "10" name ="maxDays"/>
                </br></br>
                <h4>Filter activities available:</h4>
                <select name = "activity">
                    <option value="">Select</option>
                    <?= displayCategories($vacation_master_db) ?>
                </select>
                </br></br>    
                <h4>Filter by price:</h4>
                 Mininmum:<input type = "number" min = "100" max = "10000" name = "minDays"/> Maximum: <input type ="number" min = "100" max = "10000" name ="maxDays"/>
                 </br></br>
                 <h4> Sort by: </h4>
                Price: <input type = "radio" name = "Price" value = "Price"> 
                Date: <input type = "radio" name = "Date" value = "Date">
                </br>
                <h4>Generate your results:</h4>
                 
                <input type="submit" id= "button" value="Results"/>
        </form>
            </div>
            
            <?php
            
                }//end of if statement
                else if(isset($_GET['further_info_about']))//beginning of else if statement, shows further info when button clicked
                {
            
            ?>
            
            <div id="further">
                
                <?php
                
                    foreach ($everything as $value)
                    {
                        if($_GET['further_info_about'] == $value['event_id'])
                        {
                            echo "<h1>";
                            echo $value['package_name'];
                            echo " (";
                            echo $value['event_subname'];
                            echo ")";
                            echo "</h1>";
                            
                            echo "<hr />";
                            
                            echo "<div id='item info'>";
                            
                            echo "<h2>";
                            echo $value['activity_name'];
                            echo "</h2>";
                            
                            echo "<h3>";
                            echo "Activity: ";
                            echo $value['category_name'];
                            echo "</h3>";
                            
                            echo "<p>";
                            echo $value['activity_description'];
                            
                            echo "<img style='max-width: 20%;' src='";
                            echo $value['activity_image'];
                            echo "' />";
                            
                            echo "</p>";
                            
                            echo "<p>";
                            echo "<strong>";
                            echo "Location: ";
                            echo "</strong>";
                            echo $value['activity_location'];
                            echo "</p>";
                            
                            echo "<p>";
                            echo "<strong>";
                            echo "Minimum number of people: ";
                            echo "</strong>";
                            echo $value['package_minimum'];
                            echo "</p>";
                            
                            echo "<p>";
                            echo "<strong>";
                            echo "Maximum number of people: ";
                            echo "</strong>";
                            echo $value['package_maximum'];
                            echo "</p>";
                            
                            echo "</div>";
                            
                            echo "<hr />";
                            
                            echo "<div id='lodge info'>";
                            
                            echo "<h2>";
                            echo "Lodging: ";
                            echo $value['lodge_name'];
                            echo "</h2>";
                            
                            echo "<p>";
                            echo $value['lodge_description'];
                            
                            echo "<img style='max-width: 20%;' src='";
                            echo $value['lodge_image'];
                            echo "' />";
                            
                            echo "</p>";
                            
                            echo "<strong>";
                            echo "Location; ";
                            echo "</strong>";
                            echo $value['lodge_address'];
                            
                            echo "</div>";
                        }
                    }
                
                ?>
                
            </div>
            
            <?php
            
                }//end of else if
                else//beginning of else statement, shows the results
                {
                    
            ?>
            
            <div id="results">
                
                <form>
                    <input type='hidden' name='add' value='2'/>
                    <input type='submit' value = 'submit'/>
                </form> 
                
                <?php
                    foreach($_SESSION['shoppingCart'] as $value){
                        echo $value;
                        echo "<br>";
                    }
                    //loop through to show the results here
                    foreach ($everything as $value)
                    {
                        echo "<form method='get'>";
                        echo "<button name='further_info_about' value=";
                        echo $value['event_id'];
                        echo ">";
                        echo "Get more info";
                        echo "</button>";
                        echo "</form>";
                    }
                
                ?>
                
            </div>
            
            <?php
            
                }//end of else statement
            
            ?>
            
        </main>
        
        <footer>
            
        </footer>

    </body>
</html>