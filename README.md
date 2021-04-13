see [Sandbox](https://github.com/stwe/sandbox)

### current setup

Let's say, this is your response:

```
$data =
    [
        'data' =>
            [
                [
                    'title' => 'Article example',
                    'slug' => 'first-example',
                    'content' => 'Lorem Ipsum is simply placeholder.',
                    'approved' => true,
                    'createdAt' => '2021-04-13'
                ],
                [
                    'title' => 'Next example',
                    'slug' => 'next-example',
                    'content' => 'Lorem Ipsum is simply placeholder.',
                    'approved' => 0,
                    'createdAt' => '2021-04-19'
                ]
            ]
    ];
```

The following setup is currently used to display a table:

```bash
/src
    |--Columns
    |----Article
    |------ApprovedColumn.php
    |------ContentColumn.php
    |------CreatedAtColumn.php
    |------SlugColumn.php
    |------TitleColumn.php
    |--Controller
    |----ArticleController.php
    |--Datatables
    |----ArticleDatatable.php
/templates
    |--article
    |----index.html.twig
    |--base.html.twig
```

Configure the classes with a Tag.

```yaml
# config/services.yaml

App\Datatables\:
    resource: '../src/Datatables/'
    tags: ['sg_datatable']

App\Columns\:
    resource: '../src/Columns/'
    tags: ['sg_datatable_column']
```

Widgets can be added to the columns, which are displayed with one or more renderers. Example:

```php
// src/Columns/Article/ApprovedColumn.php

namespace App\Columns\Article;

use Sg\DatatablesBundle\Datatable\Column\AbstractColumn;
use Sg\DatatablesBundle\Datatable\Renderer\BooleanRenderer;
use Sg\DatatablesBundle\Datatable\Renderer\HtmlFormatRenderer;
use Sg\DatatablesBundle\Datatable\Widget\BooleanWidget;
use Sg\DatatablesBundle\Datatable\Widget\HtmlFormatWidget;

class ApprovedColumn extends AbstractColumn
{
    private BooleanRenderer $booleanRenderer;
    private HtmlFormatRenderer $htmlFormatRenderer;

    public function __construct(BooleanRenderer $booleanRenderer, HtmlFormatRenderer $htmlFormatRenderer)
    {
        $this->booleanRenderer = $booleanRenderer;
        $this->htmlFormatRenderer = $htmlFormatRenderer;

        parent::__construct();
    }

    public function buildColumn(): void
    {
        $this->setDql('approved');

        $bw = new BooleanWidget();
        $bw->setTrueLabel('approved');
        $bw->setFalseLabel('not approved');
        $this->addWidget($bw);

        $hw = new HtmlFormatWidget();
        $hw->addTag('b');
        $hw->addTag('i');
        $hw->addTag('u');
        $this->addWidget($hw);

        $this->addRenderer($this->booleanRenderer);
        $this->addRenderer($this->htmlFormatRenderer);
    }

    public function getDatatableId(): string
    {
        return 'article';
    }
}
```

The Datatable currently only configures the path to generate a response.

```php
// src/Datatables/ArticleDatatable.php

namespace App\Datatables;

use Sg\DatatablesBundle\Datatable\AbstractDatatable;

class ArticleDatatable extends AbstractDatatable
{
    public function buildDatatable(): void
    {
        $this->getFeatures()->set([
            'auto_width' => false,
            'defer_render' => false,
            'info' => true,
            'length_change' => false,
            'ordering' => true,
            'paging' => false,
            'processing' => false,
            'scroll_x' => true,
            'scroll_y' => '200px',
            'searching' => false,
            'server_side' => false,
            'state_save' => false
        ]);

        $this->getAjax()->set([
            'url' => $this->getRouter()->generate('article_table_content'),
            'type' => 'POST'
        ]);
    }

    public function getId(): string
    {
        return 'article';
    }
}
```

Now we need a controller with two actions:

```php
// src/Controller/ArticleController.php

namespace App\Controller;

use Sg\DatatablesBundle\Datatables\Datatables;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/")
     *
     * @param Datatables $datatables
     *
     * @return Response
     */
    public function index(Datatables $datatables): Response
    {
        $datatable = $datatables->getDatatableById('article');

        return $this->render(
            'article/index.html.twig',
            [
                'datatable' => $datatable
            ]
        );
    }

    /**
     * @Route("/articles", name="article_table_content", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param Datatables $datatables
     *
     * @return JsonResponse
     */
    public function tabledata(Request $request, Datatables $datatables): JsonResponse
    {
        //$response = $datatables->handleRequest($request, 'post');

        $data =
            [
                'data' =>
                    [
                        [
                            'title' => 'Article example',
                            'slug' => 'first-example',
                            'content' => 'Lorem Ipsum is simply placeholder.',
                            'approved' => true,
                            'createdAt' => '2021-04-13'
                        ],
                        [
                            'title' => 'Next example',
                            'slug' => 'next-example',
                            'content' => 'Lorem Ipsum is simply placeholder.',
                            'approved' => 0,
                            'createdAt' => '2021-04-19'
                        ]
                    ]
            ];

        return $datatables->handleResponse($data, 'article');
    }
}
```

The `index.html.twig` now only calls the TwigExtension to render the table:

```html
{% extends 'base.html.twig' %}

{% block body %}
    <h2>Posts list</h2>
    {{ sg_datatables_render(datatable) }}
{% endblock %}
```

With the basic layout (`base.html.twig`), it is important to ensure that we are using Encore.

```html
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{% block title %}Welcome!{% endblock %}</title>
        {% block stylesheets %}
            {{ encore_entry_link_tags('app') }}
        {% endblock %}

        {% block javascripts %}
            {{ encore_entry_script_tags('app') }}
        {% endblock %}
    </head>
    <body>
        {% block body %}{% endblock %}
    </body>
</html>
```
