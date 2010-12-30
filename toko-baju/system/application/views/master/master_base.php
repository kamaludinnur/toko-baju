<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <base href="<?php echo base_url(); ?>"/>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <link rel="stylesheet" type="text/css" href="colorbox.css" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/ddaccordion.js"></script>
        <script type="text/javascript" src="js/jquery.validity.pack.js"></script>
        <script type="text/javascript" src="js/jquery.colorbox.js"></script>
        <script type="text/javascript">
            ddaccordion.init({
                headerclass: "submenuheader", //Shared CSS class name of headers group
                contentclass: "submenu", //Shared CSS class name of contents group
                revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
                mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
                collapseprev: false, //Collapse previous content (so only one open at any time)? true/false
                defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
                onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
                animatedefault: false, //Should contents open by default be animated into view?
                persiststate: true, //persist state of opened contents within browser session?
                toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
                togglehtml: ["suffix", "<"+"img src='images/plus.gif' class='statusicon' />", "<"+"img src='images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
                animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
                oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
                    //do nothing
                },
                onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
                    //do nothing
                }
            })
        </script>
        <script src="js/jquery.jclock.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/jconfirmaction.jquery.js"></script>
        <script type="text/javascript" src="js/jquery.fastconfirm.js"></script>
        <script type="text/javascript">

            $(document).ready(function() {
                $('.ask').jConfirmAction();
            });

        </script>
        <script type="text/javascript">
            $(function($) {
                $('.jclock').jclock();
            });
        </script>
        <script type="text/javascript" src="js/jquery.uitablefilter.js"></script>
        <script type="text/javascript" src="js/jquery.cookies.js"></script>
        <script type="text/javascript" src="js/jquery.autocomplete.js"></script>

        <link rel="stylesheet" type="text/css" media="all" href="niceforms-default.css" />
        <link rel="stylesheet" type="text/css" media="all" href="jquery.fastconfirm.css" />

    </head>
    <body>

        <script type="text/javascript">

        function toggleSidebar(){

            if($.cookie('tokobaju_sidebar_isHidden') != 'yes' || $.cookie('tokobaju_sidebar_isHidden') == null){
                // hide it
                $('.left_content').animate({width:"0px"}, function(){
                    $('.right_content').css({width: '860px'});
                });
                $('#sidebar_toggler input').first().val("« Menu");
                $.cookie('tokobaju_sidebar_isHidden', 'yes', {exprires: 30, path: '/'});
            } else {
                // show it
                $('.right_content').css({width: '625px'});
                $('.left_content').animate({width:"195px"});
                $.cookie('tokobaju_sidebar_isHidden', 'no', {exprires: 30, path: '/'});
                $('#sidebar_toggler input').first().val("Menu »");
            }
        }

        <?php if ($this->uri->segment(3) != 'entri') : // preserve sidebar on product entry ?>

        $(document).ready(function(){
            if($.cookie('tokobaju_sidebar_isHidden') == 'yes'){
                $('.left_content').hide()
                $('.right_content').css({width: '860px'});
                $('#sidebar_toggler input').first().val("« Menu");
            }
        })

        <?php endif; ?>

        //setInterval("console.log('hidden? ' + $.cookie('tokobaju_sidebar_isHidden'))", 1000);
        
        </script>

        <div id="main_container">

            <div class="header">

                <?php $this->load->view('master/header'); ?>

            </div>

            <div class="main_content">

                <!--
                <div class="menu">

                <?php // $this->load->view('master/navigation'); ?>

                </div>
                -->

                <div class="center_content">



                    <div class="left_content">

                        <?php if (isset($custom_sidebar)) $this->load->view('master/' . $custom_sidebar); else $this->load->view('master/sidebar'); ?>

                    </div>

                    <div id="sidebar_toggler">
                        <input type="submit" name="submit" value="Menu &raquo;" class="button blue" title="Tampil/sembunyikan menu" onclick="toggleSidebar();" style="margin: 0px; padding: 0px 5px; font-size: 11px"/>
                    </div>

                    <div class="right_content">

                        <?php $this->load->view('master/' . $view_konten); ?>

                    </div><!-- end of right content-->


                </div>   <!--end of center content -->




                <div class="clear"></div>
            </div> <!--end of main content-->


            <div class="footer">

                <?php $this->load->view('master/footer'); ?>

            </div>

        </div>
    </body>
</html>