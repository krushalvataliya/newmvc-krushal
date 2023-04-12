 <?php 
class Controller_Customer_Address extends Controller_Core_Action
{
	public function gridAction()
	{
		$layout = $this->getLayout();
		$content = $layout->createBlock('Customer_Address_Grid');
		$layout->getChild('content')->addChild('grid',$content);
		$layout->render();
	}

	public function deleteAction()
	{
		try
		{
			$request = $this->getRequest();
			if (!$request->isGet()) {
				throw new Exception("invalid Request.", 1);
			}

			$id = (int)$request->getParam('address_id');
			$customerId = (int)$request->getParam('customer_id');
			$modelProduct = Ccc::getModel('Customer_Address');
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

		return $this->redirect('grid', null,['customer_id'=>$customerId]);
	}
}