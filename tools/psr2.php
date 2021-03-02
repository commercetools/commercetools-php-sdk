<?php

declare(strict_types=1);

namespace Commercetools;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator) : void {
    $containerConfigurator->import(__DIR__ . '/php_cs_fixer/php-cs-fixer-psr2.php');
    $containerConfigurator->import(__DIR__ . '/php_codesniffer/php-codesniffer-psr2.php');
};
