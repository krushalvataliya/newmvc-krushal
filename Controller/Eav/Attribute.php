<?php 
class Controller_Eav_Attribute extends Controller_Core_Action
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
		$index = $layout->createBlock('Eav_Attribute_Grid')->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
	}

	public function addAction()
	{
		$add = $this->getLayout()->createBlock('Eav_Attribute_Edit');
		$add = $add->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$add,'element'=>'content']);
	}

	public function editAction ()
	{
		try
		{
			$request = $this->getRequest();
			$id =(int) $request->getParam('attribute_id');
			if (!$id)
			{
				throw new Exception("invalid id.", 1);
				
			}
			$modelEavAttribute = Ccc::getModel('Eav_Attribute');
			$attribute = $modelEavAttribute->load($id);
			if(!$attribute)
			{
				throw new Exception("data not found.", 1);
			}

			$edit = $this->getLayout()->createBlock('Eav_Attribute_Edit');
			$edit->setId($id);
			$edit = $edit->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$edit,'element'=>'content']);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),  Model_Core_Message::FAILURE);
			return $this->redirect('grid',null,null,true);
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
			$postData = $request->getPost('attribute');
			if(!$postData)
			{
				throw new Exception("no data posted.", 1);
			}
			$modelEavAttribute = Ccc::getModel('Eav_Attribute');
			$modelEavAttributeOption = Ccc::getModel('Eav_Attribute_Option');

			$newOptions = $request->getPost('new_option');
			$oldOptions = $request->getPost('old_option');

			if($id =(int) $request->getParam('attribute_id'))
			{
				$attribute = $modelEavAttribute->load($id);
				$postData['attribute_id'] = $attribute->attribute_id;
				$savetAtribute = $modelEavAttribute->setData($postData)->save();
				if(!$savetAtribute)
				{
					throw new Exception("Attribute not saved", 1);
				}
				$sql = $sql = "SELECT * FROM `eav_attribute_option` WHERE `attribute_id` = {$id}";
				$existOptions = $modelEavAttributeOption->fetchAll($sql);
				if($existOptions)
				{
					foreach ($existOptions->getData() as $option)
					{
						$existOption[$option->option_id] =  $option->name;
						if(isset($oldOptions))
						{
							foreach ($oldOptions as $key => $value)
							{
								if($option->option_id == $key  && ($option->position != $value['position'] || $option->name != $value['name']))
								{
									$updateData['option_id'] = $key;
									$updateData['position'] = $value['position'];
									$updateData['name'] = $value['name'];
									$update = $modelEavAttributeOption->setData($updateData)->save(); 
									if(!$update)
									{
										throw new Exception("Attribute option not saved.", 1);
									}
								}
							}
						}
					}
					if($existOption && isset($oldOptions))
					{
						$deleteOptions = array_diff_key($existOption,$oldOptions);
						foreach ($deleteOptions as $optionId => $name)
						{	
							$delete = $modelEavAttributeOption->load($optionId)->delete();
							if (!$delete)
							{
								throw new Exception("Attribute option not deleted.", 1);
							}
						}
					}
					else
					{
						foreach ($existOption as $optionId => $name)
						{	
							$delete = $modelEavAttributeOption->load($optionId)->delete();
							if (!$delete)
							{
								throw new Exception("Attribute option not deleted.", 1);
							}
						}
					}
				}
				$newOption['attribute_id'] = $id;
			}
			else
			{
				$savetAtribute = $modelEavAttribute->setData($postData)->save();
				$newOption['attribute_id'] = $savetAtribute->attribute_id;
			}
			if($newOptions['position'] || $newOptions['name'] )
			{
				foreach ($newOptions as $key => $value)
				{
					$modelEavAttributeOption = Ccc::getModel('Eav_Attribute_Option');
					$optionData['position'] =(int)$value['position'];
					$optionData['name'] = $value['name'];
					$save = $modelEavAttributeOption->setData($optionData)->save();
					if(!$save)
					{
						throw new Exception("new option not saved.", 1);
					}
				}
			}
			$this->getMessage()->addMessage('Atribute saved successfully.',  Model_Core_Message::SUCCESS);
			$layout = $this->getLayout();
			$index = $layout->createBlock('Eav_Attribute_Grid')->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('Atribute not saved.',  Model_Core_Message::FAILURE);
		}
	}

	public function deleteAction()
	{
		try
		{
			$request = $this->getRequest();
			$id =(int) $request->getParam('attribute_id');
			if (!$id)
			{
				throw new Exception("invalid id.", 1);
			}
			$modelEavAttribute = Ccc::getModel('Eav_Attribute');
			$delete = $modelEavAttribute->load($id)->delete();
			if(!$delete)
			{
				throw new Exception("data not deleted.", 1);
			}
			$this->getMessage()->addMessage('Attribute deleted successfully.',  Model_Core_Message::SUCCESS);
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Eav_Attribute_Grid')->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$grid,'element'=>'content']);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('Attribute not deleted.',  Model_Core_Message::FAILURE);
		}
	}

}
?>