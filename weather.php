<?php
/**
 * Weather Component
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled with this
 * package in the file LICENSE. It is also available through the world-wide-web
 * at this URL: http://www.opensource.org/licenses/bsd-license
 *
 * @category   Components
 * @package    CakePHP
 * @subpackage PHP
 * @copyright  Copyright (c) 2011 Signified (http://signified.com.au)
 * @license    http://www.opensource.org/licenses/bsd-license    New BSD License
 * @version    1.0
 */

/**
 * WeatherComponent class
 *
 * This component is used for getting the weather using The Google Weather API
 * http://www.google.com/ig/api?weather=<LOCATION>
 *
 * @category   Components
 * @package    CakePHP
 * @subpackage PHP
 * @copyright  Copyright (c) 2011 Signified (http://signified.com.au)
 * @license    http://www.opensource.org/licenses/bsd-license    New BSD License
 */
class WeatherComponent extends Object
{
    /**
     * The error status of the result (true or false)
     *
     * @var boolean
     * @access public
     */
    public $error = false;

    /**
     * The location for which to get the weather forecast
     *
     * @var string
     * @access public
     */
    public $location = null;

    /**
     * The result object
     *
     * @var SimpleXMLElement object
     * @access public
     */
    public $result = null;

    /**
     * Perform a weather forecast request
     *
     * @return object $this
     * @access public
     */
    public function forecast()
    {
        if (function_exists('simplexml_load_file')) {
            $url = 'http://www.google.com/ig/api?weather=' . urlencode($this->location);
            if ($this->result = simplexml_load_file($url)) {
                if (isset($this->result->weather->problem_cause)) {
                    $this->error = true;
                }
            }
        }
        return $this;
    }

    /**
     * Initialize component
     *
     * @param object $controller A reference to the instantiating controller object
     * @param array $settings Array of internal variables to set on instantiation
     * @access public
     */
    public function initialize(&$controller, $settings = array())
    {
        $this->_set($settings);
    }

    /**
     * Reset all WeatherComponent internal variables
     *
     * @return object $this
     * @access public
     */
    public function reset()
    {
        $this->error = false;
        $this->location = null;
        $this->result = null;
        return $this;
    }
}