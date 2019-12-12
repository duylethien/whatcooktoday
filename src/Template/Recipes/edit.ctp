<section id="titlebar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2><?= __('Các công thức của tôi') ?></h2>
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
                        <li><?= __('Các công thức của tôi') ?></li>
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
            <div class="col-md-12">
                <h4 class="headline"><?= __('Các công thức của tôi') ?></h4>
                <span class="line margin-bottom-30"></span>
                <div class="row margin-top-50">
                    <?php
                    echo $this->Flash->render();

                    $this->Form->setTemplates([
                        'inputContainer' => '<div class="form-group{{required}} col-md-6"> {{content}} <span class="help">{{help}}</span></div>',
                        'input' => '<input type="{{type}}" name="{{name}}" class="form-control form-control-danger" {{attrs}}/>',
                        'inputContainerError' => '<div class="form-group has-danger {{type}}{{required}}">{{content}}{{error}}</div>',
                        'error' => '<div class="text-danger">{{content}}</div>',
                        'textarea' => '<textarea  name="{{name}}" class="form-control" {{attrs}}>{{value}}</textarea>',
                    ]);
                    foreach ($categories as $item) {
                        $options[$item->category_id] = $item->title;
                    };

                    echo $this->Form->create($recipes, ['enctype' => 'multipart/form-data']);
                    echo $this->Form->controls(
                        [
                            'category_id'  => ['required'  => true, 'type' => 'select', 'options' => $options, 'value' => $recipes['category_id'], 'label' => ['text' => 'Thể loại *'], 'class' => ['class'=> 'select2-container form-control s2example-1']],
                            'title' => ['required'  => true, 'placeholder' => 'Enter Recipe Title','label' => ['class'=> 'form-control-label', 'text' => 'Chủ đề *']],
                            'permalink' => ['required'  => true, 'placeholder' => 'Enter Recipe Title', 'label' => ['class'=> 'form-control-label', 'text' => 'tên đường dẫn']],
                            'difficulty'  => ['required'  => true, 'type' => 'radio', 'options' => ['Dễ', 'Trung bình', 'Khó'], 'value' => $recipes['difficulty'], 'label' => ['text' => 'Độ khó *']],
                            'prepare_time' => ['required'  => false, 'placeholder' => 'Enter Recipe Title', 'label' => ['class'=> 'form-control-label', 'text' => 'Thời gian chuẩn bị']],
                            'serves' => ['required'  => false, 'placeholder' => 'Nhập số người', 'label' => ['class'=> 'form-control-label', 'text' => 'Phục vụ']],
                            'cooking_time' => ['required'  => false, 'placeholder' => 'Enter Recipe Title', 'label' => ['class'=> 'form-control-label', 'text' => 'Thời gian nấu']],
                            'calories' => ['required'  => false, 'placeholder' => 'Enter Recipe Title', 'label' => ['class'=> 'form-control-label', 'text' => 'Calories']],
                            'video'  => ['required'  => true, 'type' => 'textarea', 'placeholder' => 'Nhập link video hướng dẫn', 'label' => ['class'=> 'form-control-label', 'text' => 'Video']],
                            'description'  => ['required'  => true, 'type' => 'textarea', 'placeholder' => 'Enter Article Description', 'label' => ['class'=> 'form-control-label', 'text' => 'Mô tả *'], 'rows' => '10', 'cols' => '15'],
                            'directions'  => ['required'  => true, 'type' => 'textarea', 'placeholder' => 'Enter Article Description', 'label' => ['class'=> 'form-control-label', 'text' => 'Hướng dẫn *'], 'rows' => '10', 'cols' => '15'],
                            'ingredients'  => ['required'  => true, 'type' => 'textarea', 'placeholder' => 'Enter Article Description', 'label' => ['class'=> 'form-control-label', 'text' => 'Thành phần *'], 'rows' => '10', 'cols' => '15'],
                            'meta_description'  => ['required'  => false, 'type' => 'textarea', 'placeholder' => 'Enter Article Description', 'label' => ['class'=> 'form-control-label', 'text' => 'Mô tả ngắn gọn'], 'rows' => '10', 'cols' => '15'],
                            'status'  => ['required'  => true, 'type' => 'radio', 'options' => ['Inactive', 'Active'], 'value' => $recipes['status'], 'label' => ['text' => 'Trạng thái']],
//                            'featured_image' => ['type' => 'file', 'class' => 'upload-btn', 'label' => ['text' => __d('profile', 'Ảnh đại diện công thức')]]
                        ],
                        [ 'legend' => false]
                    );
                    ?>
                    <div class="form-group">
                        <label class="col-sm-2 " for="field-1"> <?php echo ('Ảnh đại diện công thức') ?> <span class="required">*</span></label>
                        <div class="col-sm-8">
                            <input type="file" name="featured_image" class="upload-btn">
                        </div>
                        <div class="col-sm-2 text-right">
                            <?php if ($recipes['featured_image']): echo $this->Html->image('recipes/' . $recipes['featured_image'], [
                                "alt" => $recipes['featured_image'],
                                "height" => "45px",
                                "max-width" =>  "100%",
                            ]); endif;?>
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="portlet light bordered form-group">
                        <div class="portlet-title col-sm-2 ">
                            <div id="advancedDropzone" class="droppable-area">
                                <label class="upload-btn">
                                    <input type="file" name="gallery[]" multiple id="gallery" onchange="imagesUpdate(this)"  />
                                    <i class="fa fa-upload"></i> <?php echo ('Tải ảnh lên') ?>
                                </label>
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <table class="table table-bordered table-striped" id="example-dropzone-filetable">
                                <thead>
                                <tr>
                                    <th><?php echo ('Những ảnh công thức đã được tải lên') ?></th>
                                </tr>
                                </thead>
                                <tbody class="gallery gallery_sortable">
                                <?php if (($images = json_decode($recipes->gallery))): ?>
                                    <?php foreach ($images as $img): ?>
                                        <tr id="<?php echo $img ?>">
                                            <td>
                                                <?php  echo $this->Html->image('recipes/' . $img, [
                                                    "alt" => "Avatar",
                                                ]);
                                                ?>
                                                <input type="hidden" name="gallery[]" value="<?php echo $img ?>" />
                                                <button type="button" onclick="imagesRemoveItem(this)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr class="no-images"><td><?php echo ('Chưa tải ảnh nào') ?>!</td></tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                    echo $this->Form->button('<i class="fa fa-plus-circle"></i> Cập nhật công thức',['class' => 'btn btn-success']);
                    echo $this->Form->end();
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;

    var featuredImageUpdate = function (input) {
        if (!$(".gallery img").length) {
            $(".gallery").html("<img src='' style='width: 100%' />");
        }
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(".gallery img").attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    };

    $(function () {
        $(".gallery_sortable").sortable();
        $(".gallery_sortable").disableSelection();
    });
    var imagesUpdate = function (that) {
        if (!$(".gallery_sortable tr td").length) {
            $(".gallery_sortable").html("");
        }

        data = new FormData();
        $(that.files).each(function (i, x) {
            data.append('file[]', x);
        });


        $.ajax({
            headers: {
                'X-CSRF-Token': csrfToken
            },
            url: "/recipes/image-upload",
            type: "POST",
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data'
        }).done(function (res) {
            res = JSON.parse(res);
            if (res.error == true)
                console.log(res.message);
            else {
                $(res.files).each(function (i, x) {
                    console.log(x);
                    $(".gallery_sortable").append('<tr id="' + x + '">'
                        + '<td>'
                        + '    <img src="/img/recipes/' + x + '" />'
                        + '    <input type="hidden" name="gallery[]" value="' + x + '" />'
                        + '    <button type="button" onclick="imagesRemoveItem(this)" class="btn btn-danger"><i class="fa fa-trash"></i></button>'
                        + '</td>'
                        + '</tr>'
                    );
                });
            }
        });
    };
    var imagesRemoveItem = function (item) {
        $(item).parent().parent().remove();
    };
</script>
