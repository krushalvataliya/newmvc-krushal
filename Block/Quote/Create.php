<?php 
class Block_Quote_Create extends  Block_Core_Layout
{
	protected $_quote = null;
	protected $_session = null;

	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('quote/create.phtml');
		$this->prepareChilderen();
	}

	public function prepareChilderen()
	{

		$customer = $this->createBlock('Quote_Customer');
		$this->addChild('customer',$customer);

		$address = $this->createBlock('Quote_Address');
		$this->addChild('address',$address);

		$method = $this->createBlock('Quote_Method');
		$this->addChild('method',$method);

		$products = $this->createBlock('Quote_Products');
		$this->addChild('products',$products);

		$cartItems = $this->createBlock('Quote_Cartitems');
		$this->addChild('cartItems',$cartItems);

		
		$total = $this->createBlock('Quote_Total');
		$this->addChild('total',$total);
	}

	
	public function getTotal()
	{
		$modelQuoteItem =Ccc::getModel('Quote_Items');
		$id =$this->getQuote()->getQuoteDetails()->quote_id;
		$sql = "SELECT * FROM `quote_items` WHERE `quote_id` = '{$id}'";
		$QuoteItems =$modelQuoteItem->fetchall($sql);
		$total = 0;
		if($QuoteItems)
		{
			foreach ($QuoteItems->getData() as $quoteItem)
			{
				$total += ((int)$quoteItem->price * (int)$quoteItem->quantity)-(int)$quoteItem->discount;
			}
		}
		return $total;		
	}

	public function getGrandTotal()
	{
		$id =(int)$this->getSession()->get('customer_id');
		$modelQuote =Ccc::getModel('quote');
		$sql = "SELECT * FROM `quote` WHERE `customer_id` = '{$id}'";
		$quote =$modelQuote->fetchRow($sql);
		$grandTotal = $this->getTotal() + $quote->shiping_amount;
		$data = ['quote_id' => $quote->quote_id, 'total' => $grandTotal];
		$quote1 = $modelQuote->setData($data)->save();

		return $quote->total; 
	}

    public function getQuote()
    {
        if($this->_quote)
        {
        	return $this->_quote;
        }
        $quote = new model_Quote();
        $this->setQuote($quote);
        return $quote;
    }

    public function setQuote($_quote)
    {
        $this->_quote = $_quote;

        return $this;
    }

    public function getSession()
    {
        if($this->_session)
        {
        	return $this->_session;
        }
        $session = Ccc::getModel('Core_Session');
        $this->setSession($session);
        return $session;
    }

    public function setSession($_session)
    {
        $this->_session = $_session;

        return $this;
    }
}