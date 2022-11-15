<!DOCTYPE html>

<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
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
        <link href="<?php echo base_url('assets/global/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/css/components.min.css');?>" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url('assets/global/css/plugins.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/layouts/layout3/css/layout.min.css?ver=1.0.0');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/layouts/layout3/css/themes/default.min.css');?>" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo base_url('assets/layouts/layout3/css/custom.min.css?ver=1.0.1');?>" rel="stylesheet" type="text/css" />
        <?php if( isset($css_files)) { foreach( $css_files as $css ){ ?>
            <link href="<?php echo $css;?>" media="all" rel="stylesheet" type="text/css" />
        <?php }} ?>
        <link rel="shortcut icon" href="favicon.ico" /> 
        <script>var base_url = '<?php echo base_url();?>';</script>
        <script>var site_url = '<?php echo site_url();?>';</script>


    </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid page-header-top-fixed">
        <!-- BEGIN HEADER -->
        <div class="page-header">
            <!-- BEGIN HEADER TOP -->
            <div class="page-header-top">
                <div class="container">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="<?php echo site_url();?>">
                            <img style="margin-top: 0px !important;" height="70px !important"
                                 src="<?php echo base_url('files/media/'.$core_settings->header_logo);?>" alt="<?php echo $core_settings->site_name;?>"
                                 class="logo-default"  />
                        </a>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler"></a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            
                            
                            
                            <li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                                    <?php if( $this->user->image && file_exists( './files/profile/'.$this->user->id.'/'.$this->user->image ) ) {?>

                                        <img alt="" class="img-circle" src="<?php echo base_url('files/profile/'.$this->user->id.'/'.$this->user->image);?>">
                                     <?php } else {?>
                                        <img alt="" class="img-circle" src="<?php echo base_url('assets/layouts/layout/img/avatar.png');?>">
                                    <?php }?>
                                    <span class="username username-hide-mobile"><?php echo $this->session->userdata('username');?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="<?php echo site_url('admin/users/profile');?>">
                                            <i class="icon-user"></i> My Profile </a>
                                    </li>
                                    
                                    <li>
                                        <a href="<?php echo site_url('admin/auth/logout');?>">
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
                            <li class="menu-dropdown classic-menu-dropdown <?php echo ($menu == 'dashboard')?'active':'';?>">
                                <a href="<?php echo site_url('admin/dashboard');?>"> Dashboard
                                    <span class="arrow"></span>
                                </a>
                                
                            </li>

                            <?php if( $this->session->userdata('group_id') == 1 ){?>
                            
                            <li class="menu-dropdown classic-menu-dropdown <?php echo ($menu =='admin')?'active':'';?>">
                                <a href="javascript:;"> Admin
                                    <span class="arrow"></span>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li class="<?php echo (isset($menu_level_two) && $menu_level_two =='users')?'active':'';?>">
                                        <a href="<?php echo site_url('admin/users');?>" class="nav-link  "> Manage Users </a>
                                    </li>
                                    <li class="dropdown-submenu <?php echo (isset($menu_level_two) && $menu_level_two =='settings')?'active':'';?>">
                                        <a href="javascript:;" class="nav-link  "> Settings </a>
                                        <ul class="dropdown-menu pull-left">
                                        	<li class="<?php echo (isset($submenu) && $submenu =='general_settings')?'active':'';?>">
                                                <a href="<?php echo site_url('admin/settings');?>" class="nav-link "> General  Settings </a>
                                            </li>
                                            <li class="<?php echo (isset($submenu) && $submenu =='backup')?'active':'';?>">
                                                <a href="<?php echo site_url('admin/settings/backup');?>" class="nav-link  "> Backup  </a>
                                            </li>
                                            <li class="<?php echo (isset($submenu) && $submenu =='email_templates')?'active':'';?>">
                                                <a href="<?php echo site_url('admin/settings/templates');?>" class="nav-link  "> Email Templates  </a>
                                            </li>
                                        </ul>
                                        
                                    </li>

                                    <li class="<?php echo (isset($menu_level_two) && $menu_level_two =='state')?'active':'';?>">
                                        <a href="<?php echo site_url('admin/state');?>" class="nav-link  "> State </a>
                                    </li>

                                    <li class="<?php echo (isset($menu_level_two) && $menu_level_two =='district')?'active':'';?>">
                                        <a href="<?php echo site_url('admin/district');?>" class="nav-link  "> District </a>
                                    </li>


                                    <li class="<?php echo (isset($menu_level_two) && $menu_level_two =='edu_category')?'active':'';?>">
                                        <a href="<?php echo site_url('admin/edu_category');?>" class="nav-link  "> Education Category </a>
                                    </li>

                                    <li class="<?php echo (isset($menu_level_two) && $menu_level_two =='edu_category_list')?'active':'';?>">
                                        <a href="<?php echo site_url('admin/edu_category_list');?>" class="nav-link  "> Education List </a>
                                    </li>

                                    <li class="<?php echo (isset($menu_level_two) && $menu_level_two =='occ_category')?'active':'';?>">
                                        <a href="<?php echo site_url('admin/occ_category');?>" class="nav-link  "> Occupational Category </a>
                                    </li>

                                    <li class="<?php echo (isset($menu_level_two) && $menu_level_two =='occ_category_list')?'active':'';?>">
                                        <a href="<?php echo site_url('admin/occ_category_list');?>" class="nav-link  "> Occupational List </a>
                                    </li>

                                    
                                </ul>
                            </li>

                            

                            <?php } ?>

                        </ul>
                    </div>
                    <!-- END MEGA MENU -->
                </div>
            </div>
            <!-- END HEADER MENU -->
        </div>
        <div class="page-container">