<?php 

class Controller_Brand extends Controller_Core_Action
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
		$index = $layout->createBlock('Brand_Grid')->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
	}

	public function addAction()
	{
		$add = $this->getLayout()->createBlock('Brand_Edit');
		$add = $add->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$add,'element'=>'content']);
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
			
			$edit = $this->getLayout()->createBlock('Brand_Edit');
			$edit->setId($brandId);
			$this->getResponse()->jsonResponse(['html'=>$edit,'element'=>'content']);
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
			$attributeData = $request->getPost('attribute');
			if(!$postData)
			{
				throw new Exception("no data posted.", 1);
			}
			$targetDir = "View/brand/image/";
			$file = basename($_FILES["fileToUpload"]["name"]);
			$fileArray = explode('.', $file);
			$targetName='IMG_'.time().'.'.$fileArray[1];
			$targetFile = $targetDir .$targetName;
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile);
			$postData['image'] =  $targetName;

			$modelRowbrand = Ccc::getModel('Brand');
			if($id = (int)$request->getParam('brand_id'))
			{
				$brandRow = $modelRowbrand->load($id);
				if (!$brandRow)
				{
					throw new Exception("invalid id", 1);
				}
				if($file == null)
				{
					$postData['image'] =  $brandRow->image;
				}
				$postData['brand_id'] =$brandRow->brand_id ;
			}
			$postData['entity_type_id'] = Model_Brand::ENTITY_TYPE_ID ;

			$modelRowbrand->setData($postData);
			$result =$modelRowbrand->save();
			if(!$result)
			{
				throw new Exception("unable to save brand", 1);
				
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
					$resource = $model->getResource()->setTableName("brand_{$backendType}")->setPrimaryKey('value_id');
					$data = ['attribute_id'=>$attributeId,'entity_id'=> $entityId, 'value' => $v];
					$uniqueColumns = ['attribute_id'=>$attributeId,'entity_id'=> $entityId];
					$insertUpdate = $resource->insertUpdateOnDuplicate($data,$uniqueColumns);
					if(!$insertUpdate)
					{
						throw new Exception("brand's Attribute not inserted.", 1);
						
					}
				}
			}

			$this->getMessage()->addMessage('brand saved successfully.',  Model_Core_Message::SUCCESS);
			$layout = $this->getLayout();
			$index = $layout->createBlock('Brand_Grid')->toHtml();
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

			$id = (int)$request->getParam('brand_id');
			$modelbrand = Ccc::getModel('Brand');
			$modelbrand->load($id);
			if(!$modelbrand->delete())
			{
				throw new Exception("Error Processing Request", 1);
				
			}
			$this->getMessage()->addMessage('brand deleted successfully.',  Model_Core_Message::SUCCESS);
			$layout = $this->getLayout();
			$index = $layout->createBlock('Brand_Grid')->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
		}
		catch(Exception $e)
		{
			$this->getMessage()->addMessage('brand not deleted.',  Model_Core_Message::FAILURE);
		}

	}

  
    
}

?>