<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2016-05-31 02:55:22 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH\classes\kohana\request.php [ 1148 ]
2016-05-31 02:55:22 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH\classes\kohana\request.php [ 1148 ]
--
#0 D:\Site\demo6\wwwroot\index.php(143): Kohana_Request->execute()
#1 {main}
2016-05-31 03:08:52 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL res/images/blank.gif was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2016-05-31 03:08:52 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL res/images/blank.gif was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 D:\Site\demo6\wwwroot\core\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 D:\Site\demo6\wwwroot\core\system\classes\kohana\request.php(1160): Kohana_Request_Client->execute(Object(Request))
#2 D:\Site\demo6\wwwroot\index.php(143): Kohana_Request->execute()
#3 {main}