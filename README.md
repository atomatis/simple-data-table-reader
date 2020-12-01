# simple-data-table-reader

POO iterable tools for parse easily any basic data table file (like csv, xlsx, ...).

## Installation

With composer

```shell script
composer require atomatis/simple-data-table-reader
```

## Purpose

Read a simple table_data.xlsx file

| Name     | ref_id  | tel N°         |
|----------|---------|----------------|
| nadege   | AR4F9EJ | 06 54 65 66 77 |
| gertrude | 45345   | 065 465 656 77 |

like this

```php
 $reader = SimpleReaderFactory::createTableDataReader('file/table_data.xlsx'/*, ?string $forceExtension*/);
 $reader->getHeader(); // return ['name', 'ref_id', 'tel_n']

 foreach ($reader->getIterator() as $row) {
    // offset 1
    $row->get('name'); // return 'nadege'
    $row->get('ref_id'); // return 'AR4F9EJ'
    $row->get('wrong_ref'); // return null
    $row(); // return ['name' => 'nadege', 'ref_id' => 'AR4F9EJ', 'tel_n' => '06 54 65 66 77']
 }
```

## Other info

| Extension available |
|---------------------|
| xlsx                |
| csv                 |
