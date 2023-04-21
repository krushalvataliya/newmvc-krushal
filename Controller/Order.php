<?php 

class Controller_Order extends Controller_Core_Action
{

	public function gridAction()
	{
		$layout = $this->getLayout();
		$content = $layout->createBlock('order_Grid');
		$layout->getChild('content')->addChild('grid',$content);
		$layout->render();
	}

	public function addAction()
	{
		$layout = $this->getLayout();
		$edit = $layout->createBlock('order_Edit');
		$edit->getAddData();
		$layout->getChild('content')->addChild('edit',$edit);
		$layout->render();
	}

	public function editAction()
	{
		try 
		{
			$request = $this->getRequest();
			$orderId=(int)$request->getParam('order_id');
			if(!$orderId)
			{
				throw new Exception("invalid Request", 1);
				
			}
			$modelorder = Ccc::getModel('order');
			$sql = "SELECT * FROM `orders` WHERE `order_id`= {$orderId}";
			$order =$modelorder->fetchRow($sql);
			if(!$order)
			{
				throw new Exception('invalid id', 1);
				
			}
			$layout = $this->getLayout();
			$content = $layout->createBlock('order_Edit');
			$content->setData(['order' => $order]);
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

			$postData = $request->getPost('order');
			$attributeData = $request->getPost('attribute');
			if(!$postData)
			{
				throw new Exception("no data posted.", 1);
			}

			$modelRoworder = Ccc::getModel('order');
			if($id = (int)$request->getParam('order_id'))
			{
				$orderRow = $modelRoworder->load($id);
				if (!$orderRow)
				{
					throw new Exception("invalid id", 1);
				}
				$postData['order_id'] =$orderRow->order_id ;
			}
			$postData['entity_type_id'] = Model_order::ENTITY_TYPE_ID ;
			$modelRoworder->setData($postData);
			$result =$modelRoworder->save();
			if(!$result)
			{
				throw new Exception("unable to save order", 1);
				
			}

			$entityId = ($id) ? ($id) : ($result->getId());
			foreach ($attributeData as $backendType => $value)
			{
				foreach ($value as $attributeId => $v)
				{
					if(is_array($v))
					{
						$v = implode(',', $v);
					}
					$model = Ccc::getModel('Core_Table');
					$resource = $model->getResource()->setTableName("order_{$backendType}")->setPrimaryKey('value_id');
					$data = ['attribute_id'=>$attributeId,'entity_id'=> $entityId, 'value' => $v];
					$uniqueColumns = ['attribute_id'=>$attributeId,'entity_id'=> $entityId];
					$insertUpdate = $resource->insertUpdateOnDuplicate($data,$uniqueColumns);
					if(!$insertUpdate)
					{
						throw new Exception("order's Attribute not inserted", 1);
						
					}
				}
			}
			$this->getMessage()->addMessage('order saved successfully.',  Model_Core_Message::SUCCESS);

		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('order not saved.',  Model_Core_Message::FAILURE);
		}

		return $this->redirect('grid', null, null, true);

	}

	public function deleteAction()
	{
		try
		{
			$request = $this->getRequest();
			if (!$request->isGet()) {
				throw new Exception("invalid Request.", 1);
			}

			$id = (int)$request->getParam('order_id');
			$modelorder = Ccc::getModel('order');
			$modelorder->load($id);
			if(!$modelorder->delete())
			{
				throw new Exception("Error Processing Request", 1);
				
			}
			$this->getMessage()->addMessage('order deleted successfully.',  Model_Core_Message::SUCCESS);
		}
		catch(Exception $e)
		{
			$this->getMessage()->addMessage('order not deleted.',  Model_Core_Message::FAILURE);
		}

		return $this->redirect('grid', null, null, true);
	}

  
    
}

?>