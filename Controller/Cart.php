<?php
/**
 * 
 */
class Controller_Cart extends Controller_Core_Action
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

	public function gridAction()
	{
		$layout = $this->getLayout();
		$content = $layout->createBlock('Cart_Grid');				
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
			$modelCart =Ccc::getModel('cart_item');
			$data=$request->getPost('product');
			$customerId=$request->getParam('customer_id');
			$sql = "SELECT * FROM `cart_item` WHERE `product_id` = {$data['product_id']} AND `customer_id` = '{$customerId}'";
			$result =$modelCart->fetchRow($sql);
			$data['customer_id'] = $customerId;
			if(!$result->getData())
			{
				$modelCart =Ccc::getModel('cart_item');
				$sql = "SELECT * FROM `products` WHERE `product_id` = {$data['product_id']}";
				$product =$modelCart->fetchRow($sql);
				$data['cost'] = $product->cost;
				$data['price'] = $product->price;
				$result =$modelCart->setData($data)->save();
				if(!$result)
				{
					throw new Exception("product not inserted in cart.", 1);
				}
			}
			else
			{
				$modelCart =Ccc::getModel('cart_item');
				$data['quantity'] += $result->quantity;
				$data['cart_item_id'] = $result->cart_item_id;
				unset($data['product_id']);
				$result2 =$modelCart->setData($data)->save();
				if(!$result2)
				{
					throw new Exception("product not updated in cart.", 1);
					
				}
			}
			$this->getMessage()->addMessage('product saved successfully in cart.',  Model_Core_Message::SUCCESS);

		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('product not saved in cart.',  Model_Core_Message::FAILURE);
		}

		return $this->redirect('grid','cart');
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
			$customerId = $request->getParam('customer_id');
			$data['customer_id'] = $customerId;
			$id = $data['shiping_method_id'];	
			$sql = "SELECT * FROM `cart` WHERE `customer_id` = '{$customerId}'";
			$modelCart =Ccc::getModel('cart');
			$result =$modelCart->fetchRow($sql);
				$cart = new model_Cart();
				$modelCart =Ccc::getModel('cart');
				$sql = "SELECT * FROM `shiping_methods`WHERE `shiping_method_id` = '{$id}'";
				$method =$modelCart->fetchRow($sql);
			if(!$result->getData())
			{
				$modelCart =Ccc::getModel('cart');
				$data['shiping_amount'] = $method->amount;
				$result =$modelCart->setData($data)->save();
				if(!$result)
				{
					throw new Exception("method not saved.", 1);
				}
			}
			else
			{
				$data['cart_id'] = $result->cart_id;
				$data['shiping_amount'] = $method->amount;
				$result =$cart->setData($data)->save();
			}
			$this->getMessage()->addMessage('method saved successfully.',  Model_Core_Message::SUCCESS);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('method not saved.',  Model_Core_Message::FAILURE);
		}
		return $this->redirect('grid','cart',null,false);

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
			$quantities = $request->getPost('quantity');
			$modelCart =Ccc::getModel('cart_item');
			foreach ($quantities as $key => $value)
			{
				$modelCart1 =Ccc::getModel('cart_item');
				$sql = "SELECT * FROM `cart_item`WHERE `product_id` = {$key}";
				$cartItem1 = $modelCart->fetchRow($sql);
				$data['cart_item_id'] = $cartItem1->cart_item_id;
				$data['quantity'] = $value;
				$update =$modelCart->setData($data)->save();
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
		return $this->redirect('grid','cart');
	}

	public function deleteproductAction()
	{
		try
		{
		$request = $this->getRequest();
		$productId =(int) $request->getParam('product_id');
		$customerId = $request->getParam('customer_id');
		$modelCart =Ccc::getModel('cart_item');
		$sql = "SELECT * FROM `cart_item` WHERE `product_id` = {$productId}";
		$result =$modelCart->fetchRow($sql);
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
		return $this->redirect('grid','cart',['customer_id'=>$customerId],true);
	}

}

?>