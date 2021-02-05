<?php
/**
 * Minify config Class
 *
 * PHP Version 5.3
 *
 * @category  PHP
 * @package   Controller
 * @author    Slawomir Jasinski <slav123@gmail.com>
 * @copyright 2015 All Rights Reserved SpiderSoft
 * @license   Copyright 2015 All Rights Reserved SpiderSoft
 * @link      http://www.spidersoft.com.au/projects/codeigniter-minify/
 */

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Minify config file
 *
 * @category  PHP
 * @package   Controller
 * @author    Slawomir Jasinski <slav123@gmail.com>
 * @copyright 2015 All Rights Reserved SpiderSoft
 * @license   Copyright 2015 All Rights Reserved SpiderSoft
 * @link      http://www.spidersoft.com.au/projects/codeigniter-minify/
 */

//Directorio archivos compilados
$config['assets_dir'] = 'assets'; 

//Directorio archivos originales
$config['css_dir']    = 'css';
$config['js_dir'] = 'js';

$config['compression_engine'] = array(
	'css' => 'minify', // minify || cssmin
	'js'  => 'jsminplus' // jsmin || closurecompiler || jsminplus
);


// optimization level (can be "WHITESPACE_ONLY", "SIMPLE_OPTIMIZATIONS" or "ADVANCED_OPTIMIZATIONS")
$config['closurecompiler']['compilation_level'] = 'SIMPLE_OPTIMIZATIONS';



// End of file minify.php
// Location: ./application/config/minify.php
