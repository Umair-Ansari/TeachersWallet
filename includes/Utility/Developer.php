<script type="text/javascript">
var newwindow;
function a(url)
{
	newwindow=window.open(url,'name','height=120,width=440');
	if (window.focus) {newwindow.focus()}
}
function b(url)
{
	newwindow=window.open(url,'name','height=800,width=800');
	if (window.focus) {newwindow.focus()}
}
</script>
<div style='position: absolute;bottom: 0px;width: 22%;'>
	<div class='nav_left' >
		<a href="javascript:b('contact.php');">
			<div class='item_nav_left'>Contact Developers</div>
			<div class='icon_nav_left' style='float:right;'><span class='contact' style='float:right'></span></div>
		</a>
	</div>
	<div class='nav_left'>
		<a href="javascript:a('about.php');">
			<div class='item_nav_left'>About</div>
			<div class='icon_nav_left' style='float:right;'><span class='error'></span></div>
		</a>
	</div>
</div>
