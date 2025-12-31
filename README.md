# 🕌 Laravel Hijri Date

> A clean and powerful Laravel package for handling **Hijri & Gregorian dates** with automatic detection, flexible input formats, and reliable conversion using Umm Al-Qura calendar.

---

## ✨ Features

* ✅ Convert **Gregorian ⇄ Hijri**
* ✅ Auto-detect input type
* ✅ Accepts Gregorian dates as:

  * `d-m-Y`
  * `d/m/Y`
* ✅ Accepts:

  * `string`
  * `Carbon`
  * `DateTime`
* ✅ Timezone support
* ✅ Uses reliable **Umm Al-Qura (via Aladhan API)**
* ✅ Daily caching
* ✅ Simple Facade API
* ✅ Laravel 10 & 11 compatible

---

## 📦 Installation

```bash
composer require omarmokhtar/laravel-hijri-date
```

Laravel will auto-discover the service provider.

---

## ⚙️ Configuration

Publish the config file:

```bash
php artisan vendor:publish --tag=hijri-date-config
```

`config/hijri-date.php`:

```php
return [
    'timezone'  => config('app.timezone'),
    'adjustment' => 0, // -1 | 0 | +1
    'cache_ttl' => 86400 // seconds (1 day)
];
```

---

## 🚀 Usage

### Get today Hijri date

```php
use HijriDate;

HijriDate::todayHijri();
```

**Output example:**

```php
[
  "day" => "10",
  "month" => [
      "number" => 9,
      "en" => "Ramadan",
      "ar" => "رمضان"
  ],
  "year" => "1446"
]
```

---

### Convert Gregorian → Hijri

#### String input (`d-m-Y` or `d/m/Y`)

```php
HijriDate::fromGregorian('15-03-2025');
HijriDate::fromGregorian('15/03/2025');
```

#### With timezone

```php
HijriDate::fromGregorian('15/03/2025', 'Africa/Cairo');
```

#### Carbon / DateTime

```php
HijriDate::fromGregorian(now());
HijriDate::fromGregorian(new DateTime());
```

---

### Convert Hijri → Gregorian

```php
HijriDate::fromHijri(1, 9, 1446);
```

Output example:

```php
[
  "date" => "01-03-2025",
  "month" => [
      "number" => 3,
      "en" => "March"
  ],
  "year" => "2025"
]
```

---

### Auto-detect & Parse

```php
HijriDate::parse('15-03-2025');

HijriDate::parse([
    'day' => 1,
    'month' => 9,
    'year' => 1446,
]);
```

---

## 🧠 How It Works

* Gregorian parsing handled via **Carbon**
* Hijri conversion using **Aladhan API**
* Calendar based on **Umm Al-Qura**
* Results cached daily for performance

---

## ❌ Error Handling

Invalid or unsupported input will throw:

```php
OmarMokhtar\HijriDate\Exceptions\InvalidDateException
```

---

## 🧪 Requirements

* PHP ^8.1
* Laravel ^10 | ^11
* Internet connection (API-based)

---

## 🔒 Offline Mode (Planned)

Upcoming features:

* ⏳ Offline astronomical calculations
* ⏳ Carbon macro (`now()->toHijri()`)
* ⏳ Validation Rule (`hijri_date`)
* ⏳ Multi-calendar support

---

## 🤝 Contributing

Contributions are welcome!

1. Fork the repo
2. Create a new branch
3. Commit your changes
4. Open a Pull Request 🚀

---

## 📄 License

MIT License © 2026
Developed by **Omar Mokhtar**