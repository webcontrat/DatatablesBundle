see [Sandbox](https://github.com/stwe/sandbox)

### current setup

Let's say, this is your response:

```
$data =
    [
        'data' =>
            [
                [
                    'name' => 'Tiger',
                    'position' => false
                ],
                [
                    'name' => '',
                    'position' => 'Worker'
                ]
            ]
    ];
```

The following setup is currently used to display a table:

```bash
/src
    |--Columns
    |----Post
    |------NameColumn.php
    |------PositionColumn.php
    |--Controller
    |----PostController.php
    |--Datatables
    |----PostDatatable.php
/templates
    |--post
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

The columns are configured with widgets and a renderer. See example:

```php
// src/Columns/Post/PositionColumn.php

namespace App\Columns\Post;

use Sg\DatatablesBundle\Datatable\Column\AbstractColumn;
use Sg\DatatablesBundle\Datatable\Renderer\DummyRenderer;
use Sg\DatatablesBundle\Datatable\Widget\BooleanWidget;
use Sg\DatatablesBundle\Datatable\Widget\HtmlFormatWidget;

class PositionColumn extends AbstractColumn
{
    public function buildColumn()
    {
        $this->setDql('position');

        $bw = new BooleanWidget();
        $bw->setTrueLabel('custom True label');
        $this->addWidget($bw);

        $hw = new HtmlFormatWidget();
        $hw->setBold(true);
        $hw->setItalic(true);
        $this->addWidget($hw);

        $this->setRenderer(new DummyRenderer());
    }

    public function getDatatableId(): string
    {
        return 'post';
    }
}
```

The Datatable currently only configures the path to generate a response.

```php
// src/Datatables/PostDatatable.php

namespace App\Datatables;

use Sg\DatatablesBundle\Datatable\AbstractDatatable;

class PostDatatable extends AbstractDatatable
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
            'url' => $this->getRouter()->generate('table_content'),
            'type' => 'POST'
        ]);
    }

    public function getId(): string
    {
        return 'post';
    }
}
```

Now we need a controller with two actions:

```php
// src/Controller/PostController.php

namespace App\Controller;

use Sg\DatatablesBundle\Datatables\Datatables;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/")
     * @param Datatables $datatables
     * @return Response
     */
    public function homepage(Datatables $datatables): Response
    {
        $datatable = $datatables->getDatatableById('post');

        return $this->render(
            'post/index.html.twig',
            [
                'datatable' => $datatable
            ]
        );
    }

    /**
     * @Route("/ajax", name="table_content", methods={"GET", "POST"})
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
                            'name' => 'Tiger',
                            'position' => false
                        ],
                        [
                            'name' => '',
                            'position' => 'Worker'
                        ]
                    ]
            ];

        $jsonResponse = $datatables->handleResponse($data, 'post');

        return $jsonResponse;
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
