<?php

namespace Store\Dashboard\Builder\Abstracts;

use Store\Dashboard\Builder\Form\Tabs;

abstract class AppendTabs
{
    public $tabs = [];

    /**
     * Get the value of tabs
     */
    public function getTabs()
    {
        return $this->tabs;
    }

    /**
     * Set the value of tabs
     *
     */
    public function setTabs($callback)
    {
        $tabs = new Tabs;

        $callback($tabs);

        $this->tabs = array_merge($this->tabs, $tabs->getTabs());
    }
}
