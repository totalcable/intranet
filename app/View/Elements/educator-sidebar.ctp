<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->

        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper">
                <form class="sidebar-search " action="extra_search.html" method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
                        </span>
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            
              <li 
            <?php
            $levels = array('Levelsadd', 'Levelsedit');
            if (in_array($this->name . '' . $this->action, $levels)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="icon-basket"></i>
                    <span class="title">Level/Class</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li
                    <?php if ($this->name . '' . $this->action == 'Levelsadd'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'levels', 'action' => 'add')) ?>">
                            <i class="fa fa-phone"></i>
                            Add Level</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Levelsedit'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'levels', 'action' => 'edit')) ?>">
                            <i class="fa fa-check"></i>
                            Edit Level</a>
                    </li>
                   
                   
                </ul>
            </li>

            <li 
            <?php
            $subs = array('Subjectsadd', 'Subjectsedit');
            if (in_array($this->name . '' . $this->action, $subs)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="icon-basket"></i>
                    <span class="title">Subject</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">

                    <li
                    <?php if ($this->name . '' . $this->action == 'Subjectsadd'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'subjects', 'action' => 'add')) ?>">
                            <i class="fa fa-phone"></i>
                            Add</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Subjectsedit'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'subjects', 'action' => 'edit')) ?>">
                            <i class="fa fa-phone"></i>
                            Edit</a>
                    </li>
                </ul>
            </li>
            <li 
            <?php
            $chap = array('Chaptersadd', 'Chaptersedit');
            if (in_array($this->name . '' . $this->action, $chap)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="icon-basket"></i>
                    <span class="title">Chapter</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">

                    <li
                    <?php if ($this->name . '' . $this->action == 'Chaptersadd'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'chapters', 'action' => 'add')) ?>">
                            <i class="fa fa-phone"></i>
                            Add</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action  == 'Chaptersedit'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'chapters', 'action' => 'edit')) ?>">
                            <i class="fa fa-phone"></i>
                            Edit</a>
                    </li>
                </ul>
            </li>
            <li 
            <?php
            $options = array('QuestionsaddOption', 'QuestionseditOption');
            if (in_array($this->name . '' . $this->action, $options)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="icon-basket"></i>
                    <span class="title">Options Format</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">

                    <li
                    <?php if ($this->name . '' . $this->action == 'QuestionsaddOption'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'questions', 'action' => 'addOption')) ?>">
                            <i class="fa fa-phone"></i>
                            Add</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'QuestionseditOption'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'questions', 'action' => 'editOption')) ?>">
                            <i class="fa fa-phone"></i>
                            Edit</a>
                    </li>
                </ul>
            </li>
            <li 
            <?php
            $uni = array('DataaddUni', 'DataeditUni','DataaddYear');
            if (in_array($this->name . '' . $this->action, $uni)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="icon-basket"></i>
                    <span class="title">Varsity/Board</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">

                    <li
                    <?php if ($this->name . '' . $this->action == 'DataaddUni'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'data', 'action' => 'addUni')) ?>">
                            <i class="fa fa-phone"></i>
                            Add</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'DataeditUni'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'data', 'action' => 'editUni')) ?>">
                            <i class="fa fa-phone"></i>
                            Edit</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'DataaddYear'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'data', 'action' => 'addYear')) ?>">
                            <i class="fa fa-phone"></i>
                            Add Year</a>
                    </li>
                </ul>
            </li>

  
            <li 
            <?php
            $question = array('Assignmentsadd', 'Assignmentsmanage','Assignmentsedit');
            if (in_array($this->name . '' . $this->action, $question)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="icon-basket"></i>
                    <span class="title">Assignment</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">

                    <li
                    <?php if ($this->name . '' . $this->action == 'Assignmentsadd'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'assignments', 'action' => 'add')) ?>">
                            <i class="fa fa-phone"></i>
                            Add</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Assignmentsmanage'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'assignments', 'action' => 'manage')) ?>">
                            <i class="fa fa-phone"></i>
                            Manage</a>
                    </li>
                  
                </ul>
            </li>

                        <li 
            <?php
            $question = array('Studiesadd', 'Studiesmanage','Studiesedit');
            if (in_array($this->name . '' . $this->action, $question)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="icon-basket"></i>
                    <span class="title">Study</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">

                    <li
                    <?php if ($this->name . '' . $this->action == 'Studiesadd'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'studies', 'action' => 'add')) ?>">
                            <i class="fa fa-phone"></i>
                            Add</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Studiesmanage'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'studies', 'action' => 'manage')) ?>">
                            <i class="fa fa-phone"></i>
                            Manage</a>
                    </li>
                  
                </ul>
            </li>
 <li 
            <?php
            $question = array('Solutionsadd', 'Solutionsmanage','Solutionsedit');
            if (in_array($this->name . '' . $this->action, $question)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="icon-basket"></i>
                    <span class="title">Solution</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">

                    <li
                    <?php if ($this->name . '' . $this->action == 'Solutionsadd'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'solutions', 'action' => 'add')) ?>">
                            <i class="fa fa-phone"></i>
                            Add</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Solutionsmanage'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'solutions', 'action' => 'manage')) ?>">
                            <i class="fa fa-phone"></i>
                            Manage</a>
                    </li>
                  
                </ul>
            </li>


             <li 
            <?php
            $question = array('Questionsadd', 'Questionsmanage','Questionsedit');
            if (in_array($this->name . '' . $this->action, $question)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="icon-basket"></i>
                    <span class="title">Varsity/Board Question</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">

                    <li
                    <?php if ($this->name . '' . $this->action == 'Questionsadd'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'questions', 'action' => 'add')) ?>">
                            <i class="fa fa-phone"></i>
                            Add</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Questionsmanage'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'questions', 'action' => 'manage')) ?>">
                            <i class="fa fa-phone"></i>
                            Manage</a>
                    </li>
                  
                </ul>
            </li>


  
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
<!-- END SIDEBAR -->