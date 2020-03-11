<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2018-08-28 10:07:45 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL res/images/nopicture.jpg was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2018-08-28 10:07:45 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL res/images/nopicture.jpg was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#2 /data/web/site/qiezi_travel/trunk/index.php(143): Kohana_Request->execute()
#3 {main}
2018-08-28 10:07:47 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 1148 ]
2018-08-28 10:07:47 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 1148 ]
--
#0 /data/web/site/qiezi_travel/trunk/index.php(143): Kohana_Request->execute()
#1 {main}
2018-08-28 10:27:06 --- ERROR: View_Exception [ 0 ]: The requested view usertpl/index/index could not be found ~ APPPATH/classes/stourweb/view.php [ 325 ]
2018-08-28 10:27:06 --- STRACE: View_Exception [ 0 ]: The requested view usertpl/index/index could not be found ~ APPPATH/classes/stourweb/view.php [ 325 ]
--
#0 /data/web/site/qiezi_travel/trunk/v5/classes/stourweb/view.php(187): Stourweb_View->set_filename('usertpl/index/i...')
#1 /data/web/site/qiezi_travel/trunk/v5/classes/stourweb/view.php(30): Stourweb_View->__construct('usertpl/index/i...', NULL, NULL, NULL)
#2 /data/web/site/qiezi_travel/trunk/v5/classes/stourweb/controller.php(48): Stourweb_View::factory('usertpl/index/i...')
#3 /data/web/site/qiezi_travel/trunk/v5/classes/controller/index.php(41): Stourweb_Controller->display('usertpl/index/i...')
#4 [internal function]: Controller_Index->action_index()
#5 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#6 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#8 /data/web/site/qiezi_travel/trunk/index.php(143): Kohana_Request->execute()
#9 {main}
2018-08-28 10:27:19 --- ERROR: View_Exception [ 0 ]: The requested view usertpl/index/index could not be found ~ APPPATH/classes/stourweb/view.php [ 325 ]
2018-08-28 10:27:19 --- STRACE: View_Exception [ 0 ]: The requested view usertpl/index/index could not be found ~ APPPATH/classes/stourweb/view.php [ 325 ]
--
#0 /data/web/site/qiezi_travel/trunk/v5/classes/stourweb/view.php(187): Stourweb_View->set_filename('usertpl/index/i...')
#1 /data/web/site/qiezi_travel/trunk/v5/classes/stourweb/view.php(30): Stourweb_View->__construct('usertpl/index/i...', NULL, NULL, NULL)
#2 /data/web/site/qiezi_travel/trunk/v5/classes/stourweb/controller.php(48): Stourweb_View::factory('usertpl/index/i...')
#3 /data/web/site/qiezi_travel/trunk/v5/classes/controller/index.php(41): Stourweb_Controller->display('usertpl/index/i...')
#4 [internal function]: Controller_Index->action_index()
#5 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#6 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#8 /data/web/site/qiezi_travel/trunk/index.php(143): Kohana_Request->execute()
#9 {main}
2018-08-28 10:28:26 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL res/images/nopicture.jpg was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2018-08-28 10:28:26 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL res/images/nopicture.jpg was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#2 /data/web/site/qiezi_travel/trunk/index.php(143): Kohana_Request->execute()
#3 {main}
2018-08-28 14:28:59 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL res/images/nopicture.jpg was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2018-08-28 14:28:59 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL res/images/nopicture.jpg was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#2 /data/web/site/qiezi_travel/trunk/index.php(143): Kohana_Request->execute()
#3 {main}