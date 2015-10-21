/*global fwGoogleFonts, fwSwitchStylePanel*/
(function ($) {

	$(".open-close-panel").click(function () {
		if ($(this).parent('.wrap-style-panel').hasClass('closed')) {
			$(this).parent('.wrap-style-panel').removeClass('closed').addClass('open');
		}
		else {
			$(this).parent('.wrap-style-panel').removeClass('open').addClass('closed');
		}
		return false;
	});

	var switchPanel = function ($panel) {

		var blocks = JSON.parse($panel.find('ul.list-style').attr('data-blocks')),
			loadedGoogleFonts = [];

		(function init() {
			$panel.find('ul.list-style li a').on('click', applyStyle);

            if (fwUseCookie == true) {
                var presetName = getCookie(fwSwitchStylePanel['cache_key']);
                $panel.find('ul.list-style li a[data-key=' + presetName  +']').click();
            }
		})();

		function applyStyle(event) {
			var settings = $(event.target).data('settings'),
				selectors,
				css = '',
				blockSettings,
				tags = {
					typography: ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p'],
					links: ['links', 'links_hover'],
					colors: ['accent', 'accentColor']
				};

			for (var blockId in settings['blocks']) {
				if (settings['blocks'].hasOwnProperty(blockId)) {
					blockSettings = settings['blocks'][blockId];
					if (typeof blocks[blockId] === 'undefined' || typeof blocks[blockId]['elements'] !== 'object' || typeof blocks[blockId]['css_selector'] === 'undefined') {
						continue;
					}
					$.each(blockSettings, function (tag, tagSettings) {
						selectors = checkSelector(blocks[blockId]['css_selector']);

						if ($.inArray(tag, blocks[blockId]['elements']) !== -1) {
							if ($.inArray(tag, tags['typography']) !== -1) {
								css += generateTypographyCss(selectors, tag, tagSettings);
							}
							else if ($.inArray(tag, tags.links) !== -1) {
								css += generateLinksCss(selectors, tag, tagSettings);
							}
							else if ($.inArray(tag, tags.colors) !== -1) {
								css += generateAccentCss(tagSettings);
							}
							else if (tag === 'background') {
								css += generateBackgroundCss(selectors, tagSettings);
							}
						}
					});
				}
			}

            var data = $(event.target).attr('data-key');

            // set page style
            $('style[data-rel="' + fwSwitchStylePanel['cache_key'] + '"]').remove();
            $panel.after('<style data-rel="' + fwSwitchStylePanel['cache_key'] + '" type="text/css">' + css + '</style>');

            // save cookie for demo mode
            if (fwUseCookie == true) {
                setCookie(fwSwitchStylePanel['cache_key'], data);
            } else if (fwIsAdmin == true) {
                // save data
                jQuery.ajax({
                    url: ajax_path,
                    type: 'POST',
                    data: {
                        action: 'save_style',
                        style: data
                    },
                    dataType: 'json',
                    success: function (response) {
                    }
                });
            }

			return false;
		}

		function generateTypographyCss(selectors, tag, options) {
			var css = '', style, weight, variants;

			$.each(selectors, function (index, selector) {
				css += selector + ' ' + tag + '{';
				if (typeof options['size'] === 'number') {
					css += 'font-size: ' + options['size'] + 'px;'
				}
				if (typeof options['color'] === 'string' && isValidColor(options['color'])) {
					css += 'color: ' + options['color'] + ';'
				}
				if (typeof options['style'] === 'string') {
					style = (/italic/i.test(options['style'])) ? 'italic' : 'normal';
					weight = (parseInt(options['style'])) ? parseInt(options['style']) : '400';
					css += 'font-style: ' + style + ';' + 'font-weight: ' + weight + ';';
				}
				if (typeof options['family'] === 'string') {
					if (fwGoogleFonts.hasOwnProperty(options['family']) && $.inArray(options['family'],
							loadedGoogleFonts) === -1) {
						variants = fwGoogleFonts[options['family']]['variants'].join(',');
						$('head').append('<link href="http://fonts.googleapis.com/css?family=' + options['family'].split(' ').join('+') + ':' + variants + '" rel="stylesheet" type="text/css">');
						loadedGoogleFonts.push(options['family']);
					}
					css += 'font-family: ' + options['family'];
				}
				css += '}';
			});

			return css;
		}

		function generateLinksCss(selectors, tag, color) {
			var css = '';

			tag = (tag === 'links') ? 'a' : 'a:hover';

			$.each(selectors, function (index, selector) {
				if (typeof color === 'string' && isValidColor(color)) {
					css += selector + ' ' + tag + '{';
					css += 'color: ' + color + ';';
					css += '}';
				}
			});

			return css;
		}

		function generateAccentCss(color){
			var css = '';
			var selectors = [
				'a.button, .contact-form input[type=submit] { background-color: {color};}',
				'a.button:active, a.button:hover, .contact-form input[type=submit]:active, .contact-form input[type=submit]:hover {background-color: {color};}',
				'a.button.button-inverted {color: {color} !important; border-color: {color} !important;}',
				'.button {background-color: {color};}',
				'.button:active, .button:hover {background-color: {color};}',
				'.button.button-inverted {color: {color} !important; border-color: {color} !important;}',
				'.button.button-inverted a{color: {color} !important; border-color: {color} !important;}',
				'.nav-menu-hiddens {border-top-color: {color} !important;}',
				'.sub-menu {border-top-color: {color} !important;}',
				'.unordered li:before {color: {color};}',
				'.ordered li:before {color: {color};}',
				'.nav-menu .sub-menu li a:hover:before{border-color: transparent transparent transparent {color};}',
				'.fw-testimonials .fw-testimonials-pagination a.selected {background-color: {color};}',
				'.fw-accordion .fw-accordion-title.ui-state-active {color: {color};}',
				'.fw-accordion .fw-accordion-title.ui-state-active:after {color: {color};}',
				'.nav-dots .item.active {background-color: {color};}',
				'.latest-blog-post .thumb-container .date .item.day {color: {color};}',
				'.latest-blog-post .thumb-container .date:before {  border-color: #fff {color} {color} #fff;}',
				'.fw-team-member-image.active{  box-shadow: 0 0 0 7px {color}, 0 0 0 1px #e5e5e5;}',
				'.fw-subscribe-content:before{color: {color}; }',
				'.portfolio-tabs .item.active {background-color: {color}; }',
				'.portfolio-tabs .item.active:after {  border-color: {color} transparent transparent transparent;}',
				'.fw-pricing .fw-package-wrap.highlight-col .fw-heading-row {background: {color}}',
				'.fw-package .fw-pricing-row span {color: {color}; }',
				'.btn-group button[data-calendar-nav] {color: {color}; }',
				'.cal-day-today {background-color: {color}; }',
				'.cal-month-day:hover span.pull-left {color: {color}; !important;}',
				'a:hover{color: {color};}',
				'.mightyslider_carouselSimple_skin .mSButtons, .mightyslider_carouselSimple_skin .mSButtons:hover {background-color: {color}}'
			];

			if (typeof color === 'string' && isValidColor(color)) {
				$.each(selectors, function(index, selector){
					css += selector.replace(/\{color\}/g, color);
				});
			}
			return css;
		}

		function generateBackgroundCss(selectors, options) {
			var css = '', fallback = '', bgImageCss = '';
			$.each(selectors, function (index, selector) {
				css += selector + '{';
				if (options['background-image']['choices'][options['background-image']['value']]['css'].hasOwnProperty('background-image')) {
					bgImageCss += options['background-image']['choices'][options['background-image']['value']]['css']['background-image'];
					fallback += 'background-image: ' + options['background-image']['choices'][options['background-image']['value']]['css']['background-image'] + ';';
					if (options['background-image']['choices'][options['background-image']['value']]['css'].hasOwnProperty('background-repeat')) {
						bgImageCss += ' ' + options['background-image']['choices'][options['background-image']['value']]['css']['background-repeat'];
						fallback += 'background-repeat: ' + options['background-image']['choices'][options['background-image']['value']]['css']['background-repeat'] + ';';
					}
					bgImageCss += ', ';
				}

				css += 'background-color: ' + options['background-color']['primary'] + ';' + fallback;
				css += 'background: ' + bgImageCss + '-webkit-gradient(linear, left top, right top, from(' + options['background-color']['primary'] + '), to(' + options['background-color']['secondary'] + '));';
				css += 'background: ' + bgImageCss + '-webkit-linear-gradient(left, ' + options['background-color']['primary'] + ', ' + options['background-color']['secondary'] + '); ';
				css += 'background: ' + bgImageCss + '-moz-linear-gradient(left, ' + options['background-color']['primary'] + ', ' + options['background-color']['secondary'] + ');';
				css += 'background: ' + bgImageCss + '-ms-linear-gradient(left, ' + options['background-color']['primary'] + ', ' + options['background-color']['secondary'] + ');';
				css += 'background: ' + bgImageCss + '-o-linear-gradient(left, ' + options['background-color']['primary'] + ', ' + options['background-color']['secondary'] + ');';

				for (var i in options['background-image']['choices'][options['background-image']['value']]['css']) {
					if (!options['background-image']['choices'][options['background-image']['value']]['css'].hasOwnProperty(i)) {
						continue;
					}
					if (i !== 'background-image' && index !== 'background-repeat') {
						css += i + ': ' + options['background-image']['choices'][options['background-image']['value']]['css'][i] + ';';
					}
				}
				css += '}';
			});

			return css;
		}

		function setCookie(c_name, value) {
			var exdays = 365, exdate = new Date();
			exdate.setDate(exdate.getDate() + exdays);
			var c_value = value + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString() + "; path=/;");
			document.cookie = c_name + "=" + c_value;
		}

        function getCookie(c_name) {
            var matches = document.cookie.match(new RegExp(
                "(?:^|; )" + c_name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        }

		function checkSelector(selector) {
			if (typeof selector === 'string') {
				selector = [ selector ]
			}
			return selector;
		}

		function isValidColor(str) {
			return str.match(/^#[a-f0-9]{6}$/i) !== null;
		}
	};

	switchPanel($('.wrap-style-panel'));

})(jQuery);
