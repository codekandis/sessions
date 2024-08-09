<?php declare( strict_types = 1 );
namespace CodeKandis\Sessions;

use LogicException;

/**
 * Represents an exception if a session key does not exist.
 * @package codekandis/sessions
 * @author Christian Ramelow <info@codekandis.net>
 */
class SessionKeyNotFoundException extends LogicException
{
}
