
# 🕌 Laravel Hijri Date

> A lightweight and powerful Laravel package to convert **Hijri ⇄ Gregorian** dates with automatic detection, multiple formats support, and offline calculations.

---

## ✨ Features

* ✅ Convert **Gregorian ⇄ Hijri**

* ✅ Auto-detect date type (Hijri or Gregorian)

* ✅ Accepts multiple formats:

  * Gregorian: `d-m-Y`, `d/m/Y`, `Y-m-d`, `Y/m/d`
  * Hijri: `d/m/Y`, `d-m-Y`, `Y/m/d`, `Y-m-d`
  * Also supports `array` input: `['day' => , 'month' => , 'year' => ]`
  * Carbon / DateTime objects

* ✅ Timezone support for Gregorian dates

* ✅ Uses internal **Umm Al-Qura** calculations

* ✅ Optional daily validation against external sources

* ✅ Daily caching for performance

* ✅ Cron Job support for validation

* ✅ Laravel 10, 11 & 12 ready

---

## 📦 Installation

```bash
composer require omarmokhtar/laravel-hijri-date
```

Laravel auto-discovers the service provider.

---

## ⚙️ Configuration

Publish the config file:

```bash
php artisan vendor:publish --tag=hijri-date-config
```

`config/hijri-date.php`:

```php
return [
    'timezone'        => config('app.timezone'),
    'adjustment'      => 0,      // Hijri adjustment: -1 | 0 | +1
    'cache_ttl'       => 86400,  // 1 day
    'validate_daily'  => true,   // optional daily validation
];
```

---

## 🚀 Usage

```php
use HijriDate;

// Today Hijri
HijriDate::todayHijri();

// Gregorian → Hijri
HijriDate::fromGregorian('15/03/2025');
HijriDate::fromGregorian(now(), 'Africa/Cairo');

// Hijri → Gregorian
HijriDate::fromHijri(1, 9, 1446);
HijriDate::fromHijriString('13/08/1447');
HijriDate::parse([
    'day' => 1,
    'month' => 9,
    'year' => 1446,
]);

// Auto-detect
HijriDate::parse('15-03-2025');          // Gregorian
HijriDate::parse('13/08/1447', 'hijri'); // Hijri
```

---

## 📄 Error Handling

Invalid input will throw:

```php
OmarMokhtar\HijriDate\Exceptions\InvalidDateException
```

---

## 🧪 Requirements

* PHP ^8.1
* Laravel ^10 | ^11 | ^12

---

## 🔒 Independence

* Internal Hijri calculations → no mandatory external API
* Optional external validation to guarantee correctness
* Cron Job ensures daily validation and cache refresh

---

## 🤝 Contributing

1. Fork the repo
2. Create a new branch
3. Commit your changes
4. Open a Pull Request 🚀

---

## 📄 License

MIT © 2026 — Developed by **Omar Mokhtar**
