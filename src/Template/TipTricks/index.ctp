<section id="titlebar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2><?php echo ('Tips & Tricks') ?></h2>
            </div>
            <div class="col-md-6">
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="<?php echo ('/') ?>"><?php echo ('Trang chủ') ?></a></li>
                        <li><?php echo ('Tips & Tricks') ?></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="blog-list">
                <?php foreach ($items as $item): ?>
                    <div class="post-item">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="post-thumb">
                                    <a href="<?php echo ('/tip-tricks/' . ($item->permalink)) ?>">
                                        <?php echo $this->Html->image('tricks/'.$item->image, [
                                            "alt" => $item->title,
                                            "width" => "100%",
                                            "class" => "responsive",
                                        ]);
                                        ?>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h3 class="post-name"><a href="<?php echo ('/tip-tricks/' . ($item->permalink)) ?>"><?php echo $item->title ?></a></h3>
                                <div class="post-metas">
                                    <span class="icon"><i class="fa fa-eye"></i> <?php echo $item->visits ?></span>
<!--                                    <span class="icon"><i class="fa fa-calendar"></i> --><?php //echo ('global_created') ?><!--: --><?php //echo date('M d, Y ', strtotime($item->created)) ?><!--</span>-->
<!--                                    <span class="icon"><i class="fa fa-clock-o"></i> --><?php //echo lang('global_Last_Update') ?><!--: --><?php //echo date('M d, Y ', strtotime($item->updated)) ?><!--</span>-->
                                </div>
                                <div class="post-item-info">
                                    <p><?php echo $item->short_description ?></p>
                                    <a href="<?php echo ('/tip-tricks/' . ($item->permalink)) ?>" class="button"><?php echo ('Xem chi tiết') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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
        <div class="col-md-3">
            <!-- Sidebar
        ================================================== -->
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

