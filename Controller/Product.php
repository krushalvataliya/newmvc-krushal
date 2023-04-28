<?php 

class Controller_Product extends Controller_Core_Action
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
		$request = $this->getRequest();
		$recordsPerPage=(int)$request->getParam('recordsPerPage');	
		$layout = $this->getLayout();
		$grid = $layout->createBlock('Product_Grid');
		$grid->setRecordPerPage($recordsPerPage);
		$grid = $grid->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$grid,'element'=>'content']);
	}

	public function addAction()
	{
		$add = $this->getLayout()->createBlock('Product_Edit');
		$add = $add->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$add,'element'=>'content']);
	}

	public function editAction()
	{
		try 
		{
			$request = $this->getRequest();
			$productId=(int)$request->getParam('product_id');
			if(!$productId)
			{
				throw new Exception("invalid Request", 1);
				
			}
			$modelProduct = Ccc::getModel('Product');
			$sql = "SELECT * FROM `products` WHERE `product_id`= {$productId}";
			$product =$modelProduct->fetchRow($sql);
			if(!$product)
			{
				throw new Exception('invalid id', 1);
				
			}
			$edit = $this->getLayout()->createBlock('Product_Edit');
			$edit->setId($productId);
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

			$postData = $request->getPost('product');
			$attributeData = $request->getPost('attribute');
			if(!$postData)
			{
				throw new Exception("no data posted.", 1);
			}

			$modelRowProduct = Ccc::getModel('Product');
			if($id = (int)$request->getParam('product_id'))
			{
				$productRow = $modelRowProduct->load($id);
				if (!$productRow)
				{
					throw new Exception("invalid id", 1);
				}
				$postData['product_id'] =$productRow->product_id ;
			}
			$postData['entity_type_id'] = Model_Product::ENTITY_TYPE_ID ;
			$modelRowProduct->setData($postData);
			$result =$modelRowProduct->save();
			if(!$result)
			{
				throw new Exception("unable to save product", 1);
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
					$resource = $model->getResource()->setTableName("product_{$backendType}")->setPrimaryKey('value_id');
					$data = ['attribute_id'=>$attributeId,'entity_id'=> $entityId, 'value' => $v];
					$uniqueColumns = ['attribute_id'=>$attributeId,'entity_id'=> $entityId];
					$insertUpdate = $resource->insertUpdateOnDuplicate($data,$uniqueColumns);
				}
			}
			$this->getMessage()->addMessage('product saved successfully.',  Model_Core_Message::SUCCESS);

			$grid = $this->getLayout()->createBlock('Product_Grid');
			$grid = $grid->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$grid,'element'=>'content']);
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

			$id = (int)$request->getParam('product_id');
			$modelProduct = Ccc::getModel('Product');
			$modelProduct->load($id);
			if(!$modelProduct->delete())
			{
				throw new Exception("Error Processing Request", 1);
				
			}
			$this->getMessage()->addMessage('product deleted successfully.',  Model_Core_Message::SUCCESS);
			$grid = $this->getLayout()->createBlock('Product_Grid');
			$grid = $grid->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$grid,'element'=>'content']);
		}
		catch(Exception $e)
		{
			$this->getMessage()->addMessage('product not deleted.',  Model_Core_Message::FAILURE);
		}
	}

	public function importAction()
	{
		$layout = $this->getLayout();
		$index = $layout->createBlock('Core_Layout')->setTemplete('product/importfile.phtml');;
		$layout->getChild('content')->addChild('index',$index);
		$this->renderLayout();
		
	}

	public function savefileAction()
	{
		$targetDir = "View/product/db/";
		$uploadModel =  CCC::getModel('Core_File_Upload');
		$uploadModel->setPath('csv')

		$file = basename($_FILES["fileToUpload"]["name"]);
		$fileArray = explode('.', $file);
		$targetName='db_'.time().'.'.$fileArray[1];
		$targetFile = $targetDir .$targetName;
		if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile))
		{
		$count = 0;
			$file = fopen($targetFile, "r");
			echo "<pre>";
			while (($row = fgetcsv($file)) !== FALSE)
			{
				if(!$count)
				{
					$count = $row;
				}
				else
				{
				 $data = array_combine($count, $row); 
				}
				if($data)
				{
					$sku = $data['sku'];
					$modelProduct = Ccc::getModel('Product');
					echo $sql = "SELECT * FROM `products` WHERE `sku` = '{$sku}'";
					$product = $modelProduct->fetchrow($sql);
					if($product->getData)
					{
						$data['product_id'] = $product->product_id;
					}
				   	 $stmt = $modelProduct->setData($data)->save();
				}
			}
		    return $this->redirect('index');
		}
	}

	public function exportAction()
	{
		
	}

  
    
}

?>