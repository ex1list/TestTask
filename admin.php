<?php
  // otkrivaem sessiy
  session_start();
  // var_dump($_GET); die();
  require("Tovar.php");
  $action = isset($_GET['action']) ? $_GET['action'] : "";
  // var_dump($action);die();

  switch ($action) {
    case 'newTovar':
        newTovar();
         break;
    case 'editTovar':
        editTovar();
        break;
    case 'deleteTovar':
        deleteTovar();
        break;
    case 'sortTovar':
        sortTovar();
        break;       
    default:
        listTovar();
  }   

// Novii tovar  
  function newTovar() {
    $results = array();
    $results['pageTitle'] = "New Tovar";
    $results['formAction'] = "newTovar";   
    if ( isset( $_POST['saveChanges'] ) ) {
      $article = new Tovar();
      $article->storeFormValues( $_POST );          
      $article->insert();
      header( "Location: admin.php?status=changesSaved" );
    } elseif ( isset( $_POST['cancel'] ) ) {
        header( "Location: admin.php" );
      } else {
        $data = new Tovar;
        require("editTovar.php");    
        }
  }
// Vivod tovarov
  function listTovar() {
    $results = array();  
    // вывод всего товара 
    $data = Tovar::getListTovar();
    // var_dump($data); die();
    $arr['tovar'] = $data; 
    // var_dump($results['tovar']); die();
    // вывод количества  товара 
    $arr['totalRows'] = $data;
    require("listTovar.php");
  }

// Redaktirovanie tovarov
  function editTovar() {    
    $results = array();
    $results['pageTitle'] = "Edit Tovar";
    $results['formAction'] = "editTovar";
    if (isset($_POST['saveChanges'])) {   
      if ( !$tovar = Tovar::getTovarById( (int)$_POST['tovarId'] ) ) {
        header( "Location: admin.php?error=TovarNotFound" );
        return;
      }       
      $tovar->storeFormValues( $_POST );
      $tovar->update();
      header( "Location: admin.php?status=changesSaved" );
    } elseif ( isset( $_POST['cancel'] ) ) {
        header( "Location: admin.php" );
      } else {
          // dannie o tovare s opredelennim id
          $data = Tovar::getTovarById((int)$_GET['tovarId']);     
          //var_dump( $data );die();
          require("editTovar.php");
        }      
  }
// Ydalenie tovarov
  function deleteTovar() {
    $data = Tovar::getTovarById((int)$_GET['tovarId']);
    $data->delete();
    header( "Location: admin.php" );
}
// Sortirovka tovarov
  function sortTovar() {
    $sorttovarid= array ();
    // var_dump($_GET );die();
    // var_dump($_GET['tovarsizesort']);die();
    //  var_dump($_GET['Parametr']);die();
    // var_dump( (int) $_GET['tovarsizesort']);die();
    $sorttovarid= Tovar::sortTovar( );
    // var_dump($sorttovarid);die();
    $results = array();  
    // vivod vsego tovara
    $data = Tovar::getListTovar();
    //var_dump($data); die();
    $arr['tovar'] = $data; 
    // var_dump($results['tovar']); die();
    // vivod kolichestva tovara
    //$arr['totalRows'] = $data;
    require("sortTovar.php");
}