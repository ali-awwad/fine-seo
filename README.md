# Fine Seo

> Fine Seo is a Statamic addon that does SEO in a simple way. The main purpose is to cover the most common scenarios. 

## Features

This addon does:

- Adds a Fieldset with SEO fields
- And imports it into the Pages collection, and you can import it into whatever other collections as needed.
- the SEO fields show progress indicator for both title and description
- finally a preview of how the search result will show up on search engines.

## How to Install

You can search for this addon in the `Tools > Addons` section of the Statamic control panel and click **install**, or run the following command from your project root:

``` bash
composer require ali-awwad/fine-seo
```

## Render meta in layout 

Add the following partial to your `layout.antlers.html`

`{{ partial:fine-seo::components/meta }}`

In case not all meta are required or further customiztion needed, then just copy the `/components/_meta.antlers.html` to your project and make the changes you like and call your own partial.

## How to Use

Its straight forward addon, just visit the addon page and click on the blue button to generate the needed seo fields.

TODOs:
[] Add Brand globals
[] Add a youtube video to describe this
[] Support JSON LD for website and organization

Statamic marketplace has other paid SEO addons with so much more functionalities. But this Fine SEO addon is a simple way to get started.
