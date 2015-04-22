<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core;

use Sphere\Core\Helper\Annotate\AnnotationGenerator;

require '../vendor/autoload.php';

$path = __DIR__ . '/../src/';

$generator = new AnnotationGenerator();
$generator->run($path);
