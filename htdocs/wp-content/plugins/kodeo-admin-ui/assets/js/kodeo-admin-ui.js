var init_kaui_post_sorting, enable_kaui_post_sorting, disable_kaui_post_sorting, fixHelper;

jQuery(document).ready(function($) {
    var $body = $('body');
    var admin_theming = $body.hasClass('kodeo-admin-ui-theme');
    var login_page = $body.hasClass('login');

    // Login Page
    if(login_page) {
        $('#user_login').attr('placeholder', l10n.login);
        $('#user_pass').attr('placeholder', l10n.pass);

    // Admin Area
    } else {
        if(admin_theming) {
            // Expand menu when it is hidden
            $('#wp-admin-bar-kodeo-menu-expand').on('click', function() {
                $('#collapse-button').trigger('click');
        	});

            // Expand submenus directly on hover or click
            var auto_collapse = $body.hasClass('auto-collapse-submenus');
            var mobile = window.innerWidth <= 782;
            if(auto_collapse) {
                if(mobile) {
                    $("a.wp-has-submenu").parent().on('click', function(e) {
                        $(this).toggleClass('open');
                    });
                } else {
                    $("a.wp-has-submenu").parent().on('mouseenter', function(e) {
                        $(this).addClass('open');
                    });
                    $("a.wp-has-submenu").parent().on('mouseleave', function(e) {
                        $(this).removeClass('open');
                    });
                }
            }
            $("a.wp-has-submenu").on('click', function(e) {
                e.preventDefault();
                if(!auto_collapse) $(this.parentNode).toggleClass('open');
            });

            $('#menu-comments.comments-disabled>a').on('click', function(e) {e.preventDefault(); return false;});

            if($('#preview-action').length !== 1) {
                $('#submitdiv .inside').css('paddingTop', '68px');
            }
        }

        /* - TOOLBAR - */

        /* - - Screen Options and Help - - */

        // Reset default Screen Options and Help behaviour
        $('#show-settings-link').text(l10n.screenOptions);
        var $wp43plus = $('#show-settings-link').length;

        if($body.hasClass('help-screen-options-modal') && admin_theming) {
            window.screenMeta = { init: function() {} };

            if($wp43plus) {
                // WP 4.3+
                $('#show-settings-link').on('click', function() {
                    tb_show(l10n.screenOptions, '#TB_inline?inlineId=screen-options-wrap');
                });
                $('#contextual-help-link').on('click', function() {
                    tb_show(l10n.help, '#TB_inline?inlineId=contextual-help-wrap');
                });
            } else {
                // Pre WP 4.3
                $('.screen-meta-toggle a').each( function() {
                    var $this = $( this ).addClass( 'thickbox' );
                    var width = 600;
                    var height = 400;
                    var target = $this.attr( 'href' ).substring( 1 );
                    $this.attr( 'href', '#TB_inline?width=' + width + '&height=' + height + '&inlineId=' + target );

                    if ( $this.is( $( '#show-settings-link' ) ) ) {
                        $this.attr( 'title', l10n.screenOptions );
                    }
                    if ( $this.is( $( '#contextual-help-link' ) ) ) {
                        $this.attr( 'title', l10n.help );
                    }
                });
            }
        } else {
            // WP 4.3+
            if($wp43plus) {
                $('#show-settings-link').on('click', function() {
                    var state = $('#contextual-help-link').prop('disabled');
                    $('#contextual-help-link').prop('disabled', !state);
                });
                $('#contextual-help-link').on('click', function() {
                    var state = $('#show-settings-link').prop('disabled');
                    $('#show-settings-link').prop('disabled', !state);
                });
            }
        }

        $('#screen-meta-links').css({
            'position': $body.hasClass('fixed-admin-toolbar') ? 'fixed' : 'absolute',
            'right': $('#wp-admin-bar-top-secondary').width()-2
        });

        /* - - Search Bar - - */

        if($body.hasClass('toolbar-search') && admin_theming && location.pathname !==
    "/wp-admin/theme-install.php") {
            var move_search_form = function(search_form) {
                search_form.hide();
                $("<li id='wp-admin-bar-search-form' class='menupop'><form method='get' id='kodeo-search-form'>" + search_form.html() + "</form></li>").appendTo("#wp-admin-bar-root-default");
                $('#kodeo-search-form input[type=search]').attr("placeholder", l10n.searchPlaceholder );
                if($('#kodeo-search-form input[type=submit]').length < 1) {
                    $('<input type="submit" class="button" value=" ">').appendTo('#kodeo-search-form');
                }
                search_form.siblings("input[type=hidden]").clone().appendTo("#kodeo-search-form");
            };

            var search_form = $('#posts-filter div.search-form');
            if( search_form.length < 1) {
                var wp_filter = $('div.wp-filter div.search-form');
                if(wp_filter.length < 1) {
                    var search_box = $("p.search-box");
                    if(search_box.length > 0) {
                        search_form = search_box;
                    } else if($('#wp-media-grid').length > 0) {
                        $('#media-search-input').ready(function() {
                           move_search_form($('div.wp-filter div.search-form'));
                        });
                        search_form = false;
                    } else {
                        search_form = false;
                    }
                } else {
                    search_form = wp_filter;
                }
            }

            if ( search_form !== false ) {
                move_search_form(search_form);
            }
        }


        /* - - Toolbar Notifications - - */

        if($body.hasClass('toolbar-notifications') && ! $body.hasClass( 'mobile' ) && admin_theming) {
            var $toolbar_item = $( '#wp-admin-bar-kodeo-toolbar-notifications' );
            var $submenu = $toolbar_item.find( '.ab-submenu' );
            var $alerts = $('#update-nag, .update-nag, .notice, .notice-success, .updated, .settings-error, .error, .notice-error, .notice-warning, .notice-info')
    			.not('.inline, .theme-update-message, .hidden, .hide-if-js');
            //var greens = [ 'updated', 'notice-success' ];
    		var reds = [ 'error', 'notice-error', 'settings-error', 'notice-warning' ];
    		//var blues = [ 'update-nag', 'notice', 'notice-info', 'update-nag' ];
            var important_flag = false;
            var counter = 0;

            $alerts.each(function(number, element) {
                if(element.innerHTML.trim().length < 1) {
                    return true;
                }
                var $alert = $( this );

                // Determine the priority
    			var j;
    			var priority = 'neutral';
    			// Red
    			for ( j = 0; j < reds.length; j += 1 ) {
    				if ( $alert.hasClass( reds[ j ] ) ) {
    					if ( ! $alert.hasClass( 'updated' ) ) { // Because of .settings-error.updated
    						priority = 'important';
    						if ( ! important_flag ) {
    							$toolbar_item.addClass( 'important' );
    							important_flag = true;
    						}
    					}
    				}
    			}

                var $new_item = $( '<li><div class="ab-item ab-empty-item notification-' + priority + '"></div></li>' ).appendTo( $submenu );
                $new_item.children('div:first').append( $alert.html() );

    			counter += 1;
            });
            if(counter > 0) {
                $alerts.remove();
                $toolbar_item.show();
                $('#kodeo-notification-count').text(counter);
            }
        }

    }
});
