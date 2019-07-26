<p align="center">
  <h2 align="center">The perfect starting point to build your <a href="https://algolia.com" target="_blank">Algolia</a> integration for PHP Framework</h4>
</p>

## ✨ Features

- Thin & minimal low-level HTTP client to interact with Algolia's API
- Supports php `^5.6`
- Additional index methods
- Splitting Records
- Generate Settings

## 💡 Getting Started

First, install Algolia PHP Helper API Client via the [composer](https://getcomposer.org/) package manager:
```bash
composer require algolia/algoliasearch-client-php-helper
```
## Supported platforms

The PHP-Helper is compatible with PHP version 5.6 and later. Build on top from our [PHP Client](https://github.com/algolia/algoliasearch-client-php).

## Algolia PHP Client
You should consider reading this [part](https://www.algolia.com/doc/api-client/getting-started/install/php/) of our documentation if you have never tried our [PHP Client](https://github.com/algolia/algoliasearch-client-php).
## Additional index methods

### Count 

```php

$numberOfRecords = $index->count();

```
## Advanced 

### Splitting Records

For performance reasons, objects in Algolia should be 10kb or less. Large records can be split into smaller records by splitting on a logical chunk such as paragraphs or sentences.

#### HTML Splitter

Sometimes, you will need a more elaborate logic to split specific types of content. A good example is HTML.
`The Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter` lets you split HTML content into coherent records.

Additionally, the `HtmlSplitter` provides another layer of logic. Because HTML is hierarchy-based, the splitter also adds an attribute in each record: `importance`.
This value is calculated for each record, based on the hierarchy of the current chunk. The splitter also updates the settings by adding [custom ranking](/doc/guides/managing-results/must-do/custom-ranking/) based on the `importance` attribute.

```php

 $splitter = new HtmlSplitter();
 $records = $splitter->split($array);
 
 $index->saveObjects($array,['autoGenerateObjectIDIfNotExist' => true]);
 	
 $index->setSettings(
   [
     'customRanking' => ['asc('importance')']
   ]
 );
 
 
```

By default, the HTML splitter parses these tags: `h1`,`h2`,`h3`,`h4`,`h5`,`h6` and `p`.
However, if you want to check less or more tags, you can do it like this:

```php
{
    $tags = [
    	'h1',
    	'h2',
     	'h3',
     	'p',
    ];
    
    $splitter = new HtmlSplitter($tags);
	
    $records = $splitter->split($array);
}
```

## Writing splitters
If you want to split other kinds of content, you can create your own splitter class.

One of the primary benefits of creating a splitter class is the ability
to type-hint any dependencies your splitter may need in its constructor.
The declared dependencies will automatically be resolved and injected
into the splitter instance.

Writing a splitter is simple. Create a new class that implements
`Algolia\ScoutExtended\Contracts\SplitterContract`, and the `split`
method should split the given `$value` as needed:

```php
namespace App\Search\Splitters;

use  Algolia\AlgoliaSearch\Helper\Contracts\SplitterContract;

class CustomSplitter implements SplitterContract
{
    /**
     * Splits the given value.
     *
     * @param mixed $value
     *
     * @return array<int, array>
     */
     public function split($searchable, $value): array
    {
        // Your splitting logic.
        return $array;
    }
}
```
## Generate Settings
Performance is important. However, for a search to be successful, results need to be relevant to the user. PHP-Helper provides a tool that you may use to optimize the search experience based on your data.

### Settings Factory 

To optimize your search based on your data, you need to configure properly all settings for your index. With Algolia you are able to directly set settings on the `Algolia dashboard`. This step may take time and is a bit complex.

The `SettingsFactory` class provide a method `create()`which will take as input one sample of your data and generate automatically settings for you.

```php

$array = [
    'category_name' => 'Foo',
    'likes_count' => 'Bar',  
    'slug' => 'Baz',
    'name_password' => 'Bam'
];

$detectedSettings = SettingsFactory::create($array);

$this->index->setSettings($settings)
```

Keep in mind, this is the first step to bring the best search for your use case, you'll need to iterate and update settings on your own.
## 📄 License

Algolia PHP API Client is an open-sourced software licensed under the [MIT license](LICENSE.md).
