<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Biggie Vs. Tupac</title>
	<link rel="stylesheet" href="/includes/style.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container" id="wrapper">
		<div class="header">
			<h3>Biggie vs Tupac</h3>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-6" style="border-right: 1px #000 solid">
								<div style="float: left;">
									<button type="button" id="biggieButton" class="btn btn-default btn-lg btn-block" onclick="vote('biggie')">Biggie</button>
								</div>
								<div class="vote" style="float: right;">
									<span id='biggieCount'></span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="vote" style="float: left;">
									<span id='tupacCount'></span>
								</div>
								<div style="float: right;">
									<button type="button" id="tupacButton" class="btn btn-default btn-lg btn-block" onclick="vote('tupac')">Tupac</button>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="jumbotron">
			<img id="biggieImage" class="img-responsive" alt="Biggie" src="img/biggie.jpg"/ height="1024">
			<img id="tupacImage" class="img-responsive" alt="Tupac" src="img/tupac.jpg"/>
			<img id="tieImage" class="img-responsive" alt="Tie" src="img/tie.jpg"/>
		</div>

		<div class="footer">
			<p>&copy; <a href="http://dennisglasberg.com">Dennis Glasberg</a> <?php echo date("Y"); ?></p>
		</div>
	</div>
	<script type="text/javascript">
		$( document ).ready(function() {
		    loadData();
		});

		function loadData() {
			$.ajax({
				dataType: "json",
				url: '<?php echo base_url(); ?>votes/getCounts',
				success: function(json) {
					var bCount = parseInt(json['votes']['biggie']);
					var tCount = parseInt(json['votes']['tupac']);

					$('#biggieCount').text(bCount);
					$('#tupacCount').text(tCount);
					if (bCount > tCount){
						$('#biggieImage').show();
						$('#tupacImage').hide();
						$('#tieImage').hide();
					}
					else if (tCount > bCount) {
						$('#tupacImage').show();
						$('#biggieImage').hide();
						$('#tieImage').hide();
					}
					else {
						$('#tieImage').show();
						$('#tupacImage').hide();
						$('#biggieImage').hide();
						
					}
				}
			});
		}

		function vote(title) {
			$.ajax({
				type: "POST",
				url: '<?php echo base_url(); ?>votes/vote/',
				data: {'title': title,
					'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
				success: function() {
					$('#' + title + 'Button').toggleClass('btn-success');
					$('#biggieButton').prop('disabled', true);
					$('#tupacButton').prop('disabled', true);
					loadData();
				}
			});
		}
	</script>
</body>
</html>