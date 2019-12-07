<div class="search-container search-home">
    <div class="container">
        <div id="advanced-search">
            <form class="row" action="<?php echo ('/recipes') ?>" method="get">
                <div class="col-md-12 margin-bottom-20">
                    <h2><?= __d('recipes', 'browse-recipes') ?></h2>
                </div>
                <div class="col-md-4">
                    <div class="select">
                        <select name="category" class="chosen-select-no-single" style="display: none;">
                            <option value="">Choose All Categories</option>
                            <?php foreach ($categories as $item): ?>
                                <option value= "<?= $item->permalink ?>" <?php if(isset($filters['category']) && ($filters['category'] == $item->permalink) ): echo 'selected'; endif;?>><?= $item->title ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="search-by-keyword">
                        <button type="submit"><span><?php echo __d('lang','search_for_recipe') ?></span><i class="fa fa-search"></i></button>
                        <input class="search-field" type="text" name="title" value="<?php if(isset($filters['title'])): echo $filters['title']; endif;?>" placeholder="<?php echo __d('lang','search_by_keyword') ?>"/>
                    </div>
                </div>
            </form>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="container margin-top-35">
    <div class="row">
        <div class="col-md-9">
            <h3 class="headline">
                <?=('Những công thức gần đây')?>
            </h3>
            <span class="line margin-bottom-35"></span>
            <div class="clearfix"></div>
            <div class="row">
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
            </div>
        </div>
        <!-- Sidebar
     ================================================== -->
        <div class="col-md-3">
            <!-- Tips and Tricks -->
            <div class="widget">
                <h4 class="headline"><?php echo ('Tips & Tricks') ?></h4>
                <span class="line margin-bottom-20"></span>
                <div class="clearfix"></div>
                <ul class="categories">
                </ul>
                <div class="clearfix"></div>
            </div>
            <!-- Popular Recipes -->
            <div class="widget">
                <h4 class="headline"><?php echo ('Các công thức nổi bật') ?></h4>
                <span class="line margin-bottom-30"></span>
                <div class="clearfix"></div>
                <?php foreach ($popular_recipes as $item): ?>
                    <div class="featured-recipe">
                        <?php echo $this->Html->image('recipes/'.$item->featured_image, [
                            "alt" => $item->title
                        ]);
                        ?>
                        <div class="featured-recipe-content">
                            <h4><a href="<?= '/recipes/post/'.$item->permalink ?>"><?php echo $item->title ?></a></h4>
                            <div class="recipe-det">
                                <span> <a href="<?php echo ('category/' . ($item->category_permalink)) ?>"> <i class="fa fa-filter"></i> <?php echo $item->category_title ?></a> </span>
                            </div>
                        </div>
                        <div class="post-icon"></div>
                    </div>
                <?php endforeach; ?>
                <div class="clearfix"></div>
            </div>
            <div class="widget members">
                <h4 class="headline"><?php echo ('Những đầu bếp nổi bật') ?></h4>
                <span class="line margin-bottom-30"></span>
                <div class="clearfix"></div>
                <ul class="boxed">
                    <?php foreach ($users as $item): ?>
                        <li>
                            <a href="<?= '/profile/' . $item['user_id'] ?>" title="<?php echo $item['firstname'] ?>">
                                <?php if (!$item['image']): echo $this->Html->image("users/default.png", [
                                    "alt" => "Avatar"
                                ]); else: echo $this->Html->image('users/' . $item['image'], [
                                    "alt" => "Avatar"
                                ]); endif; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="post-icon"></div>
            </div>
        </div>
    </div>
</div>
<script>
</script>
