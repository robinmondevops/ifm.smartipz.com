        </div>

        <!-- <div class="page-prefooter">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12 footer-block">
                        <h2>About</h2>
                        <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam dolore. </p>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs12 footer-block">
                        <h2>Subscribe Email</h2>
                        <div class="subscribe-form">
                            <form action="javascript:;">
                                <div class="input-group">
                                    <input type="text" placeholder="mail@email.com" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn" type="submit">Submit</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 footer-block">
                        <h2>Follow Us On</h2>
                        <ul class="social-icons">
                            <li>
                                <a href="javascript:;" data-original-title="rss" class="rss"></a>
                            </li>
                            <li>
                                <a href="javascript:;" data-original-title="facebook" class="facebook"></a>
                            </li>
                            <li>
                                <a href="javascript:;" data-original-title="twitter" class="twitter"></a>
                            </li>
                            <li>
                                <a href="javascript:;" data-original-title="googleplus" class="googleplus"></a>
                            </li>
                            <li>
                                <a href="javascript:;" data-original-title="linkedin" class="linkedin"></a>
                            </li>
                            <li>
                                <a href="javascript:;" data-original-title="youtube" class="youtube"></a>
                            </li>
                            <li>
                                <a href="javascript:;" data-original-title="vimeo" class="vimeo"></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 footer-block">
                        <h2>Contacts</h2>
                        <address class="margin-bottom-40"> Phone: 800 123 3456
                            <br> Email:
                            <a href="mailto:info@metronic.com">info@metronic.com</a>
                        </address>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="page-footer">
            <div class="container"> <?php echo date('Y');?> &copy; <?php echo $core_settings->site_name;?>
            </div>
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>

        <script src="<?php echo base_url('assets/global/plugins/jquery.min.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/js.cookie.min.js');?>" type="text/javascript"></script>

        <script src="<?php echo base_url('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js');?>" type="text/javascript"></script>

        <script src="<?php echo base_url('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/jquery.blockui.min.js');?>" type="text/javascript"></script>

        <script src="<?php echo base_url('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js');?>" type="text/javascript"></script>
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url('assets/global/scripts/app.min.js');?>" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url('assets/layouts/layout3/scripts/layout.min.js');?>" type="text/javascript"></script>

        <script src="<?php echo base_url('assets/layouts/layout3/scripts/demo.min.js');?>" type="text/javascript"></script>

        <script src="<?php echo base_url('assets/layouts/global/scripts/quick-sidebar.min.js');?>" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <?php if( isset($js_files)) { foreach( $js_files as $js ){ ?>
            <script src="<?php echo $js;?>" type="text/javascript"></script>
        <?php }} ?>
    </body>

</html>