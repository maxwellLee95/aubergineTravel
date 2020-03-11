<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2016-06-12 19:51:52 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2016-06-12 19:51:52 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\Site\demo6\wwwroot\core\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('demo6')
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
2016-06-12 19:52:00 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2016-06-12 19:52:00 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\Site\demo6\wwwroot\core\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('demo6')
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
2016-06-12 20:12:29 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2016-06-12 20:12:29 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\Site\demo6\wwwroot\core\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('demo6')
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
2016-06-12 20:12:30 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2016-06-12 20:12:30 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\Site\demo6\wwwroot\core\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('demo6')
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
2016-06-12 23:38:11 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2016-06-12 23:38:11 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\Site\demo6\wwwroot\core\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('demo6')
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
2016-06-12 23:41:14 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2016-06-12 23:41:14 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\Site\demo6\wwwroot\core\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('demo6')
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
2016-06-12 23:41:16 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2016-06-12 23:41:16 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\Site\demo6\wwwroot\core\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('demo6')
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
2016-06-12 23:41:27 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2016-06-12 23:41:27 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\Site\demo6\wwwroot\core\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('demo6')
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