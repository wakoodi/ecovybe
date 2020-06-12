<?php

include_once( __DIR__ . '/Db.php');

class Garden {

    private $name;
    private $item;

    public function findGardens($currentUserId){
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM garden where user_id = :currentUserId' );
        $statement->bindValue( ':currentUserId', $currentUserId );
        $statement->execute();
        $result = $statement->fetchAll( PDO::FETCH_ASSOC );

        return $result;
    }

    public function findItem($gardenId){
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT items.* FROM items INNER JOIN garden ON garden.items_id = items.id WHERE garden.id = :gardenId' );
        $statement->bindValue( ':gardenId', (int)$gardenId );
        $statement->execute();
        $result = $statement->fetch( PDO::FETCH_ASSOC );

        return $result;
    }

    public function findAllItems(){
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT name FROM items' );
        $statement->execute();
        $allNames = $statement->fetchAll( PDO::FETCH_COLUMN );
        
        return $allNames;
    }

   public function specificGarden( $user_id, $garden_id ) 
    {
      
        $conn = Db::getConnection();
        $stmt = $conn->prepare( 'SELECT * FROM garden WHERE user_id=:user_id AND id=:garden_id' );
        $stmt->bindValue( ':user_id', $user_id );
        $stmt->bindValue( ':garden_id', $garden_id );
        $stmt->execute();
        $return = $stmt->fetchAll( PDO::FETCH_ASSOC );
       
        return $return[0];
    }

    public function doCurl(){
      
        $result = file_get_contents("http://localhost/ecovybe/curl.php");
        $array = json_decode($result, true);

        return $array;
    }
}