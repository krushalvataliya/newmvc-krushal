<?php 
class Controller_Product_Media extends Controller_Core_Action
{
	
	function gridAction()
	{
		$layout = $this->getLayout();
		$content = $layout->createBlock('Product_Media_Grid');
		$layout->getChild('content')->addChild('grid',$content);
		$layout->render();
	}
	function addAction()
	{
		$layout = $this->getLayout();
		$content = $layout->createBlock('Product_Media_Add');
		$layout->getChild('content')->addChild('grid',$content);
		$layout->render();
	}
	function insertAction()
	{
		try 
		{
			$request = $this->getRequest();
			$productId =(int) $request->getParam('product_id');
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

			$this->getMessage()->addMessage('Media inserted successfully.',  Model_Core_Message::SUCCESS);
		}
		catch (Exception $e) {
			$this->getMessage()->addMessage('Media not inserted.',  Model_Core_Message::FAILURE);
		}

		return $this->redirect('grid','product_media',['product_id'-> $productId]);		
	}
	
	function updateAction()
	{
		try
		{
			$request = $this->getRequest();
			$button = $request->getPost('button');
			if($button == 'delete')
			{
				return $this->deleteAction();
			}
			$request = $this->getRequest();
			$productId =(int)$request->getParam('product_id');
			$gallaryId = $request->getPost('gallary');
			$thumbnail = (int)$request->getPost('thumbnail');
			$midium = (int)$request->getPost('midium');
			$large = (int)$request->getPost('large');
			$small = (int)$request->getPost('small');

			$modeltMedia =Ccc::getModel('Product_Media_Resource');
			$resetValue = ['thumbnail' => 0, 'base' => 0 ,'midium' => 0 ,'large' => 0, 'small' => 0, 'gallary' => 0];
			$result =$modeltMedia->update($resetValue, ['product_id' => $productId]);
			
			$modelProductMedia =Ccc::getModel('Product_Media');
			
			$setThumbnail = ['thumbnail' => 1,'media_id' => $thumbnail];
			if(!$modelProductMedia->setData($setThumbnail)->save())
			{
				throw new Exception("thumbnail not updated.", 1);
			}
			
			$setMidium = ['midium' => 1,'media_id' => $midium];
			if(!$modelProductMedia->setData($setMidium)->save())
			{
				throw new Exception("midium not updated.", 1);
			}
			
			$setLarge = ['large' => 1,'media_id' => $large];
			if(!$modelProductMedia->setData($setLarge)->save())
			{
				throw new Exception("large not updated.", 1);
			}
			
			$setSmall = ['small' => 1,'media_id' => $small];
			if(!$modelProductMedia->setData($setSmall)->save())
			{
				throw new Exception("small not updated.", 1);
			}
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
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('Media not updeted.',  Model_Core_Message::SUCCESS);
		}

		return $this->redirect('grid','product_media',['product_id' => $productId]);		

	}
	
	function deleteAction()
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
				if(!$modelProductMedia->delete())
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
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('Media not deleted.',  Model_Core_Message::FAILURE);
		}

		return $this->redirect('grid','product_media',['product_id'-> $productId]);		
	}

}
