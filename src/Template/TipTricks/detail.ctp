<section id="titlebar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2><?php echo $item->title ?></h2>
            </div>
            <div class="col-md-6">
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="<?php echo ('/') ?>"><?php echo ('Trang chủ') ?></a></li>
                        <li><a href="<?php echo ('/tip-tricks') ?>"><?php echo ('Tips & Tricks') ?></a></li>
                        <li><?php echo $item->title ?></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <h3 class="post-name"><a href="<?php echo ('tip-tricks/' . ($item->permalink)) ?>"><?php echo $item->title ?></a></h3>
            <div class="post-metas">
                <span class="icon"><i class="fa fa-eye"></i> <?php echo $item->visits ?></span>
<!--                    <span class="icon"><i class="fa fa-calendar"></i>-->
<!--                        --><?php //echo lang('global_created') ?><!--: -->
<!--                        --><?php //echo date('M d, Y ', strtotime($item->created)) ?>
<!--                    </span>-->
<!--                    <span class="icon"><i class="fa fa-clock-o"></i>-->
<!--                        --><?php //echo lang('global_Last_Update') ?><!--: -->
<!--                        --><?php //echo date('M d, Y ', strtotime($item->updated)) ?>
<!--                    </span>-->
            </div>
            <div class="blog-img">
                <?php echo $this->Html->image('tricks/'.$item->image, [
                    "alt" => $item->image
                ]);
                ?>
            </div>
            <section>
                <?php foreach (explode("\n", $item->description) as $i): ?>
                    <p class="margin-reset"> <?php echo $i ?></p>
                <?php endforeach; ?>
            </section>
            </br>
            </div>
        <!-- Sidebar
      ================================================== -->
        <div class="col-md-3">
            <div class="widget">
                <h4 class="headline"><?php echo ('Những bài Tips & Tricks được xem nhiều nhất') ?></h4>
                <span class="line margin-bottom-20"></span>
                <div class="clearfix"></div>
                <ul class="categories">
                    <?php foreach ($popular as $item): ?>
                        <li><a href="<?php echo ('/tip-tricks/' . ($item->permalink)) ?>"><?php if (strlen($item->title) > 35): ?> <?php echo substr($item->title, 0, 35) . ".."; ?> <?php else: ?> <?php echo $item->title; ?> <?php endif ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>


