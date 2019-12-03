<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <h3 class="card-header"><i class="fa fa-plus-square-o"></i>&nbsp; Add Article</h3>
            <div class="card-block">
                <?php
                echo $this->Flash->render();

                $this->Form->setTemplates([
                    'inputContainer' => '<div class="form-group{{required}}"> {{content}} <span class="help">{{help}}</span></div>',
                    'input' => '<input type="{{type}}" name="{{name}}" class="form-control form-control-danger" {{attrs}}/>',
                    'inputContainerError' => '<div class="form-group has-danger {{type}}{{required}}">{{content}}{{error}}</div>',
                    'error' => '<div class="text-danger">{{content}}</div>',
                    'textarea' => '<textarea  name="{{name}}" class="form-control" {{attrs}}>{{value}}</textarea>',
                ]);

                echo $this->Form->create($recipes);
                echo $this->Form->controls(
                    [
                        'title' => ['required'  => false, 'placeholder' => 'Enter Article Title', 'label' => ['class'=> 'form-control-label', 'text' => 'Article Title']],
                        'permalink'  => ['required'  => false, 'type' => 'textarea', 'placeholder' => 'Enter Article Description', 'label' => ['class'=> 'form-control-label', 'text' => 'Article Description'], 'rows' => '10', 'cols' => '15'],
                    ],
                    [ 'legend' => false]
                );
                echo $this->Form->button('<i class="fa fa-plus-circle"></i> Add Recipes',['class' => 'btn btn-success']);
                echo $this->Form->end();
                ?>
            </div>
        </div>
    </div>
</div>
