<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2016-11-10 01:40:11 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH\classes\kohana\request.php [ 1148 ]
2016-11-10 01:40:11 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH\classes\kohana\request.php [ 1148 ]
--
#0 D:\site\demo\wwwroot\index.php(143): Kohana_Request->execute()
#1 {main}
2016-11-10 12:23:29 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2016-11-10 12:23:29 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\www\core\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('demo')
#1 D:\www\core\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 D:\www\core\modules\database\classes\kohana\database\mysql.php(359): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 D:\www\core\modules\orm\classes\kohana\orm.php(1800): Kohana_Database_MySQL->list_columns('destinations')
#4 D:\www\core\modules\orm\classes\kohana\orm.php(455): Kohana_ORM->list_columns()
#5 D:\www\core\modules\orm\classes\kohana\orm.php(400): Kohana_ORM->reload_columns()
#6 D:\www\core\modules\orm\classes\kohana\orm.php(265): Kohana_ORM->_initialize()
#7 D:\www\core\modules\orm\classes\kohana\orm.php(46): Kohana_ORM->__construct(NULL)
#8 D:\www\v5\classes\model\destinations.php(21): Kohana_ORM::factory('destinations')
#9 D:\www\v5\classes\common.php(640): Model_Destinations::gen_web_list()
#10 D:\www\v5\bootstrap.php(166): Common::cache_web_list()
#11 D:\www\index.php(128): require('D:\www\v5\boots...')
#12 {main}
2016-11-10 12:23:38 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2016-11-10 12:23:38 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\www\core\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('demo')
#1 D:\www\core\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 D:\www\core\modules\database\classes\kohana\database\mysql.php(359): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 D:\www\core\modules\orm\classes\kohana\orm.php(1800): Kohana_Database_MySQL->list_columns('destinations')
#4 D:\www\core\modules\orm\classes\kohana\orm.php(455): Kohana_ORM->list_columns()
#5 D:\www\core\modules\orm\classes\kohana\orm.php(400): Kohana_ORM->reload_columns()
#6 D:\www\core\modules\orm\classes\kohana\orm.php(265): Kohana_ORM->_initialize()
#7 D:\www\core\modules\orm\classes\kohana\orm.php(46): Kohana_ORM->__construct(NULL)
#8 D:\www\v5\classes\model\destinations.php(21): Kohana_ORM::factory('destinations')
#9 D:\www\v5\classes\common.php(640): Model_Destinations::gen_web_list()
#10 D:\www\v5\bootstrap.php(166): Common::cache_web_list()
#11 D:\www\index.php(128): require('D:\www\v5\boots...')
#12 {main}
2016-11-10 12:24:03 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2016-11-10 12:24:03 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\www\core\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('demo')
#1 D:\www\core\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 D:\www\core\modules\database\classes\kohana\database\mysql.php(359): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 D:\www\core\modules\orm\classes\kohana\orm.php(1800): Kohana_Database_MySQL->list_columns('destinations')
#4 D:\www\core\modules\orm\classes\kohana\orm.php(455): Kohana_ORM->list_columns()
#5 D:\www\core\modules\orm\classes\kohana\orm.php(400): Kohana_ORM->reload_columns()
#6 D:\www\core\modules\orm\classes\kohana\orm.php(265): Kohana_ORM->_initialize()
#7 D:\www\core\modules\orm\classes\kohana\orm.php(46): Kohana_ORM->__construct(NULL)
#8 D:\www\v5\classes\model\destinations.php(21): Kohana_ORM::factory('destinations')
#9 D:\www\v5\classes\common.php(640): Model_Destinations::gen_web_list()
#10 D:\www\v5\bootstrap.php(166): Common::cache_web_list()
#11 D:\www\index.php(128): require('D:\www\v5\boots...')
#12 {main}
2016-11-10 12:24:20 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2016-11-10 12:24:20 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\www\core\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('demo')
#1 D:\www\core\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 D:\www\core\modules\database\classes\kohana\database\mysql.php(359): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 D:\www\core\modules\orm\classes\kohana\orm.php(1800): Kohana_Database_MySQL->list_columns('destinations')
#4 D:\www\core\modules\orm\classes\kohana\orm.php(455): Kohana_ORM->list_columns()
#5 D:\www\core\modules\orm\classes\kohana\orm.php(400): Kohana_ORM->reload_columns()
#6 D:\www\core\modules\orm\classes\kohana\orm.php(265): Kohana_ORM->_initialize()
#7 D:\www\core\modules\orm\classes\kohana\orm.php(46): Kohana_ORM->__construct(NULL)
#8 D:\www\v5\classes\model\destinations.php(21): Kohana_ORM::factory('destinations')
#9 D:\www\v5\classes\common.php(640): Model_Destinations::gen_web_list()
#10 D:\www\v5\bootstrap.php(166): Common::cache_web_list()
#11 D:\www\index.php(128): require('D:\www\v5\boots...')
#12 {main}
2016-11-10 12:24:21 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2016-11-10 12:24:21 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\www\core\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('demo')
#1 D:\www\core\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 D:\www\core\modules\database\classes\kohana\database\mysql.php(359): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 D:\www\core\modules\orm\classes\kohana\orm.php(1800): Kohana_Database_MySQL->list_columns('destinations')
#4 D:\www\core\modules\orm\classes\kohana\orm.php(455): Kohana_ORM->list_columns()
#5 D:\www\core\modules\orm\classes\kohana\orm.php(400): Kohana_ORM->reload_columns()
#6 D:\www\core\modules\orm\classes\kohana\orm.php(265): Kohana_ORM->_initialize()
#7 D:\www\core\modules\orm\classes\kohana\orm.php(46): Kohana_ORM->__construct(NULL)
#8 D:\www\v5\classes\model\destinations.php(21): Kohana_ORM::factory('destinations')
#9 D:\www\v5\classes\common.php(640): Model_Destinations::gen_web_list()
#10 D:\www\v5\bootstrap.php(166): Common::cache_web_list()
#11 D:\www\index.php(128): require('D:\www\v5\boots...')
#12 {main}
2016-11-10 13:13:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH\classes\kohana\request.php [ 1148 ]
2016-11-10 13:13:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH\classes\kohana\request.php [ 1148 ]
--
#0 D:\www\index.php(143): Kohana_Request->execute()
#1 {main}
2016-11-10 13:18:07 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH\classes\kohana\request.php [ 1148 ]
2016-11-10 13:18:07 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH\classes\kohana\request.php [ 1148 ]
--
#0 D:\www\index.php(143): Kohana_Request->execute()
#1 {main}
2016-11-10 13:18:11 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH\classes\kohana\request.php [ 1148 ]
2016-11-10 13:18:11 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH\classes\kohana\request.php [ 1148 ]
--
#0 D:\www\index.php(143): Kohana_Request->execute()
#1 {main}