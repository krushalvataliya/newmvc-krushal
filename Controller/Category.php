<?php
class Controller_Category extends Controller_Core_Action
{
	public function gridAction()
	{
		$layout = $this->getLayout();
		$content = $layout->createBlock('Category_Grid');
		$layout->getChild('content')->addChild('grid',$content);
		$layout->render();
		
	}

	public function addAction()
	{
		$layout = $this->getLayout();
		$add = $layout->createBlock('Category_Edit');
		$add->getAddData();
		$layout->getChild('content')->addChild('add',$add);
		$layout->render();
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
			$layout = $this->getLayout();
			$edit = $layout->createBlock('Category_Edit');
			$edit->setData(['category'=>$category,'categoriesData'=>$categories]);
			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();
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
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('category not deleted.',  Model_Core_Message::FAILURE);
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

			$postData = $request->getPost('category');	
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
			$category = $modelRowCategory->setData($postData);
			$result =$modelRowCategory->save();

			if(!$result)
			{
				throw new Exception("unable to save Category", 1);
			}
			if(!$id)
			{
			$category->category_id = $result;
			}
			$category->updatePath();
			$this->getMessage()->addMessage('Category saved successfully.',  Model_Core_Message::SUCCESS);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('category not saved.'.$e->getMessage(),  Model_Core_Message::FAILURE);
		}

		return $this->redirect('grid', null, null, true);
	}
	
}
