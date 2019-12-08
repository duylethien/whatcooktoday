
<!-- Recipe Background -->
<div class="recipeBackground">
    <?= $this->Html->image('recipeBackground.jpg') ?>
</div>
<!-- Content
================================================== -->
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="alignment">
                <!-- Header -->
                <section class="recipe-header">
                    <div class="title-alignment">
                        <h2><?php echo $recipe->title ?></h2>
                        <div class="recipe-cat">
                            <a href="<?php echo ('/recipes/?category=' . $recipe['category']->permalink) ?>"> <i class="fa fa-filter"></i> <?php echo $recipe['category']->title ?></a>
                            <span> <i class="fa fa-eye"></i> <?php echo $recipe->visited ?></span>
<!--                            <span><i class="fa fa-clock-o"></i> --><?php //echo ('Ngày cập nhật') ?><!--: --><?php //echo date('M d, Y ', strtotime($recipe->updated)) ?><!--</span>-->
<!--                            <span><i class="fa fa-calendar"></i> --><?php //echo ('Ngày tạo') ?><!--: --><?php //echo strtotime($recipe['updated']) ?><!--</span>-->
                        </div>
                    </div>
                </section>
                <!-- Slider -->
                <div class="recipeSlider rsDefault">
                    <?php if (json_decode($recipe->gallery)): ?>
                        <?php foreach (json_decode($recipe->gallery) as $img): ?>
                            <?php echo $this->Html->image('recipes/'.$img, [
                                "alt" => $recipe->title,
                                "class" => "rsImg",
                                "itemprop" => "image"
                            ]);
                            ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php echo $this->Html->image('recipes/'.$recipe->featured_image, [
                            "alt" => $recipe->title
                        ]);
                        ?>
                    <?php endif; ?>
                </div>
                <!-- Details -->
                <section class="recipe-details" itemprop="nutrition">
                    <ul>
                        <li><?= __d('recipes', 'Phục vụ') ?>: <strong itemprop="recipeYield"><?php if ($recipe->serves): ?><?php echo $recipe->serves ?> <?= __d('recipes', 'Người') ?><?php else: ?> - <?php endif; ?></strong></li>
                        <li><?= __d('recipes', 'Thời gian chuẩn bị') ?>: <strong itemprop="prepTime"><?php if ($recipe->prepare_time): ?><?php echo $recipe->prepare_time ?><?php else: ?> - <?php endif; ?></strong></li>
                        <li><?= __d('recipes', 'Thời gian nấu') ?>: <strong itemprop="cookTime"><?php if ($recipe->cooking_time): ?><?php echo $recipe->cooking_time ?><?php else: ?> - <?php endif; ?></strong></li>
                        <li><?= __d('recipes', 'calories') ?>: <strong itemprop="calories"><?php if ($recipe->calories): ?><?php echo $recipe->calories ?><?php else: ?> - <?php endif; ?></strong></li>
                        <li><?= __d('recipes', 'Mức độ') ?>: <strong itemprop="Difficulty">
                                <?php if (($recipe->difficulty) == 0): ?><?= __d('recipes', 'Dễ') ?><?php endif; ?>
                                <?php if (($recipe->difficulty) == 1): ?><?= __d('recipes', 'Trung bình') ?><?php endif; ?>
                                <?php if (($recipe->difficulty) == 2): ?><?= __d('recipes', 'Khó') ?><?php endif; ?>
                            </strong>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </section>
                <!-- Text -->
                <p itemprop="description"><?php echo nl2br($recipe->description) ?></p>
                <?php if ($recipe->video): ?>
                    <div class="recipe-video">
                        <iframe width="100%" height="100%" src="<?php echo str_replace('watch?v=', 'embed/', $recipe->video); ?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                <?php endif ?>
                <!-- Ingredients -->
                <h3><?= __d('recipes', 'Thành phần') ?></h3>
                <ul class="ingredients" id="ingredients-list">
                    <?php foreach (explode("\n", $recipe->ingredients) as $i): ?>
                        <li>
                            <input type="checkbox" name="check">
                            <label itemprop="ingredients"><?php echo $i ?></label>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <!-- Directions -->
                <h3><?= __d('recipes','Hướng dẫn') ?></h3>
                <ol class="directions" itemprop="recipeInstructions">
                    <?php foreach (explode("\n", $recipe->directions) as $i): ?>
                        <li ><?php echo $i ?></li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
        <div class="col-md-3">
            <!-- Search Form -->
<!--            <div class="widget search-form">-->
<!--                <nav class="search">-->
<!--                    <form action="--><?php //echo site_url('recipes/search') ?><!--" method="get">-->
<!--                        <button><i class="fa fa-search"></i></button>-->
<!--                        <input class="search-field" type="text" placeholder="--><?php //echo lang('global_Search_for_Recipes') ?><!--" name="title" value="--><?php //echo set_value('title') ?><!--"/>-->
<!--                    </form>-->
<!--                </nav>-->
<!--                <div class="clearfix"></div>-->
<!--            </div>-->
            <div class="widget">
                <div class="author-box">
                    <a href="<?php echo ('/profile/' . $recipe['user']->user_id) ?>">
                        <span class="title"><?php echo ('Tác giả') ?></span>
                        <span class="name"><?php echo $recipe['user']->username ?></span>
                        <?php if ($recipe['user']->email_appear == '1'): ?>
                            <span class="contact"><?php echo $recipe['user']->email ?></span>
                        <?php endif ?>
                        <?php if (!$recipe->user['image']): echo $this->Html->image("users/default.png", [
                            "alt" => "Avatar"
                        ]); else: echo $this->Html->image('users/' . $recipe->user['image'], [
                            "alt" => "Avatar"
                        ]); endif; ?>
                    </a>
                    <p><?php echo $recipe['user']->description ?></p>
                </div>
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
        </div>
    </div>
</div>
