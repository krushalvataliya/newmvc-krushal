<?php 

class Controller_Customer extends Controller_Core_Action
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
		$index = $layout->createBlock('Customer_Grid')->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
	}
	public function addAction()
	{
		$add = $this->getLayout()->createBlock('Customer_Edit');
		$add = $add->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$add,'element'=>'content']);
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
			
			$edit = $this->getLayout()->createBlock('Customer_Edit');
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

	protected function _saveCustomer()
	{
		$request = $this->getRequest();
		$customer = $request->getPost('customer');
		$id=(int)$request->getParam('customer_id');
		if($id)
		{
			$customer['customer_id'] = $id;
		}
		$modelCustomer =Ccc::getModel('Customer');
		$customer['entity_type_id'] = Model_Customer::ENTITY_TYPE_ID ;
		$insertCustomer = $modelCustomer->setData($customer)->save();
		return $insertCustomer;
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
			$attributeData = $request->getPost('attribute');
			
			$modelCustomer =Ccc::getModel('Customer');
			$id=(int)$request->getParam('customer_id');
			$customerAddress = $request->getPost('address');
			$customerAddress2 = $request->getPost('address2');
			$modelCustomerAddress =Ccc::getModel('Customer_Address');

			if($id)
			{
				$updeteCustomer['customer_id'] = $id;
				$customerAddress['customer_id'] = $id;
				$customerAddress2['customer_id'] = $id;
				$customerRow = $modelCustomer->load($id);
				if(!$customerRow)
				{
					throw new Exception("invalid id.", 1);
				}
				$shippingAddress =  $customerRow->getShippingAddress();
				$billingAddress =  $customerRow->getShippingAddress();
				if ($customerRow->shiping_address_id)	
				{
					$customerAddress['address_id'] = $customerRow->shiping_address_id;
				}
				if ($customerRow->billing_address_id != $customerRow->shiping_address_id )
				{
					$customerAddress2['address_id'] = $customerRow->billing_address_id;
				}
			}

			$insertCustomer = $this->_saveCustomer();
			if (!$insertCustomer) {
				throw new Exception("Customer not inserted.", 1);
			}
			if(!$id)
			{
				$updeteCustomer['customer_id'] = $insertCustomer->customer_id;
				$customerAddress['customer_id'] = $insertCustomer->customer_id;
				$customerAddress2['customer_id'] = $insertCustomer->customer_id;
			}
			$insertCustomerAddress = $modelCustomerAddress->setData($customerAddress)->save();
			$updeteCustomer['shiping_address_id'] = $insertCustomerAddress->address_id;
			if($sameaddress && !$id)
			{
				unset($customerAddress2);
				$updeteCustomer['billing_address_id'] = $insertCustomerAddress->address_id;
			}
			else if(!$sameaddress && $id)
			{
				$insertCustomerAddress2 = $modelCustomerAddress->setData($customerAddress2)->save();
				$updeteCustomer['shiping_address_id'] = $shippingAddress->address_id;
				if($shippingAddress->address_id == $billingAddress->address_id && $insertCustomerAddress2->address_id >1)
 					{
					$updeteCustomer['billing_address_id'] = $insertCustomerAddress2->address_id;
				}
			}
			else if($sameaddress && $id)
			{
				unset($customerAddress2);
				$updeteCustomer['shiping_address_id'] = $shippingAddress->address_id;
				$updeteCustomer['billing_address_id'] = $shippingAddress->address_id;
			}
			else if(!$sameaddress && !$id)
			{
				$updeteCustomer['shiping_address_id'] = $insertCustomerAddress->address_id;
				$insertCustomerAddress2 = $modelCustomerAddress->setData($customerAddress2)->save();
				$updeteCustomer['billing_address_id'] = $insertCustomerAddress2->address_id;
			}

			if (!$insertCustomer) {
				throw new Exception("Customer Address not inserted.", 1);
			}

			$entityId = ($id) ? ($id) : ($insertCustomer->getId());
			foreach ($attributeData as $backendType => $value)
			{
				foreach ($value as $attributeId => $v)
				{
					if(is_array($v))
					{
						$v = implode(',', $v);
					}
					$model = Ccc::getModel('Core_Table');
					$resource = $model->getResource()->setTableName("customer_{$backendType}")->setPrimaryKey('value_id');
					$data = ['attribute_id'=>$attributeId,'entity_id'=> $entityId, 'value' => $v];
					$uniqueColumns = ['attribute_id'=>$attributeId,'entity_id'=> $entityId];
					$insertUpdate = $resource->insertUpdateOnDuplicate($data,$uniqueColumns);
					if(!$insertUpdate)
					{
						throw new Exception("Customer's Attribute not inserted.", 1);
						
					}
				}
			}
				$insertCustomer = $modelCustomer->setData($updeteCustomer)->save();
			$this->getMessage()->addMessage('Customer saved successfully.',  Model_Core_Message::SUCCESS);
			$layout = $this->getLayout();
			$index = $layout->createBlock('Customer_Grid')->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('Customer not saved.',  Model_Core_Message::FAILURE);
		}
		
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
			$layout = $this->getLayout();
			$index = $layout->createBlock('Customer_Grid')->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('Customer not deleted.',  Model_Core_Message::FAILURE);
		}

	}
}

?>