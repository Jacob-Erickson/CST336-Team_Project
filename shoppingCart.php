<?php

    function displayCart()
    {
        global $everything;
        
        echo "<table>";
        
        foreach ($_SESSION['shoppingCart'] as $item)
        {

            echo "<tr style='border: solid;'>";
            
            foreach ($everything as $event)
            {
                if($item == $event['event_id'])
                {
                    
                    $dollars = "$";

                    echo "<td>";
                    echo "<strong>Package Name: </strong>";
                    echo $event['package_name'];
                    echo "</td>";
                    
                    echo "<td>";
                    echo "<strong>Package Description: </strong>";
                    echo $event['package_description'];
                    echo "</td>";
                    
                    echo "<td>";
                    echo "<strong>Lodge Name: </strong>";
                    echo $event['lodge_name'];
                    echo "</td>";
                    
                    echo "<td>";
                    echo "<strong>Lodge Description : </strong>";
                    echo $event['lodge_description'];
                    echo "</td>";
                    
                    echo "<td>";
                    echo "<strong>Start Date: </strong>";
                    echo $event['event_start_date'];
                    echo "</td>";
                    
                    echo "<td>";
                    echo "<strong>End Date: </strong>";
                    echo $event['event_end_date'];
                    echo "</td>";
                    
                    echo "<td>";
                    echo "<strong>Price Per Person: </strong>";
                    echo $dollars;
                    echo $event['price_per_person'];
                    echo "</td>";
                    
                    
                    /*
                    foreach ($event as $key => $value)//example, prints out everything about the item but without any formatting
                    {
                        echo "<td style='border: solid;'>";
                        echo $key;
                        echo "<br />";
                        echo $value;
                        echo "</td>";
                    }
                    */
                }
            }
            
            echo "<tr>";
        }
        
        echo "</table>";
    }

?>