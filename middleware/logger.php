<?php
function logger($message) {
    $logFile = __DIR__ . '/../logs/app.log';
    $timestamp = date("Y-m-d H:i:s");
    file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
}
?>
