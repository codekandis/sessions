<?php declare( strict_types = 1 );
namespace CodeKandis\Sessions;

/**
 * Represents an enumeration of session status codes.
 * @package codekandis/sessions
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class SessionStatus
{
	/**
	 * Sessions are deactivated.
	 * @var int
	 */
	public const DISABLED = PHP_SESSION_DISABLED;

	/**
	 * Sessions are activated but no current session exists.
	 * @var int
	 */
	public const NONE = PHP_SESSION_NONE;

	/**
	 * Sessions are activated and a current session exists.
	 * @var int
	 */
	public const ACTIVE = PHP_SESSION_ACTIVE;
}
