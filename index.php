<?php

    //Put session handling here
    session_start();
    include "shoppingCart.php";
    
    if(!isset($_SESSION['shoppingCart'])){
        $_SESSION['shoppingCart'] = array();
    }
    
    //emptys shopping cart
    if(isset($_GET['empty_cart'])){
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
        <title> Vacation Master Catalog </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style type="text/css">
            @import url("styles.css");
        </style>
    </head>
    <body>
        
        <header>
            <!-- Bootstrap Navagation Bar -->
            <nav class='navbar navbar-default - navbar-fixed-top'>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                        <a class='navbar-brand' href='index.php'>Vacation Master</a>
                    </div>
                    <ul class='nav navbar-nav'>
                        <li><a href='index.php'>Home</a></li>
                        <li>
                            <form>
                                <input type="hidden" name="view_cart" value='true'/>
                                <button class='btn' value="Submit"> 
                                <i class='glyphicon glyphicon-shopping-cart' aria-hidden='true'>
                                </i>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <br /> <br /> <br />
        
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
                else if(isset($_GET['view_cart']))
                {
            ?>
            
            <div id='cart'>
                
                <!--<form>-->
                <!--    <input type ='hidden' value = 'true' name = 'empty_cart'/>-->
                <!--    <input type = 'submit' value = 'empty the cart'/>-->
                <!--</form>-->
                <?php
                
                    displayCart();
                
                ?>
                
                <form>
                    <input type ='hidden' value = 'true' name = 'empty_cart'/>
                    <input type = 'submit' value = 'empty the cart'/>
                </form>
                
            </div>
            
            <?php
                }//end of else if, shows cart contents
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
                            echo "<form>";
                            echo "<input type='hidden' name='add' value='";
                            echo $_GET['further_info_about'];
                            echo "' />";
                            echo "<input type='submit' value='Add to cart' />";
                            echo "</form>";
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
                
                    print_r($_SESSION['shoppingCart']);
                
                    //loop through to show the results here
                    foreach ($everything as $value)//this loop is a place holder
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