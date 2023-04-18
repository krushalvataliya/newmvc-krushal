<?php 

class Controller_Vendor extends Controller_Core_Action
{
	public function gridAction()
	{
		$layout = $this->getLayout();
		$content = $layout->createBlock('Vendor_Grid');
		$layout->getChild('content')->addChild('grid',$content);
		$layout->render();
	}
	public function addAction()
	{
		$layout = $this->getLayout();
		$edit = $layout->createBlock('Vendor_Edit');
		$edit->getAddData();
		$layout->getChild('content')->addChild('edit',$edit);
		$layout->render();
	}
	public function editAction()
	{
		try
		{
			$request = $this->getRequest();
			$id=(int)$request->getParam('vendor_id');

			if(!$id)
			{
			throw new Exception("Vendor id not found", 1);
			}
			$modelVendor =Ccc::getModel('Vendor');
			$vendor =$modelVendor->load($id);
			if(!$vendor)
			{
				throw new Exception("invalid vendor id.", 1);
			}
			$modelVendorAddress =Ccc::getModel('Vendor_Address');
			$sql = "SELECT * FROM `vendor_address` WHERE `vendor_id`= {$id}";
			$vendorAddress =$modelVendorAddress->fetchRow($sql);
			if(!$vendorAddress)
			{
				throw new Exception("Address not found.", 1);
			}
			$layout = $this->getLayout();
			$content = $layout->createBlock('Vendor_Edit');
			$content->setData(['vendor'=>$vendor,'vendorAddress'=>$vendorAddress]);
			$layout->getChild('content')->addChild('edit',$content);
			$layout->render();
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage() ,  Model_Core_Message::FAILURE);
			return $this->redirect('grid', null, null, true);
		}
	}

	protected function _saveVendor()
	{
		$request = $this->getRequest();
		$vendor = $request->getPost('vendor');
		$id=(int)$request->getParam('vendor_id');
		if($id)
		{
			$vendor['vendor_id'] = $id;
		}
		$modelVendor =Ccc::getModel('vendor');
		$vendor['entity_type_id'] = Model_Vendor::ENTITY_TYPE_ID ;
		$insertVendor = $modelVendor->setData($vendor)->save();
		return $insertVendor;
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
			
			$modelVendor =Ccc::getModel('vendor');
			$id=(int)$request->getParam('vendor_id');
			$attributeData = $request->getPost('attribute');
			$vendorAddress = $request->getPost('address');
			$vendorAddress2 = $request->getPost('address2');
			$modelVendorAddress =Ccc::getModel('Vendor_Address');

			if($id)
			{
				$updeteVendor['vendor_id'] = $id;
				$vendorAddress['vendor_id'] = $id;
				$vendorAddress2['vendor_id'] = $id;
				$vendorRow = $modelVendor->load($id);
				if(!$vendorRow)
				{
					throw new Exception("invalid id.", 1);
				}
				$shippingAddress =  $vendorRow->getShippingAddress();
				$billingAddress =  $vendorRow->getShippingAddress();
				if ($vendorRow->shiping_address_id)
				{
					$vendorAddress['address_id'] = $vendorRow->shiping_address_id;
				}
				if ($vendorRow->billing_address_id != $vendorRow->shiping_address_id )
				{
					$vendorAddress2['address_id'] = $vendorRow->billing_address_id;
				}
			}

			$insertVendor = $this->_saveVendor();
			if (!$insertVendor) {
				throw new Exception("vendor not inserted.", 1);
			}
			if(!$id)
			{
				$updeteVendor['vendor_id'] = $insertVendor->vendor_id;
				$vendorAddress['vendor_id'] = $insertVendor->vendor_id;
				$vendorAddress2['vendor_id'] = $insertVendor->vendor_id;
			$insertVendorAddress = $modelVendorAddress->setData($vendorAddress)->save();
			$updeteVendor['shiping_address_id'] = $insertVendorAddress->address_id;
			}
			if($sameaddress && !$id)
			{
				unset($vendorAddress2);
				$updeteVendor['billing_address_id'] = $insertVendorAddress->address_id;
			}
			else if(!$sameaddress && $id)
			{
				$insertVendorAddress2 = $modelVendorAddress->setData($vendorAddress2)->save();
				$updeteVendor['shiping_address_id'] = $shippingAddress->address_id;
				if($shippingAddress->address_id == $billingAddress->address_id && $insertVendorAddress2->address_id >1)
				{
					$updeteVendor['billing_address_id'] = $insertVendorAddress2->address_id;
				}
			}
			else if($sameaddress && $id)
			{
				unset($vendorAddress2);
				$updeteVendor['shiping_address_id'] = $shippingAddress->address_id;
				$updeteVendor['billing_address_id'] = $shippingAddress->address_id;
			}
			else if(!$sameaddress && !$id)
			{
				$updeteVendor['shiping_address_id'] = $insertVendorAddress->address_id;
				$insertVendorAddress2 = $modelVendorAddress->setData($vendorAddress2)->save();
				$updeteVendor['billing_address_id'] = $insertVendorAddress2->address_id;
			}

			if (!$insertVendor) {
				throw new Exception("vendor Address not inserted.", 1);
			}

			$entityId = ($id) ? ($id) : ($insertVendor->getId());
			foreach ($attributeData as $backendType => $value)
			{
				foreach ($value as $attributeId => $v)
				{
					if(is_array($v))
					{
						$v = implode(',', $v);
					}
					$model = Ccc::getModel('Core_Table');
					$resource = $model->getResource()->setTableName("vendor_{$backendType}")->setPrimaryKey('value_id');
					$data = ['attribute_id'=>$attributeId,'entity_id'=> $entityId, 'value' => $v];
					$uniqueColumns = ['attribute_id'=>$attributeId,'entity_id'=> $entityId];
					$insertUpdate = $resource->insertUpdateOnDuplicate($data,$uniqueColumns);
					if(!$insertUpdate)
					{
						throw new Exception("vendor's Attribute not inserted.", 1);
						
					}
				}
			}
				$insertVendor = $modelVendor->setData($updeteVendor)->save();
			$this->getMessage()->addMessage('vendor saved successfully.',  Model_Core_Message::SUCCESS);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('vendor not saved.',  Model_Core_Message::FAILURE);
		}
		
		return $this->redirect('grid', null, null, true);
	}

	public function deleteAction()
	{
		try
		{
			$request = $this->getRequest();
			$id = (int)$request->getParam('vendor_id');
			if(!$id)
			{
				throw new Exception("invalid vendor ID", 1);
			}

			$modelVendor =Ccc::getModel('Vendor');
			$delete = $modelVendor->load($id)->delete();
			if(!$delete)
			{
				throw new Exception("vendor not deleted", 1);
			}
			$this->getMessage()->addMessage('vendor deleted successfully.',  Model_Core_Message::SUCCESS);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('vendor not deleted.',  Model_Core_Message::FAILURE);
		}

		return $this->redirect('grid', null, null, true);
	}
}
?>