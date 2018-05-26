<?php

namespace Monology\Views
{
    use Stage\System;
    use Stage\Pattern\Wire;
    use Stage\Controls;

    class ErrorPage extends Wire\LayoutAwarePage
    {
        public function __construct()
        {
            $this->initializeComponent(__FILE__);
        }

        protected function onRenderHeader()
        {
            $this->loadTemplate('./Monology/Templates/HeaderTemplate.php');
        }

        protected function onRenderFooter()
        {
            $this->loadTemplate('./Monology/Templates/FooterTemplate.php');
        }
    }
}

?>