<?php
/**
 * FrontendLandingController
 *
 *
 * @package    Dinkly
 * @subpackage AppsFrontendLandingController
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */

class FrontendLandingController extends FrontendController
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Load default view
	 *
	 * @return bool: always returns true on successful construction of view
	 *
	 */
	public function loadDefault()
	{
		$order  = 6;
	    $length = 1000;
	    
	    $text = file_get_contents($_SERVER['APPLICATION_ROOT'] . '/web/text/farewell-to-arms.txt');

	    for($i = 0; $i < 65; $i++)
	    {
	    	$text .= file_get_contents($_SERVER['APPLICATION_ROOT'] . '/web/text/fox-in-sox.txt');
	    	$text .= file_get_contents($_SERVER['APPLICATION_ROOT'] . '/web/text/oh-the-places.txt');
	    	$text .= file_get_contents($_SERVER['APPLICATION_ROOT'] . '/web/text/sneetches.txt');
	    	$text .= file_get_contents($_SERVER['APPLICATION_ROOT'] . '/web/text/the-cat-in-the-hat.txt');
	    	$text .= file_get_contents($_SERVER['APPLICATION_ROOT'] . '/web/text/the-sax.txt');
	    }
	    
	    $text = ucfirst(preg_replace('/[0-9]+/', '', $text));

	    $generator = new MarkovGenerator();

	    if(isset($text))
	    {
	        $markov_table = $generator->buildTable($text, $order);
	        $this->output = $generator->generateText($length, $markov_table, $order);
	    }

		return true;
	}
}
