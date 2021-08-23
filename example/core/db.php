<?
/* 

  Created by Viggo Jamne...

  This DB class also takes care of the prepared parameters automatically.
  It also have commit and rollback.
  This DB class is all you need for any database calls in your system.
  This class can be used in any other PHP systems.
  
  Create the class like this:
  
	$objdb = new DBCLASS(
		DB_SERVER,
		DB_PORT,
		DB_DATABASE,
		DB_SERVER_USERNAME,
		DB_SERVER_PASSWORD
    );
	
*/
class DBCLASS {
	
	public  $connection	 = null;
	private $host		 = null;
	private $port		 = null;
	public  $db_database = null;
	private $db_username = null;
	private $db_password = null;

	/* 
	  static connection function. connects to the database and stores that connection statically. 
	  Also good if you connect to multiple databases. Then the construct function is neeed.
	*/       
	public function __construct($host = "localhost", $port = 3306, $db_database = "", $db_username = "root", $db_password = ""){
		$this->host = $host;	
		$this->port = $port;	
		$this->db_database = $db_database;	
		$this->db_username = $db_username;	
		$this->db_password = $db_password;	
	}
	
	public function Connect(){
		try{
			$options = array(
				PDO::ATTR_PERSISTENT    => true, /* Can help to improve performance */
				PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION /* throws exceptions whenever a db error occurs */
			);
			$dsn = "mysql:host=localhost;dbname=$this->db_database;charset=UTF8";
			$this->connection = new PDO($dsn, $this->db_username, $this->db_password, $options);
			return [1]; /* Means true */
		} catch (PDOException $e) {
			return $e->getMessage();
			/* die($e->getMessage()); */
		} finally {
		}
	}
	
	public function Commit(){
		try{
			if ($this->connection->inTransaction())
				$this->connection->commit();
				return [1]; /* Means true */
		} catch (PDOException $e) {
			return $e->getMessage();
			/* die($e->getMessage()); */
		} finally {
		}
	}
	
	/* Insert row/s in a database table */
	public function Insert( $statement = "" , $parameters = [] ){
		try{
			$stmt = $this->executeStatement( $statement , $parameters );
			return [$this->connection->lastInsertId()]; 
			/* 
			  In PostgreSQL use the RETURNING clause instead in the SQL statement.
			  Instead of lastInsertId(), use this:
              return $stmt->fetchAll(PDO::FETCH_ASSOC);
			*/
				
		}catch(Exception $e){
			return $e->getMessage(); 
			/* throw new Exception($e->getMessage()); */   
		}		
	}
	
	/* Select row/s in a database table */
	public function Select( $statement = "" , $parameters = [] ){
		try{
			$stmt = $this->executeStatement( $statement , $parameters );
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}catch(Exception $e){
			return Exception($e->getMessage()); 
			/* throw new Exception($e->getMessage()); */   
		}		
	}
	
	/* Update row/s in a database table */
	public function Update( $statement = "" , $parameters = [] ){
		try{
			$this->executeStatement( $statement , $parameters );
		}catch(Exception $e){
			return Exception($e->getMessage()); 
			/* throw new Exception($e->getMessage()); */   
		}		
	}	
	
	/* Delete row/s in a database table */
	public function Remove( $statement = "" , $parameters = [] ){
		try{
			$this->executeStatement( $statement , $parameters );
		}catch(Exception $e){
			return Exception($e->getMessage()); 
			/* throw new Exception($e->getMessage()); */   
		}		
	}
	
	/* execute statement */
	private function executeStatement( $statement = "" , $parameters = [] ){
		try{
			$stmt = $this->connection->prepare($statement);
				if (!$this->connection->inTransaction())
					$this->connection->beginTransaction();
			$stmt->execute($parameters);
			return $stmt;
		}catch(Exception $e){
				if ($this->connection->inTransaction())
					$this->connection->rollBack();
			throw new Exception($e->getMessage());   
		}		
	}
 
}
?>