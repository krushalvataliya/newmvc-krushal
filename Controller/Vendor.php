<?php 

class Controller_Vendor extends Controller_Core_Action
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
		$index = $layout->createBlock('Vendor_Grid');
		$index->setRecordPerPage($recordsPerPage);
		$index = $index->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
	}

	public function addAction()
	{
		$add = $this->getLayout()->createBlock('Vendor_Edit');
		$add = $add->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$add,'element'=>'content']);
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
			$edit = $this->getLayout()->createBlock('Vendor_Edit');
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

	public function saveAction()
	{
		try
		{
			$request = $this->getRequest();
			if (!$request->isPost())
			{
				throw new Exception("invalid Request.", 1);
			}
			$vendor = $request->getPost('vendor');
			$vendorAddress = $request->getPost('address');

			$modelVendor =Ccc::getModel('Vendor');
			$modelVendorAddress =Ccc::getModel('Vendor_Address');

			if($id=(int)$request->getParam('vendor_id'))
			{
				$vendorRow = $modelVendor->load($id);
				if(!$vendorRow)
				{
					throw new Exception("invalid id.", 1);
				}
				$vendor['vendor_id'] = $id;
				$sql = "SELECT * FROM `vendor_address` WHERE `vendor_id`= {$id}";
				$vendorAddressRow = $modelVendorAddress->fetchRow($sql);
				if(!$vendorAddressRow)
				{
					throw new Exception("invalid vendor address.", 1);
				}
				$vendorAddress['address_id'] = $vendorAddressRow->address_id;
			}

			$insertvendor = $modelVendor->setData($vendor)->save();
			if (!$insertvendor) {
				throw new Exception("vendor not inserted.", 1);
			}

			if(!$id)
			{
			$vendorAddress['vendor_id'] = $insertvendor->vendor_id;
			}
			$insertvendorAddress = $modelVendorAddress->setData($vendorAddress)->save();

			$entityId = ($id) ? ($id) : ($insertvendor->getId());
			if(isset($attributeData))
			{
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
			}
			$this->getMessage()->addMessage('vendor saved successfully.',  Model_Core_Message::SUCCESS);
			$layout = $this->getLayout();
			$index = $layout->createBlock('Vendor_Grid')->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
	}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('vendor not saved.',  Model_Core_Message::FAILURE);
		}
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
				throw new Exception("vendor not deleted1", 1);
			}
			$this->getMessage()->addMessage('vendor deleted successfully.',  Model_Core_Message::SUCCESS);
			$layout = $this->getLayout();
			$index = $layout->createBlock('Vendor_Grid')->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),  Model_Core_Message::FAILURE);
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
			$uploadModel->setPath('csv')->setFileName('vendor.csv')->upload('fileToUpload');

			$readCsvModel =  CCC::getModel('Core_File_Csv');
			$rows = $readCsvModel->setPath('csv')->setFileName($uploadModel->getFileName())->read()->getRows();

			$modelvendor = Ccc::getModel('vendor');
			$insert = $modelvendor->getResource()->insertMultiple($rows, 'email');
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
			$modelvendor = Ccc::getModel('vendor');
			$sql = "SELECT vendor_id, entity_type_id, first_name, last_name, email, gender, mobile, status, company FROM `vendors`";
	$vendors = $modelvendor->getResource()->fetchAll($sql);
			if(!$vendors)
			{
				throw new Exception("data not found.", 1);
			}

			foreach ($vendors as &$vendor)
			{
				if($vendor['status'] == Model_Vendor::STATUS_ACTIVE)
				{
					$vendor['status'] = Model_Vendor::STATUS_ACTIVE_LBL;
				}
				if($vendor['status'] == Model_Vendor::STATUS_INACTIVE)
				{
					$vendor['status'] = Model_Vendor::STATUS_INACTIVE_LBL;
				}
			}

			$exportModel =  CCC::getModel('Core_File_Export');
			$exportModel->setFileName('vendors.csv')->putData($vendors);
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