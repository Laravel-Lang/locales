# Extended Lang Translations Template

![laravel-lang translations template](https://preview.dragon-code.pro/laravel-lang/translations-template.svg?brand=laravel&mode=dark)

[![Stable Version][badge_stable]][link_packagist]
[![Unstable Version][badge_unstable]][link_packagist]
[![Total Downloads][badge_downloads]][link_packagist]
[![License][badge_license]][link_license]

## Prepare Template

Template branch compatibility with [`publisher`](https://github.com/Laravel-Lang/publisher):

* [`14.x`](https://github.com/Laravel-Lang/translations-template/tree/14.x) - `laravel-lang/publisher:^14.0`
* [`13.x`](https://github.com/Laravel-Lang/translations-template/tree/13.x) - `laravel-lang/publisher:^13.0`
* [`12.x`](https://github.com/Laravel-Lang/translations-template/tree/12.x) - `laravel-lang/publisher:^12.0`
* [`11.x`](https://github.com/Laravel-Lang/translations-template/tree/11.x) - `laravel-lang/publisher:^11.0`
* [`10.x`](https://github.com/Laravel-Lang/translations-template/tree/10.x) - `laravel-lang/publisher:^10.0`

### Steps

1. Replace `<your_namespace>` with your GitHub package namespace. For example, `Laravel-Lang/translations-template`.
2. Replace `your/namespace`with package namespace. For example, `laravel-lang/translations-template`.
3. Replace `YourNamespace\Translations` with your PSR package namespace.
4. Replace `Extended Lang Translations Template` with your package title.
5. Replace `<username>` with your name or name of your company.
6. Update tests.
7. Remove this block.

## Installation

To get the latest version of `Extended Lang Translations Template` library, simply require the project using [Composer](https://getcomposer.org):

```
$ composer require <your_namespace> --dev
```

Instead, you may of course manually update your `require-dev` block and run `composer update` if you so choose:

```json
{
    "require-dev": {
        "<your_namespace>": "^1.0"
    }
}
```

## Using

To install files from this repository into your project, you need to install the [laravel-lang/publisher](https://github.com/Laravel-Lang/publisher)
version `^14.0` and above.

Yes, that's all 😊

Now the package is connected to your application and you can [manage localizations](https://laravel-lang.github.io/publisher/using).


[badge_stable]:     https://img.shields.io/github/v/release/<your_namespace>?label=stable&style=flat-square

[badge_unstable]:   https://img.shields.io/badge/unstable-dev--main-orange?style=flat-square

[badge_downloads]:  https://img.shields.io/packagist/dt/<your_namespace>.svg?style=flat-square

[badge_license]:    https://img.shields.io/packagist/l/<your_namespace>.svg?style=flat-square

[link_packagist]:   https://packagist.org/packages/<your_namespace>

[link_license]:     LICENSE
