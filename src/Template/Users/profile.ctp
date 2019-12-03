<section id="titlebar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2><?= __d('profile', 'dashboard') ?> - <?php echo $info['firstname'] ?> <?php echo $info['lastname'] ?></h2>
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
                        <li><?= __d('profile', 'dashboard') ?> - <?php echo $info['firstname'] ?> <?php echo $info['lastname'] ?></li>
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
                            <?php if (!$info['image']): echo $this->Html->image("users/default.png", [
                                "alt" => "Avatar"
                            ]); else: echo $this->Html->image('users/' . $info['image'], [
                                "alt" => "Avatar"
                            ]); endif; ?>
                        </figure>
                        <div class="usercontent">
                            <h3><?php echo $info['username'] ?></h3>
                            <h4><?php if ($info['usergroup_id'] == 1): echo 'Admin'; else: echo 'User'; endif ?></h4>
                        </div>
                    </div>
                    <nav class="navdashboard">
                        <ul>
                            <li>
                                <i class="fa fa-user"></i>
                                <span> <?php echo $info['firstname'] ?> <?php echo $info['lastname'] ?></span>
                            </li>
                            <li>
                                <i class="fa fa-transgender"></i>
                                <span> <?php if ($info['gender'] == 0): echo __d('profile', 'female'); else: echo __d('profile', 'male'); endif; ?></span>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i>
                                <span> <?php echo $info['email'] ?></span>
                            </li>
<!--                            <li>-->
<!--                                <i class="fa fa-flag"></i> --><?php //echo ('global_From') ?>
<!--                                <span> --><?php //echo $info['country_id'] ?><!--</span>-->
<!--                            </li>-->

                            <li>
                                <i class="icon icon-themeenergy_soup2"></i>
                                <span> <?php echo $info['sum_recipe'] ?> <?= __('recipes') ?></span>
                            </li>
                            <li>
<!--                                <i class="fa fa-calendar-check-o"></i> --><?php //echo ('global_Member_Since') ?>
                                <!--                                <span> --><?php //echo date('M d, Y', strtotime($user->created)) ?><!--</span>-->

                            </li>
                            <li>
                                <!--                                <i class="fa fa-eye"></i>-->
                                <!--                                <span> --><?php //echo $user->visited ?><!-- --><?php //echo lang('global_Profile_Views') ?><!--</span>-->
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <?php if ($info['description']): ?>
                <div class="post-quote">
                    <span class="icon"></span>
                    <blockquote>
                        <?php echo $info['description'] ?>
                    </blockquote>
                </div>
            <?php endif ?>
            <div class="inner-box">
                <div class="row">
                    <?php if ($items): ?>
                        <?php foreach ($items as $item): ?>
                            <div class="col-md-4">
                                <div class="recipe-box">
                                    <div class="thumbnail-holder">
                                        <a href="<?= '/recipes/post/'.$item->permalink ?>" >
                                            <?php echo $this->Html->image('recipes/'.$item->featured_image, [
                                                "alt" => $item->title
                                            ]);
                                            ?>
                                            <div class="hover-cover"></div>
                                            <div class="hover-icon"><i class="fa fa-eye"></i> <?= __d('recipes', 'view-recipe') ?></div>
                                        </a>
                                    </div>
                                    <div class="recipe-box-content">
                                        <h3>
                                            <a href="<?= '/recipes/post/'.$item->permalink ?>" title="<?php echo $item->title ?>">
                                                <?php echo $this->Text->truncate(
                                                    $item->title,
                                                    30,
                                                    [
                                                        'ellipsis' => '...',
                                                        'extract' => false
                                                    ]);
                                                ?>
                                            </a>
                                        </h3>
                                        <div class="recipe-category">
                                            <a ><?php echo $item->category['title'] ?></a>
                                        </div>
                                        <div class="recipe-meta">
                                            <?php if (($item->difficulty) == 'easy'): ?><i class="ico i-easy"></i> <?= __d('recipes', 'easy') ?><?php endif; ?>
                                            <?php if (($item->difficulty) == 'medium'): ?><i class="ico i-medium"></i> <?= __d('recipes', 'medium') ?><?php endif; ?>
                                            <?php if (($item->difficulty) == 'hard'): ?><i class="ico i-hard"></i> <?= __d('recipes', 'hard') ?><?php endif; ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-md-12">
                            <div class="notification notice">
                                <p><?php echo lang('global_There_is_no_recipes') ?></p>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$paginator = $this->Paginator->setTemplates([
    'number' => '<li class="page-item"><a href="{{url}}" class="page-link">{{text}}</a></li>',
    'current' => '<li class="page-item active"><a href="{{url}}" class="page-link">{{text}}</a></li>',
    'first' => '<li class="page-item"><a href="{{url}}" class="page-link">&laquo;</a></li>',
    'last' => '<li class="page-item"><a href="{{url}}" class="page-link">&raquo;</a></li>',
    'prevActive' => '<li class="page-item"><a href="{{url}}" class="page-link">&lt;</a></li>',
    'nextActive' => '<li class="page-item"><a href="{{url}}" class="page-link">&gt;</a></li>',
]);
?>
<?php if ($items): ?>
    <nav>
        <ul class="pagination">
            <?php
            echo $paginator->first();
            if($paginator->hasPrev()){
                echo $paginator->prev();
            }
            echo $paginator->numbers();
            if($paginator->hasNext()){
                echo $paginator->next();
            }
            echo $paginator->last();
            ?>
        </ul>
    </nav>
<?php endif; ?>


