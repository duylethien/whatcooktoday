<section id="titlebar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2><?= __d('profile', 'dashboard') ?> - <?php echo $user['firstname'] ?> <?php echo $user['lastname'] ?></h2>
            </div>
            <div class="col-md-6">
                <nav id="breadcrumbs">
                    <ul>
                        <li>
                            <?php echo $this->Html->link(
                                'Dashboard',
                                ['controller' => 'Users', 'action' => 'dashboard', '_full' => true]
                            );
                            ?>
                        </li>
<!--                        <li><a href="--><?php //echo site_url() ?><!--">--><?php //echo lang('global_home') ?><!--</a></li>-->
                        <li><?= __d('profile', 'dashboard') ?> - <?php echo $user['firstname'] ?> <?php echo $user['lastname'] ?></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="widget">
                <div class="sidebar-box">
                    <div class="user">
                        <figure>
                            <?php if (!$user['image']): echo $this->Html->image("users/default.png", [
                                "alt" => "Avatar"
                            ]);?>
                            <?php else: echo $this->Html->image('users/' . $user['image'], [
                                "alt" => "Avatar"
                            ]);?>
                            <?php endif ?>
                        </figure>
                        <div class="usercontent">
                            <h3><?php echo $user['username'] ?></h3>
                            <h4><?php if ($user['usergroup_id'] == 1): echo 'Admin'; else: echo 'User'; endif ?></h4>
                        </div>
                    </div>
                    <nav class="navdashboard">
                        <ul>
                            <li>
                                <a href="<?php echo ('dashboard') ?>">
                                    <i class="fa fa-dashboard"></i>
                                    <span><?= __d('profile', 'dashboard') ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= '/profile/' . $user['user_id'] ?>">
                                    <i class="fa fa-user"></i>
                                    <span><?= __d('profile', 'my profile') ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo ('/my-recipes') ?>">
                                    <i class="icon icon-themeenergy_soup2"></i>
                                    <span><?= __d('profile', 'my recipes') ?></span>
                                </a>
                            </li>
                            <?php if ($user['usergroup_id'] == 1): ?>
                            <li>
                                <a href="<?php echo ('/admin/') ?>">
                                    <i class="fa fa-user-secret"></i>
                                    <span><?= __d('profile', 'Trang Admin') ?></span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li>
                                <a href="<?php echo ('logout') ?>">
                                    <i class="fa fa-sign-out"></i>
                                    <span><?= __d('profile', 'logout') ?></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="col-md-12">
                <h4 class="headline"><?= __d('profile','public profile') ?></h4>
                <span class="line margin-bottom-30"></span>
                <div class="row margin-top-50">
                    <?php
                    echo $this->Flash->render();

                    $this->Form->setTemplates([
                        'inputContainer' => '<div class="form-group{{required}} col-md-6"> {{content}} <span class="help">{{help}}</span></div>',
                        'input' => '<input type="{{type}}" name="{{name}}" class="form-control form-control-danger" {{attrs}}/>',
                        'inputContainerError' => '<div class="form-group has-danger col-md-6 {{type}}{{required}}">{{content}}{{error}}</div>',
                        'error' => '<div class="text-danger">{{content}}</div>',
                        'legend' => null,
                    ]);

                    echo $this->Form->create($user_data, ['enctype' => 'multipart/form-data']);
                    echo $this->Form->controls(
                        [
                            'firstname'    => ['value' => $user['firstname'], 'required'  => false, 'placeholder' => 'Enter first name', 'label' => ['text' => __d('profile', 'firstname')]],
                            'lastname'     => ['value' => $user['lastname'], 'required'  => false, 'placeholder' => 'Enter last name', 'label' => ['text' => __d('profile', 'lastname')]],
                            'username'     => ['value' => $user['username'], 'required'  => false, 'placeholder' => 'Enter username', 'label' => ['text' => __d('profile', 'username')]],
                            'email'        => ['value' => $user['email'],           'required'  => false, 'placeholder' => 'Enter email', 'label' => ['text' => __d('profile', 'email')]],
                            'country'      => ['value' => $user['username'], 'required'  => false, 'placeholder' => 'Enter username', 'label' => ['text' => __d('profile', 'country')]],
                            'password'     => ['value' => $user['username'], 'required'  => false, 'placeholder' => 'Enter username', 'label' => ['text' => __d('profile', 'password')]],
                            'description'  => ['value' => $user['description'], 'type' => 'textarea', 'required'  => false, 'placeholder' => 'Enter description', 'label' => ['text' => __d('profile', 'description')]],
                            'gender'  => ['type' => 'radio', 'options' => [__d('profile', 'female'), __d('profile', 'male')], 'value' => $user['gender'], 'label' => ['text' => __d('profile', 'gender')] ],
                            'file' => ['type' => 'file', 'class' => 'form-control', 'label' => ['text' => __d('profile', 'Ảnh đại diện')]]
                        ]
                    );
                    if (!$user['image']) {
                        echo $this->Html->image("users/default.png", ["alt" => "Avatar"]);
                    } else {
                        echo $this->Html->image('users/' . $user['image'], ["alt" => "Avatar"]);
                    }
//                    echo $this->Form->radio('gender', ['Masculine', 'Feminine', 'Neuter'], ['value' => 0]);

                    echo $this->Form->button('<i class="fa fa-user"></i>'. __d('profile', 'update profile'),['class' => 'button color add_ingredient', 'style' => 'margin-left: 15px;']);
                    echo $this->Form->end();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
