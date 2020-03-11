<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2016-10-12 01:25:21 --- ERROR: Database_Exception [ 1146 ]: Table 'demo6.sline_destinations' doesn't exist [ SHOW FULL COLUMNS FROM `sline_destinations` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2016-10-12 01:25:21 --- STRACE: Database_Exception [ 1146 ]: Table 'demo6.sline_destinations' doesn't exist [ SHOW FULL COLUMNS FROM `sline_destinations` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 D:\site\demo6\wwwroot\core\modules\database\classes\kohana\database\mysql.php(359): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#1 D:\site\demo6\wwwroot\core\modules\orm\classes\kohana\orm.php(1800): Kohana_Database_MySQL->list_columns('destinations')
#2 D:\site\demo6\wwwroot\core\modules\orm\classes\kohana\orm.php(455): Kohana_ORM->list_columns()
#3 D:\site\demo6\wwwroot\core\modules\orm\classes\kohana\orm.php(400): Kohana_ORM->reload_columns()
#4 D:\site\demo6\wwwroot\core\modules\orm\classes\kohana\orm.php(265): Kohana_ORM->_initialize()
#5 D:\site\demo6\wwwroot\core\modules\orm\classes\kohana\orm.php(46): Kohana_ORM->__construct(NULL)
#6 D:\site\demo6\wwwroot\v5\classes\model\destinations.php(21): Kohana_ORM::factory('destinations')
#7 D:\site\demo6\wwwroot\v5\classes\common.php(640): Model_Destinations::gen_web_list()
#8 D:\site\demo6\wwwroot\v5\bootstrap.php(166): Common::cache_web_list()
#9 D:\site\demo6\wwwroot\index.php(128): require('D:\site\demo6\w...')
#10 {main}
2016-10-12 01:25:30 --- ERROR: Database_Exception [ 1146 ]: Table 'demo6.sline_destinations' doesn't exist [ SHOW FULL COLUMNS FROM `sline_destinations` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2016-10-12 01:25:30 --- STRACE: Database_Exception [ 1146 ]: Table 'demo6.sline_destinations' doesn't exist [ SHOW FULL COLUMNS FROM `sline_destinations` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 D:\site\demo6\wwwroot\core\modules\database\classes\kohana\database\mysql.php(359): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#1 D:\site\demo6\wwwroot\core\modules\orm\classes\kohana\orm.php(1800): Kohana_Database_MySQL->list_columns('destinations')
#2 D:\site\demo6\wwwroot\core\modules\orm\classes\kohana\orm.php(455): Kohana_ORM->list_columns()
#3 D:\site\demo6\wwwroot\core\modules\orm\classes\kohana\orm.php(400): Kohana_ORM->reload_columns()
#4 D:\site\demo6\wwwroot\core\modules\orm\classes\kohana\orm.php(265): Kohana_ORM->_initialize()
#5 D:\site\demo6\wwwroot\core\modules\orm\classes\kohana\orm.php(46): Kohana_ORM->__construct(NULL)
#6 D:\site\demo6\wwwroot\v5\classes\model\destinations.php(21): Kohana_ORM::factory('destinations')
#7 D:\site\demo6\wwwroot\v5\classes\common.php(640): Model_Destinations::gen_web_list()
#8 D:\site\demo6\wwwroot\v5\bootstrap.php(166): Common::cache_web_list()
#9 D:\site\demo6\wwwroot\index.php(128): require('D:\site\demo6\w...')
#10 {main}
2016-10-12 01:49:40 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH\classes\kohana\request.php [ 1148 ]
2016-10-12 01:49:40 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH\classes\kohana\request.php [ 1148 ]
--
#0 D:\site\demo6\wwwroot\index.php(143): Kohana_Request->execute()
#1 {main}
2016-10-12 14:40:35 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH\classes\kohana\request.php [ 1148 ]
2016-10-12 14:40:35 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH\classes\kohana\request.php [ 1148 ]
--
#0 D:\site\demo6\wwwroot\index.php(143): Kohana_Request->execute()
#1 {main}