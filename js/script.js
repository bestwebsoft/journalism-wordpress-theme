( function( $ ) {
	$( document ).ready( function() { 
/*
**journalism-top-menu
*/
		/* slide for multilevel lists */
		$( '.header-menu li' ).mouseenter( function() { 
			/*we get rest space from current sub menu to right side of window */
			var windowWidth = $( window ).width();
			var parentWidth = $( this ).width();
			var offset = $( this ).offset();
			var parentLeftOffset = offset.left;
			var restSpace = windowWidth - parentLeftOffset - parentWidth;
				/* displaying next sub menu right or left of the previous sub menu */
				if( restSpace < 218 && ($( this ).parent().hasClass( 'sub-menu' ) || $( this  ).parent().hasClass( 'children' ) ) ) {
					$( this ).children( 'ul' ).css( 'marginLeft', '-216px' );
				}
				$( this ).children( 'ul' ).slideToggle( 10 );
		}).mouseleave( function() {
			$( this ).children( 'ul' ).slideToggle( 10 );
		});

		$( '.journalism-top-menu' ).css({'overflow':'hidden'});
		$( '.header-menu li ul' ).parent().mouseover( function() { 
			$( '.journalism-top-menu' ).css({'overflow':'visible'});
		}).mouseout( function() {
			$( '.journalism-top-menu' ).css({'overflow':'hidden'});
		});

		$( '.header-menu li ul li:last-child a' ).parent().css({'border':'0px none'});
		$( '.header-menu li a' ).mouseover( function() {
			$( this ).css({'color':'#8c8f90'});
		}).mouseout( function() {
			$( this ).css({'color':'#FFF'});
		});

/*
**search
*/
		$( '.journalism-search-field' ).val( search );
		$( '.journalism-search-field' ).on( 'blur', function( e ){
			if( $( '.journalism-sub' ).data( 'mouseDown' ) != true ){
				$( '.journalism-search-field' ).val( search );
			}
		});
		$( '.journalism-sub' ).on( 'mousedown', function( e ){
			$( '.journalism-sub' ).data( 'mouseDown', true );
		});
		$( '.journalism-sub' ).on( 'mouseup', function( e ){
			$( '.journalism-sub' ).data( 'mouseDown', false );
		});

		$( '.journalism-sub' ).css( {'opacity':0} )
		$( '.journalism-sub' ).removeClass( 'journalism-submit' );
		$( '#search' ).removeClass( 'text' );
		$( '.widget .journalism-search-wrap:first-child' ).parent().css( {
			backgroundColor: '#181E21',
			paddingBottom: '0px',
			paddingTop: '0px'
		} );
		

/*
**select
*/
		$( 'select' ).addClass( 'journalism-selectbox' );
		$( '.journalism-selectbox' ).wrap( '<div class="journalism-selectdiv">' );
		$( '.journalism-selectdiv' ).append( '<span class="sel-styled-inner"></span>' );
		$( '.journalism-selectdiv' ).append( '<div class="journalism-select-content-open"></div>' );
		$( '.journalism-selectbox' ).children( 'option' ).each( function() {
			if( $( this ).attr( 'disabled' ) ){
				$( this ).parent().parent().children( '.journalism-select-content-open' ).append( '<div class="journalism-sel-opt-dis">'+$( this ).text()+'</div>' );
				}
			else{
				$( this ).parent().parent().children( '.journalism-select-content-open' ).append( '<div class="journalism-sel-opt" value="'+$( this ).val()+'">'+$( this ).text()+'</div>' );
				}
		});
		$( '.journalism-selectdiv' ).click( function(){
			$( this ).children( '.journalism-select-content-open' ).slideToggle( 700 );
			$( this ).children( '.journalism-select-content-open' ).children( '.journalism-sel-opt' ).click( function(){
				$( this ).parent().parent().children( '.journalism-seltext' ).text( $( this ).text() );
				$( this ).parent().parent().children( '.journalism-selectbox' ).val( $( this ).text() );
				var url = $( this ).attr( 'value' ); // get .sel_opt value
				if ( url.indexOf( 'http' )+1 ) { // require a URL
					window.location = url; // redirect
				};
				var domain =window.location.origin;
				if( url >= 3 ){
					window.location.href = domain + "?cat=" + url;
				};
			});
		}); 
		$( '.journalism-selectbox' ).each( function() {
			$( this ).parent().append( '<span class="journalism-seltext">'+$( this ).val()+'</span>' );
			$( '.journalism-seltext' ).text( 'select' );
		});

/*
**checkbox
*/
		$( 'input[type="checkbox"]' ).each( function() {
			$this = $( this );
			var $label = $( 'label[for="' + $this.attr( 'id' ) + '"]' );
			if ( $label.length > 0 ) {//this input has a label associated with it
				$label.after( '<div class="clear"></div>' );
			};
		});
		$( 'input[type="checkbox"]' ).addClass( 'check1' )
		$( '.check1' ).wrap( '<div class="journalism-chek">' );
			$( '.journalism-chek' ).click( function(){
			//Reads the value of the selected item
			if( $( this ).attr( 'class' )=='journalism-chek' ){
				$( this ).addClass( 'active' );
			}
			else{
				$( this ).removeClass( 'active' );
			}
		});
		$( 'input[type=checkbox]' ).css({'opacity': 0});
		$( 'input[type=checkbox]' ).css({'cursor':'pointer'});
		$( '.journalism-chek' ).wrap( '<div class="clear"></div>' );

/*
**journalism-radio
*/
		$( 'input[type="radio"]' ).each( function() {
			$this = $( this );
			var $label = $( 'label[for="' + $this.attr( 'id' ) + '"]' );
			if ( $label.length > 0 ) {//this input has a label associated with it
				$label.after( '<div class="clear"></div>' );
			};
		});
		$( 'input[type="radio"]' ).addClass( 'radio1' );
		$( '.radio1' ).wrap( '<div class="journalism-radio">' );
		$( '.journalism-radio' ).click( function(){
			//Reads the value of the selected item
			$( '.journalism-radio' ).removeClass( 'active' );
			//remove all of the selection
			if( $( this ).attr( 'class' )=='journalism-radio' ){
				$( this ).addClass( 'active' );
			}
			else{
				$( this ).removeClass( 'active' );
				$( this ).find( 'input' ).removeAttr( 'checked' );
			}
		});
		$( 'input[type=radio]' ).css({'cursor':'pointer'});
		$( 'input[type=radio]' ).css({'opacity': 0});
		$( '.journalism-radio' ).wrap( '<div class="clear"></div>' );

/*
**file input
*/
		$( 'input[type="file"]' ).css( {'opacity':0} ).wrap( '<div class="journalism-file"></div>' );
		$( '.journalism-file' ).wrap( '<div class="journalism-blok-file"></div>' );
		$( '.journalism-file' ).append( '<div class="journalism-text-file"></div>' );
		$( '.journalism-file' ).after( '<span class="journalism-file-text"></span>' );
		$( '.journalism-text-file' ).html( 'Choose file ...' );
		$( '.journalism-file-text' ).text( 'File is not selected.' );
		$( 'input[type="file"]' ).on( 'change', function() {
			var path = $( this ).val();
			if ( path ) {
				$( this ).siblings( '.journalism-text-file' ).text( path );
				$( this ).parent().siblings( '.journalism-file-text' ).text( 'File Selected' );
			} else {
				$( this ).siblings( '.journalism-text-file' );
				$( this ).parent().siblings( '.journalism-file-text' ).text( 'File is not selected.' );
			}
		});
		$( '.journalism-text-file' ).click( function() {
			$( this ).siblings( 'input[type="file"]' ).trigger( 'click' );
		});

/*
**clear
*/
		$( 'input[type="reset"]' ).click( function (){
			$( 'input[type="text"]' ).each( function(){$( this ).val( '' );} );
			$( 'textarea' ).each( function(){$( this ).val( '' );} );
			$( 'select' ).each( function(){ 
				$( this ).val( '' );
				$( '.journalism-seltext' ).text( 'Selected' ); 
			});
			$( 'input[type="radio"]' ).each( function(){
				$( this ).checked = false;
				if( $( this ).parent().hasClass( 'active' ) ){
					$( this ).parent().removeClass( 'active' );
					$( this ).removeAttr( 'active' );
				}
			});
			$( 'input[type="checkbox"]' ).each( function(){ 
				if( $( this ).parent().hasClass( 'active' ) ){
					$( this ).parent().removeClass( 'active' );
					$( this ).removeAttr( 'active' );
				}
			});
			$( 'input[type="file"]' ).each( function(){
				if ( $.browser.msie ) {
					$( this ).after( $( this ).clone( true ) ).remove(); /* create clone for ie as val ( '' )  doesn't work in it  */
				}
				 else {  
					$( this ).val( '' );
				}
				$( '.journalism-file-text' ).text( 'File is not selected.' );
				$( '.journalism-text-file' ).text( 'Choose file ...' );
			});
		});

/*
**input, tags
*/
		$( '.journalism-form p' ).css({'clear':'both'});
		$( 'input[type="submit"]' ).addClass( 'journalism-submit' );
		$( 'input[type="submit"]' ).addClass( 'journalism-submit' );
		$( 'input[type="reset"]' ).addClass( 'journalism-cler' );
		$( 'input[type="text"]' ).addClass( 'text' );
		$( 'input[type="password"]' ).addClass( 'text' );
		$( 'form' ).addClass( 'journalism-form' );
		$( '#search' ).removeClass( 'text' );
		$( '.post .journalism-top:first-child' ).css({'display':'none'});

/*
**pre
*/
		$( 'pre' ).wrap( '<div class="journalism-greey"></div>' );
		$( '.reply' ).after( '<div class="clear"></div>' );

/*
**blockquote
*/
		$( 'blockquote' ).children( 'p' ).before( '<div class="joournal-blockquote-before"></div>' );
		$( '#ie7 blockquote' ).each(  function() {
			'\"' + $(  this  ).children( 'p' ) + '\"';
		});

/*
**slides
*/		//alert("Число параграфов на странице: " + $("p").length);
		var size = $( '.slidesjs-slide' ).length;
		if( size > 1 ){
			$( '#slides' ).slidesjs({
				width: 900,
				height: 218,
				play: {
					active: true,
					auto: true,
					interval: 4000,
					swap: true
				}
			});
		}
		else{
			$( '#slides' ).slidesjs({
				width: 900,
				height: 218,
				play: {
					active: true,
					interval: 4000,
					swap: true
				}
			});
		}
/*
**top animate
*/
		$( '.journalism-top' ).click( function(){
			$( 'html' ).animate({
				scrollTop:0}, 800
			 )
		});
	});
})( jQuery );