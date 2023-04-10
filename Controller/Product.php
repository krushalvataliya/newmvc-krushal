<?php 

class Controller_Product extends Controller_Core_Action
{

	public function gridAction()
	{
		$layout = $this->getLayout();
		$content = $layout->createBlock('Product_Grid');
		$layout->getChild('content')->addChild('grid',$content);
		$layout->render();
	}

	public function addAction()
	{
		$layout = $this->getLayout();
		$edit = $layout->createBlock('Product_Edit');
		$edit->getaddData();
		$layout->getChild('content')->addChild('edit',$edit);
		$layout->render();
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
			$layout = $this->getLayout();
			$content = $layout->createBlock('Product_Edit');
			$content->setData(['product' => $product]);
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

			$postData = $request->getPost('product');
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
			$modelRowProduct->setData($postData);
			$result =$modelRowProduct->save();
			if(!$result)
			{
				throw new Exception("unable to save product", 1);
				
			}
			$this->getMessage()->addMessage('product saved successfully.',  Model_Core_Message::SUCCESS);

		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('product not saved.',  Model_Core_Message::FAILURE);
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

			$id = (int)$request->getParam('product_id');
			$modelProduct = Ccc::getModel('Product');
			$modelProduct->load($id);
			if(!$modelProduct->delete())
			{
				throw new Exception("Error Processing Request", 1);
				
			}
			$this->getMessage()->addMessage('product deleted successfully.',  Model_Core_Message::SUCCESS);
		}
		catch(Exception $e)
		{
			$this->getMessage()->addMessage('product not deleted.',  Model_Core_Message::FAILURE);
		}

		return $this->redirect('grid', null, null, true);
	}

  
    
}

?>