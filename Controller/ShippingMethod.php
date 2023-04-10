<?php 

class Controller_ShippingMethod extends Controller_Core_Action
{
	public function gridAction()
	{	
		$layout = $this->getLayout();
		$grid = $layout->createBlock('ShippingMethod_Grid');
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();

	}
	public function addAction()
	{
		$layout = $this->getLayout();
		$edit = $layout->createBlock('ShippingMethod_Edit');
		$edit->getaddData();
		$layout->getChild('content')->addChild('edit',$edit);
		$layout->render();
		
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
			$layout = $this->getLayout();
			$content = $layout->createBlock('ShippingMethod_Edit');
			$content->setData(['shippingMethod'=>$shipingMethod]);
			$layout->getChild('content')->addChild('edit',$content);
			$layout->render();
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

		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage("Shipping Method not deleted.",  Model_Core_Message::FAILURE);
		}

		return $this->redirect('grid', null, null, true);
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

		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('shiping_method not saved.',  Model_Core_Message::FAILURE);
		}

		return $this->redirect('grid', null, null, true);

	}

}

?>