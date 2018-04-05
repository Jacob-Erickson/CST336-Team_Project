<?php

    //Put session handling here
    
    $holder = array("hello", "goodbye", "hola", "adios");
    
    //Put database handling here

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
            
                if(!empty($_GET))//begining of if statement, allows form to be hidden when showing further info
                {
            
            ?>
            <div id="criteria">
                <!-- Put the form and search criteria here -->
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