<?php 

class DBController
{
    
    public $dbHost="localhost";
    public $dbUser="root";
    public $dbPassword="";
    public $dbName="caironews";
    public $connection;

    public function openConnection()
    {
        $this->connection=new mysqli($this->dbHost,$this->dbUser,$this->dbPassword,$this->dbName);
        if($this->connection->connect_error)
        {
            echo " Error in Connection : ".$this->connection->connect_error;
            return false;
        }
        else
        {
            return true;
        }
    }

    public function closeConnection()
    {
        if($this->connection)
        {
            $this->connection->close();
        }
        else
        {
            echo "Connection is not opened";
        }
    }

    public function select($qry)
    {
        $result=$this->connection->query($qry);
        if(!$result)
        {
            echo "Error : ".mysqli_error($this->connection);
            return false;
        }
        else
        {
             return $result->fetch_all(MYSQLI_ASSOC);
        }

    }
    public function insert($qry)
    {
        $result=$this->connection->query($qry);
        if(!$result)
        {
            echo "Error : ".mysqli_error($this->connection);
            return false;
        }
        else
        {
             return $this->connection->insert_id;
        }

    }
    public function delete($qry)
    {
        $result=$this->connection->query($qry);
        if(!$result)
        {
            echo "Error : ".mysqli_error($this->connection);
            return false;
        }
        else
        {
             return $result;
        }

    }

    public function Update($qry)
    {
        $result=$this->connection->query($qry);
        if(!$result)
        {
            echo "Error : ".mysqli_error($this->connection);
            return false;
        }
        else
        {
             return $result;
            
        }

    } 

    public function runQuery($query)
    {
        $result = mysqli_query($this->connection, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($this->conn));
        }

        return $result;
    }

}



?>