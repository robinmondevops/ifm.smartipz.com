<!DOCTYPE html>

<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>

        <?php if($menu == 'upgrade123'){ ?>

            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >

            <script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-
                    color="#333" bolt-logo="https://www.payumoney.com/media/images/payby_payumoney/new_buttons/23.png"></script>
<!--            https://checkout-static.citruspay.com/bolt/run/bolt.min.js-->
        <?php } ?>



        <meta charset="utf-8" />
        <title><?php echo $core_settings->site_name;?> | <?php echo $page_title;?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 

        <link href="<?php echo base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css');?>" rel="stylesheet" type="text/css" />

         <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

        <link href="<?php echo base_url('assets/global/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/css/components.min.css');?>" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url('assets/global/css/plugins.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/layouts/layout3/css/layout.min.css?ver=1.0.0');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/layouts/layout3/css/themes/default.min.css');?>" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo base_url('assets/layouts/layout3/css/custom.min.css?ver=1.0.1');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css?ver=1.1.2');?>" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url('assets/global/plugins/typeahead/typeahead.css?ver=1.0.1');?>" rel="stylesheet" type="text/css" />

        <?php if( isset($css_files)) { foreach( $css_files as $css ){ ?>
            <link href="<?php echo $css;?>" media="all" rel="stylesheet" type="text/css" />
        <?php }} ?>
        <link rel="shortcut icon" href="favicon.ico" /> 
        <script>var base_url = '<?php echo base_url();?>';</script>
        <script>var site_url = '<?php echo site_url();?>';</script>


        <script src="<?php echo base_url('assets/global/plugins/jquery-2_2.js');?>" type="text/javascript"></script>


    </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid page-header-top-fixed">
        <!-- BEGIN HEADER -->
        <div class="page-header">
            <!-- BEGIN HEADER TOP -->
            <div class="page-header-top">  
                <div class="container">
                    <!-- BEGIN LOGO -->
<!--                    hidden-xs-->
                    <div class="page-logo ">
                        <a href="<?php echo site_url();?>">
                            <img style="margin-top: 0px !important;" height="70px !important"
                                 src="<?php echo base_url('files/media/logo.jpg');?>"
                                 alt="<?php echo $core_settings->site_name;?>" class="logo-default" />
                        </a>
                    </div>

                    <div class="col-md-5 search_bar hidden-xs">
                       
                        <form role="form" method="post" action="<?php echo site_url('search'); ?>">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search By Name or ID " name="typeahead_search" id="typeahead_search" required>
                                            <span class="input-group-btn">
                                                <button class="btn blue" type="submit">Go!</button>
                                            </span>     
                                        </div>
                                        <?php echo form_error('typeahead_search');?>
                                    </div>
                                </div>
                            </div>  
                        </form>                                                          

                    </div>

                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler"></a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN NOTIFICATION DROPDOWN -->


                            <li class="droddown dropdown-separator">
                                <span class="separator"></span>
                            </li>


                            <!-- BEGIN INBOX DROPDOWN -->
                            
                            <li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle hidden-xs" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                                    <?php if( $this->user->image && file_exists( './files/profile/'.$this->user->id.'/'.$this->user->image ) ) {?>
                                        
                                        <img alt="" class="img-circle top_profile" src="<?php echo base_url('files/profile/'.$this->user->id.'/'.$this->user->image);?>">
                                        
                                     <?php } else {?>
                                        <img alt="" class="img-circle top_profile" src="<?php echo base_url('assets/layouts/layout/img/avatar.png');?>">
                                       
                                    <?php }?>
                                    <span class="username username-hide-mobile"><?php echo $this->session->userdata('username');?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="<?php echo site_url('users/profile');?>">
                                            <i class="icon-user"></i> My Profile </a>
                                    </li>
                                    
                                    <li>
                                        <a href="<?php echo site_url('auth/logout');?>">
                                            <i class="icon-key"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                            
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
            </div>
            <!-- END HEADER TOP -->
            <!-- BEGIN HEADER MENU -->
            <div class="page-header-menu">
                <div class="container">
                    
                    <div class="hor-menu  ">
                        <ul class="nav navbar-nav">
                            <li class="menu-dropdown classic-menu-dropdown <?php echo ($menu == 'dashboard_one')?'active':'';?>">
                                <a href="<?php echo site_url('dashboard_one');?>"> My Home
                                    <span class="arrow"></span>
                                </a>
                            </li>


                            <li class="menu-dropdown classic-menu-dropdown <?php echo ($menu == 'messages')?'active':'';?>">
                                <a href="<?php echo site_url('messages'); ?>"> Messages
                                    <span class="arrow"></span>
                                </a>
                            </li>

                            <li class="menu-dropdown classic-menu-dropdown <?php echo ($menu == 'edit_profile')?'active':'';?>">
                                <a href="<?php echo site_url('edit_profile/edit'); ?>"> Edit Profile
                                    <span class="arrow"></span>
                                </a>
                            </li>

                            <li class="menu-dropdown classic-menu-dropdown <?php echo ($menu == 'edit_reference')?'active':'';?>">
                                <a href="<?php echo site_url('edit_preference/edit'); ?>"> Edit Preference
                                    <span class="arrow"></span>
                                </a>
                            </li>


                            <li class="menu-dropdown classic-menu-dropdown <?php echo ($menu == 'profile')?'active':'';?>">
                                <a href="<?php echo site_url('users/profile'); ?>"> Settings
                                    <span class="arrow"></span>
                                </a>
                            </li>

                        </ul>
                    </div>
                    <!-- END MEGA MENU -->
                </div>
            </div>
            <!-- END HEADER MENU -->
        </div>
        <div class="page-container">