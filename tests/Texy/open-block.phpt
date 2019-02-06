<?php

/**
 * Test:
 */

declare(strict_types=1);

use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


$texy = new Texy\Texy;
$texy->htmlOutputModule->lineWrap = 180;

Assert::matchFile(
	__DIR__ . '/expected/open-block.html',
	$texy->process(file_get_contents(__DIR__ . '/sources/open-block.texy'))
);
