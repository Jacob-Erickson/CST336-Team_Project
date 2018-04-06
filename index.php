<?php

    //Put session handling here
    
    $holder = array("hello", "goodbye", "hola", "adios");
    
    //Put database handling here
    include '../rbradley/dbConnection.php';
    
    $conn = getDatabaseConnection('vacationMaster');
    
    function displayCategories(){
        global $conn;
        
        $sql = "SELECT * FROM `category`";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($records);
        
        foreach ($records as $record) {
            
            echo "<option value='".$record["category_name"]."' >" . $record["category_name"] . "</option>";
            
        }
        
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
                    <?= displayCategories() ?>
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
                
            </div>
            
            <?php
            
                }//end if else if
                else//beginning of else statement, shows the results
                {
                    
            ?>
            
            <div id="results">
                
                <?php
                
                    //loop through to show the results here
                
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