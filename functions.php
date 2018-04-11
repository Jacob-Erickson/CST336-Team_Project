<?php

    function addend(&$code, $check)
    {
        if($check)
        {
            $code .= " AND ";
        }
    }
    
    function displayResults() {
    
    global $vacation_master_db;
    
            $sql = "SELECT * FROM event NATURAL JOIN package NATURAL JOIN activity NATURAL JOIN lodge NATURAL JOIN category WHERE ";
            
            $all = true;
            
            $check = false;
            
            if(isset($_GET['minDays']) && $_GET['minDays'] != "")
            {
                $all = false;
                $sql .= "event_end_date - event_start_date ";
                if(isset($_GET['maxDays']) && $_GET['maxDays'] != "")
                {
                    $sql .= "BETWEEN ";
                    $sql .= $_GET['minDays'];
                    $sql .= " AND ";
                    $sql .= $_GET['maxDays'];
                }
                else
                {
                    $sql .= ">= " . $_GET['minDays'];
                }
                $check = true;
            }
            else if(isset($_GET['maxDays']) && $_GET['maxDays'] != "")
            {
                $all = false;
                $sql .= "event_end_date - event_start_date <= " . $_GET['maxDays'];
                $check = true;
            }
            
            if(isset($_GET['minPrice']) && $_GET['minPrice'] != "")
            {
                $all = false;
                addend($sql, $check);
                $sql .= "price_per_person ";
                if(!empty($_GET['maxPrice']))
                {
                    $sql .= "BETWEEN ";
                    $sql .= $_GET['minPrice'];
                    $sql .= " AND ";
                    $sql .= $_GET['maxPrice'];
                }
                else
                {
                    $sql .= ">= " . $_GET['minPrice'];
                }
                $check = true;
            }
            else if(isset($_GET['maxPrice']) && $_GET['maxPrice'] != "")
            {
                $all = false;
                addend($sql, $check);
                $sql .= "price_per_person <= " . $_GET['maxPrice'];
                $check = true;
            }
            
            if(isset($_GET['activity']) && $_GET['activity'] != "")
            {
                $all = false;
                addend($sql, $check);
                $sql .= "category_name LIKE \"%" . str_replace("+", " ", $_GET['activity']) . "%\"";
            }
            
            if(isset($_GET['sort'])) {
                
                if($_GET['sort'] == 'Price') {
                    
                    $sql .= " ORDER BY price_per_person "; 
                    
                    
                }else if($_GET['sort'] == 'Date') {
                    $sql .= " ORDER BY event_start_date ";
                    
                }
            }
            
            if($all)
            {
                $sql .= "1;";
            }
            else
            {
                $sql .= ";";
            }
            
            $execute = true;
            if(($_GET['minDays'] > $_GET['maxDays']) && ($_GET['minDays'] != "") && ($_GET['maxDays'] != ""))
            {
                echo "<h4> Select a minumum day that is smaller than the maximum day</h4>";
                $execute = false;
            }
                
            if(($_GET['minPrice'] > $_GET['maxPrice']) && ($_GET['minPrice'] != "") && ($_GET['maxPrice'] != ""))
            {
                echo "<h4> Select a minumum price that is smaller than the maximum price</h4>";
                $execute = false;
            }
            
            if($execute)
            {
                $stmt = $vacation_master_db->prepare($sql);
                $stmt->execute($namedParameters);
                $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo "<h1>";
                echo "Here are your results: ";
                echo "</h1>";
                echo "<table>";
                
                
                if(empty($records))
                {
                    echo "<h2> Sorry there was no entries found for your criteria </h2>";
                }
                
                else
                {
                    echo "<table>";
                    foreach ($records as $record)
                    {
                        echo "<tr>
                        <td>Starts:<br />".$record["event_start_date"]."</td>
                        <td>Ends:<br />".$record["event_end_date"]."</td>
                        <td>$".$record["price_per_person"]."</td>
                        <td>".$record["activity_name"]."<br />(" . $record['event_subname'].")</td>
                        <td>".$record["activity_description"]."</td>
                        <td>".$record["package_name"]."</td>
                        <td>".$record["package_description"]."</td>
                        <td>
                        <form>
                        <input type='hidden' name='add' value='".$record['event_id']."'/>
                        <input type='submit' class='btn btn-success btn-xlarge' value = 'Add to cart'/>
                        </form>
                        </td>
                        <td>
                        <form>
                        <input type='hidden' name='further_info_about' value='".$record['event_id']."'/>
                        <input type='submit' class='btn btn-success btn-xlarge' value = 'Learn More'/>
                        </form>
                        </td>
                        </tr> ";
                    }
                    echo "</table>";
                    
                }
            }
       }
?>