<?php

/**
 * Class Name: Apiview_model
 *
 * Covers Apiview Related functionality
 * 
 * PHP version 5.3
 *
 * @package    Apiview
 * @author     Hari Dornala <hari@clout.com>
 * @copyright  http://www.clout.com
 * @version    1.0.0
 * @see        See Jira/Confluence page for more info.
 * @since      File available since Release 1.0.0
 */
class Apiview_model extends CI_Model {

    /**
     * Constructor
     */
    public function __construct() {
	
    }

    /**
     * Divides api array into categories. 
     * 
     * @author Hari Dornala <hari@clout.com>
     * @return array $categories
     */
    public function get_categories($config = FALSE) {
	if (!$config) {
	    $config = 'api';
	}

	$this->load->config($config);
	$config = $this->config->item($config);


	$categories = array();
	foreach ($config as $key => $arr) {
	    $key = explode('__', $key);

	    if (count($key) > 1) {
		$category = $key[0];
		$title = $key[1];
	    } else {
		$category = 'Other';
		$title = $key[0];
	    }

	    $categories[$category][$title] = $arr;
	}

	return $categories;
    }

}
