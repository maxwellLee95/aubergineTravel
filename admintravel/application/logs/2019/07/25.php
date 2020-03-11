<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2019-07-25 10:02:08 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Line_Suit_Price::get_price_by_day() ~ APPPATH/classes/controller/leaderreport.php [ 30 ]
2019-07-25 10:02:08 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Line_Suit_Price::get_price_by_day() ~ APPPATH/classes/controller/leaderreport.php [ 30 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2019-07-25 10:02:26 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Line_Suit_Price::get_price_by_day() ~ APPPATH/classes/controller/leaderreport.php [ 30 ]
2019-07-25 10:02:26 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Line_Suit_Price::get_price_by_day() ~ APPPATH/classes/controller/leaderreport.php [ 30 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2019-07-25 10:24:19 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL leaderreport/edit/parentkey/sale/itemid/1/id/2 was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 111 ]
2019-07-25 10:24:19 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL leaderreport/edit/parentkey/sale/itemid/1/id/2 was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 111 ]
--
#0 /data/web/qiezi_travel/core/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /data/web/qiezi_travel/core/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#2 /data/web/qiezi_travel/admintravel/index.php(121): Kohana_Request->execute()
#3 {main}
2019-07-25 10:25:19 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL leaderreport/edit/parentkey/sale/itemid/1/id/2 was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 111 ]
2019-07-25 10:25:19 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL leaderreport/edit/parentkey/sale/itemid/1/id/2 was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 111 ]
--
#0 /data/web/qiezi_travel/core/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /data/web/qiezi_travel/core/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#2 /data/web/qiezi_travel/admintravel/index.php(121): Kohana_Request->execute()
#3 {main}
2019-07-25 11:11:14 --- ERROR: ErrorException [ 1 ]: Class 'Model_sline_member_order_tourer' not found ~ MODPATH/orm/classes/kohana/orm.php [ 46 ]
2019-07-25 11:11:14 --- STRACE: ErrorException [ 1 ]: Class 'Model_sline_member_order_tourer' not found ~ MODPATH/orm/classes/kohana/orm.php [ 46 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2019-07-25 11:11:42 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 1 [ SELECT `sline_member_order_tourer`.`id` AS `id`, `sline_member_order_tourer`.`orderid` AS `orderid`, `sline_member_order_tourer`.`tourername` AS `tourername`, `sline_member_order_tourer`.`sex` AS `sex`, `sline_member_order_tourer`.`cardtype` AS `cardtype`, `sline_member_order_tourer`.`cardnumber` AS `cardnumber`, `sline_member_order_tourer`.`mobile` AS `mobile`, `sline_member_order_tourer`.`is_sign` AS `is_sign` FROM `sline_member_order_tourer` AS `sline_member_order_tourer` WHERE orderid= ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2019-07-25 11:11:42 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 1 [ SELECT `sline_member_order_tourer`.`id` AS `id`, `sline_member_order_tourer`.`orderid` AS `orderid`, `sline_member_order_tourer`.`tourername` AS `tourername`, `sline_member_order_tourer`.`sex` AS `sex`, `sline_member_order_tourer`.`cardtype` AS `cardtype`, `sline_member_order_tourer`.`cardnumber` AS `cardnumber`, `sline_member_order_tourer`.`mobile` AS `mobile`, `sline_member_order_tourer`.`is_sign` AS `is_sign` FROM `sline_member_order_tourer` AS `sline_member_order_tourer` WHERE orderid= ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /data/web/qiezi_travel/core/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `sline_m...', 'Model_Member_Or...', Array)
#1 /data/web/qiezi_travel/core/modules/orm/classes/kohana/orm.php(1188): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 /data/web/qiezi_travel/core/modules/orm/classes/kohana/orm.php(1043): Kohana_ORM->_load_result(true)
#3 /data/web/qiezi_travel/core/modules/orm/classes/kohana/orm.php(1054): Kohana_ORM->find_all()
#4 /data/web/qiezi_travel/admintravel/application/classes/controller/order.php(800): Kohana_ORM->get_all()
#5 [internal function]: Controller_Order->action_genexcel()
#6 /data/web/qiezi_travel/core/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Order))
#7 /data/web/qiezi_travel/core/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /data/web/qiezi_travel/core/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#9 /data/web/qiezi_travel/admintravel/index.php(121): Kohana_Request->execute()
#10 {main}
2019-07-25 11:12:31 --- ERROR: ErrorException [ 1 ]: Class 'Model_marshal_point' not found ~ MODPATH/orm/classes/kohana/orm.php [ 46 ]
2019-07-25 11:12:31 --- STRACE: ErrorException [ 1 ]: Class 'Model_marshal_point' not found ~ MODPATH/orm/classes/kohana/orm.php [ 46 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2019-07-25 11:13:18 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Marshalpoint as array ~ APPPATH/classes/controller/order.php [ 811 ]
2019-07-25 11:13:18 --- STRACE: ErrorException [ 1 ]: Cannot use object of type Model_Marshalpoint as array ~ APPPATH/classes/controller/order.php [ 811 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}