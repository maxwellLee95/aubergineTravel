<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2016-04-10 21:25:19 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL e/install was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2016-04-10 21:25:19 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL e/install was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 D:\Site\demo6\wwwroot\core\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 D:\Site\demo6\wwwroot\core\system\classes\kohana\request.php(1160): Kohana_Request_Client->execute(Object(Request))
#2 D:\Site\demo6\wwwroot\index.php(143): Kohana_Request->execute()
#3 {main}