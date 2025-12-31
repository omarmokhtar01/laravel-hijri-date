# 🕌 Laravel Hijri Date

> A clean and powerful Laravel package for handling **Hijri & Gregorian dates** with automatic detection, flexible input formats, and reliable conversion using the **Umm Al-Qura calendar**.

---

## ✨ Features

* ✅ Convert **Gregorian ⇄ Hijri**
* ✅ Auto-detect input type
* ✅ Accepts Gregorian dates as:

  * `d-m-Y`
  * `d/m/Y`
  * `Y-m-d`
  * `Y/m/d`
* ✅ Accepts Hijri dates as:

  * `d/m/Y`
  * `d-m-Y`
  * `Y/m/d`
  * `Y-m-d`
* ✅ Accepts input as:

  * `string`
  * `Carbon`
  * `DateTime`
  * `array` with keys: `day`, `month`, `year`
* ✅ Timezone support for Gregorian dates
* ✅ Uses reliable **Umm Al-Qura calendar (via Aladhan API)**
* ✅ Daily caching for performance
* ✅ Simple Facade API
* ✅ Console command support
* ✅ Laravel **10, 11 & 12** compatible

---

## 📦 Installation

Install via Composer:

```bash
composer require omarmokhtar/laravel-hijri-date
```

Laravel will auto-discover the service provider automatically.

---

## ⚙️ Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --tag=hijri-date-config
```

### `config/hijri-date.php`

```php
return [
    'timezone'   => config('app.timezone'),
    'adjustment' => 0,        // -1 | 0 | +1 (Hijri day adjustment)
    'cache_ttl'  => 86400     // seconds (1 day)
];
```

---

## 🚀 Usage

### Get today's Hijri date

```php
use HijriDate;

HijriDate::todayHijri();
```

**Example output:**

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

#### String input

```php
HijriDate::fromGregorian('15-03-2025');
HijriDate::fromGregorian('15/03/2025');
HijriDate::fromGregorian('2025-03-15');
HijriDate::fromGregorian('2025/03/15');
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

#### Using day, month, year

```php
HijriDate::fromHijri(1, 9, 1446);
```

#### String input

```php
HijriDate::fromHijriString('13/08/1447');
HijriDate::fromHijriString('13-08-1447');
HijriDate::fromHijriString('1447/08/13');
HijriDate::fromHijriString('1447-08-13');
```

#### Array input

```php
HijriDate::parse([
    'day' => 1,
    'month' => 9,
    'year' => 1446,
]);
```

---

### Auto-detect & Parse

```php
HijriDate::parse('15-03-2025');          // Gregorian
HijriDate::parse('13/08/1447', 'hijri'); // Hijri
HijriDate::parse('1447/08/13', 'hijri'); // Hijri (YYYY/MM/DD)
```

The package will automatically detect whether the date is **Hijri or Gregorian** based on the year or optional type hint.

---

## 🧠 How It Works

* Gregorian parsing handled via **Carbon**
* Hijri conversion handled via **Aladhan API**
* Calendar based on **Umm Al-Qura**
* Results cached daily for high performance

---

## 🖥️ Console Command

This package provides a built-in Artisan command for validating Hijri date sources.

### Run manually

```bash
php artisan hijri:validate
```

---

## ⏱️ Scheduling the Command (Optional)

You can run the Hijri validation command automatically every day using **Laravel Scheduler**.

### 1️⃣ Add to `app/Console/Kernel.php`

```php
use Illuminate\Console\Scheduling\Schedule;

protected function schedule(Schedule $schedule)
{
    $schedule->command('hijri:validate')->dailyAt('00:05');
}
```

This will run the command **daily at 12:05 AM**.

---

### 2️⃣ Enable Scheduler on the Server

Make sure you have this Cron Job configured on your server:

```bash
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
```

> ⚠️ Replace `/path-to-your-project` with the actual path to your Laravel project.

---

### ✅ Notes

* Console commands are **auto-registered** via the package service provider
* No console files are copied into your project
* This is the **standard Laravel package behavior**

---

## ❌ Error Handling

Invalid or unsupported input will throw:

```php
OmarMokhtar\HijriDate\Exceptions\InvalidDateException
```

---

## 🧪 Requirements

* PHP ^8.1
* Laravel ^10 | ^11 | ^12
* Internet connection (API-based)

---

## 🔒 Offline Mode (Planned)

Upcoming features:

* ⏳ Offline astronomical calculations
* ⏳ Carbon macro (`now()->toHijri()`)
* ⏳ Validation Rule (`hijri_date`)
* ⏳ Multi-calendar support (Umm Al-Qura, Turkish, etc.)

---

## 🤝 Contributing

Contributions are welcome ❤️

1. Fork the repository
2. Create a new branch
3. Commit your changes
4. Open a Pull Request 🚀

---

## 📄 License

MIT License © 2025
Developed by **Omar Mokhtar**
