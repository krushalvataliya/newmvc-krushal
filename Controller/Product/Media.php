<?php 
class Controller_Product_Media extends Controller_Core_Action
{
	public function indexAction()
	{
		$layout = $this->getLayout();
		$index = $layout->createBlock('Product_Media_Grid')->setTemplete('core/index.phtml');;
		$layout->getChild('content')->addChild('index',$index);
		$this->renderLayout();
	}
	
	public function gridAction()
	{
		$request = $this->getRequest();
		$productId =(int) $request->getParam('product_id');
		$layout = $this->getLayout();
		$content = $layout->createBlock('Product_Media_Grid');
		$this->getSession()->start()->set('product_id',$productId );
		$content = $content->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$content,'element'=>'content']);
	}

	public function addAction()
	{
		$layout = $this->getLayout();
		$content = $layout->createBlock('Product_Media_Add');
		$content = $content->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$content,'element'=>'content']);
	}

	public function insertAction()
	{
		try 
		{
			$request = $this->getRequest();
			$productId =(int) $this->getSession()->start()->get('product_id');
			if(!isset($productId))
			{
				throw new Exception("invalid product ID.", 1);
			}
			$targetDir = "View/product/media/image/";
			$file = basename($_FILES["fileToUpload"]["name"]);
			$fileArray = explode('.', $file);
			$media = $request->getPost('media');
			$targetName='IMG_'.time().'.'.$fileArray[1];
			$targetFile = $targetDir .$targetName;
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile);
			$media['img'] = $targetName;
			$media['product_id'] = $productId;

			$modelProductMedia =Ccc::getModel('Product_Media')->setData($media);
			$insert=$modelProductMedia->save();
			if(!$insert)
			{
				throw new Exception("data not inserted.", 1);
			}

			// $this->getMessage()->addMessage('Media inserted successfully.',  Model_Core_Message::SUCCESS);
			// $layout = $this->getLayout();
			// $content = $layout->createBlock('Product_Media_Grid');
			// $content = $content->toHtml();
			// $this->getResponse()->jsonResponse(['html'=>$content,'element'=>'content']);
			return $this->redirect('index',null,['product_id' => $productId],true);
		}
		catch (Exception $e) {
			$this->getMessage()->addMessage('Media not inserted.',  Model_Core_Message::FAILURE);
		}

	}
	
	public function updateAction()
	{
		try
		{
			$request = $this->getRequest();
			$request = $this->getRequest();
			$productId =(int)$request->getParam('product_id');
			$gallaryId = $request->getPost('gallary');
			$thumbnail = (int)($request->getPost('thumbnail')) ? ($request->getPost('thumbnail')) : (null);
			$midium = (int)($request->getPost('midium')) ? ($request->getPost('midium')) : (null);
			$large = (int)($request->getPost('large')) ? ($request->getPost('large')) : (null);
			$small = (int)($request->getPost('small')) ? ($request->getPost('small')) : (null);

			$modeltMedia =Ccc::getModel('Product_Media_Resource');
			$resetValue = ['gallary' => 0];
			$result =$modeltMedia->update($resetValue, ['product_id' => $productId]);
			
			$modelProduct =Ccc::getModel('Product');
			
			$setMediaData = ['thumbnail_id' => $thumbnail,'midium_id' => $midium,'large_id' =>  $large,'small_id' => $small,'product_id' => $productId];
			$setMediaData = array_filter($setMediaData);
			if(!$modelProduct->setData($setMediaData)->save())
			{
				throw new Exception("media's data not updated.", 1);
			}

			$modelProductMedia =Ccc::getModel('Product_Media');
			if($gallaryId)
			{
				foreach ($gallaryId as $key => $value)
				{
				$setGallary = ['gallary' => 1,'media_id' => $value];
					if(!$modelProductMedia->setData($setGallary)->save())	
					{
						throw new Exception("gallary not updated.", 1);
					}
				}
			}
			$this->getMessage()->addMessage('Media updeted successfully.',  Model_Core_Message::SUCCESS);
			$layout = $this->getLayout();
			$content = $layout->createBlock('Product_Media_Grid');
			$content = $content->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$content,'element'=>'content']);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('Media not updeted.',  Model_Core_Message::SUCCESS);
		}
	}
	
	public function deleteAction()
	{
		try 
		{
			$request = $this->getRequest();
			$productId =(int)$request->getParam('product_id');
			if(!$productId)
			{
				throw new Exception("invalid product ID.", 1);
			}
			$deleteImageId = $request->getPost('delete_image');
			if (!$deleteImageId)
			{
				throw new Exception("invalid image Id", 1);
			}
			if($deleteImageId != null)
			{
			$modelProductMedia =Ccc::getModel('Product_Media');
			foreach ($deleteImageId as $key => $value)
			{
				$imageName =$modelProductMedia->load($value);
				if(!$imageName->delete())
				{
					throw new Exception("Media not deleted", 1);
				}
				$image = 'View/product/media/image/'.$imageName->img;
				if (file_exists($image))
				{
					unlink($image);
				}
			}
			}
			$this->getMessage()->addMessage('Media deleted successfully.',  Model_Core_Message::SUCCESS);
			$layout = $this->getLayout();
			$content = $layout->createBlock('Product_Media_Grid');
			$content = $content->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$content,'element'=>'content']);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),  Model_Core_Message::FAILURE);
		}

	}

}
