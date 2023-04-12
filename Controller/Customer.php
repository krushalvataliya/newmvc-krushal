<?php 

class Controller_Customer extends Controller_Core_Action
{
	public function gridAction()
	{

		$model = Ccc::getModel('customer');
		// echo "<pre>";
		// print_r($model->getAddresses());
		// // print_r($model->getBillingAddress());
		// // print_r($model->getShippingAddress());
		// die;




		$layout = $this->getLayout();
		$content = $layout->createBlock('Customer_Grid');
		$layout->getChild('content')->addChild('grid',$content);
		$layout->render();
	}
	public function addAction()
	{
		$layout = $this->getLayout();
		$edit = $layout->createBlock('Customer_Edit');
		$edit->getAddData();
		$layout->getChild('content')->addChild('edit',$edit);
		$layout->render();
	}
	public function editAction()
	{
		try
		{
			$request = $this->getRequest();
			$id=(int)$request->getParam('customer_id');
			if(!$id)
			{
			throw new Exception("Customer id not found", 1);
			}
			$modelCustomer =Ccc::getModel('Customer');
			$customer =$modelCustomer->load($id);
			if(!$customer)
			{
				throw new Exception("invalid customer id.", 1);
			}
			$modelCustomerAddress =Ccc::getModel('Customer_Address');
			$sql = "SELECT * FROM `customer_address` WHERE `customer_id`= {$id}";
			$customerAddress =$modelCustomerAddress->fetchRow($sql);
			if(!$customerAddress)
			{
				throw new Exception("Address not found.", 1);
			}
			$layout = $this->getLayout();
			$content = $layout->createBlock('Customer_Edit');
			$content->setData(['customer'=>$customer,'customerAddress'=>$customerAddress]);
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
			echo "<pre>";
			$sameaddress = $request->getPost('sameaddress');
			$customer = $request->getPost('customer');
			$id=(int)$request->getParam('customer_id');
			$customerAddress = $request->getPost('address');
			$customerAddress2 = $request->getPost('address2');
			if($sameaddress && !$id)
			{
				unset($customerAddress2);
			}
			$modelCustomer =Ccc::getModel('Customer');
			$modelCustomerAddress =Ccc::getModel('Customer_Address');

			if($id)
			{
				$customerRow = $modelCustomer->load($id);
				if(!$customerRow)
				{
					throw new Exception("invalid id.", 1);
				}
				$customer['customer_id'] = $id;
				$sql = "SELECT * FROM `customer_address` WHERE `customer_id`= {$id}";
				$customerAddressRow = $modelCustomerAddress->fetchRow($sql);
				if(!$customerAddressRow)
				{
					throw new Exception("invalid Customer address.", 1);
				}
				if ($customerRow->shiping_address_id)
				{
					$customerAddress['address_id'] = $customerRow->shiping_address_id;
				}
				if ($customerRow->billing_address_id != $customerRow->shiping_address_id )
				{
					$customerAddress2['address_id'] = $customerRow->billing_address_id;
				}
			}

			$insertCustomer = $modelCustomer->setData($customer)->save();
			if (!$insertCustomer) {
				throw new Exception("Customer not inserted.", 1);
			}

			if(!$id)
			{
				$sql = "SELECT * FROM `customer_address` WHERE `customer_id`= {$insertCustomer}";
				$customerAddressRow = $modelCustomerAddress->fetchRow($sql);
				$updeteCustomer['customer_id'] = $insertCustomer;
				$customerAddress['customer_id'] = $insertCustomer;
				$customerAddress2['customer_id'] = $insertCustomer;
				$updeteCustomer['customer_id'] = $insertCustomer;
			}
			else
			{
				$sql = "SELECT * FROM `customer_address` WHERE `customer_id`= {$id}";
				$customerAddressRow = $modelCustomerAddress->fetchRow($sql);
				$updeteCustomer['customer_id'] = $id;
				$customerAddress['customer_id'] = $id;
				$customerAddress2['customer_id'] = $id;
				$updeteCustomer['customer_id'] = $id;
			}
			if($sameaddress && !$id)
			{
			$this->getMessage()->addMessage('case 1.',  Model_Core_Message::SUCCESS);
				unset($customerAddress2);
				$insertCustomerAddress = $modelCustomerAddress->setData($customerAddress)->save();
				$updeteCustomer['shiping_address_id'] = $insertCustomerAddress;
				$updeteCustomer['billing_address_id'] = $insertCustomerAddress;
				$insertCustomer = $modelCustomer->setData($updeteCustomer)->save();
			}
			else if(!$sameaddress && $id)
			{
			$this->getMessage()->addMessage('case 2.',  Model_Core_Message::SUCCESS);
				$shippingAddress =  $modelCustomer->getShippingAddress();
				$billingAddress =  $modelCustomer->getShippingAddress();
				$insertCustomerAddress = $modelCustomerAddress->setData($customerAddress)->save();
				$insertCustomerAddress2 = $modelCustomerAddress->setData($customerAddress2)->save();
				$updeteCustomer['shiping_address_id'] = $shippingAddress->address_id;
				if($shippingAddress->address_id == $billingAddress->address_id)
				{
				$updeteCustomer['billing_address_id'] = $insertCustomerAddress2;
				}
				$insertCustomer = $modelCustomer->setData($updeteCustomer)->save();
			}
			else if($sameaddress && $id)
			{
			$this->getMessage()->addMessage('case 3.',  Model_Core_Message::SUCCESS);
				$shippingAddress =  $modelCustomer->getShippingAddress();
				$billingAddress =  $modelCustomer->getShippingAddress();
				$insertCustomerAddress = $modelCustomerAddress->setData($customerAddress)->save();
				$updeteCustomer['shiping_address_id'] = $shippingAddress->address_id;
				$updeteCustomer['billing_address_id'] = $billingAddress->address_id;
			}
			else if(!$sameaddress && !$id)
			{
			$this->getMessage()->addMessage('case 4.',  Model_Core_Message::SUCCESS);
				$insertCustomerAddress = $modelCustomerAddress->setData($customerAddress)->save();
				$updeteCustomer['shiping_address_id'] = $insertCustomerAddress;
				$insertCustomerAddress2 = $modelCustomerAddress->setData($customerAddress2)->save();
				$updeteCustomer['billing_address_id'] = $insertCustomerAddress2;
				$insertCustomer = $modelCustomer->setData($updeteCustomer)->save();
			}

			if (!$insertCustomer) {
				throw new Exception("Customer Address not inserted.", 1);
			}
			// $this->getMessage()->addMessage('Customer saved successfully.',  Model_Core_Message::SUCCESS);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('Customer not saved.',  Model_Core_Message::FAILURE);
		}
		
		return $this->redirect('grid', null, null, true);
	}

	public function deleteAction()
	{
		try
		{
			$request = $this->getRequest();
			$id = (int)$request->getParam('customer_id');
			if(!$id)
			{
				throw new Exception("invalid customer ID", 1);
			}
			$modelCustomer =Ccc::getModel('Customer');
			$delete = $modelCustomer->load($id)->delete();
			if(!$delete)
			{
				throw new Exception("Customer not deleted", 1);
			}
			$this->getMessage()->addMessage('Customer deleted successfully.',  Model_Core_Message::SUCCESS);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('Customer not deleted.',  Model_Core_Message::FAILURE);
		}

		return $this->redirect('grid', null, null, true);
	}
}

?>