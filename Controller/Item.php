<?php 

class Controller_Item extends Controller_Core_Action
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
		$index = $layout->createBlock('Item_Grid');
		$index->setRecordPerPage($recordsPerPage);
		$index = $index->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
	}

	public function addAction()
	{
		$add = $this->getLayout()->createBlock('item_Edit');
		$add = $add->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$add,'element'=>'content']);
	}

	public function editAction()
	{
		try 
		{
			$request = $this->getRequest();
			$itemId=(int)$request->getParam('item_id');
			if(!$itemId)
			{
				throw new Exception("invalid Request", 1);
				
			}
			$modelitem = Ccc::getModel('item');
			$sql = "SELECT * FROM `item` WHERE `item_id`= {$itemId}";
			$item =$modelitem->fetchRow($sql);
			if(!$item)
			{
				throw new Exception('invalid id', 1);
			}
			$edit = $this->getLayout()->createBlock('Item_Edit');
			$edit->setId($itemId);
			$edit = $edit->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$edit,'element'=>'content']);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),  Model_Core_Message::FAILURE);
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

			$postData = $request->getPost('item');
			$attributeData = $request->getPost('attribute');
			if(!$postData)
			{
				throw new Exception("item data not posted.", 1);
			}
			if(!$attributeData)
			{
				throw new Exception("attribute data not posted.", 1);
			}

			$modelRowitem = Ccc::getModel('item');
			if($id = (int)$request->getParam('item_id'))
			{
				$itemRow = $modelRowitem->load($id);
				if (!$itemRow)
				{
					throw new Exception("invalid id", 1);
				}
				$postData['item_id'] = $itemRow->item_id ;
			}
			$postData['entity_type_id'] = Model_Item::ENTITY_TYPE_ID ; 
			$modelRowitem->setData($postData);

			$item =$modelRowitem->save();
			if(!$item)
			{
				throw new Exception("unable to save item", 1);
				
			}

			$entityId = ($id) ? ($id) : ($item->getId());
			foreach ($attributeData as $backendType => $value)
			{
				foreach ($value as $attributeId => $v)
				{
					if(is_array($v))
					{
						$v = implode(',', $v);
					}
					$model = Ccc::getModel('Core_Table');
					$resource = $model->getResource()->setTableName("item_{$backendType}")->setPrimaryKey('value_id');
					$data = ['attribute_id'=>$attributeId,'entity_id'=> $entityId, 'value' => $v];
					$uniqueColumns = ['attribute_id'=>$attributeId,'entity_id'=> $entityId];
					$insertUpdate = $resource->insertUpdateOnDuplicate($data,$uniqueColumns);
					if(!$insertUpdate)
					{
						throw new Exception("item's Attribute not inserted", 1);
						
					}
				}
			}
			$this->getMessage()->addMessage('item saved successfully.',  Model_Core_Message::SUCCESS);
			$layout = $this->getLayout();
			$index = $layout->createBlock('Item_Grid')->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);

		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),  Model_Core_Message::FAILURE);
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

			$id = (int)$request->getParam('item_id');
			$modelitem = Ccc::getModel('item');
			$modelitem->load($id);
			if(!$modelitem->delete())
			{
				throw new Exception("Error Processing Request", 1);
				
			}
			$this->getMessage()->addMessage('item deleted successfully.',  Model_Core_Message::SUCCESS);
			$layout = $this->getLayout();
			$index = $layout->createBlock('Item_Grid')->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
		}
		catch(Exception $e)
		{
			$this->getMessage()->addMessage('item not deleted.',  Model_Core_Message::FAILURE);
		}
	}

  
    
}

?>