<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2016-04-05 23:16:31 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2016-04-05 23:16:31 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\Site\demo6\wwwroot\core\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('V5')
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
#11 D:\Site\demo6\wwwroot\index.php(128): require('D:\Site\demo6\w...')
#12 {main}
2016-04-05 23:16:39 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2016-04-05 23:16:39 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\Site\demo6\wwwroot\core\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('V5')
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
#11 D:\Site\demo6\wwwroot\index.php(128): require('D:\Site\demo6\w...')
#12 {main}
2016-04-05 23:18:13 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2016-04-05 23:18:13 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\Site\demo6\wwwroot\core\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('V5')
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
#11 D:\Site\demo6\wwwroot\index.php(128): require('D:\Site\demo6\w...')
#12 {main}
2016-04-05 23:18:25 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2016-04-05 23:18:25 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\Site\demo6\wwwroot\core\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('V5')
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
#11 D:\Site\demo6\wwwroot\index.php(128): require('D:\Site\demo6\w...')
#12 {main}
2016-04-05 23:21:05 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2016-04-05 23:21:05 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\Site\demo6\wwwroot\core\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('V5')
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
#11 D:\Site\demo6\wwwroot\index.php(128): require('D:\\Site\\demo6\\w...')
#12 {main}
2016-04-05 23:22:24 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2016-04-05 23:22:24 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\Site\demo6\wwwroot\core\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('V5')
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
#11 D:\Site\demo6\wwwroot\index.php(128): require('D:\Site\demo6\w...')
#12 {main}
2016-04-05 23:24:46 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2016-04-05 23:24:46 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\Site\demo6\wwwroot\core\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('V5')
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
#11 D:\Site\demo6\wwwroot\index.php(128): require('D:\Site\demo6\w...')
#12 {main}
2016-04-05 23:30:58 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2016-04-05 23:30:58 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\Site\demo6\wwwroot\core\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('V5')
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
#11 D:\Site\demo6\wwwroot\index.php(128): require('D:\Site\demo6\w...')
#12 {main}
2016-04-05 23:46:46 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL res/images/blank.gif was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2016-04-05 23:46:46 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL res/images/blank.gif was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 D:\Site\demo6\wwwroot\core\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 D:\Site\demo6\wwwroot\core\system\classes\kohana\request.php(1160): Kohana_Request_Client->execute(Object(Request))
#2 D:\Site\demo6\wwwroot\index.php(143): Kohana_Request->execute()
#3 {main}