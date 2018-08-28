
<style>
    .ui-datepicker-multi-3 {
        display: table-row-group !important;
    }
</style>

<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
</style>

<div class="page-content-wrapper">
    <div class="page-content"> 
        <div class="col-xs-12">
            <div class="row">
                <h2>Idividual movie history</h2>            
                <br><br>
                <div class="col-xs-3"></div>
                <div class="col-xs-6">
                    <p style="font-size: 19px; text-align: left;">
                        Movie Name:
                        <a tiMovie Name:tle="Click here for individual data update :-)" href="#product-pop-up<?php echo $data_movie_r['id']; ?>" class="fancybox-fast-view" style="overflow: -webkit-paged-x;">
                            <b style="color: steelblue;"><?php echo $data_movie_r['name']; ?></b> <br> </a>
                        <!-- pop up for data change start -->
                    <div id="product-pop-up<?php echo $data_movie_r['id']; ?>" style="overflow: -webkit-paged-x;display: none; height: 770px; width: 900px;">
                        <div class="product-page product-pop-up">
                            <div class="row">
                                <div class="controls center text-center">                                              
                                    <h3>You can easily modify information here</h3>
                                    <h4 style="color: royalblue;" title="Movie name is : <?php echo $data_movie_r['name']; ?> :-)"><?php echo $data_movie_r['name']; ?></h4>
                                    <br><br><br>
                                    <?php
                                    echo $this->Form->create('Movie', array(
                                        'inputDefaults' => array(
                                            'label' => false,
                                            'div' => false,
                                            'id' => false
                                        ),
                                        'id' => 'form_sample_3',
                                        'class' => 'form-horizontal',
                                        'novalidate' => 'novalidate',
                                        'url' => array('controller' => 'movietimes', 'action' => 'update_movie')
                                            )
                                    );
                                    ?>
                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button>
                                            You have some form errors. Please check below.
                                        </div>
                                        <?php echo $this->Session->flash(); ?>
                                        <?php
                                        echo $this->Form->input('id', array(
                                            'type' => 'hidden',
                                            'value' => $data_movie_r['id']
                                                )
                                        );
                                        ?>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-2"> 
                                                    <label>Movie name</label></div>
                                                <div class="col-md-7">                                                                
                                                    <?php
                                                    echo $this->Form->input('name', array(
                                                        'type' => 'text',
                                                        'class' => 'form-control ',
                                                        'value' => $data_movie_r['name']
                                                            )
                                                    );
                                                    ?>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-2"> 
                                                    <label>Category </label></div>
                                                <div class="col-md-7">                                                                
                                                    <?php
                                                    echo $this->Form->input('category', array(
                                                        $options = array('action' => 'Action','adventure' => 'Adventure','comedy' => 'Comedy', 'horror' => 'Horror', 'romantic' => 'Romantic'),
                                                        'type' => 'select',
                                                        'multiple' => 'checkbox',
                                                        'value'=> $words['movies'],
                                                        'options' => $options)
                                                    );
                                                    ?>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-2"> 
                                                    <label>Hero name</label></div>
                                                <div class="col-md-7">                                                                
                                                    <?php
                                                    echo $this->Form->input('hero', array(
                                                        'type' => 'text',
                                                        'class' => 'form-control ',
                                                        'value' => $data_movie_r['hero']
                                                            )
                                                    );
                                                    ?>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-2"> 
                                                    <label>Heroin name</label></div>
                                                <div class="col-md-7">                                                                
                                                    <?php
                                                    echo $this->Form->input('heroin', array(
                                                        'type' => 'text',
                                                        'class' => 'form-control ',
                                                        'value' => $data_movie_r['heroin']
                                                            )
                                                    );
                                                    ?>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-2"> 
                                                    <label>Release Year</label></div> 
                                                <div class="col-md-7">                                                                
                                                    <?php
                                                    echo $this->Form->input('release_year', array(
                                                        'type' => 'text',
                                                        'class' => 'form-control ',
                                                        'value' => $data_movie_r['release_year']
                                                            )
                                                    );
                                                    ?>
                                                </div>  
                                            </div>  
                                            <br>
                                            <div class="row">
                                                <div class="col-md-2"> 
                                                    <label>IMDB Rating</label></div> 
                                                <div class="col-md-7">                                                                
                                                    <?php
                                                    echo $this->Form->input('imdb_rating', array(
                                                        'type' => 'text',
                                                        'class' => 'form-control ',
                                                        'value' => $data_movie_r['imdb_rating']
                                                            )
                                                    );
                                                    ?>
                                                </div>  
                                            </div>  
                                            <br>
                                            <div class="row">
                                                <div class="col-md-2"> 
                                                    <label>Duration</label></div> 
                                                <div class="col-md-7">                                                                
                                                    <?php
                                                    echo $this->Form->input('duration', array(
                                                        'type' => 'text',
                                                        'class' => 'form-control ',
                                                        'value' => $data_movie_r['duration']
                                                            )
                                                    );
                                                    ?>
                                                </div>  
                                            </div> 
                                            <br><br><br>
                                            <div class="row">
                                                <?php
                                                echo $this->Form->button(
                                                        'Update Information', array('class' => 'btn green', 'type' => 'submit')
                                                );
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo $this->Form->end(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- pop up for data change end --> 
                    </p> 
                    <p style="font-size: 19px; text-align: left; line-height: 35px;">
                        Release Year: <b style="color: steelblue;"> <?php echo $data_movie_r['release_year']; ?></b><br>  
                        IMDB Rating:  <b style="color: steelblue;"><?php echo $data_movie_r['imdb_rating']; ?></b>  <br>
                        Cast: <b style="color: steelblue;"><?php echo $data_movie_r['hero'] . ' ,' . $data_movie_r['heroin']; ?></b> <br> 
                        Category:  <b style="color: steelblue;"><?php echo ucfirst($data_movie_r['category']); ?> </b> <br> 
                        Duration:  <b style="color: steelblue;"><?php echo $data_movie_r['duration']; ?> </b> 
                    </p> 
                </div>
                <div class="col-xs-3">
                </div>
                <div class="form-body">
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                            <tr style=" color: red; font-weight: bold;">
                                <th>
                                    On air date
                                </th>

                                <th>
                                    On air time
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $data):
                                $results = $data['movie_details'];
                                $results_movie = $data['movies'];
                                ?>
                                <tr  style=" color: green; font-weight: bold;"> 
                                    <td class="hidden-480">
                                        <?php echo $results_movie['on_air_date']; ?> 
                                    </td>

                                    <td class="hidden-480">
                                        <?php echo $results_movie['on_air_time']; ?> 
                                    </td>
                                </tr>
                            <?php endforeach; ?> 
                        </tbody>
                    </table>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>           
    </div>                             
</div>
<!-- END CONTENT -->

