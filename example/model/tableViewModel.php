<?php
class tableViewModel
{
	private $database;
	public  $error		= false;
	public  $infoText	= "";
	public 	$dbResult	= null;

	public function __construct($database = null){
		$this->database = $database;
	}

	public function loadData(){
		/* Checks connection errors */
		$connectresult = $this->database->Connect();
		
			if (!is_array($connectresult)){
				$this->error = true;		
				$this->infoText = $connectresult;
		        $this->dbResult = $connectresult;
				return $this->error;
			}
			
		$dbResult = $this->database->Select("
			SELECT name,
			CONCAT(ROUND(weight,2)) AS weight,
			color,
			CONCAT(ROUND(multiplier*weight,2),' SEK') AS shippingcost
			FROM article");
		/* Checks if it has any results, and if it is an array */
		
			if (!is_array($dbResult)){
				$this->error = true;		
				$this->infoText = $dbResult;
		        $this->dbResult = $dbResult;
				return $this->error;
			}
			
		$this->dbResult = $dbResult;
	}
	
	public function loadAJAX(){
		?>
		<script>
			SUSSY_TABLEVIEW.loadData();
		</script>
		<?php
	}

}
?>