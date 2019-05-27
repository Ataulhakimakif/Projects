  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<!----WYSWING-->
	
	  <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
	  
	   <script src="js/dropzone.js"></script>
	  
	  <script src="js/scripts.js"></script>
	  
	  <script type="text/javascript">
      google.charts.load("current", {packages:["imagepiechart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Views',        <?php echo $session->count; ?>],
          ['Photos',     <?php echo Photo::count_all(); ?>],
          ['Comments',        <?php echo Comment::count_all(); ?>],
          ['Users',       <?php echo Users::count_all(); ?>]
          
        ]);
		
		
		
        var chart = new google.visualization.ImagePieChart(document.getElementById('chart_div'));

        chart.draw(data, {width: 430, height: 240, title: 'My Daily Activities'});
      }
    </script>


</body>

</html>
