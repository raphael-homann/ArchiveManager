# ArchiveManager

ce script permet de nettoyer progressivement des backups. 

## archivage dossier simple
```php
$iterator = new SimpleDirectoryIterator();
$iterator -> setPath(__DIR__."/test","/^([0-9]{4}-[0-9]{2}-[0-9]{2}).*$/");
$iterator -> setSimulate(true);

$manager = new ArchiveManager();
// pendant une semaine, on conserve tous les backups
$manager -> addPeriod(new ArchivePeriod(new DateTime("-1 week"))) -> keepAll();
// jusqu'à 1 mois, un par semaine'
$manager -> addPeriod(new ArchivePeriod(new DateTime("-1 month"))) -> segmentBy(new DateInterval("P1W")) -> keepFirst();
// jusqu'à 1 an, 1 backup tous les mois
$manager -> addPeriod(new ArchivePeriod(new DateTime("-1 year"))) -> segmentBy(new DateInterval("P1M")) -> keepFirst();
// un seul backup par an au-delà
$manager -> addPeriod(new ArchivePeriod(new DateTime("-2 year"))) -> keepFirst();
$manager
    -> setIterator($iterator)
    -> cleanArchives();
```

##  test graphique
```php
use eFrogg\ArchiveManager\ArchiveManager;
use eFrogg\ArchiveManager\ArchivePeriod;
use eFrogg\ArchiveManager\SimpleDirectoryIterator;
use eFrogg\ArchiveManager\Tests\TestArchiveManager;

require_once __DIR__."/../vendor/autoload.php";



$manager = new ArchiveManager();
$manager -> realMode = true;
// pendant une semaine, on conserve tous les backups
$manager -> addPeriod(new ArchivePeriod(new DateTime("-1 week"))) -> keepAll();
// jusqu'à 2 mois, un par semaine'
$manager -> addPeriod(new ArchivePeriod(new DateTime("-2 month"))) -> segmentBy(new DateInterval("P1W")) -> keepFirst();
// jusqu'à 1 an, 1 backup tous les 30 jours
$manager -> addPeriod(new ArchivePeriod(new DateTime("-1 year"))) -> segmentBy(new DateInterval("P30D")) -> keepFirst();
// jusqu'à 2 sans, 2 backups par an
$manager -> addPeriod(new ArchivePeriod(new DateTime("-2 year"))) -> segmentBy(new DateInterval("P6M"))-> keepFirst();
// puis on conserve indéfiniment

$testeur = new TestArchiveManager($manager);
$testeur -> test(new DateTime("-1 year"),new DateTime("+ 1 year"),new DateInterval("P1D"),365,new DateInterval("P1D"));
```
