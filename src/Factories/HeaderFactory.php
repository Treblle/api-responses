<?php

declare(strict_types=1);

namespace Treblle\ApiResponses\Factories;

use function array_merge;

/**
 * @internal
 */
class HeaderFactory
{
    /**
     * @param array<string,string> $headers
     * @return array<string,string>
     */
    public static function default(array $headers = []): array
    {
        return array_merge(
            [
                'Content-Type' => 'application/vnd.api+json',
            ],
            $headers,
        );
    }

    /**
     * @param array<string,string> $headers
     * @return array<string,string>
     */
    public static function error(array $headers = []): array
    {
        return array_merge(
            [
                'Content-Type' => 'application/problem+json',
            ],
            $headers,
        );
    }
}
