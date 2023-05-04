class UI{

  constructor(){
    
  }
  
  
  refresh(){
	this.loadAssets();
	this.loadNFTs();
	this.loadCrypto();
	this.loadMarket();
  }
  
  	 loadAssets(){
	$.get( "php/assets.php", )
	  .done(function( data ) {
		$("#assets").html(data);
		
	  });
	}
	 loadNFTs(){  
	  $.get( "php/nfts.php", )
	  .done(function( data ) {
		$("#nft").html(data);
		
	  });
	}
  
   loadCrypto(){
		$.get( "php/crypto.php", )
	  .done(function( data ) {
		$("#crypto").html(data);
		
	  });
  }
    
	 loadMarket(){
		$.get( "php/market.php", )
			.done(function( data ) {
			$("#elons").html(data);
		
		});
	}
}
