<?php
include_once 'templates/template.php';
class startInfoView
{
	private $model;
	private $controller;

	public function __construct($model) {
		$this->model = $model;
	}

	public function output(){
		$content = <<<"EOT"
			<div class="startInfoBox defaultBox">
				<div class="mainHeader">Start Info</div>
				<div class="mainContext">
					You need to create this table.<br><br>
					Also set database settings in globs.php.<br><br>
					CREATE TABLE `article` (<br>
					`id` bigint(20) NOT NULL,
					`name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,<br>
					`weight` float NOT NULL,<br>
					`color` varchar(30) COLLATE utf8_unicode_ci NOT NULL,<br>
					`country` int(1) NOT NULL,<br>
					`multiplier` decimal(10,4) NOT NULL<br>
					) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;<br>
					<br>
					-- Index för tabell `article`<br>
					<br>
					ALTER TABLE `article`<br>
					ADD PRIMARY KEY (`id`);<br>
					<br>
					--
					-- AUTO_INCREMENT för tabell `article`<br>
					<br>
					ALTER TABLE `article`<br>
					MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;				
				</div>
			</div>
		EOT;
		return $content;
		}

}
?>