<?php
	
class gsMediaLoaderFilter extends sfFilter
{
	
	public function initialize( $context, $parameters = array() )
	{
		parent::initialize( $context, $parameters );
		
		$loader = $this->getContext()->getRequest()->getParameter('loader', 'default');
		
		sfConfig::set('sf_routing_defaults', array_merge(
			(array) sfConfig::get('sf_routing_defaults'),
			array('loader' => $loader)
		));
	}
}