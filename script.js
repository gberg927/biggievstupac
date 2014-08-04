var bCountNew = 0;
var tCountNew = 0;

function loadData()
{
	//Example JSON
	//{"votes": {"biggie": 900, "tupac": 800}}
	/*
	var jsonURL = ""

	$.ajax({
		dataType: "json",
		url: jsonURL,
		data: data,
		success: function(json) {
			var bCount = parseInt(json['votes']['biggie']);
			var tCount = parseInt(json['votes']['tupac']);
		}
	});
	*/

	//this is just a frontend test
	json = JSON.parse('{"votes": {"biggie": 900, "tupac": 905}}');
	var bCount = parseInt(json['votes']['biggie']) + bCountNew;
	var tCount = parseInt(json['votes']['tupac']) + tCountNew;

	$('#biggieCount').text(bCount);
	$('#tupacCount').text(tCount);
	if (bCount > tCount){
		$('#jumboTitle').text('Biggie');
		$('#biggieImage').show();
		$('#tupacImage').hide();
		$('#tieImage').hide();
	}
	else if (tCount > bCount) {
		$('#jumboTitle').text('Tupac');
		$('#tupacImage').show();
		$('#biggieImage').hide();
		$('#tieImage').hide();
	}
	else {
		$('#jumboTitle').text("That shit's a tie!");
		$('#tieImage').show();
		$('#tupacImage').hide();
		$('#biggieImage').hide();
		
	}
}

function biggieVote()
{
	//call to add one to biggie,
	//on success, call loadData()
	bCountNew++;
	loadData();
}

function tupacVote()
{
	//call to add one to tupac,
	//on success, call loadData()
	tCountNew++;
	loadData();
}