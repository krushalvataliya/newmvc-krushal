<?php 

class Controller_Item extends Controller_Core_Action
{

	public function gridAction()
	{
		$layout = $this->getLayout();
		$content = $layout->createBlock('Item_Grid');
		$layout->getChild('content')->addChild('grid',$content);
		$layout->render();
	}

	public function addAction()
	{
		$layout = $this->getLayout();
		$edit = $layout->createBlock('item_Edit');
		$edit->getAddData();
		$layout->getChild('content')->addChild('edit',$edit);
		$layout->render();
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
			$layout = $this->getLayout();
			$content = $layout->createBlock('item_Edit');
			$content->setData(['item' => $item]);
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

			$postData = $request->getPost('item');
			echo '<pre>';
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
			$modelRowitem->setData($postData);
			$postData['entity_type_id'] = Model_Item::ENTITY_TYPE_ID ; 

			$item =$modelRowitem->save();
			if(!$item)
			{
				throw new Exception("unable to save item", 1);
				
			}

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
					$entityId = ($id) ? ($id) : ($item->getId());
					$data = ['attribute_id'=>$attributeId,'entity_id'=> $entityId, 'value' => $v];
					$uniqueColumns = ['attribute_id'=>$attributeId,'entity_id'=> $entityId];
					$insertUpdate = $resource->insertUpdateOnDuplicate($data,$uniqueColumns);
					if(!$insertUpdate)
					{
						throw new Exception("item's attribute not inserted or updated.", 1);
						
					}
				}
			}
			$this->getMessage()->addMessage('item saved successfully.',  Model_Core_Message::SUCCESS);

		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('item not saved.',  Model_Core_Message::FAILURE);
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

			$id = (int)$request->getParam('item_id');
			$modelitem = Ccc::getModel('item');
			$modelitem->load($id);
			if(!$modelitem->delete())
			{
				throw new Exception("Error Processing Request", 1);
				
			}
			$this->getMessage()->addMessage('item deleted successfully.',  Model_Core_Message::SUCCESS);
		}
		catch(Exception $e)
		{
			$this->getMessage()->addMessage('item not deleted.',  Model_Core_Message::FAILURE);
		}

		return $this->redirect('grid', null, null, true);
	}

  
    
}

?>