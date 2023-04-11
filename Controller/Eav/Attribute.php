<?php 
class Controller_Eav_Attribute extends Controller_Core_Action
{
	public function gridAction()
	{
		$layout = $this->getLayout();
		$grid = $layout->createBlock('Eav_Attribute_Grid');
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();
	}

	public function addAction ()
	{
		$layout = $this->getLayout();
		$grid = $layout->createBlock('Eav_Attribute_Edit');
		$grid->getAddData();
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();
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
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Eav_Attribute_Edit');
			$grid->setData(['attribute'=>$attribute]);
			$layout->getChild('content')->addChild('grid',$grid);
			$layout->render();
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

			$options = $request->getPost('option');

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
						if(isset($options['exist']))
						{
							foreach ($options['exist'] as $key => $value)
							{
								if($option->option_id == $key  && $option->name != $value)
								{
									$updateData['option_id'] = $key;
									$updateData['name'] = $value;
									$update = $modelEavAttributeOption->setData($updateData)->save(); 
									if(!$update)
									{
										throw new Exception("Attribute option not saved.", 1);
									}
								}
							}
						}
					}
					if($existOption && isset($options['exist']))
					{
						$deleteOptions = array_diff_key($existOption,$options['exist']);
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
				$newOption['attribute_id'] = $savetAtribute;
			}
			if(isset($options['new']))
			{
				foreach ($options['new'] as $key => $value)
				{
					$modelEavAttributeOption = Ccc::getModel('Eav_Attribute_Option');
					$newOption['name'] = $value;
					$save = $modelEavAttributeOption->setData($newOption)->save();
					if(!$save)
					{
						throw new Exception("new option not saved.", 1);
					}
				}
			}
			$this->getMessage()->addMessage('Atribute saved successfully.',  Model_Core_Message::SUCCESS);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('Atribute not saved.',  Model_Core_Message::FAILURE);
		}

		return $this->redirect('grid',null,null,true);
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
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('Attribute not deleted.',  Model_Core_Message::FAILURE);
		}

		return $this->redirect('grid',null,null,true);
	}

}
?>