<br/>
<br/>
<br/>
<br/>
                              <div class="row-fluid " id="sloginForm">

                <div class="span12">

                    <div class="box">

                        <div class="title">
                        </div>
                        <div class="content">
                            <?php
                            echo $this->Form->create('Student', array(
                                'inputDefaults' => array(
                                    'label' => false,
                                    'div' => false
                                    ),
                                'id' => 'loginForm',
                                'class' => 'form-horizontal',
                                'novalidate' => 'novalidate',
                                'url' => array('controller' => 'frontends', 'action' => 'login'),
                                )
                            );
                            ?>
                          
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="required">Email</label>
                                            <?php
                                            echo $this->Form->input(
                                                'email', array(
                                                    'class' => 'span9 text required'
                                                    )
                                                );
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="required">Password</label>

                                                <?php
                                                echo $this->Form->input(
                                                    'password', array(
                                                        'class' => 'span9 text required'
                                                        )
                                                    );
                                                    ?>
                                                </div>
                                            </div>
                                        </div>


                                             <div class="form-row row-fluid">
                         
                                            <?php
                                            echo $this->Form->button(
                                                    'Login', array('class' => 'btn btn-warning', 'type' => 'submit')
                                            );
                                            ?>

                                      
                        </div>
                        
                                          
                        <?php echo $this->Form->end(); ?>


                                        </div>

                                    </div><!-- End .box -->

                                </div><!-- End .span12 -->

                            </div><!-- End .row-fluid (login) --> 