<?php
class testPageView
{
private $model;
private $controller;

public function __construct($model, $tpl) {
		$this->model = $model;
		$this->tpl = $tpl;
}

public function output(){
	$content = <<<"EOT"
		<div style="display:block;margin:10px;padding:10px;background:yellow;"class=""> just a second test view
		</div>
		EOT;
		return $content;
}

}
?>