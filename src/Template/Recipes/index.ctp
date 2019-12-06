<section id="titlebar" class="browse-all">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2><?= __d('recipes', 'browse-recipes') ?></h2>
            </div>
        </div>
    </div>
</section>
<div class="search-container">
    <div class="container">
        <div id="advanced-search">
            <form class="row" action="<?php echo ('/recipes/all') ?>" method="get">
                <div class="col-md-4">
                    <div class="select">
                        <select name="category_id" class="chosen-select-no-single" style="display: none;">
                            <option value="">Choose All Categories</option>
                            <?php foreach ($categories as $item): ?>
                                <option value= "<?= $item->category_id ?>"><?= $item->title ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="search-by-keyword">
                        <button type="submit"><span><?php echo ('global_Search_for_Recipes') ?></span><i class="fa fa-search"></i></button>
                        <input class="search-field" type="text" name="title" value="<?php echo ('title') ?>" placeholder="<?php echo ('global_Search_by_keyword') ?>"/>
                    </div>
                </div>
            </form>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="container margin-top-35">
    <div class="row">
        <?php /* $this->form->control('search')*/?>
        <div class="clearfix"></div>
        <div class="col-md-12">
            <h3 class="headline"><?= __d('recipes', 'all-recipes') ?></h3>
            <span class="line margin-bottom-35"></span>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12 table-content">
            <div class="row">
                <?php if ($items): ?>
                    <?php foreach ($items as $item): ?>
                        <div class="col-md-3">
                            <div class="recipe-box">
                                <div class="thumbnail-holder">
                                    <a href="<?= 'post/'.$item->permalink ?>" >
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
                                        <a href="<?= 'post/'.$item->permalink ?>" title="<?php echo $item->title ?>">
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
                                    <h5 class="author-recipe">
                                        <a href="<?= '/profile/' . $item->user['user_id'] ?>" title="<?php echo $item->user['firstname'] ?>">
                                            <span>
                                                <?php if (!$item->user['image']): echo $this->Html->image("users/default.png", [
                                                    "alt" => "Avatar"
                                                ]); else: echo $this->Html->image('users/' . $item->user['image'], [
                                                    "alt" => "Avatar"
                                                ]); endif; ?>
                                            </span>
                                            <?php echo $item->user['firstname'] ?>
                                        </a>
                                    </h5>
                                    <div class="recipe-category">
                                        <a ><?php echo $item->category['title'] ?></a>
                                    </div>
                                    <div class="recipe-meta">
                                        <?php if (($item->difficulty) == 0): ?><i class="ico i-easy"></i> <?= __d('recipes', 'easy') ?><?php endif; ?>
                                        <?php if (($item->difficulty) == 1): ?><i class="ico i-medium"></i> <?= __d('recipes', 'medium') ?><?php endif; ?>
                                        <?php if (($item->difficulty) == 2): ?><i class="ico i-hard"></i> <?= __d('recipes', 'hard') ?><?php endif; ?>
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
</div>
<script>
    $('document').ready(function(){
        $('#search').keyup(function(){
            var searchkey = $(this).val();
            searchTags( searchkey );
        });
        function searchTags( keyword ){
            var data = keyword;
            $.ajax({
                method: 'get',
                url : "<?php echo $this->Url->build( [ 'controller' => 'Recipes', 'action' => 'search' ] ); ?>",
                data: {keyword:data},
                success: function( response )
                {
                    $( '.table-content' ).html(response);
                }
            });
        };
    });
</script>
