--TEST--
swoole_http2_client_coro: http2 ping
--SKIPIF--
<?php require __DIR__ . '/../include/skipif.inc'; ?>
--FILE--
<?php
require __DIR__ . '/../include/bootstrap.php';
go(function () {
    $domain = 'nghttp2.org';
    $cli = new Swoole\Coroutine\Http2\Client($domain, 443, true);
    $cli->set([
        'timeout' => 1,
        'ssl_host_name' => $domain
    ]);
    if (!$cli->connect()) {
        exit; // we can't connect to this website without proxy in China so we skip it.
    }
    $ret = $cli->ping();
    assert($ret);
});
?>
--EXPECT--
