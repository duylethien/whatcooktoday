<br><br>
<div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
        <?php
        echo $this->Flash->render('message');

        $this->Form->setTemplates([
            'inputContainer' => '<div class="form-group{{required}}"> {{content}} <span class="help">{{help}}</span></div>',
            'input' => '<input type="{{type}}" name="{{name}}" class="form-control form-control-danger" {{attrs}}/>',
            'inputContainerError' => '<div class="form-group has-danger {{type}}{{required}}">{{content}}{{error}}</div>',
            'error' => '<div class="text-danger">{{content}}</div>'
        ]);

        echo $this->Form->create($sign_up);
//        echo $this->Form->create('', ['type' => 'POST']);
        echo $this->Form->controls(
            [
                'email'     => ['required'  => TRUE, 'placeholder' => 'Enter Email Id', 'label' => ['text' => 'User Email']],
                'password'  => ['required'  => TRUE, 'placeholder' => 'Enter Password']
            ],
            [ 'legend' => 'User Register In Here']
        );

        echo $this->Form->button('<i class="fa fa-user"></i>Register',['class' => 'btn btn-success btn-block']);
        echo $this->Form->end();
        ?>
    </div>
    <div class="col-lg-4"></div>
</div>
