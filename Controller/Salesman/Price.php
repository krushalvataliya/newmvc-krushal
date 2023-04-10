<?php 
class Controller_Salesman_price extends Controller_Core_Action
{
	public function gridAction()
	{
		$layout = $this->getLayout();
		$content = $layout->createBlock('Salesman_Price_Grid');
		$layout->getChild('content')->addChild('grid',$content);
		$layout->render();
		die();
		$request = $this->getRequest();
		$id=(int)$request->getParam('salesman_id');
		if(!$id)
		{
			throw new Exception("invalid salesman ID.", 1);
		}
		
		$sql="SELECT * FROM `salesmen` ORDER BY `first_name` ASC";
		$modelSalesmanPrice =Ccc::getModel('Salesman_Price');
		$salesmen = $modelSalesmanPrice->fetchAll($sql);


		$sql = "SELECT SP.entity_id, SP.salesman_price, P.sku, P.cost, P.price, P.product_id 
		FROM `products` P 
		LEFT JOIN `salesman_price` SP ON P.product_id = SP.product_id AND SP.salesman_id = ".$id."";
		$modelSalesmanPrice =Ccc::getModel('product');
		$products = $modelSalesmanPrice->fetchAll($sql);

	}

	public function updateAction()
	{
		try
		{
			$request = $this->getRequest();
			if (!$request->isPost())
			{
				throw new Exception("invalid Request.", 1);
			}

			$updateSalesmanPrice = $request->getPost('sprice');
			$id = (int)$request->getParam('salesman_id');
			if(!$id)
			{
				throw new Exception("invalid salesman ID;", 1);
			}

			$button = $request->getPost('button');
			if($button == 'update'){
			foreach ($updateSalesmanPrice as $key => $value)
			{
			$modelSalesmanPrice1 =Ccc::getModel('Salesman_Price');
			$sql = 'SELECT `entity_id` FROM `salesman_price` WHERE `product_id` = '.$key.' AND `salesman_id` = '.$id.'';
			$result = $modelSalesmanPrice1->fetchRow($sql);
			if ($result->getData()!=null)
			{
			$modelSalesmanPrice =Ccc::getModel('Salesman_Price');
				$salesmanPrice1['salesman_price'] = $value;
				$salesmanPrice1['entity_id'] = $result->entity_id;
				$result1 = $modelSalesmanPrice->setData($salesmanPrice1)->save();
			}
			else
			{
			if($value)
			{	
			$modelSalesmanPrice =Ccc::getModel('Salesman_Price');
			$salesmanPrice = array('product_id' => $key, 'salesman_id' => $id, 'salesman_price' => $value);
			$result2 = $modelSalesmanPrice->setData($salesmanPrice)->save();
			}
			}
			}
			}
			if ($button == 'delete')
			{
				 return  $this->deleteAction();
			}
			$this->getMessage()->addMessage('price updated successfully.',  Model_Core_Message::SUCCESS);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('price not updated.',  Model_Core_Message::FAILURE);
		}
 		return $this->redirect('grid','salesman_price',['salesman_id'-> $id]);
		}

	

	public function deleteAction()
	{
		try
		{
			$id = (int)$this->getRequest()->getParam('salesman_id');
			$modelSalesmanPrice =Ccc::getModel('Salesman_Price');
			$delete = $this->getRequest()->getPost('delete_price');
			if(isset($delete))
			{
			foreach ($delete as $key => $value) {
			$result = $modelSalesmanPrice->load($key)->delete();
			if(!$delete)
			{
				throw new Exception("price not deleted", 1);
			}
			}
			$this->getMessage()->addMessage('price deleted successfully.',  Model_Core_Message::SUCCESS);
			}
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('price not deleted.',  Model_Core_Message::FAILURE);
		}
		return $this->redirect('grid','salesman_price',['salesman_id'-> $id]);
	}
}

?>