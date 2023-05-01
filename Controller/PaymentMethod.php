<?php 

class Controller_PaymentMethod extends Controller_Core_Action
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
		$request = $this->getRequest();
		$recordsPerPage=(int)$request->getParam('recordsPerPage');	
		$index = $layout->createBlock('PaymentMethod_Grid');
		$index->setRecordPerPage($recordsPerPage);
		$index = $index->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
	}
	
	public function addAction()
	{
		$add = $this->getLayout()->createBlock('PaymentMethod_Edit');
		$add = $add->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$add,'element'=>'content']);
	}

	public function editAction()
	{
		try
		{
			$request = $this->getRequest();
			$id=(int)$request->getParam('payment_method_id');
			if(!isset($id))
			{
			  throw new Exception("id not found.", 1);
			}
			$modelPaymentMethod = Ccc::getModel('PaymentMethod');
			$paymentMethod =$modelPaymentMethod->load($id);
			if(!$paymentMethod)
			{
				throw new Exception("invalid payment_method id.", 1);
				
			}
			$edit = $this->getLayout()->createBlock('PaymentMethod_Edit');
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

	public function deleteAction()
	{
		try
		{
			$request = $this->getRequest();
			if(!$id = (int) $request->getParam('payment_method_id'))
			{
				throw new Exception("invalid id.", 1);
			}
			$modelPaymentMethod = Ccc::getModel('PaymentMethod');
			$delete = $modelPaymentMethod->load($id)->delete();
			if(!$delete)
			{
				throw new Exception("payment_method not deleted.", 1);
			}
			$this->getMessage()->addMessage('payment_method deleted successfully.',  Model_Core_Message::SUCCESS);
			$layout = $this->getLayout();
			$index = $layout->createBlock('PaymentMethod_Grid')->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('payment_method not deleted.',  Model_Core_Message::FAILURE);
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

			$postData = $request->getPost('payment_method');
			if(!$postData)
			{
				throw new Exception("no data posted.", 1);
			}

			$modelRowPaymentMethod = Ccc::getModel('PaymentMethod');
			if($id = (int)$request->getParam('payment_method_id'))
			{
				$PaymentMethodRow = $modelRowPaymentMethod->load($id);
				if (!$PaymentMethodRow)
				{
					throw new Exception("invalid id", 1);
				}
				$postData['payment_method_id'] =$PaymentMethodRow->payment_method_id ;
			}

			$modelRowPaymentMethod->setData($postData);
			$result =$modelRowPaymentMethod->save();
			if(!$result)
			{
				throw new Exception("unable to save payment_method", 1);
				
			}
			$this->getMessage()->addMessage('payment_method saved successfully.',  Model_Core_Message::SUCCESS);
			$layout = $this->getLayout();
			$index = $layout->createBlock('PaymentMethod_Grid')->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$index,'element'=>'content']);

		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('payment_method not saved.',  Model_Core_Message::FAILURE);
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
			$uploadModel->setPath('csv')->setFileName('paymentMethod.csv')->upload('fileToUpload');

			$readCsvModel =  CCC::getModel('Core_File_Csv');
			$rows = $readCsvModel->setPath('csv')->setFileName($uploadModel->getFileName())->read()->getRows();

			$paymentMethod = Ccc::getModel('paymentMethod');
			$insert = $paymentMethod->getResource()->insertMultiple($rows, 'name');
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
			$paymentMethod = Ccc::getModel('paymentMethod');
			$sql = "SELECT payment_method_id,name,status FROM `payment_methods`",
		$paymentMethods = $paymentMethod->getResource()->fetchAll($sql);
			if(!$paymentMethods)
			{
				throw new Exception("data not found.", 1);
			}
			foreach ($paymentMethods as &$paymentMethod)
			{
				if($paymentMethod['status'] == Model_PaymentMethod::STATUS_ACTIVE)
				{
					$paymentMethod['status'] = Model_paymentMethod::STATUS_ACTIVE_LBL;
				}
				if($paymentMethod['status'] == Model_paymentMethod::STATUS_INACTIVE)
				{
					$paymentMethod['status'] = Model_paymentMethod::STATUS_INACTIVE_LBL;
				}
			}

			$exportModel =  CCC::getModel('Core_File_Export');
			$exportModel->setFileName('payment_methods.csv')->putData($paymentMethods);
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