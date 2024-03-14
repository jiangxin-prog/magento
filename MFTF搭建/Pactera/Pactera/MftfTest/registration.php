<?php
/**
 * 流程一：
 *    php -d memory_limit=-1 vendor/bin/mftf generate:tests OneFlowTest --remove --force
 *    php -d memory_limit=-1 vendor/bin/mftf run:test OneFlowTest --remove --force
 */
\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    'Pactera_MftfTest',
    __DIR__
);
