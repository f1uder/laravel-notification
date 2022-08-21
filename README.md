# Laravel Livewire Notification (+ AlpineJS)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/f1uder/laravel-notification.svg?style=flat-square)](https://packagist.org/packages/f1uder/laravel-notification)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/f1uder/laravel-notification/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/f1uder/laravel-notification/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/f1uder/laravel-notification.svg?style=flat-square)](https://packagist.org/packages/f1uder/laravel-notification)

<img alt="Laravel Livewire Notification" src="https://nrox.ru/images/laravel-notification.jpg" />


## Installation

You can install the package via composer:

```bash
composer require f1uder/laravel-notification
```

Publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-notification"
```

Add css file (notification.css)
```css
@import "../../public/vendor/laravel-notification/css/notification.css";

@tailwind base;
@tailwind components;
@tailwind utilities;
```

Add code to template, after body tag

```html
<body>
  <livewire:laravel-notification.notice/>
  ...
</body>
```

## Usage Laravel

```php
return redirect('/')->notice('message text', 'alert');
```

```php
return redirect()->route('home')->notice('message text', 'info');
```

## Usage Livewire component

```php
$this->notice('message text', 'alert');
```

```php
return redirect('/')->notice('message text', 'alert');
```

## Usage alpineJS

```js
$dispatch('notice', {message: 'message text', type: 'alert'});
```
## Arguments

Usage: `notice($message, $type, $timer, $title)`
* `$message` - Message.
* `$type` - Notification type.
    * `alert`
    * `info` - default
    * `success`
* `$timer` - 3000 default = 3 sec.
* `$title` - Notification header. Default = null.

## Config
`config/notification.php`
* `$timer` - Notification display time in seconds.
* `$position` - Notification position.
  * `tr` - Top right (default).
  * `tl` - Top left.
  * `br` - Bottom right.
  * `bl` - Bottom left.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
