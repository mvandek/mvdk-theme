<?php function piwiktracker() {
if( ! get_theme_mod( 'mvdk_piwik_site_id' ) ) {
return;
} else {
?>
<script>
var _paq=[['setSiteId', <?php echo esc_html( get_theme_mod( 'mvdk_piwik_site_id' ) ); ?>],['setTrackerUrl', 'http://stat.maartenvandekamp.nl/piwik.php'],['trackPageView'],['enableLinkTracking']];
(function(d){
var g=d.createElement('script'),
s=d.scripts[0];
g.src='//www.staticcdn.nl/piwik.js';
s.parentNode.insertBefore(g,s)}
(document))
</script>
<?php
}
}