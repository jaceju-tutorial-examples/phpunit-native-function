# Lab3 - 測試 Native Function

目標：學習如何測試 native function 的邏輯？

## 讓 shell_exec 可以被 mock

為 `HolidayTest` 類別加上 namespace `Lab3` ：

```php
namespace Lab3;
```

在 namespace 下方覆寫 `shell_exec` ：

```php
function shell_exec($cmd)
{
    HolidayTest::$functions->shell_exec($cmd);
}
```

在 `HolidayTest` 類別中，加入：

```php
    /**
     * @var \Mockery\MockInterface
     */
    public static $functions = null;

    public function setUp()
    {
        self::$functions = \Mockery::mock();
        self::$functions->shouldReceive('shell_exec')
            ->withAnyArgs()
            ->andReturnNull();
    }

    public function tearDown()
    {
        \Mockery::close();
    }
```

執行測試。

## 通過無法同時被滿足的兩個測試

打開 `src/Holiday.php` ，瞭解運作方式。

打開 `tests/HolidayTest.php` ，查看驗證方式。

將 `// $this->assertTrue($actual);` 及 `// $this->assertFalse($actual);` 的 `//` 註解拿掉。

執行測試。

## 改用 Carbon

在 Terminal 執行：

```bash
composer require nesbot/carbon
```

編輯 `src/Holiday.php` ，將：

```php
return '12/25' === date('m/d');
```

替換成：

```php
$date = Carbon::now();
return '12/25' === $date->format('m/d');
```

編輯 `tests/HolidayTest.php` ，將 `today_should_be_xmas` 方法中的：

```php
$holiday = new Holiday;

$actual = $holiday->isTodayXmas();
```

替換為：

```php
$holiday = new Holiday;
Carbon::setTestNow(Carbon::create(2015, 12, 25));

$actual = $holiday->isTodayXmas();
Carbon::setTestNow();
```

執行測試。

將 `today_should_be_not_xmas` 方法中的：

```php
$holiday = new Holiday;

$actual = $holiday->isTodayXmas();
```

替換為：

```php
$holiday = new Holiday;
Carbon::setTestNow(Carbon::create(2015, 1, 1));

$actual = $holiday->isTodayXmas();
Carbon::setTestNow();
```

執行測試。