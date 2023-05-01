<?php 

class Controller_Admin extends Controller_Core_Action
{
	public function indexAction ()
	{
		$layout = $this->getLayout();
		$index = $layout->createBlock('Core_Layout')->setTemplete('core/index.phtml');;
		$layout->getChild('content')->addChild('index',$index);
		$this->renderLayout();
	}


	public function gridAction()
	{
		$layout = $this->getLayout();
		$request = $this->getRequest();
		$recordsPerPage=(int)$request->getParam('recordsPerPage');	
		$index = $layout->createBlock('Admin_Grid');
		$index->setRecordPerPage($recordsPerPage);
		$index = $index->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
	}

	public function addAction()
	{
		$add = $this->getLayout()->createBlock('Admin_Edit');
		$add = $add->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$add,'element'=>'content']);
	}

	public function editAction()
	{
		try 
		{
			$request = $this->getRequest();
			$adminId=(int)$request->getParam('admin_id');
			if($adminId == null)
			{
			throw new Exception("invalid admin Id.", 1);
			}
			$modelRowAdmin = Ccc::getModel('admin');
			$sql = "SELECT * FROM `admins` WHERE `admin_id`= {$adminId}";
			$admin =$modelRowAdmin->load($adminId);
			if(!$admin)
			{
				throw new Exception("data not found", 1);
			}
			
			$edit = $this->getLayout()->createBlock('Admin_Edit');
			$edit->setId($adminId);
			$edit = $edit->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$edit,'element'=>'content']);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),  Model_Core_Message::FAILURE);
			return $this->redirect('grid', null, null, true);
		}

	}

	public function saveAction()
	{
		try
		{	
			$request = $this->getRequest();
			if (!$request->isPost()) {
				throw new Exception("invalid Request.", 1);
			}
	
			$postData = $request->getPost('admin');
			
			if(!$postData)
			{
				throw new Exception("no data posted.", 1);
			}
			$modelAdmin = Ccc::getModel('Admin');
			if($id =(int) $request->getParam('admin_id'))
			{
				$adminRow = $modelAdmin->load($id);
				if(!$adminRow)
				{
					throw new Exception("invalid id.", 1);
				}
				$postData['admin_id']=$id;
			}
	
			$modelAdmin->setData($postData);
			$result =$modelAdmin->save();
			if(!$result)
			{
				throw new Exception("Error Processing Request", 1);
			}
			$this->getMessage()->addMessage('admin saved successfully.',  Model_Core_Message::SUCCESS);
			$layout = $this->getLayout();
			$index = $layout->createBlock('Admin_Grid')->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('admin not saved.',  Model_Core_Message::FAILURE);
		}
	
	}

	public function deleteAction()
	{
		try
		{
			$request = $this->getRequest();
			if (!$request->isGet()) {
				throw new Exception("invalid Request.", 1);
			}

			$id =(int) $request->getParam('admin_id');
			$modelAdmin = Ccc::getModel('admin');
			$modelAdmin->load($id);
			$result =$modelAdmin->delete($id);
			if(!$result)
			{
				throw new Exception("Error Processing Request", 1);
			}
			$this->getMessage()->addMessage('admin deleted successfully.',  Model_Core_Message::SUCCESS);
			$layout = $this->getLayout();
			$index = $layout->createBlock('Admin_Grid')->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
		}
		catch(Exception $e)
		{
			$this->getMessage()->addMessage('admin not deleted.',  Model_Core_Message::FAILURE);
		}
	}

	public function importAction()
	{
		$layout = $this->getLayout();
		$addImage = $layout->createBlock('Core_Layout')->setTemplete('core/importfile.phtml');;
		$addImage = $addImage->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$addImage,'element'=>'content']);
		
	}

	public function savefileAction()
	{
		try
		{
			$uploadModel =  CCC::getModel('Core_File_Upload');
			$uploadModel->setPath('csv')->setFileName('items.csv')->upload('fileToUpload');

			$readCsvModel =  CCC::getModel('Core_File_Csv');
			$rows = $readCsvModel->setPath('csv')->setFileName($uploadModel->getFileName())->read()->getRows();

			$admin = Ccc::getModel('admin');
			$insert = $admin->getResource()->insertMultiple($rows, 'email');
			if(!$insert)
			{
				throw new Exception("data not saved from csv file.", 1);
			}
			return $this->redirect('index');	
		} 
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('csv not imported because of '.$e->getMessage(),  Model_Core_Message::FAILURE);
			return $this->redirect('index');	
		}
	}

	public function exportAction()
	{
		try
		{
			$admin = Ccc::getModel('admin');
			$sql = "SELECT admin_id,name,email,status FROM `admins`";
			$admins = $admin->getResource()->fetchAll($sql);
			if(!$admins)
			{
				throw new Exception("data not found.", 1);
			}
			foreach ($admins as &$admin)
			{
				if($admin['status'] == Model_Admin::STATUS_ACTIVE)
				{
					$admin['status'] = Model_Admin::STATUS_ACTIVE_LBL;
				}
				if($admin['status'] == Model_Admin::STATUS_INACTIVE)
				{
					$admin['status'] = Model_Admin::STATUS_INACTIVE_LBL;
				}
			}

			$exportModel =  CCC::getModel('Core_File_Export');
			$exportModel->setFileName('items.csv')->putData($admins);
			$exportModel->export();
			exit();
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('csv not exported because of '.$e->getMessage(),  Model_Core_Message::FAILURE);

		}
	}

}

?>