<?php 

class Controller_ShippingMethod extends Controller_Core_Action
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
		$index = $layout->createBlock('ShippingMethod_Grid');
		$index->setRecordPerPage($recordsPerPage);
		$index = $index->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);

	}

	public function addAction()
	{
		$add = $this->getLayout()->createBlock('ShippingMethod_Edit');
		$add = $add->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$add,'element'=>'content']);
	}
	
	public function editAction()
	{
		try
		{
			$request = $this->getRequest();
			$id=(int)$request->getParam('shiping_method_id');
			if(!$id)
			{
			  throw new Exception("id not found.", 1);
			}
			$modelShippingMethod = Ccc::getModel('ShippingMethod');
			$shipingMethod =$modelShippingMethod->load($id);
			if(!$shipingMethod)
			{
				throw new Exception("invalid shiping_method id.", 1);
				
			}
			$edit = $this->getLayout()->createBlock('ShippingMethod_Edit');
			$edit->setId($id);
			$edit = $edit->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$edit,'element'=>'content']);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage() ,  Model_Core_Message::FAILURE);
			return $this->redirect('grid', null, null, true);
		}
	}



	public function deleteAction()
	{
		try
		{
			$request = $this->getRequest();
			$id =(int) $request->getParam('shiping_method_id');
			if(!$id)
			{
				throw new Exception("invalid shiping method ID", 1);
			}
				
			$modelShippingMethod = Ccc::getModel('ShippingMethod');
			$delete = $modelShippingMethod->load($id)->delete();
			if(!$delete)
			{
				throw new Exception("Shipping Method not deleted.", 1);
			}

			$this->getMessage()->addMessage("Shipping Method deleted successfully.",  Model_Core_Message::SUCCESS);
			$layout = $this->getLayout();
			$index = $layout->createBlock('ShippingMethod_Grid')->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);

		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage("Shipping Method not deleted.",  Model_Core_Message::FAILURE);
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

			$postData = $request->getPost('shiping_method');
			if(!$postData)
			{
				throw new Exception("no data posted.", 1);
			}

			$modelRowShippingMethod = Ccc::getModel('ShippingMethod');
			if($id = (int)$request->getParam('shiping_method_id'))
			{
				$ShippingMethodRow = $modelRowShippingMethod->load($id);
				if (!$ShippingMethodRow)
				{
					throw new Exception("invalid id", 1);
				}
				$postData['shiping_method_id'] =$ShippingMethodRow->shiping_method_id ;
			}

			$modelRowShippingMethod->setData($postData);
			$result =$modelRowShippingMethod->save();
			if(!$result)
			{
				throw new Exception("unable to save shiping_method", 1);
				
			}
			$this->getMessage()->addMessage('shiping_method saved successfully.',  Model_Core_Message::SUCCESS);
			$layout = $this->getLayout();
			$index = $layout->createBlock('ShippingMethod_Grid')->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),  Model_Core_Message::FAILURE);
		}

	}

}

?>