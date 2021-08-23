<?php
class tableViewView
{
	private $model;

	public function __construct($model) {
		$this->model = $model;
	}

	public function output(){
		$content = <<<"EOT"
			<div class="scrollView">
				<div class="listBoxes defaultBox">
					<div class="mainHeader">Table view</div>
					<div class="mainContext">
						<ul id="tableDBList" class="defaultList">
							<li class="defaultRowHeader">
								<div class="colItem col1">Receiver</div>
								<div class="colItem col2">Weight</div>
								<div class="colItem col3">Box colour</div>
								<div class="colItem col4">Shipping cost</div>
							</li>
						</ul> 
					</div>  
				</div>
			</div>
		EOT;
		return $content;
	}
}
?>
