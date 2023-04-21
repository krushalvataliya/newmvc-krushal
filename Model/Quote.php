<?php 

class Model_quote extends Model_Core_Table
{
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE_LBL = 'Inactive';
	const STATUS_DEFAULT  = 1;
	
	public function getStatusOptions()
	{
		return [
			self::STATUS_ACTIVE => self::STATUS_ACTIVE_LBL,
			self::STATUS_INACTIVE => self::STATUS_INACTIVE_LBL
		];
	}
	
	function __construct()
	{
		parent::__construct();
		$this->setResourceClass('Model_Quote_Resource');
	}


	public function getQuoteItemDetails()
	{
		$id =(int)$this->getSession()->get('customer_id');
		$modelCart =Ccc::getModel('quote_items');
		$sql = "SELECT C.product_id, P.name, P.sku,P.price,C.discount, C.quantity  FROM `quote_items` C JOIN `products` P ON C.product_id = P.product_id WHERE `quote_id` = '{$this->getQuoteDetails()->quote_id}'";
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

	public function getShippingMethods()
	{
		$modelShippingMethod = Ccc::getModel('ShippingMethod');
		$sql = "SELECT * FROM `shiping_methods`";
		$ShippingMethods =$modelShippingMethod->fetchall($sql);
		return $ShippingMethods->getData();
	}

	public function getPaymentMethods()
	{
		$modelPaymentmethodMethod = Ccc::getModel('PaymentMethod');
		$sql = "SELECT * FROM `payment_methods`";
		$paymentMethods =$modelPaymentmethodMethod->fetchall($sql);
		return $paymentMethods->getData();
	}

	public function getCustomers()
	{
		$id =(int)$this->getSession()->get('customer_id');
		$modelCustomer = Ccc::getModel('Customer');
		$sql = "SELECT * FROM `customers`";
		$customer =$modelCustomer->fetchall($sql);
		return $customer->getData();
	}

	public function getCustomer()
	{
		$id =(int)$this->getSession()->get('customer_id');
		$modelCustomer = Ccc::getModel('Customer');
		$sql = "SELECT * FROM `customers` WHERE `customer_id` ='{$id}';";
		$customer =$modelCustomer->fetchRow($sql);
		return $customer;
	}

	public function getQuoteDetails()
	{
		$id =(int)$this->getSession()->start()->get('customer_id');
		$modelQuote = Ccc::getModel('quote');
		$sql = "SELECT * FROM `quote` WHERE `customer_id` ='{$id}';";
		$quote =$modelQuote->fetchRow($sql);
		return $quote;
	}
	
	public function getBillingAddress()
	{
		$id =(int)$this->getSession()->get('customer_id');
		$address = Ccc::getModel('Customer_Address');
		if($id)
		{
		$sql = "SELECT * FROM `customers` WHERE `customer_id` = '{$id}' ";
		$customer = $this->fetchRow($sql);

		$sql = "SELECT * FROM `customer_address` WHERE `address_id` = '{$customer->billing_address_id}';";
		$address = $address->fetchRow($sql);
		}
		return $address;
	}

	public function getShippingAddress()
	{
		$address = Ccc::getModel('Customer_Address');
		$id =(int)$this->getSession()->get('customer_id');
		if($id)
		{
		$sql = "SELECT * FROM `customers` WHERE `customer_id` = '{$id}' ";
		$customer = $this->fetchRow($sql);

		$sql = "SELECT * FROM `customer_address` WHERE `address_id` = '{$customer->shiping_address_id}';";
		$address = $address->fetchRow($sql);
		}
		return $address;
	}

	public function getSession()
	{
		return Ccc::getModel('Core_Session');
	}
}
?>