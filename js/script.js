(function( $ ) {
	$( document ).ready( function() {
		/*
		 **journalism-top-menu
		 */
		/* slide for multilevel lists */
		$( '.header-menu li' ).mouseenter( function() {
			/*we get rest space from current sub menu to right side of window */
			var windowWidth      = $( window ).width();
			var parentWidth      = $( this ).width();
			var offset           = $( this ).offset();
			var parentLeftOffset = offset.left;
			var restSpace        = windowWidth - parentLeftOffset - parentWidth;
			/* displaying next sub menu right or left of the previous sub menu */
			if ( restSpace < 218 && ($( this ).parent().hasClass( 'sub-menu' ) || $( this ).parent().hasClass( 'children' ) ) ) {
				$( this ).children( 'ul' ).css( 'marginLeft', '-216px' );
			}
			$( this ).children( 'ul' ).slideToggle( 10 );
		} ).mouseleave( function() {
			$( this ).children( 'ul' ).slideToggle( 10 );
		} );

		$( '.journalism-top-menu' ).css( { 'overflow': 'hidden' } );
		$( '.header-menu li ul' ).parent().mouseenter( function() {
			$( '.journalism-top-menu' ).css( { 'overflow': 'visible' } );
		} ).mouseleave( function() {
			$( '.journalism-top-menu' ).css( { 'overflow': 'hidden' } );
		} );

		$( '.header-menu li ul li:last-child a' ).parent().css( { 'border': '0px none' } );
		$( '.header-menu li a' ).mouseenter( function() {
			$( this ).css( { 'color': '#8c8f90' } );
		} ).mouseleave( function() {
			$( this ).css( { 'color': '#FFF' } );
		} );

		$( '.journalism-sub' ).on( 'mousedown', function( e ) {
			$( '.journalism-sub' ).data( 'mouseDown', true );
		} );
		$( '.journalism-sub' ).on( 'mouseup', function( e ) {
			$( '.journalism-sub' ).data( 'mouseDown', false );
		} );

		$( '.journalism-sub' ).css( { 'opacity': 0 } );
		$( '.journalism-sub' ).removeClass( 'journalism-submit' );
		$( '#search' ).removeClass( 'text' );
		$( '.widget .journalism-search-wrap:first-child' ).parent().css( {
			backgroundColor: '#181E21',
			paddingBottom:   '0px',
			paddingTop:      '0px'
		} );

		/*
		 **select
		 */
		$( 'select' ).addClass( 'journalism-selectbox' );
		$( '.journalism-selectbox' ).wrap( '<div class="journalism-selectdiv">' );
		$( '.journalism-selectdiv' ).append( '<span class="sel-styled-inner"></span>' );
		$( '.journalism-selectdiv' ).append( '<div class="journalism-select-content-open"></div>' );

		$( '.journalism-selectdiv' ).each( function() {
			if ( $( this ).find( 'optgroup' ).length > 0 ) {
				$( this ).find( 'optgroup' ).each( function() {
					$( this ).closest( '.journalism-selectdiv' ).find( '.journalism-select-content-open' ).append( '<div class="journalism-sel-optgroup">' + $( this ).attr( 'label' ) + '</div>' );
					$( this ).find( 'option' ).each( function() {
						if ( $( this ).attr( 'disabled' ) ) {
							$( this ).closest( '.journalism-selectdiv' ).find( '.journalism-select-content-open' ).append( '<div class="journalism-sel-opt-dis">' + $( this ).text() + '</div>' );
						} else {
							$( this ).closest( '.journalism-selectdiv' ).find( '.journalism-select-content-open' ).append( '<div class="journalism-sel-opt">' + $( this ).text() + '</div>' );
						}
					} );
				} );
			} else {
				$( this ).find( 'option' ).each( function() {
					if ( $( this ).attr( 'disabled' ) ) {
						$( this ).closest( '.journalism-selectdiv' ).find( '.journalism-select-content-open' ).append( '<div class="journalism-sel-opt-dis">' + $( this ).text() + '</div>' );
					} else {
						$( this ).closest( '.journalism-selectdiv' ).find( '.journalism-select-content-open' ).append( '<div class="journalism-sel-opt">' + $( this ).text() + '</div>' );
					}
				} );
			}
		} );

		$( 'body' ).on( 'click', function( e ) {
			var elem;
			if ( $( e.target ).hasClass( 'journalism-selectdiv' ) ) {
				elem = e.target;
			} else if ( $( e.target ).closest( '.journalism-selectdiv' ).length > 0 ) {
				elem = $( e.target ).closest( '.journalism-selectdiv' );
			} else {
				elem = false;
			}
			if ( elem && !$( elem ).find( '.journalism-select-content-open' ).is( ':visible' ) ) {
				$( this ).find( '.journalism-select-content-open' ).slideUp();
				$( elem ).find( '.journalism-select-content-open' ).slideDown();
			} else {
				$( this ).find( '.journalism-select-content-open' ).slideUp();
			}
		} );

		$( '.journalism-selectdiv' ).on( 'click', '.journalism-sel-opt', function() {
			$( this ).closest( '.journalism-selectdiv' ).find( '.journalism-seltext' ).text( $( this ).text() );
			$( this ).closest( '.journalism-selectdiv' ).find( '.journalism-selectbox' ).val( $( this ).text() );
			$( this ).closest( '.journalism-selectdiv' ).find( 'select' ).find( 'option' ).removeAttr( 'selected' );
			$( this ).closest( '.journalism-selectdiv' ).find( 'select' ).find( 'optgroup, option' ).eq( $( this ).index() ).attr( 'selected', 'selected' ).trigger( 'change' );
		} );
		$( '.journalism-selectbox' ).each( function() {
			$( this ).closest( '.journalism-selectdiv' ).append( '<span class="journalism-seltext">' + $( this ).val() + '</span>' );
			if ( $( this ).find( 'option[selected]' ).length > 0 ) {
				$( this ).closest( '.journalism-selectdiv' ).find( '.journalism-seltext' ).text( $( this ).find( 'option[selected]' ).text() );
			} else {
				$( this ).closest( '.journalism-selectdiv' ).find( '.journalism-seltext' ).text( $( this ).find( 'option:first' ).text() );
			}
		} );

		/*
		 **checkbox
		 */
		$( 'input[type="checkbox"]' ).each( function() {
			var $this  = $( this );
			var $label = $( 'label[for="' + $this.attr( 'id' ) + '"]' );
			if ( $label.length > 0 ) {//this input has a label associated with it
				$label.after( '<div class="clear"></div>' );
			}
		} );
		$( 'input[type="checkbox"]' ).addClass( 'check1' );
		$( '.check1' ).wrap( '<div class="journalism-chek">' );
		$( '.journalism-chek' ).click( function() {
			//Reads the value of the selected item
			if ( $( this ).attr( 'class' ) == 'journalism-chek' ) {
				$( this ).addClass( 'active' );
			} else {
				$( this ).removeClass( 'active' );
			}
		} );
		$( 'input[type=checkbox]' ).css( { 'opacity': 0 } );
		$( 'input[type=checkbox]' ).css( { 'cursor': 'pointer' } );
		$( '.journalism-chek' ).wrap( '<div class="clear"></div>' );

		/*
		 **journalism-radio
		 */
		$( 'input[type="radio"]' ).each( function() {
			var $this  = $( this );
			var $label = $( 'label[for="' + $this.attr( 'id' ) + '"]' );
			if ( $label.length > 0 ) {//this input has a label associated with it
				$label.after( '<div class="clear"></div>' );
			}
		} );
		$( 'input[type="radio"]' ).addClass( 'radio1' );
		$( '.radio1' ).wrap( '<div class="journalism-radio">' );
		$( '.journalism-radio' ).click( function() {
			//Reads the value of the selected item
			$( '.journalism-radio' ).removeClass( 'active' );
			//remove all of the selection
			if ( $( this ).attr( 'class' ) == 'journalism-radio' ) {
				$( this ).addClass( 'active' );
			}
			else {
				$( this ).removeClass( 'active' );
				$( this ).find( 'input' ).removeAttr( 'checked' );
			}
		} );
		$( 'input[type=radio]' ).css( { 'cursor': 'pointer' } );
		$( 'input[type=radio]' ).css( { 'opacity': 0 } );
		$( '.journalism-radio' ).wrap( '<div class="clear"></div>' );

		/*
		 **file input
		 */
		$( 'input[type="file"]' ).css( { 'opacity': 0 } ).wrap( '<div class="journalism-file"></div>' );
		$( '.journalism-file' ).wrap( '<div class="journalism-blok-file"></div>' );
		$( '.journalism-file' ).append( '<div class="journalism-text-file"></div>' );
		$( '.journalism-file' ).after( '<span class="journalism-file-text"></span>' );
		$( '.journalism-text-file' ).html( journalismStringJs.chooseFile );
		$( '.journalism-file-text' ).text( journalismStringJs.fileNotSel );
		$( 'input[type="file"]' ).on( 'change', function() {
			var path = $( this )[ 0 ].files[ 0 ][ 'name' ];
			if ( path ) {
				$( this ).siblings( '.journalism-text-file' ).text( path );
				$( this ).parent().siblings( '.journalism-file-text' ).text( journalismStringJs.fileSel );
			} else {
				$( this ).siblings( '.journalism-text-file' );
				$( this ).parent().siblings( '.journalism-file-text' ).text( journalismStringJs.fileNotSel );
			}
		} );
		$( '.journalism-text-file' ).click( function() {
			$( this ).siblings( 'input[type="file"]' ).trigger( 'click' );
		} );

		/*
		 **clear
		 */
		$( 'input[type="reset"]' ).click( function() {
			$( 'input[type="text"]' ).each( function() {
				$( this ).val( '' );
			} );
			$( 'textarea' ).each( function() {
				$( this ).val( '' );
			} );
			$( 'select' ).each( function() {
				$( this ).val( '' );
				$( this ).children( 'option' ).removeAttr( 'selected' );
				$( this ).parent().children( '.journalism-seltext' ).text( $( this ).children( 'option:first' ).text() );
			} );

			$( 'input[type="radio"]' ).each( function() {
				$( this ).checked = false;
				if ( $( this ).parent().hasClass( 'active' ) ) {
					$( this ).parent().removeClass( 'active' );
					$( this ).removeAttr( 'active' );
				}
			} );
			$( 'input[type="checkbox"]' ).each( function() {
				if ( $( this ).parent().hasClass( 'active' ) ) {
					$( this ).parent().removeClass( 'active' );
					$( this ).removeAttr( 'active' );
				}
			} );
			$( 'input[type="file"]' ).each( function() {
				if ( $.browser.msie ) {
					$( this ).after( $( this ).clone( true ) ).remove();
					/* create clone for ie as val ( '' )  doesn't work in it  */
				} else {
					$( this ).val( '' );
				}
				$( '.journalism-file-text' ).text( journalismStringJs.fileNotSel );
				$( '.journalism-text-file' ).text( journalismStringJs.chooseFile );
			} );
		} );

		/*
		 **input, tags
		 */
		$( '.journalism-form p' ).css( { 'clear': 'both' } );
		$( 'input[type="submit"]' ).addClass( 'journalism-submit' );
		$( 'input[type="submit"]' ).addClass( 'journalism-submit' );
		$( 'input[type="reset"]' ).addClass( 'journalism-cler' );
		$( 'input[type="text"]' ).addClass( 'text' );
		$( 'input[type="password"]' ).addClass( 'text' );
		$( 'form' ).addClass( 'journalism-form' );
		$( '#search' ).removeClass( 'text' );

		/*
		 **pre
		 */
		$( 'pre' ).wrap( '<div class="journalism-greey"></div>' );
		$( '.reply' ).after( '<div class="clear"></div>' );

		/*
		 **blockquote
		 */
		$( 'blockquote' ).children( 'p' ).before( '<div class="joournal-blockquote-before"></div>' );
		$( '#ie7 blockquote' ).each( function() {
			'\"' + $( this ).children( 'p' ) + '\"';
		} );

		/*
		 **slides
		 */
		var size = $( '.slidesjs-slide' ).length;
		if ( size > 1 ) {
			$( '#slides' ).slidesjs( {
				width:  900,
				height: 218,
				play:   {
					active:   true,
					auto:     true,
					interval: 4000,
					swap:     true
				}
			} );
		} else {
			$( '#slides' ).slidesjs( {
				width:  900,
				height: 218,
				play:   {
					active:   true,
					interval: 4000,
					swap:     true
				}
			} );
		}
		/*
		 **top animate
		 */
		$( '.journalism-top' ).click( function() {
			$( 'html' ).animate( {
					scrollTop: 0
				}, 800
			)
		} );
	} );
})( jQuery );