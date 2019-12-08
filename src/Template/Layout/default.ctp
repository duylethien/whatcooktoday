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
                            <a href="/home">
                                <?php echo $this->Html->image("icons/logo.png", [
                                    "alt" => "Gusto Recipes"
                                ]);
                                ?>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-9 navigation">
                        <nav id="navigation" class="menu nav-collapse">
                            <ul>
                                <li><a href="/"><?= __('home') ?></a></li>
                                <li><a href="#"><?= __('categories') ?></a>
                                    <ul class="menu-categories">
                                    <?php if ($categories ): ?>
                                        <?php foreach ($categories as $cat): ?>
                                            <li>
                                                <a href="<?php echo ('/recipes?category=' . ($cat->permalink)) ?>" title="<?php echo $cat->title ?>">
                                                    <i class="<?php if(!empty($cat['icon']->icon)): echo $cat['icon']->icon; endif; ?>"></i>
                                                    <?php echo ($cat->title) ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    </ul>
                                </li>
                                <li><a href="/recipes"><?= __('recipes') ?></a></li>
                                <li><a href="/tip-tricks"><?= __('tip-and-tricks') ?></a></li>
<!--                                <li><a href="">--><?//= __('contact-us') ?><!--</a></li>-->
                                <li>
                                    <a class="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php switch (\Cake\I18n\I18n::getLocale()) {
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
                                            if (\Cake\I18n\I18n::getLocale() !== $supportedLang)
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
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <?= $this->Flash->render() ?>
            </div>
        </div>
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
    <div class="modal fade" id="loginModel" role="dialog">
        <div class="modal-dialog login-model">
            <div class="modal-content">
                <div class="modal-body">
                    <i class="fa fa-times-circle close" aria-hidden="true" data-dismiss="modal"></i>
                    <div class="clearfix"></div><br />
                    <div class="notification error closeable login_errors" style="display: none;"></div>
                    <div class="sdf">
                        <p class="login-icon">
                            <i class="fa fa-user-circle"></i>
                            <b><?= __('welcome') ?>,</b> <?= __('login-to-your-account') ?>.
                        </p>
                        <?php
                        echo $this->Flash->render('message');

                        $this->Form->setTemplates([
                            'inputContainer' => '<div class="form-group{{required}}"> {{content}} <span class="help">{{help}}</span></div>',
                            'input' => '<input type="{{type}}" name="{{name}}" class="form-control form-control-danger" {{attrs}}/>',
                            'inputContainerError' => '<div class="form-group has-danger {{type}}{{required}}">{{content}}{{error}}</div>',
                            'error' => '<div class="text-danger">{{content}}</div>'
                        ]);

                        echo $this->Form->create('', ['type' => 'POST', 'url' => [
                            'controller' => 'Users',
                            'action' => 'login'
                        ]]);
                        echo $this->Form->controls(
                            [
                                'email'     => ['required'  => TRUE, 'placeholder' => __('Email'), 'label' => ['text' => __('Email')]],
                                'password'  => ['required'  => TRUE, 'placeholder' => __('password'), 'label' => ['text' => __('password')]]
                            ],
                            [ 'legend' => false]
                        );

                        echo $this->Form->button('<i class="fa fa-user"></i>'. __('login'),['class' => 'button color big']);
                        echo $this->Form->end();
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <p class="popup_login"><?php echo __('Dont you have an account') ?>? <a href="/signup"><?php echo ('Register') ?></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="footer-about margin-bottom-40">
                        <?php echo $this->Html->image("icons/logo.png", [
                            "max-width" => "200",
                            "alt" => "Logo"
                        ]);
                        ?>
<!--                        <p>--><?php //echo ('description') ?><!--</p>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <p><?php echo ('2019 Gusto') ?>. Powered By <i class="fa fa-heart co-red"></i> <a href="https://www.facebook.com/duy.lethien.52">Duy Le Thien</a>.</p>
                </div>
                <div class="col-md-8">
<!--                    --><?php //$pages = $this->db->get('pages')->result(); ?>
<!--                    --><?php //if ($pages): ?>
<!--                        <ul class="pages-links list-inline">-->
<!--                            --><?php //foreach ($pages as $page): ?>
<!--                                <li><a href="--><?php //echo site_url('page/' . urlencode($page->permalink)) ?><!--">--><?php //echo $page->title ?><!--</a></li>-->
<!--                            --><?php //endforeach; ?>
<!--                        </ul>-->
<!--                    --><?php //endif ?>
                </div>
            </div>
        </div>
    </div>


    <script src="<?php echo STYLE_JS ?>/custom.js"></script>
    <!--<script>
        //NEWSLETTER FUNCTION
        $('#newsletter').submit(function(e) {
            var form = $(this);
            e.preventDefault();
            $(".loading-news").show();
            $.ajax({
                type: "POST",
                url: "<?php /*echo site_url('home/newsletters'); */?>",
                data: form.serialize(),
                dataType: "html",
                success: function(res) {
                    $('#newsletter-sucess').html(res);
                    $(".loading-news").hide();
                }
            });
        });
    </script>-->
</body>

</html>
