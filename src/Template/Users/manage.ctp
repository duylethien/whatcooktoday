<section id="titlebar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2><?= __d('profile', 'my recipes') ?></h2>
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
                        <li><?= __d('profile', 'my recipes') ?></li>
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
            <div class="inner-box">
                <div class="dashboard-box">
                    <h2 class="dashbord-title"><?= __d('profile','my recipes') ?></h2>
                    <a href="<?php echo ('/recipes/add') ?>" class="button color add_ingredient"><i class="fa fa-plus"></i> <?= __d('profile','add recipe') ?></a>
                </div>
                <div class="dashboard-wrapper">
                    <table class="table table-responsive dashboardtable tablemyads">
                        <?php if ($items): ?>
                            <thead>
                            <tr>
                                <th><?= __d('profile','photo') ?></th>
                                <th><?= __d('profile','title') ?></th>
                                <th><?= __d('profile','category') ?></th>
                                <th><?= __d('profile','status') ?></th>
                                <th><?= __d('profile','action') ?></th>
                            </tr>
                            </thead>
                        <?php endif; ?>
                        <tbody>
                        <?php foreach ($items as $recipe): ?>
                            <tr data-category="active">
                                <td class="photo">
                                    <?php echo $this->Html->image('recipes/'. $recipe['featured_image'], [
                                        "alt" => $recipe->title,
                                        "class" => "img-responsive"
                                    ]);
                                    ?>
                                </td>
                                <td data-title="Title">
                                    <h3>
                                        <?php echo $this->Text->truncate(
                                            $recipe['title'],
                                            30,
                                            [
                                                'ellipsis' => '...',
                                                'extract' => false
                                            ]);
                                        ?>
                                    </h3>
                                </td>
                                <td data-title="Category"><span class="adcategories"><?php echo $recipe['category']->title ?></span></td>
                                <td data-title="Ad Status">
                                    <?php if (($recipe['status']) == 1): ?>
                                        <span class="adstatus adstatusactive"><?php echo ('Active') ?></span>
                                    <?php elseif (($recipe['status']) == 0): ?>
                                        <span class="adstatus adstatusexpired"><?php echo ('Inactive') ?></span>
                                    <?php endif; ?>
                                </td>
                                <td data-title="Action">
                                    <div class="btns-actions">
                                        <a class="btn-action btn-view" href="<?php echo ('recipes/post/' . ($recipe->permalink)) ?>"><i class="fa fa-eye"></i></a>
                                        <a class="btn-action btn-edit" href="<?php echo ('recipes/edit/' . $recipe->recipe_id) ?>"><i class="fa fa-pencil"></i></a>
<!--                                        <a class="btn-action btn-delete" href="--><?php //echo ('recipes/delete/' . $recipe->recipe_id) ?><!--"><i class="fa fa-trash"></i></a>-->
                                        <?php echo $this->Form->postLink('<i class="fa fa-recycle"></i> Delete', '/recipes/delete/56',['confirm' => 'Are you sure?', 'class' => 'btn btn-danger', 'escape' => false]); ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
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
