<?php

/*
 * This file is part of the SgDatatablesBundle package.
 *
 * (c) stwe <https://github.com/stwe/DatatablesBundle>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sg\DatatablesBundle\Datatable\Column;

use Exception;
use Sg\DatatablesBundle\Datatable\Column\ActionColumn;
use Sg\DatatablesBundle\Datatable\Action\Action;
use Sg\DatatablesBundle\Datatable\Helper;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DropdownActionColumn extends ActionColumn
{
    /**
     * The dropdowns container.
     *
     * @var array[<Action>]
     */
    protected $dropdowns;

    //-------------------------------------------------
    // ColumnInterface
    //-------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function addDataToOutputArray(array &$row)
    {
        parent::addDataToOutputArray($row);
        
        $dropdownRowItems = [];

        /** @var Action $dropdown */
        if (!empty($this->dropdowns)) {
            foreach ($this->dropdowns as $dropdownKey => $dropdown) {
                $dropdownRowItems[$dropdownKey] = $dropdown->callRenderIfClosure($row);
            }
        }

        $row['sg_datatables_dropdowns'][$this->getIndex()] = $dropdownRowItems;
    }

    /**
     * {@inheritdoc}
     */
    public function getCellContentTemplateVars(array $row)
    {
        $vars = parent::getCellContentTemplateVars($row);

        if (empty($this->dropdowns)) {
            $vars['dropdowns'] = NULL;
            
            return $vars;
        }
        
        $parameters = [];
        $attributes = [];
        $values = [];

        // The same logic as for parent actions.
        foreach ($this->dropdowns as $actionKey => $action) {
            $routeParameters = $action->getRouteParameters();
            if (\is_array($routeParameters)) {
                foreach ($routeParameters as $key => $value) {
                    if (isset($row[$value])) {
                        $parameters[$actionKey][$key] = $row[$value];
                    } else {
                        $path = Helper::getDataPropertyPath($value);
                        $entry = $this->accessor->getValue($row, $path);

                        if (! empty($entry)) {
                            $parameters[$actionKey][$key] = $entry;
                        } else {
                            $parameters[$actionKey][$key] = $value;
                        }
                    }
                }
            } elseif ($routeParameters instanceof Closure) {
                $parameters[$actionKey] = \call_user_func($routeParameters, $row);
            } else {
                $parameters[$actionKey] = [];
            }

            $actionAttributes = $action->getAttributes();
            if (\is_array($actionAttributes)) {
                $attributes[$actionKey] = $actionAttributes;
            } elseif ($actionAttributes instanceof Closure) {
                $attributes[$actionKey] = \call_user_func($actionAttributes, $row);
            } else {
                $attributes[$actionKey] = [];
            }

            if ($action->isButton()) {
                if (null !== $action->getButtonValue()) {
                    if (isset($row[$action->getButtonValue()])) {
                        $values[$actionKey] = $row[$action->getButtonValue()];
                    } else {
                        $values[$actionKey] = $action->getButtonValue();
                    }

                    if (\is_bool($values[$actionKey])) {
                        $values[$actionKey] = (int) $values[$actionKey];
                    }

                    if (true === $action->isButtonValuePrefix()) {
                        $values[$actionKey] = 'sg-datatables-'.$this->getDatatableName().'-action-button-'.$actionKey.'-'.$values[$actionKey];
                    }
                } else {
                    $values[$actionKey] = null;
                }
            }
        }

        $vars['dropdowns'] = $this->dropdowns;
        $vars['render_if_dropdowns'] = $row['sg_datatables_dropdowns'][$this->index];
        $vars['route_parameters_dropdowns'] = $parameters;
        $vars['attributes_dropdowns'] = $attributes;
        $vars['values_dropdowns'] = $values;
        
        return $vars;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getCellContentTemplate()
    {
        return '@SgDatatables/render/dropdown_action.html.twig';
    }

    //-------------------------------------------------
    // Options
    //-------------------------------------------------

    /**
     * @return $this
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefined('dropdowns');

        $resolver->setDefaults([
            'dropdowns' => null,
        ]);

        $resolver->setAllowedTypes('dropdowns', ['array', 'null']);

        return $this;
    }

    //-------------------------------------------------
    // Getters && Setters
    //-------------------------------------------------
    
    /**
     * @return Action[]
     */
    public function getDropdowns()
    {
        return $this->dropdowns;
    }

    /**
     * @throws Exception
     *
     * @return $this
     */
    public function setDropdowns(array $actions)
    {
        if (\count($actions) > 0) {
            foreach ($actions as $action) {
                $this->addDropdown($action);
            }
        } else {
            $this->dropdowns = NULL;
        }

        return $this;
    }

    /**
     * Add dropdown action.
     *
     * @return $this
     */
    public function addDropdown(array $action)
    {
        $newAction = new Action($this->datatableName);
        $this->dropdowns[] = $newAction->set($action);

        return $this;
    }

    /**
     * Remove action.
     *
     * @return $this
     */
    public function removeDropdown(Action $action)
    {

        if (!empty($this->dropdowns)) {
            foreach ($this->dropdowns as $k => $a) {
                if ($action === $a) {
                    unset($this->dropdowns[$k]);

                    break;
                }
            }
        }

        return $this;
    }
}
