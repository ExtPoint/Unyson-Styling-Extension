<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/** @var FW_Extension_Styling $styling */
$styling = fw()->extensions->get('styling');
$background_image = array(
	'value'   => 'none',
	'choices' => array(
		'none' => array(
			'icon' => $styling->locate_URI('/static/images/patterns/no_pattern.jpg'),
			'css'  => array(
				'background-image' => 'none'
			)
		),
		'bg-1' => array(
			'icon' =>  $styling->locate_URI('/static/images/patterns/diagonal_bottom_to_top_pattern_preview.jpg'),
			'css'  => array(
				'background-image'  => 'url("' .  $styling->locate_URI('/static/images/patterns/diagonal_bottom_to_top_pattern.png') . '")',
				'background-repeat' => 'repeat',
			)
		),
		'bg-2' => array(
			'icon' =>  $styling->locate_URI('/static/images/patterns/diagonal_top_to_bottom_pattern_preview.jpg'),
			'css'  => array(
				'background-image'  => 'url("' .  $styling->locate_URI('/static/images/patterns/diagonal_top_to_bottom_pattern.png') . '")',
				'background-repeat' => 'repeat',
			)
		),
		'bg-3' => array(
			'icon' =>  $styling->locate_URI('/static/images/patterns/dots_pattern_preview.jpg'),
			'css'  => array(
				'background-image'  => 'url("' .  $styling->locate_URI('/static/images/patterns/dots_pattern.png') . '")',
				'background-repeat' => 'repeat',
			)
		),
		'bg-4' => array(
			'icon' =>  $styling->locate_URI('/static/images/patterns/romb_pattern_preview.jpg'),
			'css'  => array(
				'background-image'  => 'url("' .  $styling->locate_URI('/static/images/patterns/romb_pattern.png') . '")',
				'background-repeat' => 'repeat',
			)
		),
		'bg-5' => array(
			'icon' =>  $styling->locate_URI('/static/images/patterns/square_pattern_preview.jpg'),
			'css'  => array(
				'background-image'  => 'url("' .  $styling->locate_URI('/static/images/patterns/square_pattern.png') . '")',
				'background-repeat' => 'repeat',
			)
		),
		'bg-6' => array(
			'icon' =>  $styling->locate_URI('/static/images/patterns/noise_pattern_preview.jpg'),
			'css'  => array(
				'background-image'  => 'url("' .  $styling->locate_URI('/static/images/patterns/noise_pattern.png') . '")',
				'background-repeat' => 'repeat',
			)
		),
		'bg-7' => array(
			'icon' =>  $styling->locate_URI('/static/images/patterns/vertical_lines_pattern_preview.jpg'),
			'css'  => array(
				'background-image'  => 'url("' .  $styling->locate_URI('/static/images/patterns/vertical_lines_pattern.png') . '")',
				'background-repeat' => 'repeat',
			)
		),
		'bg-8' => array(
			'icon' =>  $styling->locate_URI('/static/images/patterns/waves_pattern_preview.jpg'),
			'css'  => array(
				'background-image'  => 'url("' .  $styling->locate_URI('/static/images/patterns/waves_pattern.png') . '")',
				'background-repeat' => 'repeat',
			)
		),
	)
);

$styles = array(
	'blue' => array(
		'name'   => 'Blue',
		'icon'   =>  $styling->locate_URI('/static/images/blue_predefined_style.jpg'),
		'blocks' => array(
			'main_color'	=> array(
				'accent'			=> '#4eaade'
			),
			'header'  => array(
				'h1'          => array(
					'size'   => 18,
					'family' => 'Raleway',
					'style'  => 'regular',
					'color'  => '#666666'
				),
				'links'       => '#666666',
				'links_hover' => '#4eaade',
				'background'  => array(
					'background-color' => array(
						'primary'   => '#ffffff',
						'secondary' => '#ffffff'
					),
					'background-image' => $background_image,
				),
			),
			'content' => array(
				'h2'          => array(
					'size'   => 30,
					'family' => 'Raleway',
					'style'  => '500',
					'color'  => '#2b2b2b'
				),
				'h3'          => array(
					'size'   => 24,
					'family' => 'Raleway',
					'style'  => '500',
					'color'  => '#2b2b2b'
				),
				'h4'          => array(
					'size'   => 18,
					'family' => 'Raleway',
					'style'  => '500',
					'color'  => '#2b2b2b'
				),

				'h5'          => array(
					'size'   => 14,
					'family' => 'Raleway',
					'style'  => '500',
					'color'  => '#2b2b2b'
				),

				'h6'          => array(
					'size'   => 12,
					'family' => 'Raleway',
					'style'  => '500',
					'color'  => '#2b2b2b'
				),
				'p'           => array(
					'size'   => 14,
					'family' => 'Raleway',
					'style'  => '500',
					'color'  => '#666666'
				),
				'links'       => '#4eaade',
				'links_hover' => '#666666',
				'background'  => array(
					'background-color' => array(
						'primary'   => '#ffffff',
						'secondary' => '#ffffff'
					),
					'background-image' => $background_image,
				),
			),
			'aside-sidebar' => array(
				'h2'          => array(
					'size'   => 18,
					'family' => 'Raleway',
					'style'  => 'regular',
					'color'  => '#666666'
				),
				'links'       => '#666666',
				'links_hover' => '#4eaade',
				'background'  => array(
					'background-color' => array(
						'primary'   => '#ffffff',
						'secondary' => '#ffffff'
					),
					'background-image' => $background_image,
				),
			),
			'footer-sidebar' => array(
				'h2'          => array(
					'size'   => 18,
					'family' => 'Raleway',
					'style'  => 'regular',
					'color'  => '#ffffff'
				),
				'links'       => '#ffffff',
				'links_hover' => '#4eaade',
				'background'  => array(
					'background-color' => array(
						'primary'   => '#363f48',
						'secondary' => '#363f48'
					),
					'background-image' => $background_image,
				),
			),
			'footer'  => array(
				'p'          => array(
					'size'   => 14,
					'family' => 'Raleway',
					'style'  => 'regular',
					'color'  => '#6e7780'
				),
				'links'       => '#6e7780',
				'links_hover' => '#4eaade',
				'background'  => array(
					'background-color' => array(
						'primary'   => '#272e34',
						'secondary' => '#272e34'
					),
					'background-image' => $background_image,
				),
			)
		)
	),
	'black' => array(
		'name'   => 'Black',
		'icon'   =>  $styling->locate_URI('/static/images/black_predefined_style.jpg'),
		'blocks' => array(
			'main_color'	=> array(
				'accent'			=> '#f17e12'
			),
			'header'  => array(
				'h1'          => array(
					'size'   => 18,
					'family' => 'Merienda One',
					'style'  => 'regular',
					'color'  => '#ffffff'
				),
				'links'       => '#ffffff',
				'links_hover' => '#f17e12',
				'background'  => array(
					'background-color' => array(
						'primary'   => '#111111',
						'secondary' => '#111111'
					),
					'background-image' => $background_image,
				),
			),
			'content' => array(
				'h2'          => array(
					'size'   => 24,
					'family' => 'Merienda One',
					'style'  => 'regular',
					'color'  => '#2b2b2b'
				),
				'h3'          => array(
					'size'   => 22,
					'family' => 'Merienda One',
					'style'  => 'regular',
					'color'  => '#2b2b2b'
				),
				'p'           => array(
					'size'   => 16,
					'family' => 'Open Sans',
					'style'  => 'regular',
					'color'  => '#2b2b2b'
				),
				'links'       => '#f17e12',
				'links_hover' => '#834a15',
				'background'  => array(
					'background-color' => array(
						'primary'   => '#ffffff',
						'secondary' => '#ffffff'
					),
					'background-image' => $background_image,
				),
			),
			'aside-sidebar' => array(
				'h2'          => array(
					'size'   => 11,
					'family' => 'Lato',
					'style'  => '900',
					'color'  => '#ffffff'
				),
				'links'       => '#ffffff',
				'links_hover' => '#f17e12',
				'background'  => array(
					'background-color' => array(
						'primary'   => '#111111',
						'secondary' => '#111111'
					),
					'background-image' => $background_image,
				),
			),
			'footer-sidebar' => array(
				'h2'          => array(
					'size'   => 11,
					'family' => 'Lato',
					'style'  => '900',
					'color'  => '#ffffff'
				),
				'links'       => '#ffffff',
				'links_hover' => '#f17e12',
				'background'  => array(
					'background-color' => array(
						'primary'   => '#111111',
						'secondary' => '#111111'
					),
					'background-image' => $background_image,
				),
			),
			'footer'  => array(
				'p'          => array(
					'size'   => 11,
					'family' => 'Lato',
					'style'  => '900',
					'color'  => '#ffffff'
				),
				'links'       => '#f17e12',
				'links_hover' => '#f17e12',
				'background'  => array(
					'background-color' => array(
						'primary'   => '#111111',
						'secondary' => '#111111'
					),
					'background-image' => $background_image,
				),
			)
		)
	),
	'green' => array(
		'name'   => 'Green',
		'icon'   =>  $styling->locate_URI('/static/images/green_predefined_style.jpg'),
		'blocks' => array(
			'main_color'	=> array(
				'accent'			=> '#04d19b'
			),
			'header'  => array(
				'h1'          => array(
					'size'   => 18,
					'family' => 'Philosopher',
					'style'  => 'regular',
					'color'  => '#ffffff'
				),
				'links'       => '#04d19b',
				'links_hover' => '#34fdbe',
				'background'  => array(
					'background-color' => array(
						'primary'   => '#006c4f',
						'secondary' => '#006c4f'
					),
					'background-image' => $background_image,
				),
			),
			'content' => array(
				'h2'          => array(
					'size'   => 24,
					'family' => 'Philosopher',
					'style'  => 'regular',
					'color'  => '#2b2b2b'
				),
				'h3'          => array(
					'size'   => 22,
					'family' => 'Philosopher',
					'style'  => 'regular',
					'color'  => '#2b2b2b'
				),
				'p'           => array(
					'size'   => 16,
					'family' => 'Gafata',
					'style'  => 'regular',
					'color'  => '#2b2b2b'
				),
				'links'       => '#006c4f',
				'links_hover' => '#00a77a',
				'background'  => array(
					'background-color' => array(
						'primary'   => '#ffffff',
						'secondary' => '#ffffff'
					),
					'background-image' => $background_image,
				),
			),
			'aside-sidebar' => array(
				'h2'          => array(
					'size'   => 12,
					'family' => 'Philosopher',
					'style'  => 'regular',
					'color'  => '#ffffff'
				),
				'links'       => '#04d19b',
				'links_hover' => '#34fdbe',
				'background'  => array(
					'background-color' => array(
						'primary'   => '#006c4f',
						'secondary' => '#006c4f'
					),
					'background-image' => $background_image,
				),
			),
			'footer-sidebar' => array(
				'h2'          => array(
					'size'   => 12,
					'family' => 'Philosopher',
					'style'  => 'regular',
					'color'  => '#ffffff'
				),
				'links'       => '#04d19b',
				'links_hover' => '#34fdbe',
				'background'  => array(
					'background-color' => array(
						'primary'   => '#006c4f',
						'secondary' => '#006c4f'
					),
					'background-image' => $background_image,
				),
			),
			'footer'  => array(
				'p'          => array(
					'size'   => 12,
					'family' => 'Philosopher',
					'style'  => 'regular',
					'color'  => '#ffffff'
				),
				'links'       => '#04d19b',
				'links_hover' => '#34fbde',
				'background'  => array(
					'background-color' => array(
						'primary'   => '#006c4f',
						'secondary' => '#006c4f'
					),
					'background-image' => $background_image,
				),
			),
		)
	)
);
return apply_filters( 'fw_ext_styling_predefined_styles', $styles );
