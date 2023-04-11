<?php 

class Controller_Salesman extends Controller_Core_Action
{
	public function gridAction()
	{
		$layout = $this->getLayout();
		$content = $layout->createBlock('Salesman_Grid');
		$layout->getChild('content')->addChild('grid',$content);
		$layout->render();
	}
	public function addAction()
	{
		$layout = $this->getLayout();
		$edit = $layout->createBlock('Salesman_Edit');
		$edit->getAddData();
		$layout->getChild('content')->addChild('edit',$edit);
		$layout->render();
	}
	public function editAction()
	{
		try
		{
			$request = $this->getRequest();
			$id=(int)$request->getParam('salesman_id');

			if(!$id)
			{
			throw new Exception("salesman id not found", 1);
			}
			$modelSalesman =Ccc::getModel('Salesman');
			$salesman =$modelSalesman->load($id);
			if(!$salesman)
			{
				throw new Exception("invalid salesman id.", 1);
			}
			$modelSalesmanAddress =Ccc::getModel('Salesman_Address');
			$sql = "SELECT * FROM `salesman_address` WHERE `salesman_id`= {$id}";
			$salesmanAddress =$modelSalesmanAddress->fetchRow($sql);
			if(!$salesmanAddress)
			{
				throw new Exception("Address not found.", 1);
			}$layout = $this->getLayout();
			$content = $layout->createBlock('Salesman_Edit');
			$content->setData(['salesman'=>$salesman,'salesmanAddress'=>$salesmanAddress]);
			$layout->getChild('content')->addChild('edit',$content);
			$layout->render();
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage() ,  Model_Core_Message::FAILURE);
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
			$salesman = $request->getPost('salesman');
			$salesmanAddress = $request->getPost('address');

			$modelSalesman =Ccc::getModel('Salesman');
			$modelSalesmanAddress =Ccc::getModel('Salesman_Address');

			if($id=(int)$request->getParam('salesman_id'))
			{
				$salesmanRow = $modelSalesman->load($id);
				if(!$salesmanRow)
				{
					throw new Exception("invalid id.", 1);
				}
				$salesman['salesman_id'] = $id;
				$sql = "SELECT * FROM `salesman_address` WHERE `salesman_id`= {$id}";
				$salesmanAddressRow = $modelSalesmanAddress->fetchRow($sql);
				if(!$salesmanAddressRow)
				{
					throw new Exception("invalid salesman address.", 1);
				}
				$salesmanAddress['address_id'] = $salesmanAddressRow->address_id;
			}

			$insertsalesman = $modelSalesman->setData($salesman)->save();
			if (!$insertsalesman) {
				throw new Exception("salesman not inserted.", 1);
			}

			if(!$id)
			{
			$salesmanAddress['salesman_id'] = $insertsalesman;
			}
			$insertsalesmanAddress = $modelSalesmanAddress->setData($salesmanAddress)->save();
			if (!$insertsalesman) {
				throw new Exception("salesman Address not inserted.", 1);
			}

			$this->getMessage()->addMessage('salesman saved successfully.',  Model_Core_Message::SUCCESS);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('salesman not saved.',  Model_Core_Message::FAILURE);
		}
		
		return $this->redirect('grid', null, null, true);
	}

	public function deleteAction()
	{
		try
		{
			$request = $this->getRequest();
			$id = (int)$request->getParam('salesman_id');
			if(!$id)
			{
				throw new Exception("invalid salesman ID", 1);
			}

			$modelSalesman =Ccc::getModel('Salesman');
			$delete = $modelSalesman->load($id)->delete();
			if(!$delete)
			{
				throw new Exception("salesman not deleted", 1);
			}
			$this->getMessage()->addMessage('salesman deleted successfully.',  Model_Core_Message::SUCCESS);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('salesman not deleted.',  Model_Core_Message::FAILURE);
		}

		return $this->redirect('grid', null, null, true);
	}
}

?>