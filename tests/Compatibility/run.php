<?php

$version = $argv[1] ?? (getenv('TIPTAP_VERSION') ?: 'latest');

putenv("TIPTAP_VERSION={$version}");

$run = function (array $command): void {
    $process = proc_open(
        $command,
        [STDIN, STDOUT, STDERR],
        $pipes,
        dirname(__DIR__, 2),
    );

    if (! is_resource($process)) {
        fwrite(STDERR, 'Unable to start: ' . implode(' ', $command) . PHP_EOL);
        exit(1);
    }

    $exitCode = proc_close($process);

    if ($exitCode !== 0) {
        exit($exitCode);
    }
};

$run(['npm', 'run', 'install-compatibility-dependencies']);
$run([PHP_BINARY, 'vendor/bin/pest', 'tests/Compatibility']);
