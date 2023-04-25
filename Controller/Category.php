<?php
class Controller_Category extends Controller_Core_Action
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
		$index = $layout->createBlock('Category_Grid')->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
		
	}

	public function addAction()
	{
		$edit = $this->getLayout()->createBlock('Category_Edit');
		$edit = $edit->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$edit,'element'=>'content']);
	}

	public function editAction()
	{
		try 
		{
			$request = $this->getRequest();
			$id=(int)$request->getParam('category_id');
			if(!$id)
			{
				throw new Exception("id not found.", 1);
			}
			$category = Ccc::getModel('Cetegory')->load($id);
			if(!$category)
			{
				throw new Exception("id not found.", 1);
			}
			$sql = "SELECT * FROM `category` WHERE `path` NOT LIKE '{$category->path}=%' AND `path` NOT LIKE '{$category->path}';";
			$categories = Ccc::getModel('Cetegory')->fetchAll($sql);
			if(!$categories)
			{
				throw new Exception("id not found.", 1);
			}
			
			$edit = $this->getLayout()->createBlock('Category_Edit');
			$edit->setId($id);
			$this->getResponse()->jsonResponse(['html'=>$edit,'element'=>'content']);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),  Model_Core_Message::FAILURE);
			return $this->redirect('grid', null, null, true);
		}
	}
	
	public function deleteAction()
	{
		try
		{
			$request = $this->getRequest();
			$id =(int)$request->getParam('category_id');
			if(!$id)
			{
				throw new Exception("invalid category ID.", 1);
			}
			$modelCetegory = Ccc::getModel('Cetegory');;
			$delete = $modelCetegory->load($id)->delete();
			if(!$delete)
			{
				throw new Exception("cetegory not deleted.", 1);
			}
			$this->getMessage()->addMessage('category deleted successfully.',  Model_Core_Message::SUCCESS);
			$layout = $this->getLayout();
			$index = $layout->createBlock('Category_Grid')->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('category not deleted.',  Model_Core_Message::FAILURE);
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

			$postData = $request->getPost('category');
			print_r($postData);
			$attributeData = $request->getPost('attribute');
			if(!$postData)
			{
				throw new Exception("no data posted.", 1);
			}
			$modelRowCategory = Ccc::getModel('Cetegory');
			if($id = (int)$request->getParam('category_id'))
			{
				$categoryRow = $modelRowCategory->load($id);
				if (!$categoryRow)
				{
					throw new Exception("invalid id", 1);
				}
				$postData['category_id'] =$categoryRow->category_id ;
				$postData['path'] =$categoryRow->path ;
			}
			$postData['entity_type_id'] = Model_Cetegory::ENTITY_TYPE_ID ;
			$category = $modelRowCategory->setData($postData);
			$result =$modelRowCategory->save();

			if(!$result)
			{
				throw new Exception("unable to save Category", 1);
			}
			if(!$id)
			{
			$category->category_id = $result->category_id;
			}
			$category->updatePath();

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
					$resource = $model->getResource()->setTableName("category_{$backendType}")->setPrimaryKey('value_id');
					$data = ['attribute_id'=>$attributeId,'entity_id'=> $entityId, 'value' => $v];
					$uniqueColumns = ['attribute_id'=>$attributeId,'entity_id'=> $entityId];
					$insertUpdate = $resource->insertUpdateOnDuplicate($data,$uniqueColumns);
					if(!$insertUpdate)
					{
						throw new Exception("Category's Attribute not inserted.", 1);
						
					}
				}
			
			}
			$this->getMessage()->addMessage('Category saved successfully.',  Model_Core_Message::SUCCESS);
			$edit = $this->getLayout()->createBlock('Product_Grid');
			$edit = $edit->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$edit,'element'=>'content']);		
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('category not saved.'.$e->getMessage(),  Model_Core_Message::FAILURE);
		}

	}
	
}
