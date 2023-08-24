# API Responses

A package to help you keep your API Responses standardized.

## Installation

```bash
composer require treblle/api-responses
```

## Usage

In your controllers, simply return the response type that you need:

```php
public function __invoke(Request $request, User $user): Responsable
{
    return new ModelResponse(
        data: new UserResource(
            resource: $user,
        ),
    );
}
```

This package currently contains the following responses:

- `ModelResponse`: For responding a single model resource.
- `CollectionResponse`: For responding a collection of models for a resource.
- `ErrorResponse`: For responding when you have encountered an Error.
- `MessageResponse`: For when you are returning a simple message.
- `ExpandedResponse`: For when you want to send a message and some data in the response.

Please note, the `ErrorResponse` is not idea for any `400` responses as these are user errors such as wrong resource or Validation problems.

## Handling Errors

When an error occurs in your application, you should let this bubble up to your Exception Handler. Then you can respond in the following way:

```php
use Treblle\ApiResponses\Responses\ErrorResponse;
use Treblle\ApiResponses\Data\ApiError;

return new ErrorResponse(
    data: new ApiError(
        title: 'Bad Request',
        detail: 'This endpoint only accepts POST requests, GET request sent.',
        instance: request()->path(),
        code: ErrorCode::BAD_REQUEST->value,
        link: 'https://docs.domain.com/errors/bad-request',
    ),
    status: Status::BAD_REQUEST,
);
```
