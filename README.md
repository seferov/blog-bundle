# BlogBundle

Symfony Blog Bundle

## Installation

Download the bundle:

`composer require seferov/blog-bundle`

 
 Register it:
 
```php
// app/AppKernel.php
// ...
public function registerBundles()
{
    $bundles = array(
        // ...
        new Seferov\BlogBundle\SeferovBlogBundle(),
        new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
        new WhiteOctober\BreadcrumbsBundle\WhiteOctoberBreadcrumbsBundle(),
        new Knp\Bundle\MarkdownBundle\KnpMarkdownBundle(),
        new Sonata\SeoBundle\SonataSeoBundle(),
    );
}
```

Add routing:

```yml
seferov_blog:
    resource: "@SeferovBlogBundle/Resources/config/routing.yml"
    prefix:   /blog
```

Create database tables:

`bin/console doctrine:schema:update --dump-sql`

Install assets:

`bin/console assets:install`

## TODO

- remove tons of dependencies
- write tests
- release stable version
- documentation (especially about overwriting templates)
- fixtures
- proper default template

## Examples

On production:
- [azerdict blog](https://azerdict.com/blog/)
