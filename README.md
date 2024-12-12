# PHPStan local package issue

This repository is used to showcase issue when using PHPStan's cache with a local package.

## The issue

Here we created a `project/` that depends on a `library/` via a local repository:
```json5
// project/composer.json
{
  // [...]
  "repositories": { "library": { "type": "path", "url": "../library" } },
  // [...]
}
```

And we have a `project/src/Bar.php` that uses a result from `library/src/Foo.php`.

When running `vendor/bin/phpstan analyze --level max src/` the first time in `project/` it will report no errors.

We then modify `library/src/Foo.php` to:
```php
    public static function produceValue(): string
    {
        return '';
    }
```

And re-run `vendor/bin/phpstan analyze --level max src/` in `project/`.

🐛 PHPStan report's no issue. It should report an issue.

## Extension to the issue

Similary (could not reproduce here), in some cases when updating the code on both places, PHPStan's will keep the old cache info he had from the library.

## Possible solutions

Local repositories get always re-analyzed just to always re-retrieve their functions signatures.