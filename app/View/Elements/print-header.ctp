<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>Print Preview</title>
      
        <?php echo $this->Html->css(['/printPlugin/css/960'],['media' => 'screen']); ?>
        <?php echo $this->Html->css(['/printPlugin/css/screen'],['media' => 'screen']); ?>
        <?php echo $this->Html->css(['/printPlugin/css/print'],['media' => 'print']); ?>
        <?php echo $this->Html->css(['/printPlugin/src/css/print-preview'],['media' => 'screen']); ?>
        
        <?php
        echo $this->Html->script(
                array(
                    'http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js',
                    '/printPlugin/src/jquery.print-preview'
                )
        );
        ?>

        <script type="text/javascript">
            $(function () {
                /*
                 * Initialise example carousel
                 */
                $("#feature > div").scrollable({interval: 2000}).autoscroll();

                /*
                 * Initialise print preview plugin
                 */
                // Add link for print preview and intialise
                $('#aside').prepend('<a class="print-preview">Print this page</a>');
                $('a.print-preview').printPreview();

                // Add keybinding (not recommended for production use)
                // $(document).bind('keydown', function(e) {
                //     var code = (e.keyCode ? e.keyCode : e.which);
                //     if (code == 80 && !$('#print-modal').length) {
                //         $.printPreview.loadPrintPreview();
                //         return false;
                //     }            
                // });
            });
        </script>
    </head>
    <!-- END HEAD -->
    <body>                
        
    