</div>
</div>
</div>
<div class="row mt-2">
	<div class="col-lg-12 col-sm-12 text-center"><?php echo SC_NAME; ?> Install Wizard. Script by <a href="//smartyscripts.com" target="_blank">SmartyScripts</a></div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript">
	$(document).ready(function () {
		// get current URL path and assign 'active' class
		var url = window.location+'';
		var pathname = window.location.pathname;
		var homeurl = url.split('/',3)[2];
		var install = url.split('/')[3];
		var base = url.split('/',2)[0]+'//'+homeurl+'/'+install;
		var activeurl = pathname.split('/')[2];
		if(activeurl){
			$('.stepsmenu > a[href="'+base+'/'+activeurl+'"]').addClass('active');
		}else{
			$('.stepsmenu > a[href="'+base+'"]').addClass('active');
		}
	});
</script>

</body>
</html>
