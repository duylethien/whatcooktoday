<div class="row">
    <div class="col-lg-4" style="left: 33.5vw;">
        <div class="modal-content">
            <br>
            <p class="login-icon">
                <i class="fa fa-user-circle"></i>
                <?php echo ('Xin Chào!') ?> </b> <?php echo ('Đăng nhập với tài khoản của bạn') ?>
            </p>
            <?php
            echo $this->Flash->render('message');

            $this->Form->setTemplates([
                'inputContainer' => '<div class="form-group{{required}} col-lg-12"> {{content}} <span class="help">{{help}}</span></div>',
                'input' => '<input type="{{type}}" name="{{name}}" class="form-control form-control-danger col-lg-12" {{attrs}}/>',
                'inputContainerError' => '<div class="form-group has-danger {{type}}{{required}} col-lg-12">{{content}}{{error}}</div>',
                'error' => '<div class="text-danger col-lg-10">{{content}}</div>'
            ]);

            echo $this->Form->create($login);
            echo $this->Form->controls(
                [
                    'email'     => ['required'  => TRUE, 'placeholder' => 'Nhập email', 'label' => ['text' => 'Email']],
                    'password'  => ['required'  => TRUE, 'placeholder' => 'Nhập mật khẩu', 'label' => ['text' => 'Mật khẩu']],
                ],
                [ 'legend' => false]
            );

            echo $this->Form->button('<i class="fa fa-user"></i>Đăng nhập',['class' => 'btn button color big', 'style' => 'margin-left: 11.5vw; margin-bottom: 15px']);
            echo $this->Form->end();
            ?>
        </div>
    </div>
</div>
<br><br>
<br><br><!--
<div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
        <?php
/*        echo $this->Flash->render('message');

        $this->Form->setTemplates([
            'inputContainer' => '<div class="form-group{{required}}"> {{content}} <span class="help">{{help}}</span></div>',
            'input' => '<input type="{{type}}" name="{{name}}" class="form-control form-control-danger" {{attrs}}/>',
            'inputContainerError' => '<div class="form-group has-danger {{type}}{{required}}">{{content}}{{error}}</div>',
            'error' => '<div class="text-danger">{{content}}</div>'
        ]);

//        echo $this->Form->create($login);
         echo $this->Form->create('', ['type' => 'POST']);
        echo $this->Form->controls(
            [
                'email'     => ['required'  => TRUE, 'placeholder' => 'Enter Email Id', 'label' => ['text' => 'User Email']],
                'password'  => ['required'  => TRUE, 'placeholder' => 'Enter Password']
            ],
            [ 'legend' => 'User Login Here']
        );

        echo $this->Form->button('<i class="fa fa-user"></i> Login',['class' => 'btn btn-success btn-block']);
        echo $this->Form->end();
        */?>
    </div>
    <div class="col-lg-4"></div>
</div>-->
