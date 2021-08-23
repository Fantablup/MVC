<?php
 class addBoxView
{
	private $model;

	public function __construct($model) {
		$this->model = $model;
	}

	public function output(){
		$name = "";
		$weight = "";
		$color = "";
		$countries = "1";
		$infoClass = "idle";
		$infoText = $this->model->infoText;
			if ($this->model->error){
				$infoClass = "error";
			}
			if ($this->model->saved){
				$infoClass = "ok";
				$this->model->color = null;
				$this->model->countries = "1";
			} else{
				$name = $this->model->name;
				$weight = $this->model->weight;
				$color = $this->model->color;
				$countries = $this->model->countries;
			}
		$selcountry[0] = "";
		$selcountry[1] = "";
		$selcountry[2] = "";
		$selcountry[3] = "";
			if ($this->model->countries ==="1")
				$selcountry[0] = "selected";
			if ($this->model->countries ==="2")
				$selcountry[1] = "selected";
			if ($this->model->countries ==="3")
				$selcountry[2] = "selected";
			if ($this->model->countries ==="4")
				$selcountry[3] = "selected";
		$options = "";
		$i = 0;
			foreach ($this->model->countriesOptions as  $key => $data) {
				$i++;	
				$options .= "<option value=$i ". $selcountry[$i - 1].">$key</option>"; 
			}

		$content = <<<"EOT"
			<div class="addBox defaultBox">
				<div class="mainHeader">Add a new name</div>
				<form action="index.php" method="get" id="addboxform">
					<div class="mainContext">
						<input type="text" name="name" id="addBoxname" class="name" value="$name" placeholder="Name" maxlength="40" />
						<input type="number" step="0.01"  name="weight" id="addBoxweight" class="weight" value="$weight" placeholder="Weight" maxlength="20" />
						<input type="text" readonly onclick="SUSSY_ADDBOX.openColors()" id="addBoxColor" value="" placeholder="Click to show colour picker" />
						<input type="hidden" name="color" value="" id="colorvalue">
						<input type="color" id="c"  tabindex=-1 onchange="SUSSY_ADDBOX.changeColor(this.value)" class="hidden">
						<select id="addBoxcountries" name="countries">'.$options.
						'</select>
						<div class="boxBottom">
							<div id="addInfoBbox" class="$infoClass">
								{$this->model->infoText}
							</div>
							<div>
								<input type="hidden" name="action" value="addbox">
								<button type="submit" class="saveBtn" form="addboxform" name="submittype" value="savebox">Save</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		EOT;
		return $content;
	}
}
?>