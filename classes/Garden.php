<?php

include_once( __DIR__ . '/Db.php');

class Garden {

    private $id;
    private $name;
    private $item;
    private $items_id;
    private $kitCode;
    private $created;
    private $user_id;

    public function findGardens($currentUserId){
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM garden where user_id = :currentUserId ORDER BY created DESC' );
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
        $statement = $conn->prepare( 'SELECT name, id FROM items' );
        $statement->execute();
        $result = $statement->fetchAll( PDO::FETCH_ASSOC );
        
        return $result;
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

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of items_id
     */ 
    public function getItems_id()
    {
        return $this->items_id;
    }

    /**
     * Set the value of items_id
     *
     * @return  self
     */ 
    public function setItems_id($items_id)
    {

        $this->items_id = $items_id;

        return $this;
    }

    /**
     * Get the value of kitCode
     */ 
    public function getKitCode()
    {
        return $this->kitCode;
    }

    /**
     * Set the value of kitCode
     *
     * @return  self
     */ 
    public function setKitCode($kitCode)
    {
        $this->kitCode = $kitCode;

        return $this;
    }

    /**
     * Get the value of created
     */ 
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set the value of created
     *
     * @return  self
     */ 
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get the value of user_id
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of item
     */ 
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set the value of item
     *
     * @return  self
     */ 
    public function setItem($item)
    {
        $this->item = $item;

        return $this;
    }

    public function save()
    {
        try {
            $conn = Db::getConnection();
            $statement = $conn->prepare('INSERT INTO garden (name, items_id, kitCode, created, user_id) VALUES (:name, :items_id, :kitCode, :created, :user_id)');
            $name = $this->getName();
            $items_id = $this->getItems_id();
            $kitCode = $this->getKitCode();
            $created = $this->getCreated();
            $user_id = $this->getUser_id();
            $statement->bindValue(':name', $name);
            $statement->bindValue(':items_id', $items_id);
            $statement->bindValue(':kitCode', $kitCode);
            $statement->bindValue(':created', $created);
            $statement->bindValue(':user_id', $user_id);

            $result = $statement->execute();

            return $result;
        } catch (PDOException $e) {
            print 'Error!: ' . $e->getMessage() . '<br/>';
            die();
        }
    }
}