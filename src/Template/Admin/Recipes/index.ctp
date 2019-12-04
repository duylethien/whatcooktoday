<div class="page-title">
    <div class="breadcrumb-env" style="float: left">
        <ul class="user-info-menu left-links list-inline list-unstyled">
            <li class="hidden-sm hidden-xs">
                <a href="#" data-toggle="sidebar">
                    <i class="fa-bars"></i>
                </a>
            </li>
        </ul>
        <ol class="breadcrumb bc-1" >
            <li>
                <a href="<?php echo ('/admin/dashboard') ?>"><i class="fa-home"></i> <?php echo ('Home') ?></a>
            </li>
            <li class="active">
                <strong><?php echo ('Recipes') ?></strong>
            </li>
        </ol>
    </div>
</div>
<!-- Admin Table-->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo ('Recipes') ?></h3>
        <div class="panel-options">
            <a href="<?php echo ('/admin/recipes/add'); ?>" class="btn btn-secondary btn-sm" style="color:#fff"><i class="fa fa-plus-square" aria-hidden="true"></i> <?php echo ('Add New Record') ?></a>
        </div>
    </div>
    <div class="panel-body">
        <?php echo $this->Flash->render(); ?>
        <div class="table-responsive" data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="true" data-add-display-all-btn="true" data-add-focus-btn="true">
            <table cellspacing="0" class="table table-small-font table-bordered table-striped" >
                <thead>
                <tr>
                    <th><?php echo ('Category') ?></th>
                    <th><?php echo ('Title') ?></th>
                    <th><?php echo ('Published By') ?></th>
                    <th><?php echo ('Status') ?></th>
                    <th><?php echo ('Operations') ?></th>
                </tr>
                </thead>
                <tbody class="middle-align">
                <?php foreach ($items as $item): ?>
                    <tr id="<?php echo $item->recipe_id ?>">
                        <td><?php echo $item['category']->title ?></td>
                        <td><?php echo $item->title ?></td>
                        <td><?php echo $item['user']->email ?></td>
                        <?php if ($item->status == (\App\Model\Enum\EStatus::ACTIVE)): ?>
                            <td><button class="btn btn-success btn-sm"> <?php echo ('Active') ?></button></td>
                        <?php else: ?>
                            <td><button class="btn btn-dart btn-sm"> <?php echo ('Inactive') ?></button></td>
                        <?php endif ?>
                        <td>
                            <a href="<?php echo ('/admin/recipes/edit/' . $item->recipe_id); ?>" class="btn btn-orange btn-sm">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                <?php echo ('Edit') ?>
                            </a>
                            <?php echo $this->Form->postLink('<i class="fa fa-trash"></i> Delete', '/admin/recipes/delete/' . $item->recipe_id,['confirm' => 'Are you sure?', 'class' => 'btn btn-danger', 'escape' => false]); ?>
<!--                            <a class="btn btn-danger btn-sm remove">-->
<!--                                <i class="fa fa-trash" aria-hidden="true"></i>-->
<!--                                --><?php //echo ('Delete') ?>
<!--                            </a>-->
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
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
    </div>
</div>

