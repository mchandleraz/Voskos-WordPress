<?php

// header.php
function frmwrk_wrap_before() { do_action('frmwrk_wrap_before'); }
function frmwrk_header_before() { do_action('frmwrk_header_before'); }
function frmwrk_header_inside() { do_action('frmwrk_header_inside'); }
function frmwrk_header_after() { do_action('frmwrk_header_after'); }

// 404.php, archive.php, front-page.php, index.php, loop-page.php, loop-search.php, loop-single.php,
// loop.php, page-custom.php, page-full.php, page.php, search.php, single.php
function frmwrk_content_before() { do_action('frmwrk_content_before'); }
function frmwrk_content_after() { do_action('frmwrk_content_after'); }
function frmwrk_main_before() { do_action('frmwrk_main_before'); }
function frmwrk_main_after() { do_action('frmwrk_main_after'); }
function frmwrk_post_before() { do_action('frmwrk_post_before'); }
function frmwrk_post_after() { do_action('frmwrk_post_after'); }
function frmwrk_post_inside_before() { do_action('frmwrk_post_inside_before'); }
function frmwrk_post_inside_after() { do_action('frmwrk_post_inside_after'); }
function frmwrk_loop_before() { do_action('frmwrk_loop_before'); }
function frmwrk_loop_after() { do_action('frmwrk_loop_after'); }
function frmwrk_sidebar_before() { do_action('frmwrk_sidebar_before'); }
function frmwrk_sidebar_inside_before() { do_action('frmwrk_sidebar_inside_before'); }
function frmwrk_sidebar_inside_after() { do_action('frmwrk_sidebar_inside_after'); }
function frmwrk_sidebar_after() { do_action('frmwrk_sidebar_after'); }

// footer.php
function frmwrk_footer_before() { do_action('frmwrk_footer_before'); }
function frmwrk_footer_before_copyright() { do_action('frmwrk_footer_before_copyright'); }
function frmwrk_footer_inside() { do_action('frmwrk_footer_inside'); }
function frmwrk_footer_after() { do_action('frmwrk_footer_after'); }
function frmwrk_footer() { do_action('frmwrk_footer'); }

?>