<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2016-04-25 16:49:44 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH\classes\kohana\request.php [ 1148 ]
2016-04-25 16:49:44 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH\classes\kohana\request.php [ 1148 ]
--
#0 D:\Site\demo6\wwwroot\index.php(143): Kohana_Request->execute()
#1 {main}
2016-04-25 16:50:57 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL res/images/blank.gif was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2016-04-25 16:50:57 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL res/images/blank.gif was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 D:\Site\demo6\wwwroot\core\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 D:\Site\demo6\wwwroot\core\system\classes\kohana\request.php(1160): Kohana_Request_Client->execute(Object(Request))
#2 D:\Site\demo6\wwwroot\index.php(143): Kohana_Request->execute()
#3 {main}
2016-04-25 22:08:05 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: admin1.php ~ SYSPATH\classes\kohana\request.php [ 1148 ]
2016-04-25 22:08:05 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: admin1.php ~ SYSPATH\classes\kohana\request.php [ 1148 ]
--
#0 D:\Site\demo6\wwwroot\index.php(143): Kohana_Request->execute()
#1 {main}
2016-04-25 22:08:09 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: admin.php ~ SYSPATH\classes\kohana\request.php [ 1148 ]
2016-04-25 22:08:09 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: admin.php ~ SYSPATH\classes\kohana\request.php [ 1148 ]
--
#0 D:\Site\demo6\wwwroot\index.php(143): Kohana_Request->execute()
#1 {main}
2016-04-25 22:22:59 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH\classes\kohana\request.php [ 1148 ]
2016-04-25 22:22:59 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH\classes\kohana\request.php [ 1148 ]
--
#0 D:\Site\demo6\wwwroot\index.php(143): Kohana_Request->execute()
#1 {main}
2016-04-25 22:49:08 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: admin1.php ~ SYSPATH\classes\kohana\request.php [ 1148 ]
2016-04-25 22:49:08 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: admin1.php ~ SYSPATH\classes\kohana\request.php [ 1148 ]
--
#0 D:\Site\demo6\wwwroot\index.php(143): Kohana_Request->execute()
#1 {main}
2016-04-25 23:14:43 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2016-04-25 23:14:43 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\Site\demo6\wwwroot\core\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db(NULL)
#1 D:\Site\demo6\wwwroot\core\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 D:\Site\demo6\wwwroot\core\modules\database\classes\kohana\database\mysql.php(359): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 D:\Site\demo6\wwwroot\core\modules\orm\classes\kohana\orm.php(1800): Kohana_Database_MySQL->list_columns('destinations')
#4 D:\Site\demo6\wwwroot\core\modules\orm\classes\kohana\orm.php(455): Kohana_ORM->list_columns()
#5 D:\Site\demo6\wwwroot\core\modules\orm\classes\kohana\orm.php(400): Kohana_ORM->reload_columns()
#6 D:\Site\demo6\wwwroot\core\modules\orm\classes\kohana\orm.php(265): Kohana_ORM->_initialize()
#7 D:\Site\demo6\wwwroot\core\modules\orm\classes\kohana\orm.php(46): Kohana_ORM->__construct(NULL)
#8 D:\Site\demo6\wwwroot\v5\classes\model\destinations.php(21): Kohana_ORM::factory('destinations')
#9 D:\Site\demo6\wwwroot\v5\classes\common.php(640): Model_Destinations::gen_web_list()
#10 D:\Site\demo6\wwwroot\v5\bootstrap.php(166): Common::cache_web_list()
#11 D:\Site\demo6\wwwroot\index.php(124): require('D:\Site\demo6\w...')
#12 {main}