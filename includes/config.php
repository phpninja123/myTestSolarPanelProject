<?php

define('ENV', 'TEST');
if( ENV == 'TEST' ) {
	define('HOST', 'localhost');
	define('USERNAME', 'root');
	define('PASSWORD', 'iprogrammer123#');
	define('DBNAME', 'solar');	
} else {
	define('HOST', 'localhost');
	define('USERNAME', 'root');
	define('PASSWORD', 'iprogrammer123#');
	define('DBNAME', 'solar');	
}
