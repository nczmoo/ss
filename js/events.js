$(document).on('click', '.buy', function(e){
	let id = e.target.id.split('-')[1];
	$.post( "php/buy.php", { market_id: id })
	.done(function( data ) {
		console.log(data);

	});
});

$(document).on('click', '.menu', function(e){
	let id_name = e.target.id.split('-')[1];
	$(".window").addClass('d-none');
	$("#" + id_name ).removeClass('d-none');
	$(".menu").removeClass('active');
	$(e.target.id).addClass('active');
	
})

$(document).on('keyup', '.mine', function(e){
	if(e.key=='Enter'){
		updateMine(e.target.id);
	}
})

$(document).on('change', '.mine', function(e){
	updateMine(e.target.id);
})

$(document).on('keyup', '#NFTName', function(e){
	if(e.key=='Enter'){
		createNFT();
	}
})

$(document).on('keyup', '#NFTResell', function(e){
	if(e.key=='Enter'){
		createNFT();
	}
})


$(document).on('click', 'button', function(e){
  ui.refresh()
})
