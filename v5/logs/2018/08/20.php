<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2018-08-20 09:56:33 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL res/images/nopicture.jpg was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2018-08-20 09:56:33 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL res/images/nopicture.jpg was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#2 /data/web/site/qiezi_travel/trunk/index.php(143): Kohana_Request->execute()
#3 {main}
2018-08-20 09:56:35 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 1148 ]
2018-08-20 09:56:35 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 1148 ]
--
#0 /data/web/site/qiezi_travel/trunk/index.php(143): Kohana_Request->execute()
#1 {main}