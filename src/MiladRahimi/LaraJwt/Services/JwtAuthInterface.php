<?php
/**
 * Created by PhpStorm.
 * User: Milad Rahimi <info@miladrahimi.com>
 * Date: 11/2/2017 AD
 * Time: 19:58
 */

namespace MiladRahimi\LaraJwt\Services;

use Closure;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\ServiceProvider;
use MiladRahimi\LaraJwt\Exceptions\InvalidJwtException;

interface JwtAuthInterface
{
    /**
     * Generate JWT from user model or id
     *
     * @param Authenticatable|int $user
     * @param array $claims
     * @return string
     */
    public function generateTokenFrom($user, array $claims = []): string;

    /**
     * Retrieve user from given jwt and by given user provider
     *
     * @param string $jwt
     * @param ServiceProvider|string $provider
     * @return Authenticatable
     */
    public function retrieveUserFrom(string $jwt, $provider = null): Authenticatable;

    /**
     * Retrieve claims from given jwt
     *
     * @param string $jwt
     * @return array
     */
    public function retrieveClaimsFrom(string $jwt): array;

    /**
     * Is given JWT valid?
     *
     * @param string|null $jwt
     * @return bool
     */
    public function isJwtValid($jwt): bool;

    /**
     * Register new user validator to validate user
     *
     * @param Closure $hook
     */
    public function registerPostHook(Closure $hook);

    /**
     * Run registered post-hooks
     *
     * @param Authenticatable|int $user
     */
    public function runPostHooks($user);

    /**
     * Clear JWT cache
     *
     * @param Authenticatable|int $user
     */
    public function clearCache($user);

    /**
     * Logout user
     *
     * @param Authenticatable|int $user
     */
    public function logout($user);

    /**
     * Get cache key LaraJwt uses to cache tokens
     *
     * @param Authenticatable|int $user
     * @return string|null
     */
    public function getUserCacheKey($user);

    /**
     * Get cache key LaraJwt uses to cache user logout times
     *
     * @param Authenticatable|int $user
     * @return string|null
     */
    public function getUserLogoutCacheKey($user);
}