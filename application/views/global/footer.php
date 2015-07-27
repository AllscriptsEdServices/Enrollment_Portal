<footer class='bottom-footer'>
	Allscripts Education Services
</footer>

<script>
	//$(".nav li.disabled a").click(function() {
	$(document).on('click', ".nav li.disabled a" , function() {   
	     return false;
	});
   
	$("#mainNav li").removeClass("active");		
	$("#"+<?php echo json_encode($activeTab) ?>).addClass('active');	
	
</script>

</body>

</html>