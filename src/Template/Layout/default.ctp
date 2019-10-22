<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Nấu gì hôm nay';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->css('style.css') ?>
    <!-- <?= $this->Html->css('bootstrap-rtl.min.css') ?> -->
    <!-- <?= $this->Html->css('font-awesome.css') ?> -->
    <!-- <?= $this->Html->css('icons.css') ?> -->
    <!-- <?= $this->Html->css('style-rtl.css') ?> -->
    <!-- <?= $this->Html->css('home.css') ?> -->

    <!-- <?= $this->Html->script('jquery-3.2.1.slim.min.js') ?>   -->
    <?= $this->Html->script('jquery.min.js') ?>
    <?= $this->Html->script('bootstrap.js') ?>
    <?= $this->Html->script('jquery.superfish.js') ?>
    <?= $this->Html->script('jquery.royalslider.min.js') ?>
    <?= $this->Html->script('responsive-nav.js') ?>
    <?= $this->Html->script('hoverIntent.js') ?>
    <?= $this->Html->script('chosen.jquery.min.js') ?>
    <?= $this->Html->script('jquery-ui.min.js') ?>

    <?= $this->Html->script('custom.js') ?>
    <?= $this->Html->script('jquery-printme.min.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <div class="wrapper">
        <header id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div id="logo">
                            <a href="http://gusto.localhost/"><img src="http://gusto.localhost//cdn/about/logo.png" alt="Gusto Recipes CMS" title="Gusto Recipes CMS"></a>
                        </div>
                    </div>
                    <div class="col-md-9 navigation">
                        <a href="#" class="nav-toggle" aria-hidden="true">Menu</a>
                        <nav id="navigation" class="menu nav-collapse sf-js-enabled sf-arrows nav-collapse nav-collapse-0 closed" style="transition: max-height 284ms ease 0s; position: relative;" aria-hidden="false">
                            <ul>
                                <li><a href="http://gusto.localhost/"> <?= __('home')?></a></li>
                                <li><a href="#" class="sf-with-ul"><?=__('categories')?></a>
                                    <ul class="menu-categories" style="display: none;">

                                        <li>
                                            <a href="http://gusto.localhost/category/beef" title="Beef">
                                                <i class="icon icon-themeenergy_beef2"></i>
                                                Beef </a>
                                        </li>

                                        <li>
                                            <a href="http://gusto.localhost/category/bread" title="Bread">
                                                <i class="icon icon-themeenergy_beef"></i>
                                                Bread </a>
                                        </li>

                                        <li>
                                            <a href="http://gusto.localhost/category/cakes" title="Cakes">
                                                <i class="icon icon-themeenergy_cake"></i>
                                                Cakes </a>
                                        </li>

                                        <li>
                                            <a href="http://gusto.localhost/category/ice-cream2" title="Category">
                                                <i class="icon icon-themeenergy_blender"></i>
                                                Category </a>
                                        </li>

                                    </ul>
                                </li>
                                <li><a href="http://gusto.localhost/recipes"><?= __('recipes')?></a></li>
                                <li><a href="http://gusto.localhost/tricks"><?= __('tip-and-tricks')?></a></li>
                                <li><a href="http://gusto.localhost/contact"><?= __('contact-us')?></a></li>
                                <li>
                                    <a href="javascript:popup_switch('login')" class="login">
                                        <i class="fa fa-user" aria-hidden="true"></i> 
                                        <?= __('login-and-register')?></a>
                                </li>
                                <li><?= $this->Html->image("/lang_en.svg", [
                                    "alt" => "English",
                                    'url' => ['controller' => 'App', 'action' => 'change-language', 'en']
                                    ]); ?></li>
                                <li><?= $this->Html->image("/lang_vi.svg", [
                                    "alt" => "Việt Nam",
                                    'url' => ['controller' => 'App', 'action' => 'change-language', 'vi']
                                    ]); ?></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
    </div>


    <!-- <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <li><a target="_blank" href="https://book.cakephp.org/3.0/">Documentation</a></li>
                <li><a target="_blank" href="https://api.cakephp.org/3.0/">API</a></li>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer> -->
</body>

</html>