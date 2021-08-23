<?php
class Controller
{
private $model;

	public function execute($objdb = null)
	{
		$tpl = new Template("templates/".'Wrapper.tpl.php'); // template for the main page with header and footer.
		$tpl->title = 'MVC Demo';
		$tpl->menu = new Template("templates/".'Menu.tpl.php');
		$tpl->menu->title = 'Main menu';
		$tpl->content = "";
		$action = $_REQUEST['action'] ?? null;
		$loadtable = $_POST['loadtable'] ?? null;
		$savedata = $_POST['savedata'] ?? null;
		$postdata = $_POST['postdata'] ?? null;
		$doSaveData = false;
		$postdata =json_decode($postdata, true);
		$postdata['action'] = $postdata['action'] ?? null;
		$postdata['savedata'] = $postdata['savedata'] ?? null;
		$postdata['name'] = $postdata['name'] ?? null;
		$postdata['weight'] = $postdata['weight'] ?? null;
		$postdata['color'] = $postdata['color'] ?? null;
		$postdata['countries'] = $postdata['countries'] ?? null;
		$postdata['multiplier'] = $postdata['multiplier'] ?? null;
		
			if ($postdata['action']==='addbox')
				$action = 'addbox';
				
			if ($action === 'startinfo') {
				$model = new startInfoModel();
				$view = new startInfoView($model,$tpl);
				$tpl->content .= $view->output();
				echo $tpl;
				exit;
			}
			if ($action === 'addbox') {
				$model = new addBoxModel($objdb);
				$view = new addBoxView($model,$tpl);
				$submitType = $_GET['submittype'] ?? null;
				
					if ($postdata['savedata'] === '1') {
						$model->saveData($postdata);
							
							if ($model->error === false){ /* data is saved */
								echo json_encode([$model->lastid]);
							}
							else{
								echo $model->infoText;
							}
								
						exit;
					}
					
					if ($submitType === 'savebox')
					
						if (!$model->checkData()){
							$doSaveData = true;
						}
						
					//echo $postdata['countries'];exit;
				$tpl->content .= $view->output();
				echo $tpl;
				$model->changeColor();
					if ($doSaveData){
						$model->saveAJAX();
					}
					
				exit;
			}	
		
			if ($action === 'tableview') {
				$model = new tableViewModel($objdb);
					
					if ($loadtable === '1') {
						$model->loadData();
							if ($model->error)
								echo $model->dbResult;
							else
								echo json_encode($model->dbResult,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
						exit;
					}
					
				$view = new tableViewView($model,$tpl);
				$tpl->content .= $view->output();
				echo $tpl;
				$model->loadAJAX();
				exit;
			}
			
		$model = new startPageModel();
		$view = new startPageView($model,$tpl);
		$tpl->content .= $view->output();
		// Test to add another view to the page
		
		$view2 = new testPageView($model,$tpl);
		$tpl->content .= $view2->output();
		
		echo $tpl;
	}
	
}
?>