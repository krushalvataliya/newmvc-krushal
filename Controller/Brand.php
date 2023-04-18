<?php 

class Controller_Brand extends Controller_Core_Action
{

	public function gridAction()
	{
		$layout = $this->getLayout();
		$content = $layout->createBlock('Brand_Grid');
		$layout->getChild('content')->addChild('grid',$content);
		$layout->render();
	}

	public function addAction()
	{
		$layout = $this->getLayout();
		$edit = $layout->createBlock('Brand_Edit');
		$layout->getChild('content')->addChild('edit',$edit);
		$layout->render();
	}

	public function editAction()
	{
		try 
		{
			$request = $this->getRequest();
			$brandId=(int)$request->getParam('brand_id');
			if(!$brandId)
			{
				throw new Exception("invalid Request", 1);
				
			}
			$modelbrand = Ccc::getModel('Brand');
			$sql = "SELECT * FROM `brand` WHERE `brand_id`= {$brandId}";
			$brand =$modelbrand->fetchRow($sql);
			if(!$brand)
			{
				throw new Exception('invalid id', 1);
				
			}
			$layout = $this->getLayout();
			Ccc::register('brand',$brand);
			$content = $layout->createBlock('Brand_Edit');
			$layout->getChild('content')->addChild('edit',$content);
			$layout->render();
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
			if (!$request->isPost())
			{
				throw new Exception("invalid Request.", 1);
			}

			$postData = $request->getPost('brand');
			if(!$postData)
			{
				throw new Exception("no data posted.", 1);
			}

			$modelRowbrand = Ccc::getModel('Brand');
			if($id = (int)$request->getParam('brand_id'))
			{
				$brandRow = $modelRowbrand->load($id);
				if (!$brandRow)
				{
					throw new Exception("invalid id", 1);
				}
				$postData['brand_id'] =$brandRow->brand_id ;
			}
			$modelRowbrand->setData($postData);
			$result =$modelRowbrand->save();
			if(!$result)
			{
				throw new Exception("unable to save brand", 1);
				
			}
			$this->getMessage()->addMessage('brand saved successfully.',  Model_Core_Message::SUCCESS);

		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),  Model_Core_Message::FAILURE);
		}

		// return $this->redirect('grid', null, null, true);

	}

	public function deleteAction()
	{
		try
		{
			$request = $this->getRequest();
			if (!$request->isGet()) {
				throw new Exception("invalid Request.", 1);
			}

			$id = (int)$request->getParam('brand_id');
			$modelbrand = Ccc::getModel('Brand');
			$modelbrand->load($id);
			if(!$modelbrand->delete())
			{
				throw new Exception("Error Processing Request", 1);
				
			}
			$this->getMessage()->addMessage('brand deleted successfully.',  Model_Core_Message::SUCCESS);
		}
		catch(Exception $e)
		{
			$this->getMessage()->addMessage('brand not deleted.',  Model_Core_Message::FAILURE);
		}

		return $this->redirect('grid', null, null, true);
	}

  
    
}

?>