<?php

declare(strict_types=1);

namespace Treblle\ApiResponses\Data;

/**
 * @internal
 */
readonly class ApiError
{
    /**
     * @param string $title The Human readable title of the error
     * @param string $detail The Human readable details of the error
     * @param string $instance The URL where the Error happened
     * @param string $code The unique code for this error: ERROR_1234
     * @param null|string $link The link in the docs for the error
     */
    public function __construct(
        private string $title,
        private string $detail,
        private string $instance,
        private string $code,
        private null|string $link = null,
    ) {
    }

    /**
     * @param array{title:string,detail:string,instance:string,code:string,link:null|string} $data
     * @return ApiError
     */
    public static function fromRequest(array $data): ApiError
    {
        return new ApiError(
            title: $data['title'],
            detail: $data['detail'],
            instance: $data['instance'],
            code: $data['code'],
            link: $data['link'],
        );
    }

    /**
     * @return array{title:string,detail:string,instance:string,code:string,link:null|string}
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'detail' => $this->detail,
            'instance' => $this->instance,
            'code' => $this->code,
            'link' => $this->link,
        ];
    }
}
