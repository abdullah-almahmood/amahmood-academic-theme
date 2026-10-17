<?php
/**
 * Abdullah Al Mahmood, Academic (Violet) 4.
 *
 * @package aam
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'AAM_VERSION', '4.5.0' );
define( 'AAM_COPY_VERSION', '4.3.0' );

function aam_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'style', 'script', 'navigation-widgets' ) );
	add_editor_style( 'assets/css/theme.css' );
	load_theme_textdomain( 'aam', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'aam_setup' );

function aam_fonts_url() {
	return 'https://fonts.googleapis.com/css2'
		. '?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,600;12..96,700;12..96,800'
		. '&family=Instrument+Sans:wght@400;500;600'
		. '&family=IBM+Plex+Mono:wght@400;500'
		. '&display=swap';
}

function aam_assets() {
	$dir = get_template_directory();

	wp_enqueue_style( 'aam-fonts', aam_fonts_url(), array(), null );
	wp_enqueue_style( 'aam-style', get_stylesheet_uri(), array( 'aam-fonts' ), AAM_VERSION );

	$css = '/assets/css/theme.css';
	wp_enqueue_style(
		'aam-theme',
		get_theme_file_uri( 'assets/css/theme.css' ),
		array( 'aam-style' ),
		file_exists( $dir . $css ) ? filemtime( $dir . $css ) : AAM_VERSION
	);

	$js = '/assets/js/site.js';
	wp_enqueue_script(
		'aam-site',
		get_theme_file_uri( 'assets/js/site.js' ),
		array(),
		file_exists( $dir . $js ) ? filemtime( $dir . $js ) : AAM_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'aam_assets' );

function aam_editor_assets() {
	wp_enqueue_style( 'aam-fonts-editor', aam_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'aam_editor_assets' );

function aam_pattern_category() {
	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category(
			'aam',
			array(
				'label'       => __( 'Abdullah Al Mahmood', 'aam' ),
				'description' => __( 'Sections built for the academic site: hero, profile, interests, publications, achievements, gallery, timeline, contact.', 'aam' ),
			)
		);
	}
}
add_action( 'init', 'aam_pattern_category' );

function aam_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#aam-main">' . esc_html__( 'Skip to content', 'aam' ) . '</a>';
}
add_action( 'wp_body_open', 'aam_skip_link' );

function aam_portrait_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'src' => aam_portrait_url(),
			'alt' => __( 'Portrait of Abdullah Al Mahmood', 'aam' ),
		),
		$atts,
		'aam_portrait'
	);

	return sprintf(
		'<figure class="aam-portrait"><span class="aam-portrait__halo" aria-hidden="true"></span><img src="%1$s" alt="%2$s" loading="lazy" decoding="async" width="718" height="1200" /></figure>',
		esc_url( $atts['src'] ),
		esc_attr( $atts['alt'] )
	);
}
add_shortcode( 'aam_portrait', 'aam_portrait_shortcode' );

function aam_year_shortcode() {
	return esc_html( gmdate( 'Y' ) );
}
add_shortcode( 'aam_year', 'aam_year_shortcode' );

/* Editable site content. Settings -> Site content (AAM) */

const AAM_OPTION = 'aam_settings';

function aam_defaults() {
	$u = 'https://amahmood.com/wp-content/uploads/2026/10/';

	return array(
		'email'           => 'abdullahalmahmoodshowrav@gmail.com',
		'phone_display'   => '+60 13 674 3166',
		'phone_tel'       => '+60136743166',
		'whatsapp'        => '60136743166',
		'location'        => 'Cheras, Selangor 43200, Malaysia',
		'orcid'           => '0009-0009-8360-9690',
		'linkedin'        => 'https://www.linkedin.com/in/abdullah-al-mahm00d',
		'github'          => 'https://github.com/abdullah-almahmood',
		'website'         => 'https://amahmood.com',
		'availability'    => 'Immediately &middot; funded doctorate from 2027 &middot; willing to relocate',
		'referees'        => 'Two academic, one professional, on request',

		'cv_url'          => 'https://amahmood.com/wp-content/uploads/2026/08/Abdullah_Al_Mahmood_Academic_CV.docx.pdf',
		'portrait'        => '',

		'hero_eyebrow'    => 'Prospective PhD candidate, 2027 &middot; Research Intern, XIoT Lab, MMU &middot; Applied machine learning &middot; Digital health &middot; Energy systems &middot; Measurement design',
		'hero_lede'       => 'Research Intern at the XIoT Lab, Faculty of Computing and Informatics, Multimedia University. I study how people, machines and systems actually behave, and design the instruments that measure it, across digital healthcare and telemedicine, AI-powered motion detection, hydroelectric power, healthcare device design and generative AI. Electrical and electronic engineer with six and a half years in applied engineering. Seeking a funded doctoral position starting 2027.',
		'profile_heading' => 'I conceptualise the instrument, collect the data, and follow the question wherever it leads.',
		'profile_body'    => "I am a Research Intern at the <strong>XIoT Lab, Faculty of Computing and Informatics, Multimedia University</strong>, and an electrical and electronic engineer who builds what he studies. My work spans <strong>digital healthcare and telemedicine</strong>, <strong>AI-powered motion detection</strong>, <strong>hydroelectric power</strong>, <strong>healthcare device design</strong> and <strong>generative AI</strong>, held together by one aim: recording behaviour as it happens, not reconstructing it afterwards.\n\nMy MSc thesis detected over-speeding and lane changes in <strong>naturalistic traffic footage</strong>; my BSc thesis scheduled hydroelectric dispatch to cut load shedding in Bangladesh. My 2021 telemedicine study rests on <strong>35 in-depth interviews</strong> under ethics approval, and my recent co-authored work applies machine learning to <strong>dengue, air quality and model interpretability</strong>.\n\nSince 2019 I have also run controlled experiments inside large advertising systems across five markets, with <strong>randomisation and outcomes pre-specified</strong> before the data is seen. MSc in ICT, CGPA 3.81 / 4.00. Four peer-reviewed papers, a fifth presented in September 2026, one in preparation.",
		'research_intro'  => 'Each interest below grows out of something already in my record: a thesis, a paper, or years of hands-on work with the systems involved. I am open to a supervisor shaping any of them into a doctoral project.',
		'contact_heading' => 'I am looking for a funded doctoral position starting 2027.',
		'contact_intro'   => 'If any of the interests above overlaps with your group&rsquo;s work, I would value a short conversation. I can send a research statement, full texts of any paper listed here, and my transcripts on request.',
		'contact_body'    => "A Bangladeshi national based in Malaysia on a long-term pass, I am currently a Research Intern at the XIoT Lab, Faculty of Computing and Informatics, Multimedia University, and I am ready to relocate for the right doctoral programme. My work brings together in-depth field interviews with clinicians and patients, deep-learning analysis of real-world driving behaviour, and six years of controlled experimentation at scale.\n\nEmail is the quickest way to reach me. I usually reply within one working day.",
		'footer_role'     => 'Research Intern, XIoT Lab, FCI MMU &middot; Applied ML, digital health, energy systems &middot; Seeking a funded doctorate, 2027',

		'cert_1'          => $u . '01.jpeg',
		'cert_1_cap'      => 'MECON 2026 &middot; Dengue outbreak forecasting',
		'cert_2'          => $u . '02.jpeg',
		'cert_2_cap'      => 'MECON 2026 &middot; Dhaka air-quality prediction',
		'cert_3'          => $u . '03.png',
		'cert_3_cap'      => 'AJMRR 2021 &middot; AI-based telemedicine',
		'cert_4'          => $u . '04.jpeg',
		'cert_4_cap'      => 'IJARCCE 2024 &middot; Explainable AI',
		'photo_1'         => $u . 'WhatsApp-Image-2026-10-16-at-12.29.21-2.jpeg',
		'photo_1_cap'     => 'AI Elevate, TM',
		'photo_2'         => $u . 'WhatsApp-Image-2026-10-16-at-12.29.21.jpeg',
		'photo_2_cap'     => 'Poster session, 8th ASEAN&ndash;UEC Workshop',
		'photo_3'         => $u . 'WhatsApp-Image-2026-10-16-at-12.34.43-2.jpeg',
		'photo_3_cap'     => 'Dhaka air-quality study, MMU',
		'photo_4'         => $u . 'WhatsApp-Image-2026-10-16-at-12.34.43.jpeg',
		'photo_4_cap'     => 'Certificates, UEC Workshop, 6 Sept 2026',
	);
}

function aam_fields() {
	$showcase = array();
	for ( $i = 1; $i <= 4; $i++ ) {
		$showcase[ 'cert_' . $i ]          = array( 'media', sprintf( __( 'Certificate %d, image', 'aam' ), $i ) );
		$showcase[ 'cert_' . $i . '_cap' ] = array( 'text', sprintf( __( 'Certificate %d, caption', 'aam' ), $i ) );
	}
	for ( $i = 1; $i <= 4; $i++ ) {
		$showcase[ 'photo_' . $i ]          = array( 'media', sprintf( __( 'Photo %d, image', 'aam' ), $i ) );
		$showcase[ 'photo_' . $i . '_cap' ] = array( 'text', sprintf( __( 'Photo %d, caption', 'aam' ), $i ) );
	}

	return array(
		'contact'  => array(
			'title'  => __( 'Contact details', 'aam' ),
			'note'   => __( 'Used in the contact section, the footer and the 404 page. Change once here and every appearance follows.', 'aam' ),
			'fields' => array(
				'email'         => array( 'text', __( 'Email address', 'aam' ) ),
				'phone_display' => array( 'text', __( 'Phone, as displayed', 'aam' ) ),
				'phone_tel'     => array( 'text', __( 'Phone, dial format', 'aam' ), __( 'Digits and a leading +, no spaces. Used for tel: links.', 'aam' ) ),
				'whatsapp'      => array( 'text', __( 'WhatsApp number', 'aam' ), __( 'Country code and number, digits only, e.g. 60136743166.', 'aam' ) ),
				'location'      => array( 'text', __( 'Location', 'aam' ) ),
				'orcid'         => array( 'text', __( 'ORCID iD', 'aam' ) ),
				'linkedin'      => array( 'text', __( 'LinkedIn URL', 'aam' ) ),
				'github'        => array( 'text', __( 'GitHub URL', 'aam' ) ),
				'website'       => array( 'text', __( 'Website URL', 'aam' ) ),
				'availability'  => array( 'text', __( 'Availability line', 'aam' ) ),
				'referees'      => array( 'text', __( 'Referees line', 'aam' ) ),
			),
		),
		'files'    => array(
			'title'  => __( 'CV file and portrait', 'aam' ),
			'note'   => __( 'Upload a new CV or a new photograph in the Media Library and pick it here. No theme edit needed.', 'aam' ),
			'fields' => array(
				'cv_url'   => array( 'media', __( 'CV file (PDF)', 'aam' ), __( 'Every Download CV and View CV button on the site points here.', 'aam' ) ),
				'portrait' => array( 'media', __( 'Portrait image', 'aam' ), __( 'Leave empty to use the portrait bundled with the theme.', 'aam' ) ),
			),
		),
		'showcase' => array(
			'title'  => __( 'Achievements and gallery', 'aam' ),
			'note'   => __( 'Four certificates and four photographs. Each set shows as one row of equal tiles; hovering a tile opens a large preview, and clicking opens it full screen.', 'aam' ),
			'fields' => $showcase,
		),
		'copy'     => array(
			'title'  => __( 'Section copy', 'aam' ),
			'note'   => __( 'Basic HTML is allowed. In the longer boxes, leave a blank line between paragraphs.', 'aam' ),
			'fields' => array(
				'hero_eyebrow'    => array( 'text', __( 'Hero: top line (separate keywords with &middot;)', 'aam' ) ),
				'hero_lede'       => array( 'textarea', __( 'Hero: opening paragraph', 'aam' ) ),
				'profile_heading' => array( 'textarea', __( 'Profile: heading', 'aam' ) ),
				'profile_body'    => array( 'textarea', __( 'Profile: body', 'aam' ), '', 14 ),
				'research_intro'  => array( 'textarea', __( 'Doctoral interests: introduction', 'aam' ) ),
				'contact_heading' => array( 'textarea', __( 'Contact: heading', 'aam' ) ),
				'contact_intro'   => array( 'textarea', __( 'Contact: introduction', 'aam' ) ),
				'contact_body'    => array( 'textarea', __( 'Contact: body', 'aam' ), '', 8 ),
				'footer_role'     => array( 'textarea', __( 'Footer: role line', 'aam' ) ),
			),
		),
	);
}

function aam_migrate_copy() {
	if ( AAM_COPY_VERSION === get_option( 'aam_copy_version' ) ) {
		return;
	}
	$saved = get_option( AAM_OPTION, array() );
	if ( is_array( $saved ) ) {
		foreach ( array( 'hero_eyebrow', 'hero_lede', 'profile_heading', 'profile_body', 'research_intro', 'contact_heading', 'contact_intro', 'contact_body', 'footer_role' ) as $key ) {
			unset( $saved[ $key ] );
		}
		update_option( AAM_OPTION, $saved );
	}
	update_option( 'aam_copy_version', AAM_COPY_VERSION );
}
add_action( 'after_setup_theme', 'aam_migrate_copy', 20 );

function aam_opt( $key ) {
	$defaults = aam_defaults();
	$saved    = get_option( AAM_OPTION, array() );
	if ( is_array( $saved ) && isset( $saved[ $key ] ) && '' !== trim( (string) $saved[ $key ] ) ) {
		return (string) $saved[ $key ];
	}
	return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
}

function aam_rich( $key ) {
	return wp_kses_post( aam_opt( $key ) );
}

function aam_paragraphs( $key ) {
	$chunks = preg_split( "/\n\s*\n/", str_replace( "\r\n", "\n", aam_opt( $key ) ) );
	$out    = '';
	foreach ( $chunks as $chunk ) {
		$chunk = trim( $chunk );
		if ( '' !== $chunk ) {
			$out .= '<p>' . wp_kses_post( $chunk ) . '</p>' . "\n";
		}
	}
	return $out;
}

function aam_whatsapp_url() {
	$digits = preg_replace( '/\D+/', '', aam_opt( 'whatsapp' ) );
	return $digits ? 'https://wa.me/' . $digits : '';
}

function aam_portrait_url() {
	$custom = aam_opt( 'portrait' );
	return $custom ? $custom : get_theme_file_uri( 'assets/img/portrait.png' );
}

/* Settings screen */

function aam_register_settings() {
	register_setting(
		'aam_settings_group',
		AAM_OPTION,
		array(
			'type'              => 'array',
			'sanitize_callback' => 'aam_sanitize_settings',
			'default'           => array(),
		)
	);
}
add_action( 'admin_init', 'aam_register_settings' );

function aam_sanitize_settings( $input ) {
	$clean = array();
	if ( ! is_array( $input ) ) {
		return $clean;
	}
	foreach ( aam_fields() as $group ) {
		foreach ( $group['fields'] as $key => $def ) {
			if ( ! isset( $input[ $key ] ) ) {
				continue;
			}
			$value = (string) $input[ $key ];
			if ( 'media' === $def[0] ) {
				$clean[ $key ] = esc_url_raw( trim( $value ) );
			} elseif ( 'email' === $key ) {
				$clean[ $key ] = sanitize_email( trim( $value ) );
			} else {
				$clean[ $key ] = wp_kses_post( trim( $value ) );
			}
		}
	}
	return $clean;
}

function aam_settings_menu() {
	add_options_page( __( 'Site content', 'aam' ), __( 'Site content (AAM)', 'aam' ), 'manage_options', 'aam-settings', 'aam_settings_page' );
}
add_action( 'admin_menu', 'aam_settings_menu' );

function aam_settings_assets( $hook ) {
	if ( 'settings_page_aam-settings' !== $hook ) {
		return;
	}
	wp_enqueue_media();
	wp_add_inline_script(
		'jquery-core',
		"jQuery(function($){
			$('.aam-pick').on('click', function(e){
				e.preventDefault();
				var target = $('#' + $(this).data('target'));
				var frame = wp.media({ title: 'Choose a file', button: { text: 'Use this file' }, multiple: false });
				frame.on('select', function(){
					target.val(frame.state().get('selection').first().toJSON().url).trigger('change');
				});
				frame.open();
			});
			$('.aam-clear').on('click', function(e){
				e.preventDefault();
				$('#' + $(this).data('target')).val('').trigger('change');
			});
		});"
	);
}
add_action( 'admin_enqueue_scripts', 'aam_settings_assets' );

function aam_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Site content', 'aam' ); ?></h1>
		<p style="max-width:70ch;"><?php esc_html_e( 'Contact details, the CV file, the portrait, the certificates, the gallery photos and the main blocks of copy all live here. Leave a field empty to fall back to the value shipped with the theme.', 'aam' ); ?></p>
		<form method="post" action="options.php">
			<?php settings_fields( 'aam_settings_group' ); ?>
			<?php foreach ( aam_fields() as $group_key => $group ) : ?>
				<h2><?php echo esc_html( $group['title'] ); ?></h2>
				<?php if ( ! empty( $group['note'] ) ) : ?>
					<p class="description" style="max-width:70ch;"><?php echo esc_html( $group['note'] ); ?></p>
				<?php endif; ?>
				<table class="form-table" role="presentation"><tbody>
				<?php foreach ( $group['fields'] as $key => $def ) : ?>
					<?php
					$type  = $def[0];
					$label = $def[1];
					$help  = isset( $def[2] ) ? $def[2] : '';
					$rows  = isset( $def[3] ) ? (int) $def[3] : 3;
					$id    = 'aam_field_' . $key;
					$name  = AAM_OPTION . '[' . $key . ']';
					$value = aam_opt( $key );
					?>
					<tr>
						<th scope="row"><label for="<?php echo esc_attr( $id ); ?>"><?php echo wp_kses_post( $label ); ?></label></th>
						<td>
							<?php if ( 'textarea' === $type ) : ?>
								<textarea id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" rows="<?php echo esc_attr( $rows ); ?>" class="large-text code"><?php echo esc_textarea( $value ); ?></textarea>
							<?php elseif ( 'media' === $type ) : ?>
								<input type="text" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>" class="large-text code" />
								<p>
									<button class="button aam-pick" data-target="<?php echo esc_attr( $id ); ?>"><?php esc_html_e( 'Choose from Media Library', 'aam' ); ?></button>
									<button class="button-link aam-clear" data-target="<?php echo esc_attr( $id ); ?>" style="margin-left:.75rem;"><?php esc_html_e( 'Clear', 'aam' ); ?></button>
								</p>
								<?php if ( $value && preg_match( '/\.(png|jpe?g|webp|gif)$/i', $value ) ) : ?>
									<p><img src="<?php echo esc_url( $value ); ?>" alt="" style="max-height:90px;border:1px solid #ddd;border-radius:6px;" /></p>
								<?php endif; ?>
							<?php else : ?>
								<input type="text" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>" class="regular-text" />
							<?php endif; ?>
							<?php if ( $help ) : ?>
								<p class="description"><?php echo esc_html( $help ); ?></p>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody></table>
			<?php endforeach; ?>
			<h2><?php esc_html_e( 'Shortcodes you can drop into any block', 'aam' ); ?></h2>
			<p class="description" style="max-width:70ch;">
				<code>[aam_email]</code> &middot; <code>[aam_phone]</code> &middot; <code>[aam_phone_tel]</code> &middot; <code>[aam_whatsapp]</code> &middot;
				<code>[aam_location]</code> &middot; <code>[aam_cv_url]</code> &middot; <code>[aam_orcid]</code> &middot; <code>[aam_github]</code> &middot;
				<code>[aam_year]</code> &middot; <code>[aam_portrait]</code> &middot; <code>[aam_view_cv]</code> &middot;
				<code>[aam_showcase set="certs"]</code> &middot; <code>[aam_showcase set="photos"]</code> &middot; <code>[aam_text key="hero_lede"]</code>
			</p>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

/* Shortcodes */

function aam_value_shortcodes() {
	$map = array(
		'aam_email'     => function () { return esc_html( aam_opt( 'email' ) ); },
		'aam_phone'     => function () { return esc_html( aam_opt( 'phone_display' ) ); },
		'aam_phone_tel' => function () { return esc_attr( aam_opt( 'phone_tel' ) ); },
		'aam_whatsapp'  => function () { return esc_url( aam_whatsapp_url() ); },
		'aam_location'  => function () { return esc_html( aam_opt( 'location' ) ); },
		'aam_cv_url'    => function () { return esc_url( aam_opt( 'cv_url' ) ); },
		'aam_orcid'     => function () { return esc_html( aam_opt( 'orcid' ) ); },
		'aam_linkedin'  => function () { return esc_url( aam_opt( 'linkedin' ) ); },
		'aam_github'    => function () { return esc_url( aam_opt( 'github' ) ); },
		'aam_website'   => function () { return esc_url( aam_opt( 'website' ) ); },
	);
	foreach ( $map as $tag => $cb ) {
		add_shortcode( $tag, $cb );
	}
}
add_action( 'init', 'aam_value_shortcodes' );

function aam_text_shortcode( $atts ) {
	$atts = shortcode_atts( array( 'key' => '' ), $atts, 'aam_text' );
	return $atts['key'] ? wp_kses_post( aam_opt( $atts['key'] ) ) : '';
}
add_shortcode( 'aam_text', 'aam_text_shortcode' );

function aam_showcase_shortcode( $atts ) {
	$atts = shortcode_atts(
		array( 'set' => 'certs', 'section' => '', 'id' => '', 'index' => '', 'eyebrow' => '', 'title' => '', 'intro' => '', 'tint' => '' ),
		$atts,
		'aam_showcase'
	);

	$photos = ( 'photos' === $atts['set'] );
	$prefix = $photos ? 'photo_' : 'cert_';
	$admin  = current_user_can( 'manage_options' );
	$tiles  = '';

	for ( $i = 1; $i <= 4; $i++ ) {
		$src = aam_opt( $prefix . $i );
		$cap = aam_opt( $prefix . $i . '_cap' );
		if ( ! $src ) {
			if ( $admin ) {
				$tiles .= '<div class="aam-tile aam-tile--empty"><span class="aam-tile__frame"><span class="aam-tile__todo">'
					. esc_html__( 'Add this image in Settings, Site content (AAM)', 'aam' )
					. '</span></span><span class="aam-tile__cap">' . wp_kses_post( $cap ) . '</span></div>';
			}
			continue;
		}
		$alt    = wp_strip_all_tags( html_entity_decode( $cap, ENT_QUOTES, 'UTF-8' ) );
		$tiles .= sprintf(
			'<a class="aam-tile" href="%1$s" data-aam-zoom data-caption="%2$s"><span class="aam-tile__frame"><img src="%1$s" alt="%2$s" loading="lazy" decoding="async" /><span class="aam-tile__hint" aria-hidden="true">+</span></span><span class="aam-tile__cap">%3$s</span></a>',
			esc_url( $src ),
			esc_attr( $alt ),
			wp_kses_post( $cap )
		);
	}

	if ( '' === $tiles ) {
		return '';
	}

	$row = '<div class="aam-showcase ' . ( $photos ? 'aam-showcase--photos' : 'aam-showcase--certs' ) . '">' . $tiles . '</div>';
	if ( ! $atts['section'] ) {
		return $row;
	}

	$out  = '<section class="aam-section' . ( $atts['tint'] ? ' aam-section--tint' : '' ) . '"' . ( $atts['id'] ? ' id="' . esc_attr( $atts['id'] ) . '"' : '' ) . '>';
	$out .= '<div class="aam-shell aam-reveal"><div class="aam-rail" aria-hidden="true"></div><div class="aam-head">';
	if ( $atts['index'] ) {
		$out .= '<span class="aam-ghost" aria-hidden="true">' . esc_html( $atts['index'] ) . '</span>';
	}
	if ( $atts['eyebrow'] ) {
		$out .= '<p class="aam-eyebrow">' . esc_html( $atts['eyebrow'] ) . '</p>';
	}
	if ( $atts['title'] ) {
		$out .= '<h2 class="aam-h2">' . esc_html( $atts['title'] ) . '</h2>';
	}
	if ( $atts['intro'] ) {
		$out .= '<p class="aam-head__intro">' . esc_html( $atts['intro'] ) . '</p>';
	}
	$out .= '</div>' . $row . '</div></section>';
	return $out;
}
add_shortcode( 'aam_showcase', 'aam_showcase_shortcode' );

function aam_shortcodes_in_blocks( $content ) {
	if ( is_string( $content ) && false !== strpos( $content, '[aam_' ) ) {
		$content = do_shortcode( $content );
	}
	return $content;
}
add_filter( 'render_block', 'aam_shortcodes_in_blocks', 10, 1 );

/* CV viewer */

function aam_cv_modal() {
	$url = aam_opt( 'cv_url' );
	if ( ! $url ) {
		return;
	}
	?>
	<div class="aam-modal" id="aam-cv-modal" hidden>
		<div class="aam-modal__backdrop" data-aam-close></div>
		<div class="aam-modal__panel" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Academic CV', 'aam' ); ?>">
			<div class="aam-modal__bar">
				<p class="aam-modal__title"><?php esc_html_e( 'Academic CV', 'aam' ); ?></p>
				<div class="aam-modal__actions">
					<a class="aam-btn aam-btn--ghost" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Open in a new tab', 'aam' ); ?></a>
					<a class="aam-btn aam-btn--ghost" href="<?php echo esc_url( $url ); ?>" download><?php esc_html_e( 'Download', 'aam' ); ?></a>
					<button type="button" class="aam-modal__close" data-aam-close aria-label="<?php esc_attr_e( 'Close the CV viewer', 'aam' ); ?>">&times;</button>
				</div>
			</div>
			<div class="aam-modal__body">
				<object class="aam-modal__doc" type="application/pdf" aria-label="<?php esc_attr_e( 'Academic CV', 'aam' ); ?>" data-src="<?php echo esc_url( $url ); ?>#view=FitH&amp;toolbar=1">
					<div class="aam-modal__inline-fallback">
						<p><?php esc_html_e( 'This browser cannot display the PDF inline.', 'aam' ); ?></p>
						<a class="aam-btn" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Open the CV in a new tab', 'aam' ); ?></a>
					</div>
				</object>
				<div class="aam-modal__fallback">
					<p><?php esc_html_e( 'This browser cannot display the PDF inline.', 'aam' ); ?></p>
					<a class="aam-btn" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Open the CV in a new tab', 'aam' ); ?></a>
				</div>
			</div>
		</div>
	</div>
	<?php
}
add_action( 'wp_footer', 'aam_cv_modal' );

function aam_view_cv_shortcode( $atts ) {
	$atts = shortcode_atts( array( 'label' => __( 'View CV', 'aam' ), 'class' => 'aam-btn aam-btn--ghost' ), $atts, 'aam_view_cv' );
	if ( ! aam_opt( 'cv_url' ) ) {
		return '';
	}
	return sprintf( '<a class="%1$s aam-cv-open" href="%2$s">%3$s</a>', esc_attr( $atts['class'] ), esc_url( aam_opt( 'cv_url' ) ), esc_html( $atts['label'] ) );
}
add_shortcode( 'aam_view_cv', 'aam_view_cv_shortcode' );
