<?php 
class Block_Cart_Grid extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('cart/grid.phtml');
	}

	public function getCartDetails()
	{
		$modelCart =Ccc::getModel('cart');
		$sql = "SELECT C.product_id, P.name, P.sku,P.price, C.quantity  FROM `cart_item` C JOIN `products` P ON C.product_id = P.product_id";
		$cartDetails =$modelCart->fetchall($sql);
		return $cartDetails;		
	}

	public function getProducts()
	{
		$modelProduct = Ccc::getModel('Product');
		$sql = "SELECT * FROM `products`";
		$products =$modelProduct->fetchall($sql);
		return $products;	
	}

	public function getTotal()
	{
		$modelCartItem =Ccc::getModel('cart_item');
		$sql = "SELECT * FROM `cart_item`";
		$cartItems =$modelCartItem->fetchall($sql);
		$total = 0;
		if($cartItems)
		{
			foreach ($cartItems->getData() as $cartItem)
			{
				$total += ($cartItem->price * $cartItem->quantity);
			}
		}
		
		return $total;		
	}
	public function getShippingMethods()
	{
		$modelShippingMethod = Ccc::getModel('ShippingMethod');
		$sql = "SELECT * FROM `shiping_methods`";
		$ShippingMethods =$modelShippingMethod->fetchall($sql);
		return $ShippingMethods;
	}

	public function getselectedShippingMethod()
	{
		$request = $this->getRequest();
		$modelCart =Ccc::getModel('cart');
		$selectedShippingMethod = [];
		$id =(int) $request->getParam('shipping_method_id');
		if (isset($id)) {
			$sql = "SELECT * FROM `cart` where `shiping_method_id` = {$id}";
			$selectedShippingMethod =$modelCart->fetchRow($sql);
		}
		return $selectedShippingMethod;
	}

}