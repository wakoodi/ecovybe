<?php

include_once( __DIR__ . '/Db.php' );

class User {

    private $id;
    private $email;
    private $firstName;
    private $lastName;
    private $password;

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

    public function setId( $id )
 {
        $this->id = $id;

        return $this;
    }

    /**
    * Get the value of email
    */

    public function getEmail()
 {
        return $this->email;
    }

    /**
    * Set the value of email
    *
    * @return  self
    */

    public function setEmail( $email )
 {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM users WHERE email=? ' );
        $statement->execute( [$email] );

        $users = $statement->fetch();

        if ( empty( $email ) ) {
            throw new Exception( 'Email cannot be empty' );
        }
        $this->email = $email;

        return $this;
    }

    /**
    * Get the value of firstName
    */

    public function getFirstName()
 {
        return $this->firstName;
    }

    /**
    * Set the value of firstName
    *
    * @return  self
    */

    public function setFirstName( $firstName )
 {
        if ( empty( $firstName ) ) {
            throw new Exception( 'First name cannot be empty' );
        }

        $number = preg_match( '@[0-9]@', $firstName );
        // includes number?

        if ( $number ) {
            throw new Exception( 'First name cannot include numbers' );
        }

        $this->firstName = $firstName;

        return $this;
    }

    /**
    * Get the value of lastName
    */

    public function getLastName()
 {
        return $this->lastName;
    }

    /**
    * Set the value of lastName
    *
    * @return  self
    */

    public function setLastName( $lastName )
 {
        if ( empty( $lastName ) ) {
            throw new Exception( 'Last name cannot be empty' );
        }

        $number = preg_match( '@[0-9]@', $lastName );
        // includes number?

        if ( $number ) {
            throw new Exception( 'last name cannot include numbers' );
        }
        $this->lastName = $lastName;

        return $this;
    }

    /**
    * Get the value of password
    */

    public function getPassword()
 {
        return $this->password;
    }

    /**
    * Set the value of password
    *
    * @return  self
    */

    public function setPassword( $password )
 {
        if ( empty( $password ) ) {
            throw new Exception( 'password cannot be empty' );
        }

        $password = password_hash( $password, PASSWORD_DEFAULT, ['cost'=>16] );

        $this->password = $password;

        return $this;
    }

    public function save(){
        try {
            $conn = Db::getConnection();
            $statement = $conn->prepare('INSERT INTO users (email, firstName, lastName, password) VALUES (:email, :firstName, :lastName, :password)');
            $email = $this->getEmail();
            $firstName = $this->getFirstName();
            $lastName = $this->getLastName();
            $password = $this->getPassword();
            $statement->bindValue(":email", $email);
            $statement->bindValue(":firstName", $firstName);
            $statement->bindValue(":lastName", $lastName);
            $statement->bindValue(":password", $password);

            $result = $statement->execute();

            return $result;
                
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}