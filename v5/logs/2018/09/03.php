<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2018-09-03 09:53:00 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 1148 ]
2018-09-03 09:53:00 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 1148 ]
--
#0 /data/web/site/qiezi_travel/trunk/index.php(143): Kohana_Request->execute()
#1 {main}
2018-09-03 12:21:06 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL wechat/v4/index/looknew was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2018-09-03 12:21:06 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL wechat/v4/index/looknew was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#2 /data/web/site/qiezi_travel/trunk/index.php(143): Kohana_Request->execute()
#3 {main}
2018-09-03 12:21:15 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL wechat/v4/index/looknew was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2018-09-03 12:21:15 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL wechat/v4/index/looknew was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#2 /data/web/site/qiezi_travel/trunk/index.php(143): Kohana_Request->execute()
#3 {main}
2018-09-03 12:24:28 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL wechat/v4/index/looknew was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2018-09-03 12:24:28 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL wechat/v4/index/looknew was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /data/web/site/qiezi_travel/trunk/core/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#2 /data/web/site/qiezi_travel/trunk/index.php(143): Kohana_Request->execute()
#3 {main}