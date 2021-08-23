<?php
include_once 'templates/template.php';
class startPageView
{
	private $model;
	private $controller;

	public function __construct($model, $tpl) {
		$this->model = $model;
		$this->tpl = $tpl;
	}

	public function output(){
		$content = <<<"EOT"
			<div class="startBox defaultBox">
				<div class="mainHeader">Start {$this->tpl->title}</div>
				<div class="mainContext">
				Welcome to this demo of MVC.
				A simple understanding example of how to create your own MVC framework.
				<br><br>
				This demo have four views + the test view.
				<br><br>
				I created this for learning MVC.
				</div>
			</div>
			EOT;
			return $content;
	}

}
?>