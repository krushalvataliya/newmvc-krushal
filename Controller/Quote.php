<?php
/**
 * 
 */
class Controller_Quote extends Controller_Core_Action
{
	public function indexAction ()
	{
		$layout = $this->getLayout();
		$index = $layout->createBlock('Core_Layout')->setTemplete('core/index.phtml');;
		$layout->getChild('content')->addChild('index',$index);
		$this->renderLayout();
	}

	
	function __construct()
	{
		
	}

	public function setidAction()
	{
		$request = $this->getRequest();
		$customerId=$request->getParam('customer_id');
		$this->getSession()->start()->set('customer_id',$customerId );
		return $this->redirect('grid','quote',null,true);
	}	

	public function gridAction()
	{
		$layout = $this->getLayout();
		$content = $layout->createBlock('Quote_Grid');				
		$layout->getChild('content')->addChild('grid',$content);
		echo $layout->toHtml();
	}

	public function addproductAction()
	{	
		try
		{
			$request = $this->getRequest();
			if (!$request->isPost())
			{
				throw new Exception("invalid Request.", 1);
			}
			$modelQuoteItems =Ccc::getModel('Quote_Items');
			$modelQuote =Ccc::getModel('Quote');
			$quoteId = $modelQuote->getQuoteDetails()->quote_id;
			$quantity=$request->getPost('quantity');
			$add=$request->getPost('add');
			echo '<pre>';
			$quantity = array_filter($quantity);

			$customerId=(int)$this->getSession()->start()->get('customer_id');
			foreach ($quantity as $productId => $quantity)
			{
				$sql = "SELECT * FROM `quote_items` WHERE `product_id` = '{$productId}' AND `quote_id` = '{$quoteId}'";
				$result =$modelQuote->fetchRow($sql);
				$data['product_id'] = $productId;
				$data['quantity'] = $quantity;
				if(!$result->getData())
				{
					$modelQuoteItems =Ccc::getModel('Quote_Items');
					$modelQuote =Ccc::getModel('Quote');
					$sql = "SELECT * FROM `products` WHERE `product_id` = '{$productId}'";
					$product =$modelQuote->fetchRow($sql);
					$data['price'] = $product->price;
					$data['quote_id'] = $quoteId;
					$result =$modelQuoteItems->setData($data)->save();
					if(!$result)
					{
						throw new Exception("product not inserted in cart.", 1);
					}
				}
				else
				{
					$modelQuoteItems =Ccc::getModel('Quote_Items');
					$modelQuote =Ccc::getModel('Quote');
					$data['quantity'] += $result->quantity;
					$data['item_id'] = $result->item_id;
					unset($productId);
					$result2 =$modelQuoteItems->setData($data)->save();
					if(!$result2)
					{
						throw new Exception("product not updated in cart.", 1);
					}
				}
			}
			$this->getMessage()->addMessage('product saved successfully in cart.',  Model_Core_Message::SUCCESS);

		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('product not saved in cart.',  Model_Core_Message::FAILURE);
		}

		return $this->redirect('grid','quote');
	}

	public function addMethodAction()
	{
		try
		{
			$request = $this->getRequest();
			if (!$request->isPost())
			{
				throw new Exception("invalid Request.", 1);
			}
			$data = $request->getPost();
			$customerId =(int)$this->getSession()->start()->get('customer_id');
			$data['customer_id'] = $customerId;
			$id = $data['shiping_method_id'];	
			$sql = "SELECT * FROM `quote` WHERE `customer_id` = '{$customerId}'";
			$modelQuote =Ccc::getModel('quote');
			$result =$modelQuote->fetchRow($sql);
				$modelQuote =Ccc::getModel('quote');
				$sql = "SELECT * FROM `shiping_methods`WHERE `shiping_method_id` = '{$id}'";
				$method =$modelQuote->fetchRow($sql);
			if(!$result->getData())
			{
				$modelQuote =Ccc::getModel('quote');
				$data['shiping_amount'] = $method->amount;
				$result =$modelQuote->setData($data)->save();
				if(!$result)
				{
					throw new Exception("method not saved.", 1);
				}
			}
			else
			{
				$data['quote_id'] = $result->quote_id;
				$data['shiping_amount'] = $method->amount;
				$result =$modelQuote->setData($data)->save();
				if(!$result)
				{
					throw new Exception("method not saved.", 1);
				}
			}
			$this->getMessage()->addMessage('method saved successfully.',  Model_Core_Message::SUCCESS);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('method not saved.',  Model_Core_Message::FAILURE);
		}
		return $this->redirect('grid','quote',null,false);

	}

	public function updateQuantityAction()
	{
		try
		{
			$request = $this->getRequest();
			if (!$request->isPost())
			{
				throw new Exception("invalid Request.", 1);
			}
			$products = $request->getPost('product');
			$modelQuote =Ccc::getModel('quote');
			$quoteId =(int) $modelQuote->getQuoteDetails()->quote_id;
			$modelQuoteItems =Ccc::getModel('Quote_Items');
			foreach ($products as $productId => $detail)
			{
				$modelQuote1 =Ccc::getModel('Quote_Items');
				$sql = "SELECT * FROM `quote_items`WHERE `product_id` = '{$productId}' AND `quote_id` = '{$quoteId}' ";
				$cartItem1 = $modelQuoteItems->fetchRow($sql);
				$data['item_id'] = $cartItem1->item_id;
				$data['quantity'] = (int)$detail['quantity'];
				$data['discount'] = (int)$detail['discount'];
				$update =$modelQuoteItems->setData($data)->save();
				if(!$update)
				{
					throw new Exception("quantity not updated", 1);
				}

			}
			$this->getMessage()->addMessage('product quantity updated successfully in cart.',  Model_Core_Message::SUCCESS);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('product quantity not updated in cart.',  Model_Core_Message::FAILURE);
		}
		return $this->redirect('grid','quote');
	}

	public function deleteproductAction()
	{
		try
		{
		$request = $this->getRequest();
		$productId =(int) $request->getParam('product_id');
		$modelQuoteItems =Ccc::getModel('Quote_Items');
		$sql = "SELECT * FROM `quote_items` WHERE `product_id` = {$productId}";
		$result =$modelQuoteItems->fetchRow($sql);
		$delete = $result->delete();			
		if(!$delete)
		{
			throw new Exception("product not deleted", 1);
		}
			$this->getMessage()->addMessage('product deleted successfully from cart.',  Model_Core_Message::SUCCESS);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('product not deleted from cart.',  Model_Core_Message::FAILURE);
		}
		return $this->redirect('grid','quote',null,true);
	}

	public function addaddressAction()
	{
		try
		{
			$request = $this->getRequest();
			if (!$request->isPost())
			{
				throw new Exception("invalid Request.", 1);
			}
			$customerId =(int)$this->getSession()->start()->get('customer_id');
			echo "<pre>";
			$address = $request->getPost('address');
			$address2 = $request->getPost('address2');
			$markAsShippinng = $request->getPost('markasshippinng');
			($markAsShippinng)?($saveAddress = $address):($saveAddress = $address2);

			$modelQuote =Ccc::getModel('quote');
			$quoteId =(int) $modelQuote->getQuoteDetails()->quote_id;
			$saveAddress['quote_id'] = $quoteId;
			echo $sql = "SELECT * FROM `quote_address` WHERE `quote_id` = '{$quoteId}'";
			$modelQuoteAddress = Ccc::getModel('Quote_Address');
			$addressResult = $modelQuoteAddress->fetchRow($sql);
			if($addressResult->getData())
			{
				$saveAddress['address_id'] = $addressResult->address_id;
			}
			$modelQuoteAddress->setData($saveAddress)->save();
			$this->getMessage()->addMessage('address saved successfully in quote.',  Model_Core_Message::SUCCESS);

		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('address not saved in quote.',  Model_Core_Message::FAILURE);
		}
		return $this->redirect('grid','quote',null,true);
	}

}

?>