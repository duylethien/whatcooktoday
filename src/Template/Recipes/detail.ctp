
<?php foreach ($item as $recipe): ?>
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
                            <a > <i class="fa fa-filter"></i> <?php echo $recipe->category_title ?></a>
<!--                            <span> <i class="fa fa-eye"></i> --><?php //echo $item->visited ?><!--</span>-->
<!--                            <span><i class="fa fa-clock-o"></i> --><?php //echo lang('global_Last_Update') ?><!--: --><?php //echo date('M d, Y ', strtotime($item->updated)) ?><!--</span>-->
<!--                            <span><i class="fa fa-calendar"></i> --><?php //echo lang('global_created') ?><!--: --><?php //echo date('M d, Y ', strtotime($item->created)) ?><!--</span>-->
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
                        <li><?= __d('recipes', 'serves') ?>: <strong itemprop="recipeYield"><?php if ($recipe->serves): ?><?php echo $recipe->serves ?> <?= __d('recipes', 'people') ?><?php else: ?> - <?php endif; ?></strong></li>
                        <li><?= __d('recipes', 'prep-time') ?>: <strong itemprop="prepTime"><?php if ($recipe->prepare_time): ?><?php echo $recipe->prepare_time ?><?php else: ?> - <?php endif; ?></strong></li>
                        <li><?= __d('recipes', 'cooking') ?>: <strong itemprop="cookTime"><?php if ($recipe->cooking_time): ?><?php echo $recipe->cooking_time ?><?php else: ?> - <?php endif; ?></strong></li>
                        <li><?= __d('recipes', 'calories') ?>: <strong itemprop="calories"><?php if ($recipe->calories): ?><?php echo $recipe->calories ?><?php else: ?> - <?php endif; ?></strong></li>
                        <li><?= __d('recipes', 'difficulty') ?>: <strong itemprop="Difficulty">
                                <?php if (($recipe->difficulty) == 'easy'): ?><?= __d('recipes', 'easy') ?><?php endif; ?>
                                <?php if (($recipe->difficulty) == 'medium'): ?><?= __d('recipes', 'medium') ?><?php endif; ?>
                                <?php if (($recipe->difficulty) == 'hard'): ?><?= __d('recipes', 'hard') ?><?php endif; ?>
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
                <h3><?= __d('recipes', 'ingredients') ?></h3>
                <ul class="ingredients" id="ingredients-list">
                    <?php foreach (explode("\n", $recipe->ingredients) as $i): ?>
                        <li>
                            <input type="checkbox" name="check">
                            <label itemprop="ingredients"><?php echo $i ?></label>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <!-- Directions -->
                <h3><?= __d('recipes','directions') ?></h3>
                <ol class="directions" itemprop="recipeInstructions">
                    <?php foreach (explode("\n", $recipe->directions) as $i): ?>
                        <li ><?php echo $i ?></li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
