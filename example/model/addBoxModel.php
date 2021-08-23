<?php
class addBoxModel
{
	private $database;
	public	$name 		= "";
	public	$weight		= "";
	public	$color 		= null;
	public	$countries	= "";
	public	$multiplier	= "";
	public  $error		= false;
	public  $infoText	= "";
	public  $saved		= false;
	public 	$lastid 	= null;
	public 	$countriesOptions = array( /* Set up for also being used in a PHP component. */
		'Sweden'	=> 1.3,
		'China'		=> 4,
		'Brazil'	=> 8.6,
		'Australia'	=> 7.2
	);

	public function __construct($database = null){
		$this->database = $database;
	}
	
	private function rgbToHtml($hex){
		$hex = str_replace('#', '', $hex);
			
			if(strlen($hex) > 3) $color = str_split($hex, 2);
			else $color = str_split($hex);
			
			if (sizeof($color) ==3)
				$color = [hexdec($color[0]), hexdec($color[1]), hexdec($color[2])];
			
			if (sizeof($color) ===1)
				return [];
				
		return $color;
	}	
	
	public function checkData(){
		$error = false;	
		$errorText = "";
		$this->name = $_GET['name'] ?? null;
		$this->weight = $_GET['weight'] ?? null;
		$this->color = $_GET['color'] ?? null;
		$this->countries = $_GET['countries'] ?? null;
		$weight = is_numeric($this->weight) ? (float)$this->weight : null;
			
			if (trim($this->name)==="" or is_null($this->name))
				$this->error = true;		
			
			if (is_null($weight))
				$this->error = true;		
			
			if ($weight < 0)
				$this->error = true;		
 			
			if (trim($this->countries)==="" or is_null($this->countries))
				$this->error = true;
				
        $multiplierArray = array_values($this->countriesOptions);				
		$this->multiplier = $multiplierArray[$this->countries-1]; 
		$color = $this->rgbToHtml(trim($this->color));
		
			if (count($color) === 0)
				$this->error = true;
				
			if (count($color) >0)
			{
				$r = $color[0];
				$g = $color[1];
				$b = $color[2];
					if ($r === 0 && $g === 0 && $b > 0 )
						$this->error = true;
			}
			
			if ($this->error){	
					if ($weight < 0){
						$this->infoText .= "You cannot enter a negative number";
						return $this->error;
					}
					/* Error if selected any shades of the blue color */
					if (count($color) > 0){
						if ($r === 0 && $g === 0 && $b > 0 ){
							$this->infoText .= "You cannot select any shades of the blue color";
							return $this->error;
						}
					}
				$this->error = true;
				$this->infoText .= "You must insert value in all boxes";
				return $this->error;
			}
			
		return false;
	}
	
	public function saveData($params){

		/* Checks connection errors */
		$connectresult = $this->database->Connect();
		
			if (!is_array($connectresult)){
				$this->error = true;		
				$this->infoText = $connectresult;
				return $this->error;
			}
			
		$dbResult = $this->database->Insert("insert into article (name, weight, color, country, multiplier) 
			values(:name, :weight,:color, :country, :multiplier)",[
			'name' => $params["name"],
			'weight' => $params["weight"],
			'color' => $params["color"],
			'country' => $params["countries"],
			'multiplier' => $params["multiplier"]]);
			
			/* Checks if it has any results, and if it is an array */
			if (!is_array($dbResult)){
				$this->error = true;		
				$this->infoText = $dbResult;
				return $this->error;
			}
			
		/* Checks commit errors */
		$commitresult = $this->database->Commit();
			if (!is_array($commitresult)){
				$this->error = true;		
				$this->infoText = $commitresult;
				return $this->error;
			}
			
		/* 
		  Everything is succeful saved.
		  Also preventing re-post when refreshing		  
		*/
		$this->infoText = "Data is saved. Last id is $dbResult[0].<br>Look in the table view";
		$this->saved = true;
		$this->lastid = $dbResult[0];
	}
	
	public function saveAJAX(){
		$params = array(
			'action'		=> 'addbox',
			'savedata'		=> '1',
			'name'			=> $this->name,
			'weight'		=> $this->weight,
			'color'			=> $this->color,
			'countries'		=> $this->countries,
			'multiplier'	=> $this->multiplier);
		?>
		<script>
			var params = <?php echo json_encode($params); ?>;
			console.log(params);
			// just to show how we use await
			
				async function saveawait(){
					var fresult = await SUSSY_ADDBOX.saveData(params);
						if (fresult){
							// Do something here...
						}
				}
				
			saveawait();
		</script>
		<?php
	}
	
	public function changeColor(){
		?>
		<script>
			SUSSY_ADDBOX.changeColor("<?php echo $this->color; ?>");
		</script>
		<?php
	}
	
}
?>