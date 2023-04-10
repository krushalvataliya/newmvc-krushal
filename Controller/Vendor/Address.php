<?php 
class Controller_Vendor_Address extends Controller_Core_Action
{
	public function gridAction()
	{
		$layout = $this->getLayout();
		$content = $layout->createBlock('Vendor_Address_Grid');
		$layout->getChild('content')->addChild('grid',$content);
		$layout->render();
	}
}

?>