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
                <strong><?php echo ('Update Recipe') ?></strong>
            </li>
        </ol>
    </div>
</div>
<!-- Admin Table-->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo ('Update Recipe') ?></h3>
        <div class="panel-options">
        </div>
    </div>
    <div class="panel-body">
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

        echo $this->Form->create($recipes);
        echo $this->Form->controls(
            [
                'category_id'  => ['required'  => true, 'type' => 'select', 'options' => $options, 'value' => $recipes['category_id'], 'label' => ['text' => 'Category'], 'class' => ['class'=> 'select2-container form-control s2example-1']],
                'title' => ['required'  => true, 'placeholder' => 'Enter Recipe Title', 'label' => ['class'=> 'form-control-label', 'text' => 'Title']],
                'permalink' => ['required'  => true, 'placeholder' => 'Enter Recipe Title', 'label' => ['class'=> 'form-control-label', 'text' => 'Permalink']],
                'difficulty'  => ['required'  => true, 'type' => 'radio', 'options' => ['Easy', 'Medium', 'Hard'], 'value' => $recipes['difficulty'], 'label' => ['text' => 'Difficulty']],
                'prepare_time' => ['required'  => false, 'placeholder' => 'Enter Recipe Title', 'label' => ['class'=> 'form-control-label', 'text' => 'Prepare time']],
                'cooking_time' => ['required'  => false, 'placeholder' => 'Enter Recipe Title', 'label' => ['class'=> 'form-control-label', 'text' => 'Cooking time']],
                'calories' => ['required'  => false, 'placeholder' => 'Enter Recipe Title', 'label' => ['class'=> 'form-control-label', 'text' => 'Calories']],
                'description'  => ['required'  => true, 'type' => 'textarea', 'placeholder' => 'Enter Article Description', 'label' => ['class'=> 'form-control-label', 'text' => 'Description'], 'rows' => '10', 'cols' => '15'],
                'directions'  => ['required'  => true, 'type' => 'textarea', 'placeholder' => 'Enter Article Description', 'label' => ['class'=> 'form-control-label', 'text' => 'Directions'], 'rows' => '10', 'cols' => '15'],
                'ingredients'  => ['required'  => true, 'type' => 'textarea', 'placeholder' => 'Enter Article Description', 'label' => ['class'=> 'form-control-label', 'text' => 'Ingredients'], 'rows' => '10', 'cols' => '15'],
                'meta_description'  => ['required'  => false, 'type' => 'textarea', 'placeholder' => 'Enter Article Description', 'label' => ['class'=> 'form-control-label', 'text' => 'Meta Description'], 'rows' => '10', 'cols' => '15'],
                'status'  => ['required'  => true, 'type' => 'radio', 'options' => ['Inactive', 'Active'], 'value' => $recipes['status'], 'label' => ['text' => 'Status']],
                'file' => ['type' => 'file', 'class' => 'form-control']
            ],
            [ 'legend' => false]
        );

        echo $this->Form->file('file', ['class' => 'form-control']);
//        echo $this->Form->select('gender', $options);
        echo $this->Form->button('<i class="fa fa-plus-circle"></i> Update Recipes',['class' => 'btn btn-success']);
        echo $this->Form->end();
        ?>
    </div>
</div>

