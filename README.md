# ArchiveManager

```php
$iterator = new SimpleDirectoryIterator();
$iterator -> setPath(__DIR__."/test","/^([0-9]{4}-[0-9]{2}-[0-9]{2}).*$/");

$manager = new ArchiveManager();
$manager -> realMode = true;
$manager -> addPeriod(new ArchivePeriod(new DateTime("-1 week"))) -> keepAll();
$manager -> addPeriod(new ArchivePeriod(new DateTime("-1 month"))) -> segmentBy(new DateInterval("P1W")) -> keepFirst();
$manager -> addPeriod(new ArchivePeriod(new DateTime("-1 year"))) -> segmentBy(new DateInterval("P1M")) -> keepFirst();
$manager -> addPeriod(new ArchivePeriod(new DateTime("-2 year"))) -> keepFirst();
$manager
    -> setIterator($iterator)
    -> cleanArchives();
```