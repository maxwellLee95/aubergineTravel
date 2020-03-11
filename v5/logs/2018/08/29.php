<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2018-08-29 11:06:27 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL res/images/nopicture.jpg was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2018-08-29 11:06:27 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL res/images/nopicture.jpg was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#2 /data/web/site/qiezi_travel/trunk/index.php(143): Kohana_Request->execute()
#3 {main}
2018-08-29 11:06:29 --- ERROR: Database_Exception [ 1146 ]: Table 'qiezi.sline_search' doesn't exist [ SELECT count(*) as num FROM `sline_search` where  title like '%154%' ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2018-08-29 11:06:29 --- STRACE: Database_Exception [ 1146 ]: Table 'qiezi.sline_search' doesn't exist [ SELECT count(*) as num FROM `sline_search` where  title like '%154%' ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /data/web/site/qiezi_travel/trunk/core/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'SELECT count(*)...', false, Array)
#1 /data/web/site/qiezi_travel/trunk/v5/classes/model/search.php(117): Kohana_Database_Query->execute()
#2 /data/web/site/qiezi_travel/trunk/v5/classes/model/search.php(67): Model_Search::get_count('where  title li...')
#3 /data/web/site/qiezi_travel/trunk/v5/classes/controller/search.php(71): Model_Search::get_left_nav('154')
#4 [internal function]: Controller_Search->action_cloudsearch()
#5 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Search))
#6 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#8 /data/web/site/qiezi_travel/trunk/index.php(143): Kohana_Request->execute()
#9 {main}
2018-08-29 11:06:55 --- ERROR: Database_Exception [ 1146 ]: Table 'qiezi.sline_search' doesn't exist [ SELECT count(*) as num FROM `sline_search` where  title like '%154%' ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2018-08-29 11:06:55 --- STRACE: Database_Exception [ 1146 ]: Table 'qiezi.sline_search' doesn't exist [ SELECT count(*) as num FROM `sline_search` where  title like '%154%' ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /data/web/site/qiezi_travel/trunk/core/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'SELECT count(*)...', false, Array)
#1 /data/web/site/qiezi_travel/trunk/v5/classes/model/search.php(117): Kohana_Database_Query->execute()
#2 /data/web/site/qiezi_travel/trunk/v5/classes/model/search.php(67): Model_Search::get_count('where  title li...')
#3 /data/web/site/qiezi_travel/trunk/v5/classes/controller/search.php(71): Model_Search::get_left_nav('154')
#4 [internal function]: Controller_Search->action_cloudsearch()
#5 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Search))
#6 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#8 /data/web/site/qiezi_travel/trunk/index.php(143): Kohana_Request->execute()
#9 {main}
2018-08-29 11:06:59 --- ERROR: Database_Exception [ 1146 ]: Table 'qiezi.sline_search' doesn't exist [ SELECT count(*) as num FROM `sline_search` where  title like '%154%' ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2018-08-29 11:06:59 --- STRACE: Database_Exception [ 1146 ]: Table 'qiezi.sline_search' doesn't exist [ SELECT count(*) as num FROM `sline_search` where  title like '%154%' ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /data/web/site/qiezi_travel/trunk/core/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'SELECT count(*)...', false, Array)
#1 /data/web/site/qiezi_travel/trunk/v5/classes/model/search.php(117): Kohana_Database_Query->execute()
#2 /data/web/site/qiezi_travel/trunk/v5/classes/model/search.php(67): Model_Search::get_count('where  title li...')
#3 /data/web/site/qiezi_travel/trunk/v5/classes/controller/search.php(71): Model_Search::get_left_nav('154')
#4 [internal function]: Controller_Search->action_cloudsearch()
#5 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Search))
#6 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#8 /data/web/site/qiezi_travel/trunk/index.php(143): Kohana_Request->execute()
#9 {main}
2018-08-29 14:09:47 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL admin/public/vendor/slineeditor/js/editor_config.js was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2018-08-29 14:09:47 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL admin/public/vendor/slineeditor/js/editor_config.js was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#2 /data/web/site/qiezi_travel/trunk/index.php(143): Kohana_Request->execute()
#3 {main}
2018-08-29 14:09:47 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL admin/public/vendor/slineeditor/js/edito_all_min.js was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2018-08-29 14:09:47 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL admin/public/vendor/slineeditor/js/edito_all_min.js was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#2 /data/web/site/qiezi_travel/trunk/index.php(143): Kohana_Request->execute()
#3 {main}
2018-08-29 14:09:49 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL admin/public/vendor/slineeditor/themes/default/css/ueditor.min.css was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2018-08-29 14:09:49 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL admin/public/vendor/slineeditor/themes/default/css/ueditor.min.css was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#2 /data/web/site/qiezi_travel/trunk/index.php(143): Kohana_Request->execute()
#3 {main}
2018-08-29 14:09:49 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL admin/public/vendor/slineeditor/lang/zh-cn/zh-cn.js was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2018-08-29 14:09:49 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL admin/public/vendor/slineeditor/lang/zh-cn/zh-cn.js was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#2 /data/web/site/qiezi_travel/trunk/index.php(143): Kohana_Request->execute()
#3 {main}
2018-08-29 14:09:50 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL admin/public/vendor/slineeditor/themes/default/css/ueditor.min.css was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2018-08-29 14:09:50 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL admin/public/vendor/slineeditor/themes/default/css/ueditor.min.css was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#2 /data/web/site/qiezi_travel/trunk/index.php(143): Kohana_Request->execute()
#3 {main}