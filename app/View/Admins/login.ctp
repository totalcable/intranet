<div class="container-fluid">

    <div class="loginContainer">
        <?php echo $this->Session->flash(); ?>
        <?php
        echo $this->Form->create('User', array(
            'inputDefaults' => array(
                'label' => false,
                'div' => false
            ),
            'class' => 'form-horizontal',
            'role' => 'form',
            'id' => 'loginForm',
            'url' => array('controller' => 'admins', 'action' => 'login'),
        ));
        ?>
        <div class="form-row row-fluid">
            <div class="span12">
                <div class="row-fluid">
                    <label class="form-label span12" for="username">
                        Email:
                        <span class="icon16 icomoon-icon-user-3 right gray marginR10"></span>
                    </label>
                    <?php
                    echo $this->Form->input('email', array(
                        'class' => 'span12',
                        'id' => 'username',
                        'type' => 'text',
                    ));
                    ?>
                </div>
            </div>
        </div>

        <div class="form-row row-fluid">
            <div class="span12">
                <div class="row-fluid">
                    <label class="form-label span12" for="password">
                        Password:
                        <span class="icon16 icomoon-icon-locked right gray marginR10"></span>
                        <span class="forgot"><a href="#">Forgot your password?</a></span>
                    </label>
                    <?php
                    echo $this->Form->input('password', array(
                        'class' => 'span12',
                        'id' => 'password',
                        'type' => 'password',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-row row-fluid">                       
            <div class="span12">
                <div class="row-fluid">
                    <div class="form-actions">
                        <div class="span12 controls">
                            <?php
                            echo $this->Form->button(
                                    'Login', array('class' => 'btn marginR10', 'type' => 'submit')
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <?php echo $this->Form->end(); ?>
    </div>

</div><!-- End .container-fluid -->
