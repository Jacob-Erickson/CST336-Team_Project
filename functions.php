<?php
    
    function displayResults() {
    
    global $vacation_master_db;
    
    //checks if user submits the form(clicks search)
       if (isset($_GET['submit'])) { //checks whether user has submitted the form
            echo "<h3>Vacations Found: </h3>"; 
            
            //following sql works but it DOES NOT prevent SQL Injection
            //$sql = "SELECT * FROM om_product WHERE 1
            //       AND productName LIKE '%".$_GET['product']."%'";
            
            //Query below prevents SQL Injection
            
            $namedParameters = array();
            
            $sql = "SELECT * FROM event NATURAL JOIN package NATURAL JOIN activity NATURAL JOIN lodge NATURAL JOIN category WHERE 1 ";
            
            if($_GET['minDays'] > $_GET['maxDays']) {
                echo "<h4> Select a minumum day that is smaller than the maximum day</h4>";
            }
            if($_GET['minPrice'] > $_GET['maxPrice']) {
                echo "<h4> Select a minumum price that is smaller than the maximum price</h4>";
            }
            
            if(!empty($_GET['minDays']) && !empty($_GET['maxDays']) ) {
                $sql .= " AND event_end_date - event_start_date BETWEEN :minDays AND :maxDays";
                $namedParameters[":minDays"] = $_GET['minDays'];
                $namedParameters[":maxDays"] = $_GET['maxDays'];
                
            }
            
            if(!empty($_GET['minPrice'])) {
                $sql.= " AND price_per_person <= :minPrice ";
                $namedParameters[":minPrice"] = $_GET["minPrice"];
                
            }
            
            if(!empty($_GET['maxPrice'])){
                $sql .= " AND price_per_person >= :maxPrice ";
                $namedParameters[":maxPrice"] = $_GET['maxPrice'];
                
            }
        
            
            if(isset($_GET['sort'])) {
                
                if($_GET['sort'] == 'Price') {
                    
                    $sql .= " ORDER BY price_per_person "; 
                    
                    
                }else if($_GET['sort'] == 'Date') {
                    $sql .= " ORDER BY event_start_date ";
                    
                }
            }
            
            
             $stmt = $vacation_master_db->prepare($sql);
             $stmt->execute($namedParameters);
             $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "<table>
                  <tr>
                  <th>Event Start Date</th>
                  <th>Event End Date</th>
                  <th>Price Per Person</th>
                  <th>Activity Name</th>
                  <th>Activity Description</th>
                  <th>Lodge Name</th>
                  <th>Lodge Description</th>
                  <th>Package Name</th>
                  <th>Package Description</th>
                  </tr>";
            foreach ($records as $record) {
            
                echo "<tr>
                  <td>".$record["event_start_date"]."</td>
                  <td>".$record["event_end_date"]."</td>
                  <td>".$record["price_per_person"]."</td>
                  <td>".$record["activity_name"]."</td>
                  <td>".$record["activity_description"]."</td>
                  <td>".$record["lodge_name"]."</td>
                  <td>".$record["lodge_description"]."</td>
                  <td>".$record["package_name"]."</td>
                  <td>".$record["package_description"]."</td>
                  </tr> ";
            }
            echo "</table>";
        }
        
}
?>