<!DOCTYPE HTML lang="en">
<head>
    <title>Junior General Home Page</title>
    <meta name="description" content="Promoting the use of historical simulations as a tool for teaching history.  Free resources anyone can use.">
    <title>Junior General</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="Public">
    <meta http-equiv="Cache-Control" content="max-age=5000">
    <meta http-equiv="expires" content="0" />
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.0.4/css/bootstrap-combined.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/juniorgeneral/css/jg.css">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.0.4/js/bootstrap.min.js"></script>
</head>
<body data-spy="scroll">

    <div class="navbar navbar-inverse navbar-fixed-top">

        <div class="navbar-inner">
            <a class="brand" href="https://juniorgeneral.org">JuniorGeneral.org</a>
            <div class="container">

                <ul class="nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="jg_tweleve"></i>Paper Soldiers
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url(); ?>index.php/figure/figureList/masters">Masters</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/figure/figureList/ancient">Ancients</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/figure/figureList/medieval">Medieval</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/figure/figureList/renaissance">Renaissance</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/figure/figureList/18thcentury">18th Century</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/figure/figureList/19thcentury">19th Century</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/figure/figureList/early20th">Early 20th</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/figure/figureList/ww2">WW2</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/figure/figureList/coldwar">Cold War</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/figure/figureList/modern">Modern</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/figure/figureList/topdowns">Top-downs</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/figure/figureList/nonhistorical">Non-Historical</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/scenario/"><i class="jg_fourty"></i>Scenarios</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/article/"><i class="jg_nine"></i>Articles</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/links/"><i class="jg_eight"></i>Links</a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/pages/Junior-General/122810484457982/"><i class="jg_thirtyfour"></i>Facebook</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/user/"><i class="jg_thirtynine"></i>
                            <?php
                            if (!defined('JGLOGGEDIN')): echo 'Login';
                            else: echo 'Dashboard';
                            endif;
                            ?>

                        </a>
                    </li>
                    <?php
                    if (defined('JGLOGGEDIN')):
                        ?>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/user/logout"><i class="jg_thirtyfive"></i>
                                Logout
                            </a>
                        </li>
                        <?php
                    endif;
                    ?>
                </ul>
                <form method="post" action="<?php echo base_url(); ?>index.php/search/searchItem/" class="navbar-search pull-left">
                    <input type="text" class="search-query" placeholder="Search" id="search" name="search">
                </form>
            </div>           
        </div>

    </div>
