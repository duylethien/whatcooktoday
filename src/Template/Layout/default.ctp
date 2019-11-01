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

    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('font-awesome.css') ?>

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
        <!-- Header
        ==================================================================== -->
        <header id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div id="logo">
                            <a href="http://gusto.localhost/"><img src="http://gusto.localhost//cdn/about/logo.png" alt="Gusto Recipes CMS" title="Gusto Recipes CMS"></a>
                        </div>
                    </div>
                    <div class="col-md-9 navigation">
                        <nav id="navigation" class="menu nav-collapse">
                            <ul>
                                <li><a href=""><?= __('home') ?></a></li>
                                <li><a href="#"><?= __('categories') ?></a>
                                    <ul class="menu-categories">
                                        <li>
                                            <a href="" title="<?= __('categories') ?>">
                                                <i class="<?= __('categories') ?>"></i>
                                                <?= __('categories') ?>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href=""><?= __('recipes') ?></a></li>
                                <li><a href=""><?= __('tip-and-tricks') ?></a></li>
                                <li><a href=""><?= __('contact-us') ?></a></li>
                                <li>
                                    <a class="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php switch ($lang) {
                                            case (\App\Model\Enum\ELanguage::EN):
                                                echo $this->Html->image("lang_en.svg", [
                                                    "height" => "20",
                                                    "width" => "30",
                                                    "alt" => "English"
                                                ]);
                                                break;
                                            case (\App\Model\Enum\ELanguage::VI):
                                                echo $this->Html->image("lang_vi.svg", [
                                                    "height" => "20",
                                                    "width" => "30",
                                                    "alt" => "Việt Nam"
                                                ]);
                                                break;
                                            default:
                                                echo $this->Html->image("lang_vi.svg", [
                                                    "height" => "20",
                                                    "width" => "30",
                                                    "alt" => "Việt Nam"
                                                ]);
                                            }
                                        ?>
                                    </a>
                                    <div class="dropdown-menu">
                                        <?php foreach (\App\Model\Enum\ELanguage::getSupportedLanguage() as $supportedLang) 
                                            if ($lang !== $supportedLang) 
                                                echo $this->Link->changeLangByFlag($supportedLang);
                                        ?>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:popup_switch('login')" class="login">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <?= __('login') ?>
                                    </a>
                                </li>
                                <!-- <li>
                                    <?= $this->Link->makeEdit('Change this Recipe', '/recipes/edit/5') ?>
                                </li> -->
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <?php ?>
    <div class="modal fade" id="loginModel" role="dialog">
        <div class="modal-dialog login-model">
            <div class="modal-content">
                <div class="modal-body">
                    <i class="fa fa-times-circle close" aria-hidden="true" data-dismiss="modal"></i>
                    <div class="clearfix"></div><br />
                    <div class="notification error closeable login_errors" style="display: none;"></div>
                    <form class="popup_login" method="post">
                        <p class="login-icon">
                            <i class="fa fa-user-circle"></i>
                            <b><?= __('welcome') ?>,</b> <?= __('login-to-your-account') ?>.
                        </p>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="email" placeholder="<?= __('Email') ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="password" name="password" placeholder="<?= __('password') ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                <label class="check-text" for="user-session-remember-me">
                                    <input name="remember" type="checkbox" tabindex="4" value="1" checked="checked" />
                                    <span class="chk-img"></span>
                                    <a id="remember-button"><?= __('remember_me') ?></a>
                                </label>
                            </div>
                            <div class="col-sm-6 text-right">
                                <a href="javascript:popup_switch('forgot')" class="forget-pass"><?= __('forget_password') ?></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="button color big"><?= __('login') ?>
                                    <i class="fa fa-spin fa-spinner login_loading" style="display: none;"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
    <script src="<?php echo STYLE_JS ?>/custom.js"></script>
    <script>
        //NEWSLETTER FUNCTION
        $('#newsletter').submit(function(e) {
            var form = $(this);
            e.preventDefault();
            $(".loading-news").show();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('home/newsletters'); ?>",
                data: form.serialize(),
                dataType: "html",
                success: function(res) {
                    $('#newsletter-sucess').html(res);
                    $(".loading-news").hide();
                }
            });
        });
    </script>
</body>

</html>