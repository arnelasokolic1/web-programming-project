<?php

require 'vendor/autoload.php';
require 'rest/routes/actions_routes.php';
require 'rest/routes/admin_routes.php';
require 'rest/routes/customer_routes.php';
require 'rest/routes/messages_routes.php';
require 'rest/routes/products_routes.php';
require 'rest/routes/auth_routes.php';
require 'rest/routes/middleware_routes.php';

Flight::start();
?>
