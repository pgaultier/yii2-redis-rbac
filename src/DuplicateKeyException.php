<?php
/**
 * DuplicateKeyException.php
 *
 * PHP version 5.6+
 *
 * @author Philippe Gaultier <pgaultier@sweelix.net>
 * @copyright 2010-2017 Philippe Gaultier
 * @license http://www.sweelix.net/license license
 * @version XXX
 * @link http://www.sweelix.net
 * @package sweelix\rbac\redis
 */

namespace sweelix\rbac\redis;

use Exception;

/**
 * This exception is raised when a duplicate key is found and
 * entity cannot be inserted.
 *
 * @author Philippe Gaultier <pgaultier@sweelix.net>
 * @copyright 2010-2017 Philippe Gaultier
 * @license http://www.sweelix.net/license license
 * @version XXX
 * @link http://www.sweelix.net
 * @package sweelix\rbac\redis
 * @since XXX
 */
class DuplicateKeyException extends Exception
{

}
