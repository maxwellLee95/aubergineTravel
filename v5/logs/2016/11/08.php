<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2016-11-08 22:20:31 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL upload/images/000/000/001/56ffd8d9e5faf1680603.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2016-11-08 22:20:31 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL upload/images/000/000/001/56ffd8d9e5faf1680603.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 D:\site\demo\wwwroot\core\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 D:\site\demo\wwwroot\core\system\classes\kohana\request.php(1160): Kohana_Request_Client->execute(Object(Request))
#2 D:\site\demo\wwwroot\index.php(143): Kohana_Request->execute()
#3 {main}
2016-11-08 22:56:51 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH\classes\kohana\request.php [ 1148 ]
2016-11-08 22:56:51 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH\classes\kohana\request.php [ 1148 ]
--
#0 D:\site\demo\wwwroot\index.php(143): Kohana_Request->execute()
#1 {main}
2016-11-08 23:14:54 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH\classes\kohana\request.php [ 1148 ]
2016-11-08 23:14:54 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH\classes\kohana\request.php [ 1148 ]
--
#0 D:\site\demo\wwwroot\index.php(143): Kohana_Request->execute()
#1 {main}