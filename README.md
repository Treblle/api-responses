<div align="center">
  <img src="https://treblle-github.s3.amazonaws.com/header.png"/>
</div>
<div align="center">

# API Responses

<!-- BADGES_START -->
[![Latest Version][badge-release]][packagist]
[![PHP Version][badge-php]][php]
![tests](https://github.com/JustSteveKing/php-sdk/workflows/tests/badge.svg)
[![Total Downloads][badge-downloads]][downloads]

[badge-release]: https://img.shields.io/packagist/v/treblle/api-responses.svg?style=flat-square&label=release
[badge-php]: https://img.shields.io/packagist/php-v/treblle/api-responses.svg?style=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/treblle/api-responses.svg?style=flat-square&colorB=mediumvioletred

[packagist]: https://packagist.org/packages/treblle/api-responses
[php]: https://php.net
[downloads]: https://packagist.org/packages/treblle/api-responses
<!-- BADGES_END -->

<a href="https://docs.treblle.com/en/integrations" target="_blank">Integrations</a>
<span>&nbsp;&nbsp;•&nbsp;&nbsp;</span>
<a href="http://treblle.com/" target="_blank">Website</a>
<span>&nbsp;&nbsp;•&nbsp;&nbsp;</span>
<a href="https://docs.treblle.com" target="_blank">Docs</a>
<span>&nbsp;&nbsp;•&nbsp;&nbsp;</span>
<a href="https://blog.treblle.com" target="_blank">Blog</a>
<span>&nbsp;&nbsp;•&nbsp;&nbsp;</span>
<a href="https://twitter.com/treblleapi" target="_blank">Twitter</a>
<span>&nbsp;&nbsp;•&nbsp;&nbsp;</span>
<a href="https://treblle.com/chat" target="_blank">Discord</a>
<br />

  <hr />
</div>

A package to help you keep your API Responses standardized.

## Installation

```bash
composer require treblle/api-responses
```

## Usage

This package is easy to use, it is designed to be used within your controllers to return API responses that are simple and standardized.

## Returning a single model

Some API endpoints just need to return a single model, in this situation you should use the `ModelResponse` which accepts a `JsonResource` representation of your model.

```php
final class ShowController
{
    public function __invoke(Request $request, User $user): Responsable
    {
        return new ModelResponse(
            data: new UserResource(
                resource: $user,
            ),
        );
    }
}
```

## Returning a collection of models

Other API endpoints want to return a collection of models, in these situations you should use the `CollectionResponse` which accepts an `AnonymousResourceCollection` which is a collection of Models transformed through API Resources.

```php
final class IndexController
{
    public function __invoke(Request $request): Responsable
    {
        return new CollectionResponse(
            data: UserResource::collection(
                resource: User::query()->get(),
            ),
        );
    }
}
```

## When something goes wrong

The best approach when something goes wrong in your API, the best approach is to allow this to bubble up the your Exception Handler and manage how you respond in one central place.

```php
final class Handler extends ExceptionHandler
{
    public function register(): void
    {
        $this->renderable(fn (ModelNotFoundException $exception, Request $request) => new ErrorResponse(
            data: new ApiError(
                title: 'Not Found',
                detail: $exception->getMessage(),
                instance: $request->path(),
                code: ErrorCode::NOT_FOUND->value,
                link: 'https://docs.domain.com/errors/not-found',
            ),
            status: Status::NOT_FOUND,
        ));
    }
}
```

## Sending a simple message response

Sometimes all you need to do is send a simple message back through your API. Perhaps you are pushing the logic to a background job.

```php
final class StoreController
{
    public function __invoke(StoreRequest $request): Responsable
    {
        dispatch(new RegisterProvider($request->payload()));
        
        return new MessageResponse(
            data: 'We have accepted your request, and are processing this action.',
            status: Status::ACCEPTED,
        )
    }
}
```

## Sending back a more complex message response

At times you want to pass back a message as well as some data, perhaps to signify actions that need to be taken.

```php
final class LoginController
{
    public function __invoke(Request $request): Responsable
    {
        return new \Treblle\ApiResponses\Responses\ExpandedResponse(
            message: __('auth.login'),
            data: [
                'type' => 'login',
                'attributes' => [
                    'mfa' => __('auth.mfa_required'),
                ]
            ],
        )
    }
}
```

## General Usage

This package currently contains the following responses:

- `ModelResponse`: For responding a single model resource.
- `CollectionResponse`: For responding a collection of models for a resource.
- `ErrorResponse`: For responding when you have encountered an Error.
- `MessageResponse`: For when you are returning a simple message.
- `ExpandedResponse`: For when you want to send a message and some data in the response.

Please note, the `ErrorResponse` is not idea for any `400` responses as these are user errors such as wrong resource or Validation problems.


## Community 💙

First and foremost: **Star and watch this repository** to stay up-to-date.

Also, follow our [Blog](https://blog.treblle.com), and on [Twitter](https://twitter.com/treblleapi).

You can chat with the team and other members on [Discord](https://treblle.com/chat) and follow our tutorials and other video material at [YouTube](https://youtube.com/@treblle).

[![Treblle Discord](https://img.shields.io/badge/Treblle%20Discord-Join%20our%20Discord-F3F5FC?labelColor=7289DA&style=for-the-badge&logo=discord&logoColor=F3F5FC&link=https://treblle.com/chat)](https://treblle.com/chat)

[![Treblle YouTube](https://img.shields.io/badge/Treblle%20YouTube-Subscribe%20on%20YouTube-F3F5FC?labelColor=c4302b&style=for-the-badge&logo=YouTube&logoColor=F3F5FC&link=https://youtube.com/@treblle)](https://youtube.com/@treblle)

[![Treblle on Twitter](https://img.shields.io/badge/Treblle%20on%20Twitter-Follow%20Us-F3F5FC?labelColor=1DA1F2&style=for-the-badge&logo=Twitter&logoColor=F3F5FC&link=https://twitter.com/treblleapi)](https://twitter.com/treblleapi)

### How to contribute

Here are some ways of contributing to making Treblle better:

- **[Try out Treblle](https://docs.treblle.com/en/introduction#getting-started)**, and let us know ways to make Treblle better for you. Let us know here on [Discord](https://treblle.com/chat).
- Join our [Discord](https://treblle.com/chat) and connect with other members to share and learn from.
- Send a pull request to any of our [open source repositories](https://github.com/Treblle) on Github. Check the contribution guide on the repo you want to contribute to for more details about how to contribute. We're looking forward to your contribution!
- 
## Testing

To run the test suite:

```bash
composer run test
```

## Credits

<a href="https://github.com/Treblle/api-responses/graphs/contributors">
  <p align="center">
    <img  src="https://contrib.rocks/image?repo=Treblle/api-responses" alt="A table of avatars from the project's contributors" />
  </p>
</a>

## LICENSE

The MIT LIcense (MIT). Please see [License File](./LICENSE) for more information.
