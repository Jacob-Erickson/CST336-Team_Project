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
                    //echo the event information here in place of the foreach loop below
                    echo "<td>";
                    echo $event['package_name'];
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