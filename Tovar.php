<?php
  // Klass dlya obrabotki tovarov
  class Tovar {
    // Svoistva
    public $id = null;
    public $Name = null;
    public $Length = null;
    public $Width = null;
    public $height = null;
    public $cost = null;
    public $sort = null;

    public function __construct($data=array())  {
      if (isset($data['id'])) {
        $this->id = (int) $data['id'];
      }

      if (isset( $data['Name'])) {
        $this->Name= (string) $data['Name'];     
      }

      if (isset($data['Length'])) {
        $this->Length = $data['Length'];        
      }

      if (isset($data['Width'])) {
        $this->Width = (int) $data['Width'];      
      }

      if (isset($data['height'])) {
        $this->height = (int) $data['height'];      
      }

      if (isset($data['cost'])) {
        $this->cost = $data['cost'];         
      }

      if (isset($data['sort'])) {
        $this->cost = $data['sort'];         
      }          
    }
  // Zapis' v svoistva
  public function storeFormValues ( $params ) {
    //var_dump( $params); die();
    $this->__construct( $params );
  }

  public static function getTovarById ($id) {
    $conn = new PDO( "mysql:host=localhost;dbname=store;charset=utf8;","root","");
    $sql = "SELECT * FROM articles WHERE id = :id";
    $st = $conn->prepare($sql);
    $st->bindValue(":id", $id, PDO::PARAM_INT);
    $st->execute();       
    $row = $st->fetch();
    // var_dump($row); die();
    $conn = null;       
    if ($row) { 
      return new Tovar($row);
    }    
  } 

  public static function getListTovar($numRows=1000000, 
    $categoryId=null, $order="publicationDate DESC") {
    $conn = new PDO( "mysql:host=localhost;dbname=store;charset=utf8;","root","");
    $sql = "SELECT * FROM articles";   
    $st = $conn->prepare($sql);
    $st->execute(); 
    $list = array();
      while ($row = $st->fetch()) {
        $article = new Tovar($row);
        $list[] = $article;
      }
    // var_dump($list);die();
    // Получаем общее количество товара, которые соответствуют критерию
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query($sql)->fetch();
    $conn = null;      
    return (array(
      "results" => $list, 
      "totalRows" => $totalRows[0]
      ) 
    );
  }

  public function insert() {
    // Вставляем товар
    $conn = new PDO( "mysql:host=localhost;dbname=store;charset=utf8;","root","");
    $sql = "INSERT INTO articles (Name, Length, Width, height, cost) VALUES (:Name, :Length ,:Width, :height, :cost)";
    $st = $conn->prepare ($sql);
    $st->bindValue( ":Name", $this->Name, PDO::PARAM_STR );
    $st->bindValue( ":Length", $this->Length, PDO::PARAM_INT );
    $st->bindValue( ":Width", $this->Width, PDO::PARAM_INT );
    $st->bindValue( ":height", $this->height, PDO::PARAM_INT );
    $st->bindValue( ":cost", $this->cost, PDO::PARAM_INT);       
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }


  public function update() {
    $conn = new PDO( "mysql:host=localhost;dbname=store;charset=utf8;","root","");
    $sql = "UPDATE articles SET 
    Name=:Name, Length=:Length, Width=:Width, height=:height,cost=:cost WHERE id = :id";      
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":Name", $this->Name, PDO::PARAM_STR );
    $st->bindValue( ":Length", $this->Length, PDO::PARAM_INT );
    $st->bindValue( ":Width", $this->Width, PDO::PARAM_INT );
    $st->bindValue( ":height", $this->height, PDO::PARAM_INT );
    $st->bindValue( ":cost", $this->cost, PDO::PARAM_INT ); 
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

  public function delete() {
    $conn = new PDO( "mysql:host=localhost;dbname=store;charset=utf8;","root","");
    $st = $conn->prepare ( "DELETE FROM articles WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

  public static function  sortTovar ( ) {
    //$a=$_GET['Parametr'];
    // var_dump($_GET );die();
    // $str = $_GET['Parametr'];
    // $str = str_replace('"', '', $str);
    //echo $str;die();
    // var_dump($tovarsizesort);die();
    $a=$_GET['Parametr'];
    //$str = str_replace('"', '', $a);
    $conn = new PDO( "mysql:host=localhost;dbname=store;charset=utf8;","root","" );
    $sql = "SELECT IF("."$a"."<:Sort, id, 0) FROM articles;";
    $st = $conn->prepare ( $sql );
    //var_dump($st);die();
    $st->bindValue( ":Sort", $_GET['tovarsizesort'], PDO::PARAM_INT );
    $st->execute();
    $array = $st->fetchAll(PDO::FETCH_ASSOC);
    $conn = null; 
    // var_dump($array); die();
    $sortlistid =array ();
    // $key ="IF('".$_GET['Parametr']."'<".$tovarsizesort.", id, 0)";
    //var_dump($key); die();
    foreach ($array as $key => $value) {
      //echo $key;
      // var_dump($value) ;
      //  'IF( 'Length'<50, id, 0)'
      foreach ($value as $key => $strid) {
        //  var_dump( (int) $strid) ;
        if ( (int) $strid != 0 ) {
          $sortlistid [] = (int) $strid; 
        }
      }
    }
    // var_dump($sortlistid);
    return $sortlistid;
  }

  }