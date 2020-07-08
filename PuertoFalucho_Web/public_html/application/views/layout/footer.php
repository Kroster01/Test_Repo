<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- footer-->
<div class="contact">
    <div class="container">
        <div class="w3agile_contact_grid">
            <div class="col-md-12 w3agile_contact_right">
                <h2><?php echo lang('datosDeContacto') ?></h2>
                <ul class="agileinfo_contact_grid_list">
                    <li><i class="fa fa-map-marker contact_icons" aria-hidden="true"></i>
                    <?php echo lang('direccionLaboral') ?></span>
                    </li>
                    <li><i class="fa fa-envelope-o contact_icons" aria-hidden="true"></i><a
                        href="mailto:info@example.com"><?php echo lang('correoContacto') ?></a></li>
                    <li><i class="fa fa-phone contact_icons" aria-hidden="true"></i><?php echo lang('fonoContacto') ?></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="copy-right">
        <p>
        <?php echo lang('derechosFooter') ?><a href="<?php echo lang('w3layouts') ?>"><?php echo lang('disenaPor') ?></a>
        </p>
    </div>

</div>
<!-- //footer -->

<!--/google map section ends here-->

<!-- required-js-files-->
<!--<link href="public/css/owl.carousel.css" rel="stylesheet">-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/owl.carousel.css')?>">
<!--<script src="public/js/.js"></script>-->
<script type="text/javascript" src="<?php echo base_url('public/js/owl.carousel.js')?>"></script>
<script>
    $(document).ready(function() {
        $("#owl-demo").owlCarousel({
            items : 1,
            lazyLoad : true,
            autoPlay : true,
            navigation : false,
            navigationText :  false,
            pagination : true,
        });
    });
</script>
<!--//required-js-files-->

<!-- search-jQuery -->
<!-- //here ends scrolling icon -->

<script type="text/javascript">
    $(document).ready(function() {
    
        var defaults = {
        containerID: 'toTop', // fading element id
        containerHoverID: 'toTopHover', // fading element hover id
        scrollSpeed: 1200,
        easingType: 'linear' 
        };
                                
    $().UItoTop({ easingType: 'easeOutQuart' });
    });
</script>
<a href="#" id="toTop" style="display: block;"> <span id="toTopHover"
    style="opacity: 1;"> </span> </a>
<!--<script src="public/js/SmoothScroll.min.js"></script>-->
<script type="text/javascript" src="<?php echo base_url('public/js/SmoothScroll.min.js')?>"></script>
<!-- start-smoth-scrolling -->
<!--<script type="text/javascript" src="public/js/move-top.js"></script>
<script type="text/javascript" src="public/js/easing.js"></script>-->
<script type="text/javascript" src="<?php echo base_url('public/js/move-top.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/easing.js')?>"></script>
<?php
$this->load->view("genericPage/email_js")
?>

<!-- start-smoth-scrolling -->
<!-- smooth scrolling-bottom-to-top -->
<!--<script src="public/js/.js"></script>-->
<script type="text/javascript" src="<?php echo base_url('public/js/bootstrap.js')?>"></script>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="width: auto; padding: 5px; max-width: 600px;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo lang('informacion') ?></h4>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('cerrarModal') ?></button>
            </div>
        </div>
    </div>
</div>
</body>
</html>

