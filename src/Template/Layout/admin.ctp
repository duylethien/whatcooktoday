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
    <!-- <?= $this->Html->meta('icon') ?> -->

    <?= $this->Html->css('admin/bootstrap.css') ?>
    <?= $this->Html->css('admin/components.css') ?>
    <?= $this->Html->css('admin/core.css') ?>
    <?= $this->Html->css('admin/custom.css') ?>
    <?= $this->Html->css('font-awesome.css') ?>
    <?= $this->Html->css('admin/forms.css') ?>
    <?= $this->Html->css('admin/icons.css') ?>
    <?= $this->Html->css('admin/skins.css') ?>
    <?= $this->Html->css('admin/style.css') ?>


    <?= $this->Html->script('admin/jquery-1.11.1.min.js') ?>
    <?= $this->Html->script('admin/jquery-ui.min.js') ?>

    <?= $this->Html->script('admin/bootstrap.min.js') ?>
    <?= $this->Html->script('admin/TweenMax.min.js') ?>
    <?= $this->Html->script('admin/resizeable.js') ?>
    <?= $this->Html->script('admin/joinable.js') ?>
    <?= $this->Html->script('admin/select2/select2.min.js') ?>
    <?= $this->Html->script('admin/toggles.js') ?>
    <?= $this->Html->script('admin/widgets.js') ?>
    <?= $this->Html->script('admin/custom.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body class="page-body">
    <div class="settings-pane">
        <a href="#" data-toggle="settings-pane" data-animate="true">
            &times;
        </a>
        <div class="settings-pane-inner">
            <div class="row">
                <div class="col-md-4">
                    <div class="user-info">
                        <div class="user-details">
                            <h3>
                                <span class="user-status is-online"></span>
                                <a href="#"><?php echo $this->request->getSession()->read('Auth.User.lastname') ?> <?php echo $this->request->getSession()->read('Auth.User.firstname') ?></a>
                            </h3>
                            <p class="user-title"><?php echo ('Administrator') ?></p>
                            <div class="user-links">
                                <a href="/dashboard" class="btn btn-primary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?php echo ('Edit Profile') ?></a>
                                <a href="/logout" class="btn btn-success"> <i class="fa fa-sign-out" aria-hidden="true"></i> <?php echo ('Logout') ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-container">
        <div class="sidebar-menu toggle-others fixed">
            <div class="sidebar-menu-inner">
                <header class="logo-env">
                    <!-- logo -->
                    <div class="logo">
                        <?php echo $this->Html->image("icons/logo.png", [
                            "width" => "100",
                            "alt" => "English"
                        ]);
                        ?>
                    </div>
                    <div class="mobile-menu-toggle visible-xs">
                        <a href="#" data-toggle="mobile-menu">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="settings-icon">
                        <a href="#" data-toggle="settings-pane" data-animate="true">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                        </a>
                    </div>
                </header>
                <ul id="main-menu" class="main-menu">
                    <li>
                        <a href="<?php echo ('admin/dashboard') ?>">
                            <i class="fa-home"></i>
                            <span class="title"><?php echo ('Dashboard') ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo ('admin/settings') ?>">
                            <i class="fa fa-cogs"></i>
                            <span class="title"><?php echo ('Settings') ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo ('/admin/recipes') ?>">
                            <i class="fa fa-cutlery"></i>
                            <span class="title"><?php echo ('Recipes') ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <?= $this->fetch('content') ?>
            <footer class="main-footer sticky footer-type-1">
                <div class="footer-inner">
                    <div class="footer-text">
                        <strong><a href="https://elmanawy.info/">Powered By Marwa El-Manawy</a></strong>.
                    </div>
                    <div class="go-up">
                        <a href="#" rel="go-top">
                            <i class="fa-angle-up"></i>
                        </a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>
