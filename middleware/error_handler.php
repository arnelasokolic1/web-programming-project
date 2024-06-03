<?php
function errorHandler($e) {
    logger($e);
    Flight::halt($e->getCode(), $e->getMessage());
    Flight::stop();
}

set_error_handler("errorHandler");
?>
