game = new Game()
ui = new UI()
ui.refresh()


  
  function createNFT(){
	if ($("#NFTName").length > 16 || $("#NFTName").val() == ""){		  
	 console.log('error');
	 return;
	}
	  
	if ($("#NFTResell").val() == "" || Number($("#NFTResell").val()) > 99 || Number($("#NFTResell").val()) < 0){
	 console.log('error'); 
	 return;
	}
	
	$.post( "php/nft-new.php", { NFTName: $("#NFTName").val() , resell: Number($('#NFTResell').val()) })
		.done(function( data ) {
			console.log(data);
	
		});
  }
  
  function updateMine(id){
	if (Number($("#" + id).val()) < 0){
		console.log('error');
		return;
	}
	$.post( "php/mine.php", { crypto_id: id.split('-')[1], 
		quantity: Number($("#" + id).val()) })
	.done(function( data ) {
	console.log(data);
		ui.loadCrypto();

	});  
  }