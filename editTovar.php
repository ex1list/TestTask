  <?php include "header.php" ?>
  <h1 class="hedittovar"><?php echo $results['pageTitle']?></h1>
  <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">
    <table class="edittable" border="1">
      <tr >
        <td class="rtw">
          id
        </td>  
        <td class="rtw">
          <input type="text" name="tovarId" value="<?php echo $data->id ?>">
        </td>   
      </tr>      
      <tr >
        <td class="rtw">
          Name 
        </td>
        <td>
          <input type="text" name="Name" id="title" placeholder="Name of Tovar" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $data->Name )?>" />
        </td>    
      </tr>
      <tr>
        <td>
          Length
        </td>
        <td>
          <input type="text" name="Length" id="title" placeholder="Length of Tovar" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $data->Length )?>" />
        </td>
      </tr>
      <tr>
        <td> 
          Width 
        </td>
        <td>
          <input type="text" name="Width" id="title" placeholder="Width of Tovar" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $data->Width )?>" />
        </td>
      </tr>
      <tr>
        <td>height  </td>
        <td>
          <input type="text" name="height" id="title" placeholder="height of Tovar" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $data->height)?>" />
        </td>
      </tr>
      <tr>
        <td>cost</td>
        <td>
        <input type="text" name="cost" id="title" placeholder="Name of Tovar" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $data->cost)?>" />
        </td>
      </tr>
      <tr align="center">
        <td >
          <div class="buttons">
          <input type="submit" name="saveChanges" value="Save Changes" />
        </td>
        <td>
           <input type="submit" formnovalidate name="cancel" value="Cancel" />
          </div>
        </td>
      </tr>
    </table>
  </form>
  <?php if ($data->id) { ?>
    <p>
    <a href="admin.php?action=deleteTovar&amp;tovarId=<?php echo $data->id ?>" onclick="return confirm('Delete This Tovar?')">
      Delete This Tovar
    </a>
    </p>
  <?php } ?>



              