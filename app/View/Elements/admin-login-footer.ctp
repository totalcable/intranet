    <!-- Le javascript
    ================================================== -->
      <?php echo $this->Html->script(
          array(
                   'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min',
                   'bootstrap/bootstrap',
                   '/plugins/misc/touch-punch/jquery.ui.touch-punch.min',
                   '/plugins/misc/ios-fix/ios-orientationchange-fix',
                   '/plugins/forms/validate/jquery.validate.min',
                   '/plugins/forms/uniform/jquery.uniform.min'
                )
         ); 
     ?>



     <script type="text/javascript">
        // document ready function
        $(document).ready(function() {
            $("input, textarea, select").not('.nostyle').uniform();
            $("#loginForm").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 4
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }  
                },
                messages: {
                    username: {
                        required: "Fill me please",
                        minlength: "My name is bigger"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "My password is more that 6 chars"
                    }
                }   
            });
        });
    </script>

    <!-- NACHALO NA TYXO.BG BROYACH -->
    <script type="text/javascript">
    <!--
    d=document;d.write('<a href="https://www.tyxo.bg/?138779" title="Tyxo.bg counter"><img width="1" height="1" border="0" alt="Tyxo.bg counter" src="'+location.protocol+'//cnt.tyxo.bg/138779?rnd='+Math.round(Math.random()*2147483647));
    d.write('&sp='+screen.width+'x'+screen.height+'&r='+escape(d.referrer)+'"></a>');
    //-->
    </script><noscript><a href="http://www.tyxo.bg/?138779" title="Tyxo.bg counter"><img src="https://cnt.tyxo.bg/138779" width="1" height="1" border="0" alt="Tyxo.bg counter" /></a></noscript>
    <!-- KRAI NA TYXO.BG BROYACH -->
 
    </body>
</html>
