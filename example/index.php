<?php
include("core/db.php");
include("core/globs.php");
include_once 'templates/template.php';
include("model/startPageModel.php");
include("view/startpage.php");
include("model//startInfoModel.php");
include("view/startinfo.php");
include("model/testviewModel.php");
include("view/testview.php");
include("model/addBoxModel.php");
include("view/addBox.php");
include("model/tableViewModel.php");
include("view/tableview.php");
include("controller/controller.php");

$controller = new Controller();

//Executing the controller with the database connection object. But it is not connected yet.
$controller->execute($objdb); // You can also instead add this in a construct function in the controller.


?>