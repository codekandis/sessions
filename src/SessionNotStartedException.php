<?php declare( strict_types = 1 );
namespace CodeKandis\Sessions;

use LogicException;

/**
 * Represents an exception if a session has not been started.
 * @package codekandis/sessions
 * @author Christian Ramelow <info@codekandis.net>
 */
class SessionNotStartedException extends LogicException
{
}
