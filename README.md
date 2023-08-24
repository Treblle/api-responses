# API Responses

A Laravel package to help keep your API responses standardized.

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

- `ModelResponse`: For responding a single model resource
- `CollectionResponse`: For responding a collection of models for a resource
- `ErrorResponse`: For responding when you have encountered an Error.

Please note, the `ErrorResponse` is not idea for any `400` responses as these are user errors such as wrong resource or Validation problems.
