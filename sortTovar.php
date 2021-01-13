<?php include "header.php" ?>
<h1>Sort Tovars</h1>
<table border="1">
  <tr >
    <th>ID</th>
    <th>Name</th>
    <th>Length
      <select name="Sort_length">
        <option value="0" onclick="location='admin.php?action=sortTovar&amp;tovarsizesort=50&amp;Parametr=Length'">
        <50
        </option>
        <option value="1" onclick="location='admin.php?action=sortTovar&amp;tovarsizesort=150&amp;Parametr=Length'">
        <150
        </option>
        <option value="2" onclick="location='admin.php?action=sortTovar&amp;tovarsizesort=350&amp;Parametr=Length'">
        <350
        </option>
      </select>
    </th>
    <th>Width
      <select name="Sort_width">
        <option value="0" onclick="location='admin.php?action=sortTovar&amp;tovarsizesort=50&amp;Parametr=Width'">
        <50
        </option>
        <option value="1" onclick="location='admin.php?action=sortTovar&amp;tovarsizesort=150&amp;Parametr=Width'">
        <150
        </option>
        <option value="2" onclick="location='admin.php?action=sortTovar&amp;tovarsizesort=350&amp;Parametr=Width'">
        <350
        </option>
      </select>
    </th>
    <th>Height
      <select name="Sort_height">
        <option value="0" onclick="location='admin.php?action=sortTovar&amp;tovarsizesort=50&amp;Parametr=height'">
        <50
        </option>
        <option value="1" onclick="location='admin.php?action=sortTovar&amp;tovarsizesort=150&amp;Parametr=height'">
        <150
        </option>
        <option value="2" onclick="location='admin.php?action=sortTovar&amp;tovarsizesort=350&amp;Parametr=height'">
        <350
        </option>
      </select>
    </th>
    <th>Cost
      <select name="Sort_cost">
      rthtr
        <option value="0" onclick="location='admin.php?action=sortTovar&amp;tovarsizesort=500&amp;Parametr=cost'">
        <500
        </option>
        <option value="1" onclick="location='admin.php?action=sortTovar&amp;tovarsizesort=1500&amp;Parametr=cost'">
        <1500
        </option>
        <option value="2" onclick="location='admin.php?action=sortTovar&amp;tovarsizesort=3500&amp;Parametr=cost'">
        <3500
        </option>
      </select>
    </th>
    </tr>
    <?php 
      foreach ( $sorttovarid as $sortid) { 
        foreach ( $arr['tovar']['results'] as $tovar ) {  
          if ((int) $tovar->id ==  $sortid) { 
    ?>
      <tr onclick="location='admin.php?action=editTovar&amp;tovarId=9'">
        <td>
          <?php      
            if(isset ($tovar->id)) {
              echo $tovar->id;                        
            } 
          ?>
        </td>
        <td>
          <?php 
            if(isset ($tovar->Name)) {
              echo  $tovar->Name; 
            } else {
              echo "Без name";
            }
            ?>
        </td>
        <td>
          <?php 
            if(isset ($tovar->Length)) {
              echo  $tovar->Length; 
            } else {
                echo "Без Length";
              }
          ?>
        </td>
        <td>
          <?php 
            if(isset ($tovar->Width)) {
              echo  $tovar->Width; 
            } else {
                echo "Без Width";
              }
          ?>
        </td>
        <td>
          <?php 
            if(isset ($tovar->height)) {
              echo  $tovar->height; 
            } else {
                echo "Без height";
              }
          ?>
        </td>
        <td>
          <?php 
            if(isset ($tovar->cost)) {
              echo  $tovar->cost; 
            } else {
                echo "Без cost";
              }
          ?>
        </td>
      </tr>
    </tr>
    <?php } } } ?>
  </table>
<!-- <p><?php echo $results['totalRows']?> tovar<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?>vsego tovarov.</p> -->
  <p><a href="admin.php?action=newTovar">Add a New Tovar</a></p>

