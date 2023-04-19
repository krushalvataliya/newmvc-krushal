<?php 
class Block_Core_Template extends Model_Core_View
{
	protected $children = [];
    protected $layout = null;
	
	public function __construct()
	{
		parent::__construct();
	}

    public function getChildren()
    {
        return $this->children;
    }

    public function getChildHtml($key)
    {
        if($child = $this->getChild($key))
        {
            return $child->ToHtml();
        }
        return null;
    }

    public function toHtml()
    {
        ob_start();
        $this->render();
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
        
    }

    public function setChildren(array $children)
    {
        $this->children = $children;

        return $this;
    }

    public function addChild($key,$value)
    {
    	 $this->children[$key] = $value;
    	 return $this;
    }

     public function getChild($key)
    {
    	if(array_key_exists($key, $this->children))
    	{
    		return $this->children[$key];
    	}
    	return null;
    }

     public function removeChild($key)
    {
    	if(array_key_exists($key,$this->children))
    	{
    		unset($this->children[$key]);
    	}
    	return $this;
    }

    public function getLayout()
    {
        return $this->layout;
    }

    public function setLayout(Block_Core_Layout $layout)
    {
        $this->layout = $layout;

        return $this;
    }
}