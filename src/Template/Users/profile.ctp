<section id="titlebar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2><?= __('profile', 'profile') ?> - <?php echo $user['firstname'] ?> <?php echo $user['lastname'] ?></h2>
            </div>
            <div class="col-md-6">
                <nav id="breadcrumbs">
<!--                    <ul>-->
<!--                        <li><a href="--><?php //echo site_url() ?><!--">--><?php //echo lang('global_home') ?><!--</a></li>-->
<!--                        <li>--><?php //echo lang('global_Profile') ?><!-- - --><?php //echo $user->firstname ?><!-- --><?php //echo $user->lastname ?><!--</li>-->
<!--                    </ul>-->
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
                            <h4><?php echo $user['usergroup_id'] ?></h4>
                        </div>
                    </div>
                    <nav class="navdashboard">
                        <ul>
                            <li>
                                <i class="fa fa-user"></i>
                                <span> <?php echo $user['firstname'] ?> <?php echo $user['lastname'] ?></span>
                            </li>
                            <li>
                                <i class="fa fa-transgender"></i>
                                <span> <?php echo $user['gender'] ?></span>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i>
                                <span> <?php echo $user['email'] ?></span>
                            </li>
                            <li>
                                <i class="fa fa-flag"></i> <?php echo ('global_From') ?>
                                <span> <?php echo $user['country_id'] ?></span>
                            </li>

                            <li>
                                <i class="icon icon-themeenergy_soup2"></i>
<!--                                <span> --><?php //echo $count ?><!-- --><?php //echo lang('global_Recipes') ?><!--</span>-->
                            </li>
                            <li>
                                <i class="fa fa-calendar-check-o"></i> <?php echo ('global_Member_Since') ?>
<!--                                <span> --><?php //echo date('M d, Y', strtotime($user->created)) ?><!--</span>-->

                            </li>
                            <li>
                                <i class="fa fa-eye"></i>
<!--                                <span> --><?php //echo $user->visited ?><!-- --><?php //echo lang('global_Profile_Views') ?><!--</span>-->
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <?php if ($user['description']): ?>
                <div class="post-quote">
                    <span class="icon"></span>
                    <blockquote>
                        <?php echo $user['description'] ?>
                    </blockquote>
                </div>
            <?php endif ?>
    </div>
</div>
<?php echo $user['email'] ?>
