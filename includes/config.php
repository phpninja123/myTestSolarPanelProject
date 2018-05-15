<?php

define('ENV', 'TEST');
if( ENV == 'TEST' ) {
	define('HOST', 'localhost');
	define('USERNAME', 'root');
	define('PASSWORD', 'root');
	define('DBNAME', 'solar');	
} else {
	define('HOST', 'db703433613.db.1and1.com');
	define('USERNAME', 'dbo703433613');
	define('PASSWORD', '');
	define('DBNAME', 'db703433613');	
}
