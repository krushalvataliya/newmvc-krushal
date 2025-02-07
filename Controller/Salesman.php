<?php 

class Controller_Salesman extends Controller_Core_Action
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
		$index = $layout->createBlock('Salesman_Grid');
		$index->setRecordPerPage($recordsPerPage);
		$index = $index->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
	}

	public function addAction()
	{
		$add = $this->getLayout()->createBlock('Salesman_Edit');
		$add = $add->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$add,'element'=>'content']);
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
			}

			$edit = $this->getLayout()->createBlock('Salesman_Edit');
			$edit->setId($id);
			$edit = $edit->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$edit,'element'=>'content']);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage() ,  Model_Core_Message::FAILURE);
			return $this->redirect('grid', null, null, true);
		}
	}

	protected function _saveSalesman()
	{
		$request = $this->getRequest();
		$salesman = $request->getPost('salesman');
		$id=(int)$request->getParam('salesman_id');
		if($id)
		{
			$salesman['salesman_id'] = $id;
		}
		$modelSalesman =Ccc::getModel('Salesman');
		$insertSalesman = $modelSalesman->setData($salesman)->save();
		return $insertSalesman;
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
			$sameaddress = $request->getPost('sameaddress');
			
			$modelSalesman =Ccc::getModel('Salesman');
			$id=(int)$request->getParam('salesman_id');
			$salesmanAddress = $request->getPost('address');
			$salesmanAddress2 = $request->getPost('address2');
			$modelSalesmanAddress =Ccc::getModel('Salesman_Address');

			if($id)
			{
				$updeteSalesman['salesman_id'] = $id;
				$salesmanAddress['salesman_id'] = $id;
				$salesmanAddress2['salesman_id'] = $id;
				$salesmanRow = $modelSalesman->load($id);
				if(!$salesmanRow)
				{
					throw new Exception("invalid id.", 1);
				}
				$shippingAddress =  $salesmanRow->getShippingAddress();
				$billingAddress =  $salesmanRow->getShippingAddress();
				if ($salesmanRow->shiping_address_id)
				{
					$salesmanAddress['address_id'] = $salesmanRow->shiping_address_id;
				}
				if ($salesmanRow->billing_address_id != $salesmanRow->shiping_address_id )
				{
					$salesmanAddress2['address_id'] = $salesmanRow->billing_address_id;
				}
			}

			$insertSalesman = $this->_saveSalesman();
			if (!$insertSalesman) {
				throw new Exception("salesman not inserted.", 1);
			}
			if(!$id)
			{
				$updeteSalesman['salesman_id'] = $insertSalesman->salesman_id;
				$salesmanAddress['salesman_id'] = $insertSalesman->salesman_id;
				$salesmanAddress2['salesman_id'] = $insertSalesman->salesman_id;
			}
			$insertSalesmanAddress = $modelSalesmanAddress->setData($salesmanAddress)->save();
			$updeteSalesman['shiping_address_id'] = $insertSalesmanAddress->address_id;
			if($sameaddress && !$id)
			{
				unset($salesmanAddress2);
				$updeteSalesman['billing_address_id'] = $insertSalesmanAddress->address_id;
			}
			else if(!$sameaddress && $id)
			{
				$insertSalesmanAddress2 = $modelSalesmanAddress->setData($salesmanAddress2)->save();
				$updeteSalesman['shiping_address_id'] = $shippingAddress->address_id;
				if($shippingAddress->address_id == $billingAddress->address_id && $insertSalesmanAddress2->address_id >1)
				{
					$updeteSalesman['billing_address_id'] = $insertSalesmanAddress2->address_id;
				}
			}
			else if($sameaddress && $id)
			{
				unset($salesmanAddress2);
				$updeteSalesman['shiping_address_id'] = $shippingAddress->address_id;
				$updeteSalesman['billing_address_id'] = $shippingAddress->address_id;
			}
			else if(!$sameaddress && !$id)
			{
				$updeteSalesman['shiping_address_id'] = $insertSalesmanAddress->address_id;
				$insertSalesmanAddress2 = $modelSalesmanAddress->setData($salesmanAddress2)->save();
				$updeteSalesman['billing_address_id'] = $insertSalesmanAddress2->address_id;
			}

			if (!$insertSalesman) {
				throw new Exception("salesman Address not inserted.", 1);
			}
				$insertSalesman = $modelSalesman->setData($updeteSalesman)->save();
			$this->getMessage()->addMessage('salesman saved successfully.',  Model_Core_Message::SUCCESS);
			$layout = $this->getLayout();
			$index = $layout->createBlock('Salesman_Grid')->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('salesman not saved.',  Model_Core_Message::FAILURE);
		}
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
			$layout = $this->getLayout();
			$index = $layout->createBlock('Salesman_Grid')->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('salesman not deleted.',  Model_Core_Message::FAILURE);
		}

	}

	public function importAction()
	{
		$layout = $this->getLayout();
		$addImage = $layout->createBlock('Core_Layout')->setTemplete('core/importfile.phtml');;
		$addImage = $addImage->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$addImage,'element'=>'content']);
		
	}

	public function savefileAction()
	{
		try
		{
			$uploadModel =  CCC::getModel('Core_File_Upload');
			$uploadModel->setPath('csv')->setFileName('salesman.csv')->upload('fileToUpload');

			$readCsvModel =  CCC::getModel('Core_File_Csv');
			$rows = $readCsvModel->setPath('csv')->setFileName($uploadModel->getFileName())->read()->getRows();

			$modelSalesman = Ccc::getModel('salesman');
			$insert = $modelSalesman->getResource()->insertMultiple($rows, 'email');
			if(!$insert)
			{
				throw new Exception("data not saved from csv file.", 1);
			}
			return $this->redirect('index');	
		} 
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('csv not imported because of '.$e->getMessage(),  Model_Core_Message::FAILURE);
			return $this->redirect('index');	
		}
	}

	public function exportAction()
	{
		try
		{
			$modelSalesman = Ccc::getModel('salesman');
			$sql = "SELECT salesman_id,first_name,last_name,email,gender,mobile,status,company FROM `salesmen`";
			$salesmem = $modelSalesman->getResource()->fetchAll($sql);
			if(!$salesmem)
			{
				throw new Exception("data not found.", 1);
			}
			foreach ($salesmem as &$salesman)
			{
				if($salesman['status'] == Model_Salesman::STATUS_ACTIVE)
				{
					$salesman['status'] = Model_Salesman::STATUS_ACTIVE_LBL;
				}
				if($salesman['status'] == Model_Salesman::STATUS_INACTIVE)
				{
					$salesman['status'] = Model_Salesman::STATUS_INACTIVE_LBL;
				}
			}

			$exportModel =  CCC::getModel('Core_File_Export');
			$exportModel->setFileName('salesm.csv')->putData($salesmem);
			$exportModel->export();
			exit();
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('csv not exported because of '.$e->getMessage(),  Model_Core_Message::FAILURE);

		}
	}
}

?>