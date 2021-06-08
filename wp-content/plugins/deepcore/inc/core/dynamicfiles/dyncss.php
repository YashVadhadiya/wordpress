<?php
ob_start();
$thm_options = get_option( 'deep_options' );

/* Body Typography */
if ( ! empty( $thm_options['body-typography']['font-family'] ) ) {
	if ( $thm_options['body-typography']['font-family'] == 'Open Sans,arial,helvatica' || $thm_options['body-typography']['font-family'] == 'BebasRegular,arial,helvatica' || $thm_options['body-typography']['font-family'] == 'LeagueGothicRegular,arial,helvatica' || $thm_options['body-typography']['font-family'] == 'Arial,helvetica,sans-serif' || $thm_options['body-typography']['font-family'] == 'helvetica,sans-serif,arial' || $thm_options['body-typography']['font-family'] == 'sans-serif,arial,helvatica' || $thm_options['body-typography']['font-family'] == 'verdana,san-serif,helvatica' ) {
		$body_style = 'font-family:' . $thm_options['body-typography']['font-family'] . ';';
	} else {
		$body_style = 'font-family:"' . $thm_options['body-typography']['font-family'] . '";';
	}
} else {
	$body_style = '';
}
$body_style .= ! empty( $thm_options['body-typography']['font-style'] ) ? 'font-style:' . $thm_options['body-typography']['font-style'] . ';' : '';
$body_style .= ! empty( $thm_options['body-typography']['font-weight'] ) ? 'font-weight:' . $thm_options['body-typography']['font-weight'] . ';' : '';
$body_style .= ! empty( $thm_options['body-typography']['word-spacing'] ) ? 'word-spacing:' . $thm_options['body-typography']['word-spacing'] . ';' : '';
$body_style .= ! empty( $thm_options['body-typography']['text-transform'] ) ? 'text-transform:' . $thm_options['body-typography']['text-transform'] . ';' : '';
$body_style .= ! empty( $thm_options['body-typography']['letter-spacing'] ) ? 'letter-spacing:' . $thm_options['body-typography']['letter-spacing'] . ';' : '';
$body_style .= ! empty( $thm_options['body-typography']['color'] ) ? 'color:' . $thm_options['body-typography']['color'] . ';' : '';
$body_style .= ! empty( $thm_options['body-typography']['text-align'] ) ? 'text-align:' . $thm_options['body-typography']['text-align'] . ';' : '';
$body_style .= ! empty( $thm_options['body-typography']['line-height'] ) ? 'line-height:' . $thm_options['body-typography']['line-height'] . ';' : '';
$body_style .= ! empty( $thm_options['body-typography']['font-size'] ) ? 'font-size:' . $thm_options['body-typography']['font-size'] . ';' : '';

if ( ! empty( $body_style ) ) {
	echo 'body{' . $body_style . '}';
}

/* Paragraph Typography */
if ( ! empty( $thm_options['p-typography']['font-family'] ) ) {
	if ( $thm_options['p-typography']['font-family'] == 'Open Sans,arial,helvatica' || $thm_options['p-typography']['font-family'] == 'BebasRegular,arial,helvatica' || $thm_options['p-typography']['font-family'] == 'LeagueGothicRegular,arial,helvatica' || $thm_options['p-typography']['font-family'] == 'Arial,helvetica,sans-serif' || $thm_options['p-typography']['font-family'] == 'helvetica,sans-serif,arial' || $thm_options['p-typography']['font-family'] == 'sans-serif,arial,helvatica' || $thm_options['p-typography']['font-family'] == 'verdana,san-serif,helvatica' ) {
		$paragraph_style = 'font-family:' . $thm_options['p-typography']['font-family'] . '; ';
	} else {
		$paragraph_style = 'font-family:"' . $thm_options['p-typography']['font-family'] . '";';
	}
} else {
	$paragraph_style = '';
}
$paragraph_style .= ! empty( $thm_options['p-typography']['font-style'] ) ? 'font-style:' . $thm_options['p-typography']['font-style'] . '; ' : '';
$paragraph_style .= ! empty( $thm_options['p-typography']['font-weight'] ) ? 'font-weight:' . $thm_options['p-typography']['font-weight'] . '; ' : '';
$paragraph_style .= ! empty( $thm_options['p-typography']['word-spacing'] ) ? 'word-spacing:' . $thm_options['p-typography']['word-spacing'] . '; ' : '';
$paragraph_style .= ! empty( $thm_options['p-typography']['text-transform'] ) ? 'text-transform:' . $thm_options['p-typography']['text-transform'] . '; ' : '';
$paragraph_style .= ! empty( $thm_options['p-typography']['letter-spacing'] ) ? 'letter-spacing:' . $thm_options['p-typography']['letter-spacing'] . '; ' : '';
$paragraph_style .= ! empty( $thm_options['p-typography']['color'] ) ? 'color:' . $thm_options['p-typography']['color'] . '; ' : '';
$paragraph_style .= ! empty( $thm_options['p-typography']['text-align'] ) ? 'text-align:' . $thm_options['p-typography']['text-align'] . '; ' : '';
$paragraph_style .= ! empty( $thm_options['p-typography']['line-height'] ) ? 'line-height:' . $thm_options['p-typography']['line-height'] . '; ' : '';
$paragraph_style .= ! empty( $thm_options['p-typography']['font-size'] ) ? 'font-size:' . $thm_options['p-typography']['font-size'] . '; ' : '';

if ( ! empty( $paragraph_style ) ) {
	echo 'body .wn-wrap p{' . $paragraph_style . '}';
}

/* All Heading Typography */
if ( ! empty( $thm_options['all-h-typography']['font-family'] ) ) {
	if ( $thm_options['all-h-typography']['font-family'] == 'Open Sans,arial,helvatica' || $thm_options['all-h-typography']['font-family'] == 'BebasRegular,arial,helvatica' || $thm_options['all-h-typography']['font-family'] == 'LeagueGothicRegular,arial,helvatica' || $thm_options['all-h-typography']['font-family'] == 'Arial,helvetica,sans-serif' || $thm_options['all-h-typography']['font-family'] == 'helvetica,sans-serif,arial' || $thm_options['all-h-typography']['font-family'] == 'sans-serif,arial,helvatica' || $thm_options['all-h-typography']['font-family'] == 'verdana,san-serif,helvatica' ) {
		$all_h_style = 'font-family:' . $thm_options['all-h-typography']['font-family'] . '; ';
	} else {
		$all_h_style = 'font-family:"' . $thm_options['all-h-typography']['font-family'] . '";';
	}
} else {
	$all_h_style = '';
}
$all_h_style .= ! empty( $thm_options['all-h-typography']['font-style'] ) ? 'font-style:' . $thm_options['all-h-typography']['font-style'] . '; ' : '';
$all_h_style .= ! empty( $thm_options['all-h-typography']['font-weight'] ) ? 'font-weight:' . $thm_options['all-h-typography']['font-weight'] . '; ' : '';
$all_h_style .= ! empty( $thm_options['all-h-typography']['word-spacing'] ) ? 'word-spacing:' . $thm_options['all-h-typography']['word-spacing'] . '; ' : '';
$all_h_style .= ! empty( $thm_options['all-h-typography']['text-transform'] ) ? 'text-transform:' . $thm_options['all-h-typography']['text-transform'] . '; ' : '';
$all_h_style .= ! empty( $thm_options['all-h-typography']['letter-spacing'] ) ? 'letter-spacing:' . $thm_options['all-h-typography']['letter-spacing'] . '; ' : '';
$all_h_style .= ! empty( $thm_options['all-h-typography']['color'] ) ? 'color:' . $thm_options['all-h-typography']['color'] . '; ' : '';
$all_h_style .= ! empty( $thm_options['all-h-typography']['text-align'] ) ? 'text-align:' . $thm_options['all-h-typography']['text-align'] . '; ' : '';
$all_h_style .= ! empty( $thm_options['all-h-typography']['line-height'] ) ? 'line-height:' . $thm_options['all-h-typography']['line-height'] . '; ' : '';
$all_h_style .= ! empty( $thm_options['all-h-typography']['font-size'] ) ? 'font-size:' . $thm_options['all-h-typography']['font-size'] . '; ' : '';

if ( ! empty( $all_h_style ) ) {
	echo '.wn-wrap h1,.wn-wrap h2,.wn-wrap h3,.wn-wrap h4,.wn-wrap h5,.wn-wrap h6 {' . $all_h_style . '}';
}

/* Heading1 Typography */
if ( ! empty( $thm_options['h1-typography']['font-family'] ) ) {
	if ( $thm_options['h1-typography']['font-family'] == 'Open Sans,arial,helvatica' || $thm_options['h1-typography']['font-family'] == 'BebasRegular,arial,helvatica' || $thm_options['h1-typography']['font-family'] == 'LeagueGothicRegular,arial,helvatica' || $thm_options['h1-typography']['font-family'] == 'Arial,helvetica,sans-serif' || $thm_options['h1-typography']['font-family'] == 'helvetica,sans-serif,arial' || $thm_options['h1-typography']['font-family'] == 'sans-serif,arial,helvatica' || $thm_options['h1-typography']['font-family'] == 'verdana,san-serif,helvatica' ) {
		$h1_style = 'font-family:' . $thm_options['h1-typography']['font-family'] . '; ';
	} else {
		$h1_style = 'font-family:"' . $thm_options['h1-typography']['font-family'] . '";';
	}
} else {
	$h1_style = '';
}
$h1_style .= ! empty( $thm_options['h1-typography']['font-style'] ) ? 'font-style:' . $thm_options['h1-typography']['font-style'] . '; ' : '';
$h1_style .= ! empty( $thm_options['h1-typography']['font-weight'] ) ? 'font-weight:' . $thm_options['h1-typography']['font-weight'] . '; ' : '';
$h1_style .= ! empty( $thm_options['h1-typography']['word-spacing'] ) ? 'word-spacing:' . $thm_options['h1-typography']['word-spacing'] . '; ' : '';
$h1_style .= ! empty( $thm_options['h1-typography']['text-transform'] ) ? 'text-transform:' . $thm_options['h1-typography']['text-transform'] . '; ' : '';
$h1_style .= ! empty( $thm_options['h1-typography']['letter-spacing'] ) ? 'letter-spacing:' . $thm_options['h1-typography']['letter-spacing'] . '; ' : '';
$h1_style .= ! empty( $thm_options['h1-typography']['color'] ) ? 'color:' . $thm_options['h1-typography']['color'] . '; ' : '';
$h1_style .= ! empty( $thm_options['h1-typography']['text-align'] ) ? 'text-align:' . $thm_options['h1-typography']['text-align'] . '; ' : '';
$h1_style .= ! empty( $thm_options['h1-typography']['line-height'] ) ? 'line-height:' . $thm_options['h1-typography']['line-height'] . '; ' : '';
$h1_style .= ! empty( $thm_options['h1-typography']['font-size'] ) ? 'font-size:' . $thm_options['h1-typography']['font-size'] . '; ' : '';

if ( ! empty( $h1_style ) ) {
	echo 'body .wn-wrap h1 {' . $h1_style . '}';
}

/* Heading2 Typography */
if ( ! empty( $thm_options['h2-typography']['font-family'] ) ) {
	if ( $thm_options['h2-typography']['font-family'] == 'Open Sans,arial,helvatica' || $thm_options['h2-typography']['font-family'] == 'BebasRegular,arial,helvatica' || $thm_options['h2-typography']['font-family'] == 'LeagueGothicRegular,arial,helvatica' || $thm_options['h2-typography']['font-family'] == 'Arial,helvetica,sans-serif' || $thm_options['h2-typography']['font-family'] == 'helvetica,sans-serif,arial' || $thm_options['h2-typography']['font-family'] == 'sans-serif,arial,helvatica' || $thm_options['h2-typography']['font-family'] == 'verdana,san-serif,helvatica' ) {
		$h2_style = 'font-family:' . $thm_options['h2-typography']['font-family'] . '; ';
	} else {
		$h2_style = 'font-family:"' . $thm_options['h2-typography']['font-family'] . '";';
	}
} else {
	$h2_style = '';
}
$h2_style .= ! empty( $thm_options['h2-typography']['font-style'] ) ? 'font-style:' . $thm_options['h2-typography']['font-style'] . '; ' : '';
$h2_style .= ! empty( $thm_options['h2-typography']['font-weight'] ) ? 'font-weight:' . $thm_options['h2-typography']['font-weight'] . '; ' : '';
$h2_style .= ! empty( $thm_options['h2-typography']['word-spacing'] ) ? 'word-spacing:' . $thm_options['h2-typography']['word-spacing'] . '; ' : '';
$h2_style .= ! empty( $thm_options['h2-typography']['text-transform'] ) ? 'text-transform:' . $thm_options['h2-typography']['text-transform'] . '; ' : '';
$h2_style .= ! empty( $thm_options['h2-typography']['letter-spacing'] ) ? 'letter-spacing:' . $thm_options['h2-typography']['letter-spacing'] . '; ' : '';
$h2_style .= ! empty( $thm_options['h2-typography']['color'] ) ? 'color:' . $thm_options['h2-typography']['color'] . '; ' : '';
$h2_style .= ! empty( $thm_options['h2-typography']['text-align'] ) ? 'text-align:' . $thm_options['h2-typography']['text-align'] . '; ' : '';
$h2_style .= ! empty( $thm_options['h2-typography']['line-height'] ) ? 'line-height:' . $thm_options['h2-typography']['line-height'] . '; ' : '';
$h2_style .= ! empty( $thm_options['h2-typography']['font-size'] ) ? 'font-size:' . $thm_options['h2-typography']['font-size'] . '; ' : '';

if ( ! empty( $h2_style ) ) {
	echo 'body .wn-wrap h2 {' . $h2_style . '}';
}

/* Heading3 Typography */
if ( ! empty( $thm_options['h3-typography']['font-family'] ) ) {
	if ( $thm_options['h3-typography']['font-family'] == 'Open Sans,arial,helvatica' || $thm_options['h3-typography']['font-family'] == 'BebasRegular,arial,helvatica' || $thm_options['h3-typography']['font-family'] == 'LeagueGothicRegular,arial,helvatica' || $thm_options['h3-typography']['font-family'] == 'Arial,helvetica,sans-serif' || $thm_options['h3-typography']['font-family'] == 'helvetica,sans-serif,arial' || $thm_options['h3-typography']['font-family'] == 'sans-serif,arial,helvatica' || $thm_options['h3-typography']['font-family'] == 'verdana,san-serif,helvatica' ) {
		$h3_style = 'font-family:' . $thm_options['h3-typography']['font-family'] . '; ';
	} else {
		$h3_style = 'font-family:"' . $thm_options['h3-typography']['font-family'] . '";';
	}
} else {
	$h3_style = '';
}
$h3_style .= ! empty( $thm_options['h3-typography']['font-style'] ) ? 'font-style:' . $thm_options['h3-typography']['font-style'] . '; ' : '';
$h3_style .= ! empty( $thm_options['h3-typography']['font-weight'] ) ? 'font-weight:' . $thm_options['h3-typography']['font-weight'] . '; ' : '';
$h3_style .= ! empty( $thm_options['h3-typography']['word-spacing'] ) ? 'word-spacing:' . $thm_options['h3-typography']['word-spacing'] . '; ' : '';
$h3_style .= ! empty( $thm_options['h3-typography']['text-transform'] ) ? 'text-transform:' . $thm_options['h3-typography']['text-transform'] . '; ' : '';
$h3_style .= ! empty( $thm_options['h3-typography']['letter-spacing'] ) ? 'letter-spacing:' . $thm_options['h3-typography']['letter-spacing'] . '; ' : '';
$h3_style .= ! empty( $thm_options['h3-typography']['color'] ) ? 'color:' . $thm_options['h3-typography']['color'] . '; ' : '';
$h3_style .= ! empty( $thm_options['h3-typography']['text-align'] ) ? 'text-align:' . $thm_options['h3-typography']['text-align'] . '; ' : '';
$h3_style .= ! empty( $thm_options['h3-typography']['line-height'] ) ? 'line-height:' . $thm_options['h3-typography']['line-height'] . '; ' : '';
$h3_style .= ! empty( $thm_options['h3-typography']['font-size'] ) ? 'font-size:' . $thm_options['h3-typography']['font-size'] . '; ' : '';

if ( ! empty( $h3_style ) ) {
	echo 'body .wn-wrap h3 {' . $h3_style . '}';
}

/* Heading4 Typography */
if ( ! empty( $thm_options['h4-typography']['font-family'] ) ) {
	if ( $thm_options['h4-typography']['font-family'] == 'Open Sans,arial,helvatica' || $thm_options['h4-typography']['font-family'] == 'BebasRegular,arial,helvatica' || $thm_options['h4-typography']['font-family'] == 'LeagueGothicRegular,arial,helvatica' || $thm_options['h4-typography']['font-family'] == 'Arial,helvetica,sans-serif' || $thm_options['h4-typography']['font-family'] == 'helvetica,sans-serif,arial' || $thm_options['h4-typography']['font-family'] == 'sans-serif,arial,helvatica' || $thm_options['h4-typography']['font-family'] == 'verdana,san-serif,helvatica' ) {
		$h4_style = 'font-family:' . $thm_options['h4-typography']['font-family'] . '; ';
	} else {
		$h4_style = 'font-family:"' . $thm_options['h4-typography']['font-family'] . '";';
	}
} else {
	$h4_style = '';
}
$h4_style .= ! empty( $thm_options['h4-typography']['font-style'] ) ? 'font-style:' . $thm_options['h4-typography']['font-style'] . '; ' : '';
$h4_style .= ! empty( $thm_options['h4-typography']['font-weight'] ) ? 'font-weight:' . $thm_options['h4-typography']['font-weight'] . '; ' : '';
$h4_style .= ! empty( $thm_options['h4-typography']['word-spacing'] ) ? 'word-spacing:' . $thm_options['h4-typography']['word-spacing'] . '; ' : '';
$h4_style .= ! empty( $thm_options['h4-typography']['text-transform'] ) ? 'text-transform:' . $thm_options['h4-typography']['text-transform'] . '; ' : '';
$h4_style .= ! empty( $thm_options['h4-typography']['letter-spacing'] ) ? 'letter-spacing:' . $thm_options['h4-typography']['letter-spacing'] . '; ' : '';
$h4_style .= ! empty( $thm_options['h4-typography']['color'] ) ? 'color:' . $thm_options['h4-typography']['color'] . '; ' : '';
$h4_style .= ! empty( $thm_options['h4-typography']['text-align'] ) ? 'text-align:' . $thm_options['h4-typography']['text-align'] . '; ' : '';
$h4_style .= ! empty( $thm_options['h4-typography']['line-height'] ) ? 'line-height:' . $thm_options['h4-typography']['line-height'] . '; ' : '';
$h4_style .= ! empty( $thm_options['h4-typography']['font-size'] ) ? 'font-size:' . $thm_options['h4-typography']['font-size'] . '; ' : '';

if ( ! empty( $h4_style ) ) {
	echo 'body .wn-wrap h4 {' . $h4_style . '}';
}

/* Heading5 Typography */
if ( ! empty( $thm_options['h5-typography']['font-family'] ) ) {
	if ( $thm_options['h5-typography']['font-family'] == 'Open Sans,arial,helvatica' || $thm_options['h5-typography']['font-family'] == 'BebasRegular,arial,helvatica' || $thm_options['h5-typography']['font-family'] == 'LeagueGothicRegular,arial,helvatica' || $thm_options['h5-typography']['font-family'] == 'Arial,helvetica,sans-serif' || $thm_options['h5-typography']['font-family'] == 'helvetica,sans-serif,arial' || $thm_options['h5-typography']['font-family'] == 'sans-serif,arial,helvatica' || $thm_options['h5-typography']['font-family'] == 'verdana,san-serif,helvatica' ) {
		$h5_style = 'font-family:' . $thm_options['h5-typography']['font-family'] . '; ';
	} else {
		$h5_style = 'font-family:"' . $thm_options['h5-typography']['font-family'] . '";';
	}
} else {
	$h5_style = '';
}
$h5_style .= ! empty( $thm_options['h5-typography']['font-style'] ) ? 'font-style:' . $thm_options['h5-typography']['font-style'] . '; ' : '';
$h5_style .= ! empty( $thm_options['h5-typography']['font-weight'] ) ? 'font-weight:' . $thm_options['h5-typography']['font-weight'] . '; ' : '';
$h5_style .= ! empty( $thm_options['h5-typography']['word-spacing'] ) ? 'word-spacing:' . $thm_options['h5-typography']['word-spacing'] . '; ' : '';
$h5_style .= ! empty( $thm_options['h5-typography']['text-transform'] ) ? 'text-transform:' . $thm_options['h5-typography']['text-transform'] . '; ' : '';
$h5_style .= ! empty( $thm_options['h5-typography']['letter-spacing'] ) ? 'letter-spacing:' . $thm_options['h5-typography']['letter-spacing'] . '; ' : '';
$h5_style .= ! empty( $thm_options['h5-typography']['color'] ) ? 'color:' . $thm_options['h5-typography']['color'] . '; ' : '';
$h5_style .= ! empty( $thm_options['h5-typography']['text-align'] ) ? 'text-align:' . $thm_options['h5-typography']['text-align'] . '; ' : '';
$h5_style .= ! empty( $thm_options['h5-typography']['line-height'] ) ? 'line-height:' . $thm_options['h5-typography']['line-height'] . '; ' : '';
$h5_style .= ! empty( $thm_options['h5-typography']['font-size'] ) ? 'font-size:' . $thm_options['h5-typography']['font-size'] . '; ' : '';

if ( ! empty( $h5_style ) ) {
	echo 'body .wn-wrap h5 {' . $h5_style . '}';
}

/* Heading6 Typography */
if ( ! empty( $thm_options['h6-typography']['font-family'] ) ) {
	if ( $thm_options['h6-typography']['font-family'] == 'Open Sans,arial,helvatica' || $thm_options['h6-typography']['font-family'] == 'BebasRegular,arial,helvatica' || $thm_options['h6-typography']['font-family'] == 'LeagueGothicRegular,arial,helvatica' || $thm_options['h6-typography']['font-family'] == 'Arial,helvetica,sans-serif' || $thm_options['h6-typography']['font-family'] == 'helvetica,sans-serif,arial' || $thm_options['h6-typography']['font-family'] == 'sans-serif,arial,helvatica' || $thm_options['h6-typography']['font-family'] == 'verdana,san-serif,helvatica' ) {
		$h6_style = 'font-family:' . $thm_options['h6-typography']['font-family'] . '; ';
	} else {
		$h6_style = 'font-family:"' . $thm_options['h6-typography']['font-family'] . '";';
	}
} else {
	$h6_style = '';
}
$h6_style .= ! empty( $thm_options['h6-typography']['font-style'] ) ? 'font-style:' . $thm_options['h6-typography']['font-style'] . '; ' : '';
$h6_style .= ! empty( $thm_options['h6-typography']['font-weight'] ) ? 'font-weight:' . $thm_options['h6-typography']['font-weight'] . '; ' : '';
$h6_style .= ! empty( $thm_options['h6-typography']['word-spacing'] ) ? 'word-spacing:' . $thm_options['h6-typography']['word-spacing'] . '; ' : '';
$h6_style .= ! empty( $thm_options['h6-typography']['text-transform'] ) ? 'text-transform:' . $thm_options['h6-typography']['text-transform'] . '; ' : '';
$h6_style .= ! empty( $thm_options['h6-typography']['letter-spacing'] ) ? 'letter-spacing:' . $thm_options['h6-typography']['letter-spacing'] . '; ' : '';
$h6_style .= ! empty( $thm_options['h6-typography']['color'] ) ? 'color:' . $thm_options['h6-typography']['color'] . '; ' : '';
$h6_style .= ! empty( $thm_options['h6-typography']['text-align'] ) ? 'text-align:' . $thm_options['h6-typography']['text-align'] . '; ' : '';
$h6_style .= ! empty( $thm_options['h6-typography']['line-height'] ) ? 'line-height:' . $thm_options['h6-typography']['line-height'] . '; ' : '';
$h6_style .= ! empty( $thm_options['h6-typography']['font-size'] ) ? 'font-size:' . $thm_options['h6-typography']['font-size'] . '; ' : '';

if ( ! empty( $h6_style ) ) {
	echo 'body .wn-wrap h6 {' . $h6_style . '}';
}

/* Menu Typography */
if ( ! empty( $thm_options['menu-typography']['font-family'] ) ) {
	if ( $thm_options['menu-typography']['font-family'] == 'Open Sans,arial,helvatica' || $thm_options['menu-typography']['font-family'] == 'BebasRegular,arial,helvatica' || $thm_options['menu-typography']['font-family'] == 'LeagueGothicRegular,arial,helvatica' || $thm_options['menu-typography']['font-family'] == 'Arial,helvetica,sans-serif' || $thm_options['menu-typography']['font-family'] == 'helvetica,sans-serif,arial' || $thm_options['menu-typography']['font-family'] == 'sans-serif,arial,helvatica' || $thm_options['menu-typography']['font-family'] == 'verdana,san-serif,helvatica' ) {
		$menu_style = 'font-family:' . $thm_options['menu-typography']['font-family'] . '; ';
	} else {
		$menu_style = 'font-family:"' . $thm_options['menu-typography']['font-family'] . '";';
	}
} else {
	$menu_style = '';
}
$menu_style .= ! empty( $thm_options['menu-typography']['font-style'] ) ? 'font-style:' . $thm_options['menu-typography']['font-style'] . '; ' : '';
$menu_style .= ! empty( $thm_options['menu-typography']['font-weight'] ) ? 'font-weight:' . $thm_options['menu-typography']['font-weight'] . '; ' : '';
$menu_style .= ! empty( $thm_options['menu-typography']['word-spacing'] ) ? 'word-spacing:' . $thm_options['menu-typography']['word-spacing'] . '; ' : '';
$menu_style .= ! empty( $thm_options['menu-typography']['text-transform'] ) ? 'text-transform:' . $thm_options['menu-typography']['text-transform'] . '; ' : '';
$menu_style .= ! empty( $thm_options['menu-typography']['letter-spacing'] ) ? 'letter-spacing:' . $thm_options['menu-typography']['letter-spacing'] . '; ' : '';
$menu_style .= ! empty( $thm_options['menu-typography']['color'] ) ? 'color:' . $thm_options['menu-typography']['color'] . '; ' : '';
$menu_style .= ! empty( $thm_options['menu-typography']['text-align'] ) ? 'text-align:' . $thm_options['menu-typography']['text-align'] . '; ' : '';
$menu_style .= ! empty( $thm_options['menu-typography']['line-height'] ) ? 'line-height:' . $thm_options['menu-typography']['line-height'] . '; ' : '';
$menu_style .= ! empty( $thm_options['menu-typography']['font-size'] ) ? 'font-size:' . $thm_options['menu-typography']['font-size'] . '; ' : '';

if ( ! empty( $menu_style ) ) {
	echo '  .transparent-header-w.t-dark-w #wrap #webnus-header-builder .whb-row1-area .nav>li>a,
  ul > li.menu-item > a {' . $menu_style . '}';
}

/* Sub Menu Typography */
if ( ! empty( $thm_options['sub-menu-typography']['font-family'] ) ) {
	if ( $thm_options['sub-menu-typography']['font-family'] == 'Open Sans,arial,helvatica' || $thm_options['sub-menu-typography']['font-family'] == 'BebasRegular,arial,helvatica' || $thm_options['sub-menu-typography']['font-family'] == 'LeagueGothicRegular,arial,helvatica' || $thm_options['sub-menu-typography']['font-family'] == 'Arial,helvetica,sans-serif' || $thm_options['sub-menu-typography']['font-family'] == 'helvetica,sans-serif,arial' || $thm_options['sub-menu-typography']['font-family'] == 'sans-serif,arial,helvatica' || $thm_options['sub-menu-typography']['font-family'] == 'verdana,san-serif,helvatica' ) {
		$sub_menu_style = 'font-family:' . $thm_options['sub-menu-typography']['font-family'] . '; ';
	} else {
		$sub_menu_style = 'font-family:"' . $thm_options['sub-menu-typography']['font-family'] . '";';
	}
} else {
	$sub_menu_style = '';
}
$sub_menu_style .= ! empty( $thm_options['sub-menu-typography']['font-style'] ) ? 'font-style:' . $thm_options['sub-menu-typography']['font-style'] . '; ' : '';
$sub_menu_style .= ! empty( $thm_options['sub-menu-typography']['font-weight'] ) ? 'font-weight:' . $thm_options['sub-menu-typography']['font-weight'] . '; ' : '';
$sub_menu_style .= ! empty( $thm_options['sub-menu-typography']['word-spacing'] ) ? 'word-spacing:' . $thm_options['sub-menu-typography']['word-spacing'] . '; ' : '';
$sub_menu_style .= ! empty( $thm_options['sub-menu-typography']['text-transform'] ) ? 'text-transform:' . $thm_options['sub-menu-typography']['text-transform'] . '; ' : '';
$sub_menu_style .= ! empty( $thm_options['sub-menu-typography']['letter-spacing'] ) ? 'letter-spacing:' . $thm_options['sub-menu-typography']['letter-spacing'] . '; ' : '';
$sub_menu_style .= ! empty( $thm_options['sub-menu-typography']['color'] ) ? 'color:' . $thm_options['sub-menu-typography']['color'] . '; ' : '';
$sub_menu_style .= ! empty( $thm_options['sub-menu-typography']['text-align'] ) ? 'text-align:' . $thm_options['sub-menu-typography']['text-align'] . '; ' : '';
$sub_menu_style .= ! empty( $thm_options['sub-menu-typography']['line-height'] ) ? 'line-height:' . $thm_options['sub-menu-typography']['line-height'] . '; ' : '';
$sub_menu_style .= ! empty( $thm_options['sub-menu-typography']['font-size'] ) ? 'font-size:' . $thm_options['sub-menu-typography']['font-size'] . '; ' : '';

if ( ! empty( $sub_menu_style ) ) {
	echo '#wrap.wn-wrap .nav ul li.menu-item a {' . $sub_menu_style . '}';
}

/* post title Typography */
if ( ! empty( $thm_options['post-title-typography']['font-family'] ) ) {
	if ( $thm_options['post-title-typography']['font-family'] == 'Open Sans,arial,helvatica' || $thm_options['post-title-typography']['font-family'] == 'BebasRegular,arial,helvatica' || $thm_options['post-title-typography']['font-family'] == 'LeagueGothicRegular,arial,helvatica' || $thm_options['post-title-typography']['font-family'] == 'Arial,helvetica,sans-serif' || $thm_options['post-title-typography']['font-family'] == 'helvetica,sans-serif,arial' || $thm_options['post-title-typography']['font-family'] == 'sans-serif,arial,helvatica' || $thm_options['post-title-typography']['font-family'] == 'verdana,san-serif,helvatica' ) {
		$post_title_style = 'font-family:' . $thm_options['post-title-typography']['font-family'] . '; ';
	} else {
		$post_title_style = 'font-family:"' . $thm_options['post-title-typography']['font-family'] . '";';
	}
} else {
	$post_title_style = '';
}
$post_title_style .= ! empty( $thm_options['post-title-typography']['font-style'] ) ? 'font-style:' . $thm_options['post-title-typography']['font-style'] . '; ' : '';
$post_title_style .= ! empty( $thm_options['post-title-typography']['font-weight'] ) ? 'font-weight:' . $thm_options['post-title-typography']['font-weight'] . '; ' : '';
$post_title_style .= ! empty( $thm_options['post-title-typography']['word-spacing'] ) ? 'word-spacing:' . $thm_options['post-title-typography']['word-spacing'] . '; ' : '';
$post_title_style .= ! empty( $thm_options['post-title-typography']['text-transform'] ) ? 'text-transform:' . $thm_options['post-title-typography']['text-transform'] . '; ' : '';
$post_title_style .= ! empty( $thm_options['post-title-typography']['letter-spacing'] ) ? 'letter-spacing:' . $thm_options['post-title-typography']['letter-spacing'] . '; ' : '';
$post_title_style .= ! empty( $thm_options['post-title-typography']['color'] ) ? 'color:' . $thm_options['post-title-typography']['color'] . '; ' : '';
$post_title_style .= ! empty( $thm_options['post-title-typography']['text-align'] ) ? 'text-align:' . $thm_options['post-title-typography']['text-align'] . '; ' : '';
$post_title_style .= ! empty( $thm_options['post-title-typography']['line-height'] ) ? 'line-height:' . $thm_options['post-title-typography']['line-height'] . '; ' : '';
$post_title_style .= ! empty( $thm_options['post-title-typography']['font-size'] ) ? 'font-size:' . $thm_options['post-title-typography']['font-size'] . '; ' : '';

if ( ! empty( $post_title_style ) ) {
	echo '.blog-post h4, .blog-post h1, .blog-post h3, .blog-line h4, .blog-single-post h1, .blog-post h3.post-title {' . $post_title_style . '}';
}

/* single post title Typography */
if ( ! empty( $thm_options['single-post-title-typography']['font-family'] ) ) {
	if ( $thm_options['single-post-title-typography']['font-family'] == 'Open Sans,arial,helvatica' || $thm_options['single-post-title-typography']['font-family'] == 'BebasRegular,arial,helvatica' || $thm_options['single-post-title-typography']['font-family'] == 'LeagueGothicRegular,arial,helvatica' || $thm_options['single-post-title-typography']['font-family'] == 'Arial,helvetica,sans-serif' || $thm_options['single-post-title-typography']['font-family'] == 'helvetica,sans-serif,arial' || $thm_options['single-post-title-typography']['font-family'] == 'sans-serif,arial,helvatica' || $thm_options['single-post-title-typography']['font-family'] == 'verdana,san-serif,helvatica' ) {
		$single_post_title_style = 'font-family:' . $thm_options['single-post-title-typography']['font-family'] . ';';
	} else {
		$single_post_title_style = 'font-family:"' . $thm_options['single-post-title-typography']['font-family'] . '";';
	}
} else {
	$single_post_title_style = '';
}$single_post_title_style .= ! empty( $thm_options['single-post-title-typography']['font-style'] ) ? 'font-style:' . $thm_options['single-post-title-typography']['font-style'] . ';' : '';
$single_post_title_style  .= ! empty( $thm_options['single-post-title-typography']['font-weight'] ) ? 'font-weight:' . $thm_options['single-post-title-typography']['font-weight'] . ';' : '';
$single_post_title_style  .= ! empty( $thm_options['single-post-title-typography']['word-spacing'] ) ? 'word-spacing:' . $thm_options['single-post-title-typography']['word-spacing'] . ';' : '';
$single_post_title_style  .= ! empty( $thm_options['single-post-title-typography']['text-transform'] ) ? 'text-transform:' . $thm_options['single-post-title-typography']['text-transform'] . ';' : '';
$single_post_title_style  .= ! empty( $thm_options['single-post-title-typography']['letter-spacing'] ) ? 'letter-spacing:' . $thm_options['single-post-title-typography']['letter-spacing'] . ';' : '';
$single_post_title_style  .= ! empty( $thm_options['single-post-title-typography']['color'] ) ? 'color:' . $thm_options['single-post-title-typography']['color'] . ';' : '';
$single_post_title_style  .= ! empty( $thm_options['single-post-title-typography']['text-align'] ) ? 'text-align:' . $thm_options['single-post-title-typography']['text-align'] . ';' : '';
$single_post_title_style  .= ! empty( $thm_options['single-post-title-typography']['line-height'] ) ? 'line-height:' . $thm_options['single-post-title-typography']['line-height'] . ';' : '';
$single_post_title_style  .= ! empty( $thm_options['single-post-title-typography']['font-size'] ) ? 'font-size:' . $thm_options['single-post-title-typography']['font-size'] . ';' : '';

if ( ! empty( $single_post_title_style ) ) {
	echo '.wn-wrap .blog-single-post h1 {' . $single_post_title_style . '}';
}


/*
 * Body style
*/
$thm_options['deep_background_pattern'] = isset( $thm_options['deep_background_pattern'] ) ? $thm_options['deep_background_pattern'] : '';
if ( ! empty( $thm_options['deep_background_pattern'] ) && ( $thm_options['deep_background_pattern'] != 'none' ) ) {
	echo "body{background-image:url('{$thm_options['deep_background_pattern']}') !important; background-repeat:repeat;} ";
}

$thm_options['deep_wide_screen'] = isset( $thm_options['deep_wide_screen'] ) ? $thm_options['deep_wide_screen'] : '1';
if ( $thm_options['deep_wide_screen'] == '1' ) {
	echo '
    @media only screen and (min-width: 1367px) {
      .container {width: 96%;}
    }
  ';
}



/*
 * Footer Background image
*/
$footer_background_image = isset( $thm_options['deep_footer_background_image']['url'] ) ? $thm_options['deep_footer_background_image']['url'] : '';


if ( ! empty( $footer_background_image ) ) {
	echo "#wrap #footer { background-image: url('$footer_background_image'); background-size: cover;}\n";
}

/*
 * Custom Scrollbar
*/
$deep_custom_scrollbar = isset( $thm_options['deep_custom_scrollbar'] ) ? $thm_options['deep_custom_scrollbar'] : '1';

$deep_scrollbar_cursor_color    = isset( $thm_options['deep_scrollbar_cursor_color'] ) ? $thm_options['deep_scrollbar_cursor_color'] : '';
$deep_scrollbar_rail_background = isset( $thm_options['deep_scrollbar_rail_background'] ) ? $thm_options['deep_scrollbar_rail_background'] : '';
$deep_scrollbar_width           = isset( $thm_options['deep_scrollbar_width'] ) ? $thm_options['deep_scrollbar_width'] : '10';


if ( $deep_custom_scrollbar == '1' ) {

	echo "@media screen and (min-width: 960px) { #ascrail2000, #ascrail2000 .nicescroll-cursors { width: {$deep_scrollbar_width}px !important; } }";

	if ( $deep_scrollbar_rail_background ) {
		echo "@media screen and (min-width: 960px) { #ascrail2000 { background: {$deep_scrollbar_rail_background} !important; } }";
	}

	if ( $deep_scrollbar_cursor_color ) {
		echo "@media screen and (min-width: 960px) { #ascrail2000 .nicescroll-cursors { background-color: {$deep_scrollbar_cursor_color} !important; } }";
	}
}


/* Custom Inner scrollbar .color */
$deep_inner_scrollbar_handle_color = isset( $thm_options['deep_inner_scrollbar_handle_color'] ) ? $thm_options['deep_inner_scrollbar_handle_color'] : '';
if ( $deep_inner_scrollbar_handle_color ) {
	echo "#wn-inner-scroll-column .nicescroll-cursors { background-color: {$deep_inner_scrollbar_handle_color} !important; }";
}

/*
 * Header Style
*/

$thm_options['deep_container_width'] = isset( $thm_options['deep_container_width'] ) ? $thm_options['deep_container_width'] : '';
if ( ! empty( $thm_options['deep_container_width'] ) ) {
	$w_value = trim( $thm_options['deep_container_width'] );
	if ( $w_value ) {
		if ( substr( $w_value, -2, 2 ) != 'px' ) {
			$w_value .= 'px';
		};
		echo esc_attr( "#wrap .container {max-width:{$w_value};}\n\n" );
	}
} elseif ( empty( $thm_options['deep_container_width'] ) && get_option( 'elementor_container_width' ) == '' ) {
	echo esc_attr( "#wrap .container {max-width:inherit;}\n\n" );
}

$thm_options['deep_blog_container_width'] = isset( $thm_options['deep_blog_container_width'] ) ? $thm_options['deep_blog_container_width'] : '';
if ( ! empty( $thm_options['deep_blog_container_width'] ) ) {
	$w_value = trim( $thm_options['deep_blog_container_width'] );
	if ( $w_value ) {
		if ( substr( $w_value, -2, 2 ) != 'px' ) {
			$w_value .= 'px';
		};
		echo esc_attr( "body.archive #wrap .container.page-content, body.blog #wrap .container.page-content, body.blog-pg-w #wrap .container.page-content, body.search #wrap .container.search-results, body.search-no-results #wrap .container.search-results, body.single-post #wrap .container.page-content {max-width:{$w_value} !important;}\n\n" );
	}
}


$thm_options['deep_mobile_container_width_768'] = isset( $thm_options['deep_mobile_container_width_768'] ) ? $thm_options['deep_mobile_container_width_768'] : '';
if ( ! empty( $thm_options['deep_mobile_container_width_768'] ) ) {
	$w_value = trim( $thm_options['deep_mobile_container_width_768'] );
	if ( $w_value ) {
		if ( substr( $w_value, -2, 2 ) != 'px' ) {
			$w_value .= 'px';
		};
		echo esc_attr( "@media(min-width:481px) and (max-width: 768px){#wrap .container {max-width:{$w_value};}}\n\n" );
	}
}

$thm_options['deep_mobile_container_width_480'] = isset( $thm_options['deep_mobile_container_width_480'] ) ? $thm_options['deep_mobile_container_width_480'] : '';
if ( ! empty( $thm_options['deep_mobile_container_width_480'] ) ) {
	$w_value = trim( $thm_options['deep_mobile_container_width_480'] );
	if ( $w_value ) {
		if ( substr( $w_value, -2, 2 ) != 'px' ) {
			$w_value .= 'px';
		};
		echo esc_attr( "@media(min-width:321px) and (max-width: 480px){#wrap .container {max-width:{$w_value};}}\n\n" );
	}
}

$thm_options['deep_mobile_container_width_320'] = isset( $thm_options['deep_mobile_container_width_320'] ) ? $thm_options['deep_mobile_container_width_320'] : '';
if ( ! empty( $thm_options['deep_mobile_container_width_320'] ) ) {
	$w_value = trim( $thm_options['deep_mobile_container_width_320'] );
	if ( $w_value ) {
		if ( substr( $w_value, -2, 2 ) != 'px' ) {
			$w_value .= 'px';
		};
		echo esc_attr( "@media(max-width: 320px){#wrap .container {max-width:{$w_value};}}\n\n" );
	}
}

$thm_options['deep_header_padding_top'] = isset( $thm_options['deep_header_padding_top'] ) ? $thm_options['deep_header_padding_top'] : '';
if ( ! empty( $thm_options['deep_header_padding_top'] ) ) {
	$w_value = trim( $thm_options['deep_header_padding_top'] );
	if ( $w_value ) {
		if ( substr( $w_value, -2, 2 ) != 'px' ) {
			$w_value .= 'px';
		};
		echo esc_attr( "#header {padding-top:{$w_value};}\n\n" );
	}
}

$thm_options['deep_header_padding_bottom'] = isset( $thm_options['deep_header_padding_bottom'] ) ? $thm_options['deep_header_padding_bottom'] : '';
if ( ! empty( $thm_options['deep_header_padding_bottom'] ) ) {
	$w_value = trim( $thm_options['deep_header_padding_bottom'] );
	if ( $w_value ) {
		if ( substr( $w_value, -2, 2 ) != 'px' ) {
			$w_value .= 'px';
		};
		echo esc_attr( "#header {padding-bottom:{$w_value};}\n\n" );
	}
}

/*
 * Custom Fonts For P,H Tags
*/
$w_custom_font1_src = $w_custom_font2_src = $w_custom_font3_src = array();

// custom-font-1 font-face
if ( isset( $thm_options['deep_custom_font1_eot'] ) && isset( $thm_options['deep_custom_font1_eot']['url'] ) && $thm_options['deep_custom_font1_eot']['url'] ) {
	$w_custom_font1_src[] = "url('{$thm_options['deep_custom_font1_eot']['url']}?#iefix') format('embedded-opentype')";
}
if ( isset( $thm_options['deep_custom_font1_woff'] ) && isset( $thm_options['deep_custom_font1_woff']['url'] ) && $thm_options['deep_custom_font1_woff']['url'] ) {
	$w_custom_font1_src[] = "url('{$thm_options['deep_custom_font1_woff']['url']}') format('woff')";
}
if ( isset( $thm_options['deep_custom_font1_ttf'] ) && isset( $thm_options['deep_custom_font1_ttf']['url'] ) && $thm_options['deep_custom_font1_ttf']['url'] ) {
	$w_custom_font1_src[] = "url('{$thm_options['deep_custom_font1_ttf']['url']}') format('truetype')";
}

if ( ! empty( $w_custom_font1_src ) ) {
	$w_custom_font1_src = implode( ",\n", $w_custom_font1_src );
	echo "@font-face {
  font-family: 'custom-font-1';
  font-style: normal;
  font-weight: normal;
  src: {$w_custom_font1_src};\n}\n";
}

// custom-font-2 font-face
if ( isset( $thm_options['deep_custom_font2_eot'] ) && isset( $thm_options['deep_custom_font2_eot']['url'] ) && $thm_options['deep_custom_font2_eot']['url'] ) {
	$w_custom_font2_src[] = "url('{$thm_options['deep_custom_font2_eot']['url']}?#iefix') format('embedded-opentype')";
}
if ( isset( $thm_options['deep_custom_font2_woff'] ) && isset( $thm_options['deep_custom_font2_woff']['url'] ) && $thm_options['deep_custom_font2_woff']['url'] ) {
	$w_custom_font2_src[] = "url('{$thm_options['deep_custom_font2_woff']['url']}') format('woff')";
}
if ( isset( $thm_options['deep_custom_font2_ttf'] ) && isset( $thm_options['deep_custom_font2_ttf']['url'] ) && $thm_options['deep_custom_font2_ttf']['url'] ) {
	$w_custom_font2_src[] = "url('{$thm_options['deep_custom_font2_ttf']['url']}') format('truetype')";
}

if ( ! empty( $w_custom_font2_src ) ) {
	$w_custom_font2_src = implode( ",\n", $w_custom_font2_src );
	echo "@font-face {
  font-family: 'custom-font-2';
  font-style: normal;
  font-weight: normal;
  src: {$w_custom_font2_src};\n}\n";
}

// custom-font-3 font-face
if ( isset( $thm_options['deep_custom_font3_eot'] ) && isset( $thm_options['deep_custom_font2_eot']['url'] ) && $thm_options['deep_custom_font2_eot']['url'] ) {
	$w_custom_font3_src[] = "url('{$thm_options['deep_custom_font3_eot']['url']}?#iefix') format('embedded-opentype')";
}
if ( isset( $thm_options['deep_custom_font3_woff'] ) && isset( $thm_options['deep_custom_font3_woff']['url'] ) && $thm_options['deep_custom_font3_woff']['url'] ) {
	$w_custom_font3_src[] = "url('{$thm_options['deep_custom_font3_woff']['url']}') format('woff')";
}
if ( isset( $thm_options['deep_custom_font3_ttf'] ) && isset( $thm_options['deep_custom_font3_ttf']['url'] ) && $thm_options['deep_custom_font3_ttf']['url'] ) {
	$w_custom_font3_src[] = "url('{$thm_options['deep_custom_font3_ttf']['url']}') format('truetype')";
}

if ( ! empty( $w_custom_font3_src ) ) {
	$w_custom_font3_src = implode( ",\n", $w_custom_font3_src );
	echo "@font-face {
  font-family: 'custom-font-3';
  font-style: normal;
  font-weight: normal;
  src: {$w_custom_font3_src};\n}\n";
}

// Typekit
if ( isset( $thm_options['deep_adobe_typekit'] ) && $thm_options['deep_adobe_typekit'] == '1' && ! empty( $thm_options['deep_typekit_id'] ) ) {
	if ( ! empty( $thm_options['deep_typekit_font1'] ) ) {
		$typekit_1 = $thm_options['deep_typekit_font1'];
		if ( $thm_options['body-typography']['font-family'] == 'typekit-font-1' ) {
			echo "body { font-family: {$typekit_1} !important; }";
		}
		if ( $thm_options['p-typography']['font-family'] == 'typekit-font-1' ) {
			echo "body #wrap p { font-family: {$typekit_1} !important; }";
		}
		if ( $thm_options['all-h-typography']['font-family'] == 'typekit-font-1' ) {
			echo "body #wrap h1,body #wrap h2,body #wrap h3,body #wrap h4,body #wrap h5,body #wrap h6 { font-family: {$typekit_1} !important; }";
		}
		if ( $thm_options['h1-typography']['font-family'] == 'typekit-font-1' ) {
			echo "body #wrap h1 { font-family: {$typekit_1} !important; }";
		}
		if ( $thm_options['h2-typography']['font-family'] == 'typekit-font-1' ) {
			echo "body #wrap h2 { font-family: {$typekit_1} !important; }";
		}
		if ( $thm_options['h3-typography']['font-family'] == 'typekit-font-1' ) {
			echo "body #wrap h3 { font-family: {$typekit_1} !important; }";
		}
		if ( $thm_options['h4-typography']['font-family'] == 'typekit-font-1' ) {
			echo "body #wrap h4 { font-family: {$typekit_1} !important; }";
		}
		if ( $thm_options['h5-typography']['font-family'] == 'typekit-font-1' ) {
			echo "body #wrap h5 { font-family: {$typekit_1} !important; }";
		}
		if ( $thm_options['h6-typography']['font-family'] == 'typekit-font-1' ) {
			echo "body #wrap h6 { font-family: {$typekit_1} !important; }";
		}
		if ( $thm_options['menu-typography']['font-family'] == 'typekit-font-1' ) {
			echo "body #wrap ul.nav a { font-family: {$typekit_1} !important; }";
		}
		if ( $thm_options['sub-menu-typography']['font-family'] == 'typekit-font-1' ) {
			echo "body .nav ul li a { font-family: {$typekit_1} !important; }";
		}
		if ( $thm_options['post-title-typography']['font-family'] == 'typekit-font-1' ) {
			echo ".blog-post h4, .blog-post h1, .blog-post h3, .blog-line h4, .blog-single-post h1 { font-family: {$typekit_1} !important; }";
		}
		if ( $thm_options['single-post-title-typography']['font-family'] == 'typekit-font-1' ) {
			echo ".blog-single-post h1 { font-family: {$typekit_1} !important; }";
		}
	}
	if ( ! empty( $thm_options['deep_typekit_font2'] ) ) {
		$typekit_2 = $thm_options['deep_typekit_font2'];
		if ( $thm_options['body-typography']['font-family'] == 'typekit-font-2' ) {
			echo "body { font-family: {$typekit_2} !important; }";
		}
		if ( $thm_options['p-typography']['font-family'] == 'typekit-font-2' ) {
			echo "body #wrap p { font-family: {$typekit_2} !important; }";
		}
		if ( $thm_options['all-h-typography']['font-family'] == 'typekit-font-2' ) {
			echo "body #wrap h1,body #wrap h2,body #wrap h3,body #wrap h4,body #wrap h5,body #wrap h6 { font-family: {$typekit_2} !important; }";
		}
		if ( $thm_options['h1-typography']['font-family'] == 'typekit-font-2' ) {
			echo "body #wrap h1 { font-family: {$typekit_2} !important; }";
		}
		if ( $thm_options['h2-typography']['font-family'] == 'typekit-font-2' ) {
			echo "body #wrap h2 { font-family: {$typekit_2} !important; }";
		}
		if ( $thm_options['h3-typography']['font-family'] == 'typekit-font-2' ) {
			echo "body #wrap h3 { font-family: {$typekit_2} !important; }";
		}
		if ( $thm_options['h4-typography']['font-family'] == 'typekit-font-2' ) {
			echo "body #wrap h4 { font-family: {$typekit_2} !important; }";
		}
		if ( $thm_options['h5-typography']['font-family'] == 'typekit-font-2' ) {
			echo "body #wrap h5 { font-family: {$typekit_2} !important; }";
		}
		if ( $thm_options['h6-typography']['font-family'] == 'typekit-font-2' ) {
			echo "body #wrap h6 { font-family: {$typekit_2} !important; }";
		}
		if ( $thm_options['menu-typography']['font-family'] == 'typekit-font-2' ) {
			echo "body #wrap ul.nav a { font-family: {$typekit_2} !important; }";
		}
		if ( $thm_options['sub-menu-typography']['font-family'] == 'typekit-font-2' ) {
			echo "body .nav ul li a { font-family: {$typekit_2} !important; }";
		}
		if ( $thm_options['post-title-typography']['font-family'] == 'typekit-font-2' ) {
			echo ".blog-post h4, .blog-post h1, .blog-post h3, .blog-line h4, .blog-single-post h1 { font-family: {$typekit_2} !important; }";
		}
		if ( $thm_options['single-post-title-typography']['font-family'] == 'typekit-font-2' ) {
			echo ".blog-single-post h1 { font-family: {$typekit_2} !important; }";
		}
	}
	if ( ! empty( $thm_options['deep_typekit_font3'] ) ) {
		$typekit_3 = $thm_options['deep_typekit_font3'];
		if ( $thm_options['body-typography']['font-family'] == 'typekit-font-3' ) {
			echo "body { font-family: {$typekit_3} !important; }";
		}
		if ( $thm_options['p-typography']['font-family'] == 'typekit-font-3' ) {
			echo "body #wrap p { font-family: {$typekit_3} !important; }";
		}
		if ( $thm_options['all-h-typography']['font-family'] == 'typekit-font-3' ) {
			echo "body #wrap h1,body #wrap h2,body #wrap h3,body #wrap h4,body #wrap h5,body #wrap h6 { font-family: {$typekit_3} !important; }";
		}
		if ( $thm_options['h1-typography']['font-family'] == 'typekit-font-3' ) {
			echo "body #wrap h1 { font-family: {$typekit_3} !important; }";
		}
		if ( $thm_options['h2-typography']['font-family'] == 'typekit-font-3' ) {
			echo "body #wrap h2 { font-family: {$typekit_3} !important; }";
		}
		if ( $thm_options['h3-typography']['font-family'] == 'typekit-font-3' ) {
			echo "body #wrap h3 { font-family: {$typekit_3} !important; }";
		}
		if ( $thm_options['h4-typography']['font-family'] == 'typekit-font-3' ) {
			echo "body #wrap h4 { font-family: {$typekit_3} !important; }";
		}
		if ( $thm_options['h5-typography']['font-family'] == 'typekit-font-3' ) {
			echo "body #wrap h5 { font-family: {$typekit_3} !important; }";
		}
		if ( $thm_options['h6-typography']['font-family'] == 'typekit-font-3' ) {
			echo "body #wrap h6 { font-family: {$typekit_3} !important; }";
		}
		if ( $thm_options['menu-typography']['font-family'] == 'typekit-font-3' ) {
			echo "body #wrap ul.nav a { font-family: {$typekit_3} !important; }";
		}
		if ( $thm_options['sub-menu-typography']['font-family'] == 'typekit-font-3' ) {
			echo "body .nav ul li a { font-family: {$typekit_3} !important; }";
		}
		if ( $thm_options['post-title-typography']['font-family'] == 'typekit-font-3' ) {
			echo ".blog-post h4, .blog-post h1, .blog-post h3, .blog-line h4, .blog-single-post h1 { font-family: {$typekit_3} !important; }";
		}
		if ( $thm_options['single-post-title-typography']['font-family'] == 'typekit-font-3' ) {
			echo ".blog-single-post h1 { font-family: {$typekit_3} !important; }";
		}
	}
}


/*
 * Breadcrumbs Style
*/
$bc_padding_op = isset( $thm_options['breadcrumbs_padding'] ) ? $thm_options['breadcrumbs_padding'] : '';

if ( ! empty( $bc_padding_op ) ) {

	if ( ! empty( $bc_padding_op['padding-top'] ) ) {

		echo ' .breadcrumbs-w { padding-top: ' . esc_attr( $bc_padding_op['padding-top'] ) . ';}';

	}
	if ( ! empty( $bc_padding_op['padding-right'] ) ) {

		echo ' .breadcrumbs-w { padding-right: ' . esc_attr( $bc_padding_op['padding-right'] ) . ';}';

	}
	if ( ! empty( $bc_padding_op['padding-bottom'] ) ) {

		echo ' .breadcrumbs-w { padding-bottom: ' . esc_attr( $bc_padding_op['padding-bottom'] ) . ';}';

	}
	if ( ! empty( $bc_padding_op['padding-left'] ) ) {

		echo ' .breadcrumbs-w { padding-left: ' . esc_attr( $bc_padding_op['padding-left'] ) . ';}';

	}
}

// Breadcrumb in mobile
$bc_on_mobile = isset( $thm_options['deep_enable_mobile_breadcrumbs'] ) ? $thm_options['deep_enable_mobile_breadcrumbs'] : '0';
if ( $bc_on_mobile == '0' ) {

	echo '@media(max-width:767px) { .breadcrumbs-w { display: none;} }';

}

// Breadcrumb Height
$bc_height  = isset( $thm_options['breadcrumbs_height'] ) ? $thm_options['breadcrumbs_height'] : '';
$bc_mheight = isset( $thm_options['breadcrumbs_mobileheight'] ) ? $thm_options['breadcrumbs_mobileheight'] : '';

if ( ! empty( $bc_height ) ) {

	echo ' .breadcrumbs-w { height: ' . esc_attr( $bc_height ) . ';}';

}

if ( ! empty( $bc_mheight ) ) {

	echo '@media(max-width:767px) { .breadcrumbs-w { height: ' . esc_attr( $bc_mheight ) . ';} }';

}


/*
 * Footer Bottom Style
*/
$footer_bottom_left_style  = isset( $thm_options['deep_footer_bottom_left_align'] ) ? $thm_options['deep_footer_bottom_left_align'] : 'left';
$footer_bottom_right_style = isset( $thm_options['deep_footer_bottom_right_align'] ) ? $thm_options['deep_footer_bottom_right_align'] : 'right';

if ( $footer_bottom_left_style != 'left' ) {

	echo '@media(min-width:768px) { .footer-navi { text-align: ' . esc_attr( $footer_bottom_left_style ) . ';} }';

}

if ( $footer_bottom_right_style != 'right' ) {

	echo '@media(min-width:768px) { .footer-navi.floatright { text-align: ' . esc_attr( $footer_bottom_right_style ) . ';} }';

}

/*
 * Selection Color
 * */

 // selection_color
if ( isset( $thm_options['selection_color'] ) && $thm_options['selection_bg'] ) {
	echo "::selection { color:{$thm_options['selection_color']}; background:{$thm_options['selection_bg']};}\n\n";
}

/*
 Side
===========================================*/

/* Side Bar size */
$thm_options['deep_sidebar_width'] = isset( $thm_options['deep_sidebar_width'] ) ? $thm_options['deep_sidebar_width'] : '';
$thm_options['deep_blog_sidebar']  = isset( $thm_options['deep_blog_sidebar'] ) ? $thm_options['deep_blog_sidebar'] : '';
echo ( $thm_options['deep_blog_sidebar'] == 'both' ) ? '@media (min-width: 961px) {.col-md-3.sidebar, .vc_col-sm-4.sidebar { width: 25%;}}' : '';
if ( $thm_options['deep_sidebar_width'] ) {

	$thm_options['deep_sidebar_width'] = explode( 'px', $thm_options['deep_sidebar_width'] );
	$thm_options['deep_sidebar_width'] = $thm_options['deep_sidebar_width'][0] + 40;

	if ( $thm_options['deep_blog_sidebar'] != 'both' ) {
		echo '
		@media ( min-width: 1280px ) {
			.col-md-9.cntt-w,
			.vc_col-sm-8.cntt-w  {
				width: calc( 100% - ' . $thm_options['deep_sidebar_width'] . 'px );
			}
			.col-md-3.sidebar,
			.vc_col-sm-4.sidebar {
				width: ' . $thm_options['deep_sidebar_width'] . 'px;
			}
		}';

	}
}


/* Side Bar Options - Widgets and Title */
$thm_options['deep_custom_sidebar_widgets'] = isset( $thm_options['deep_custom_sidebar_widgets'] ) ? $thm_options['deep_custom_sidebar_widgets'] : '1';
$thm_options['deep_edit_widget_margin']     = isset( $thm_options['deep_edit_widget_margin'] ) ? $thm_options['deep_edit_widget_margin'] : '1';
$widget_margin_top                          = isset( $thm_options['deep_edit_widget_margin']['margin-top'] ) ? 'margin-top: ' . $thm_options['deep_edit_widget_margin']['margin-top'] . ';' : '0';
$widget_margin_bottom                       = isset( $thm_options['deep_edit_widget_margin']['margin-bottom'] ) ? 'margin-bottom: ' . $thm_options['deep_edit_widget_margin']['margin-bottom'] . ';' : '0';
$widget_margin_left                         = isset( $thm_options['deep_edit_widget_margin']['margin-left'] ) ? 'margin-right: ' . $thm_options['deep_edit_widget_margin']['margin-right'] . ';' : '0';
$widget_margin_right                        = isset( $thm_options['deep_edit_widget_margin']['margin-right'] ) ? 'margin-left: ' . $thm_options['deep_edit_widget_margin']['margin-left'] . ';' : '0';
if ( ! empty( $widget_margin_top ) || ! empty( $widget_margin_bottom ) || ! empty( $widget_margin_right ) || ! empty( $widget_margin_left ) ) {
	if ( $thm_options['deep_custom_sidebar_widgets'] == '1' ) {
		echo '
    .sidebar .widget,
    .wpb_column .widget {
      ' . $widget_margin_top . $widget_margin_bottom . $widget_margin_left . $widget_margin_right . '
    }
    ';
	}
}


// widgets box shadow
$deep_widgets_box_shadow = isset( $thm_options['deep_widgets_box_shadow'] ) ? $thm_options['deep_widgets_box_shadow'] : '';
if ( ! empty( $deep_widgets_box_shadow ) ) {
	if ( $thm_options['deep_custom_sidebar_widgets'] == '1' ) {
		$deep_widgets_box_shadow['rgba']       = isset( $deep_widgets_box_shadow['rgba'] ) ? $deep_widgets_box_shadow['rgba'] : '';
		$deep_widgets_box_shadow['horizontal'] = isset( $deep_widgets_box_shadow['horizontal'] ) ? $deep_widgets_box_shadow['horizontal'] : '';
		$deep_widgets_box_shadow['vertical']   = isset( $deep_widgets_box_shadow['vertical'] ) ? $deep_widgets_box_shadow['vertical'] : '';
		$deep_widgets_box_shadow['blur']       = isset( $deep_widgets_box_shadow['blur'] ) ? $deep_widgets_box_shadow['blur'] : '';
		$deep_widgets_box_shadow['spread']     = isset( $deep_widgets_box_shadow['spread'] ) ? $deep_widgets_box_shadow['spread'] : '';
		if ( $deep_widgets_box_shadow['rgba'] || $deep_widgets_box_shadow['horizontal'] || $deep_widgets_box_shadow['vertical'] || $deep_widgets_box_shadow['blur'] || $deep_widgets_box_shadow['spread'] ) {
			echo '
      .sidebar .widget {
        box-shadow: ' . $deep_widgets_box_shadow['rgba'] . '  ' . $deep_widgets_box_shadow['horizontal'] . '  ' . $deep_widgets_box_shadow['vertical'] . ' ' . $deep_widgets_box_shadow['blur'] . ' ' . $deep_widgets_box_shadow['spread'] . ';
      }';
		}
	}
}


// widgets padding
$widget_padding_top    = isset( $thm_options['deep_edit_widget_padding']['padding-top'] ) ? 'padding-top: ' . $thm_options['deep_edit_widget_padding']['padding-top'] . ';' : '0';
$widget_padding_bottom = isset( $thm_options['deep_edit_widget_padding']['padding-bottom'] ) ? 'padding-bottom: ' . $thm_options['deep_edit_widget_padding']['padding-bottom'] . ';' : '0';
$widget_padding_left   = isset( $thm_options['deep_edit_widget_padding']['padding-left'] ) ? 'padding-right: ' . $thm_options['deep_edit_widget_padding']['padding-right'] . ';' : '0';
$widget_padding_right  = isset( $thm_options['deep_edit_widget_padding']['padding-right'] ) ? 'padding-left: ' . $thm_options['deep_edit_widget_padding']['padding-left'] . ';' : '0';
if ( ! empty( $widget_padding_top ) || ! empty( $widget_padding_bottom ) || ! empty( $widget_padding_right ) || ! empty( $widget_padding_left ) ) {
	if ( $thm_options['deep_custom_sidebar_widgets'] == '1' ) {
		echo '
      .sidebar .widget,
      .wpb_column .widget {
        ' . $widget_padding_top . $widget_padding_bottom . $widget_padding_left . $widget_padding_right . '
      }
    ';
	}
}

$widget_content_padding_top    = isset( $thm_options['deep_edit_widget_content_padding']['padding-top'] ) ? 'padding-top: ' . $thm_options['deep_edit_widget_content_padding']['padding-top'] . ';' : '0';
$widget_content_padding_bottom = isset( $thm_options['deep_edit_widget_content_padding']['padding-bottom'] ) ? 'padding-bottom: ' . $thm_options['deep_edit_widget_content_padding']['padding-bottom'] . ';' : '0';
$widget_content_padding_left   = isset( $thm_options['deep_edit_widget_content_padding']['padding-left'] ) ? 'padding-right: ' . $thm_options['deep_edit_widget_content_padding']['padding-right'] . ';' : '0';
$widget_content_padding_right  = isset( $thm_options['deep_edit_widget_content_padding']['padding-right'] ) ? 'padding-left: ' . $thm_options['deep_edit_widget_content_padding']['padding-left'] . ';' : '0';
if ( ! empty( $widget_content_padding_top ) || ! empty( $widget_content_padding_bottom ) || ! empty( $widget_content_padding_right ) || ! empty( $widget_content_padding_left ) ) {
	if ( $thm_options['deep_custom_sidebar_widgets'] == '1' ) {
		echo '
      #wrap .widget > form,
      #wrap .widget > div:not(.subtitle-wrap),
      #wrap .widget .subtitle-wrap+form,
      #wrap .widget .subtitle-wrap+div+ul,
      #wrap .widget .subtitle-wrap+ul {
        ' . $widget_content_padding_top . $widget_content_padding_bottom . $widget_content_padding_left . $widget_content_padding_right . '
      }
    ';
	}
}

$thm_options['deep_edit_widget_border'] = isset( $thm_options['deep_edit_widget_border'] ) ? $thm_options['deep_edit_widget_border'] : '1';
$widget_border_color                    = isset( $thm_options['deep_edit_widget_border']['border-color'] ) ? ' ' . $thm_options['deep_edit_widget_border']['border-color'] . ' ' : '';
$widget_border_style                    = isset( $thm_options['deep_edit_widget_border']['border-style'] ) ? ' ' . $thm_options['deep_edit_widget_border']['border-style'] . ' ' : '';
$widget_border_top                      = isset( $thm_options['deep_edit_widget_border']['border-top'] ) ? ' border-top:' . $thm_options['deep_edit_widget_border']['border-top'] . $widget_border_style . $widget_border_color . '; ' : '0';
$widget_border_right                    = isset( $thm_options['deep_edit_widget_border']['border-right'] ) ? ' border-right:' . $thm_options['deep_edit_widget_border']['border-right'] . $widget_border_style . $widget_border_color . '; ' . ' ' : '0';
$widget_border_bottom                   = isset( $thm_options['deep_edit_widget_border']['border-bottom'] ) ? ' border-bottom:' . $thm_options['deep_edit_widget_border']['border-bottom'] . $widget_border_style . $widget_border_color . '; ' . ' ' : '0';
$widget_border_left                     = isset( $thm_options['deep_edit_widget_border']['border-left'] ) ? ' border-left:' . $thm_options['deep_edit_widget_border']['border-left'] . $widget_border_style . $widget_border_color . '; ' . ' ' : '0';
if ( $thm_options['deep_custom_sidebar_widgets'] == '1' ) {
	echo '
    #wrap .widget {
    ' . $widget_border_top . $widget_border_right . $widget_border_bottom . $widget_border_left . '
  }';
}

$title_shape = isset( $thm_options['deep_blog_sidebar_title_shape'] ) ? $thm_options['deep_blog_sidebar_title_shape'] : '0';
switch ( $title_shape ) :
	case '0':
		echo '
		#wrap .widget .subtitle-wrap h4.subtitle {
			color: #252525;
			padding: 0 0 10px;
			text-transform: uppercase;
			line-height: 20px;
			font-size: 18px;
			word-spacing: 1px;
			letter-spacing: -0.001em;
		}
		.widget .subtitle-wrap {
			position: relative;
			margin: 20px 0;
			padding-bottom: 4px;
			line-height: 18px;
			border-bottom: 1px solid #e5e5e5;
		}
		.widget .subtitle-wrap:before {
			content: "";
			width: 46px;
			height: 4px;
			position: absolute;
			bottom: -4px;
			left: 0;
			display: block;
			background: #437dfa;
		}
		.rtl .widget .subtitle-wrap:before {
			left: auto;
			right: 0;
		}';
		break;
	case '1':
		echo '
		#wrap .widget .subtitle-wrap .widget h4.subtitle {
			color: #4a4a4a;
			font-size: 17px;
			font-weight: 700;
			letter-spacing: .011em;
			word-spacing: .02em;
			line-height: 36px;
		}
		#wrap .widget .subtitle-wrap:before {
			content: "";
			width: 46px;
			height: 4px;
			position: absolute;
			bottom: -4px;
			background-color: #4a4a4a;
			display: block;
		}';
		break;
	case '2':
		echo '
		#wrap .widget .subtitle-wrap h4.subtitle {
			color: #252525;
			padding: 0;
			text-transform: uppercase;
			line-height: 20px;
			margin-left: 65px;
			font-size: 24px;
			word-spacing: 1px;
			letter-spacing: -0.001em;
		}
		.rtl #wrap .widget .subtitle-wrap h4.subtitle {
			margin-left: 0;
			margin-right: 65px;
		}
		#wrap .widget .subtitle-wrap h4.subtitle:before {
			content: "";
			position: absolute;
			width: 55px;
			height: 7px;
			background: #437df9;
			position: absolute;
			top: 50%;
			transform: translate(0, -50%);
			left: 0;
		}
		.rtl #wrap .widget .subtitle-wrap h4.subtitle:before {
			left: auto;
			right: 0;
		}';
		break;
	case '3':
		echo '
		#wrap .widget .subtitle-wrap {
			border-bottom: 1px solid #f0f0f0;
			text-align: center;
			padding-bottom: 3px;
			position: relative;
			margin-bottom: 26px;
			border-bottom: 1px solid #f0f0f0;
		}
		#wrap .widget .subtitle-wrap:after {
			content: "";
			width: 17px;
			height: 2px;
			position:absolute;
			bottom: -2px;
			left: 50%;
			transform : translate(-50%,0);
			-webkit-transform : translate(-50%,0);
			background: #fe1743;
		}';
		break;
	case '4':
		echo '
		#wrap .widget .subtitle-wrap {
			position: relative;
		}
		#wrap .widget .subtitle-wrap:before {
			content: "";
			width: 80px;
			height: 3px;
			position: absolute;
			bottom: -3px;
			display: block;
		}';
	case '5':
		echo '
		.widget .subtitle-wrap:before {
			display: none;
		}';
		break;
endswitch;

$thm_options['deep_edit_title_margin'] = isset( $thm_options['deep_edit_title_margin'] ) ? $thm_options['deep_edit_title_margin'] : '1';
$title_margin_top                      = $title_margin_bottom = '';
if ( ! empty( $thm_options['deep_edit_title_margin']['margin-top'] ) ) {
	if ( substr( $thm_options['deep_edit_title_margin']['margin-top'], -2 ) != 'px' && substr( $thm_options['deep_edit_title_margin']['margin-top'], -1 ) != '%' && substr( $thm_options['deep_edit_title_margin']['margin-top'], -2 ) != 'em' ) {
		$title_margin_top = 'margin-top:' . $thm_options['deep_edit_title_margin']['margin-top'] . 'px;';
	} else {
		$title_margin_top = 'margin-top:' . $thm_options['deep_edit_title_margin']['margin-top'] . ';';
	}
}
if ( ! empty( $thm_options['deep_edit_title_margin']['margin-bottom'] ) ) {
	if ( substr( $thm_options['deep_edit_title_margin']['margin-bottom'], -2 ) != 'px' && substr( $thm_options['deep_edit_title_margin']['margin-bottom'], -1 ) != '%' && substr( $thm_options['deep_edit_title_margin']['margin-bottom'], -2 ) != 'em' ) {
		$title_margin_bottom = 'margin-bottom:' . $thm_options['deep_edit_title_margin']['margin-bottom'] . 'px;';
	} else {
		$title_margin_bottom = 'margin-bottom:' . $thm_options['deep_edit_title_margin']['margin-bottom'] . ';';
	}
}
$title_margin_right = ! empty( $thm_options['deep_edit_title_margin']['margin-right'] ) ? 'margin-right:  ' . $thm_options['deep_edit_title_margin']['margin-right'] . ';' : '';
$title_margin_left  = ! empty( $thm_options['deep_edit_title_margin']['margin-left'] ) ? 'margin-left:   ' . $thm_options['deep_edit_title_margin']['margin-left'] . ';' : '';
if ( $title_margin_top || $title_margin_bottom || $title_margin_left || $title_margin_right ) {
	echo '
    #wrap .widget .subtitle-wrap {
      ' . $title_margin_top . $title_margin_bottom . $title_margin_left . $title_margin_right . '
    }';
}

$thm_options['deep_edit_title_text_margin'] = isset( $thm_options['deep_edit_title_text_margin'] ) ? $thm_options['deep_edit_title_text_margin'] : '1';
$title_text_margin_top                      = $title_text_margin_bottom = '';
if ( ! empty( $thm_options['deep_edit_title_text_margin']['margin-top'] ) ) {
	if ( substr( $thm_options['deep_edit_title_text_margin']['margin-top'], -2 ) != 'px' && substr( $thm_options['deep_edit_title_text_margin']['margin-top'], -1 ) != '%' && substr( $thm_options['deep_edit_title_text_margin']['margin-top'], -2 ) != 'em' ) {
		$title_text_margin_top = 'margin-top:' . $thm_options['deep_edit_title_text_margin']['margin-top'] . 'px;';
	} else {
		$title_text_margin_top = 'margin-top:' . $thm_options['deep_edit_title_text_margin']['margin-top'] . ';';
	}
}
if ( ! empty( $thm_options['deep_edit_title_text_margin']['margin-bottom'] ) ) {
	if ( substr( $thm_options['deep_edit_title_text_margin']['margin-bottom'], -2 ) != 'px' && substr( $thm_options['deep_edit_title_text_margin']['margin-bottom'], -1 ) != '%' && substr( $thm_options['deep_edit_title_text_margin']['margin-bottom'], -2 ) != 'em' ) {
		$title_text_margin_bottom = 'margin-bottom:' . $thm_options['deep_edit_title_text_margin']['margin-bottom'] . 'px;';
	} else {
		$title_text_margin_bottom = 'margin-bottom:' . $thm_options['deep_edit_title_text_margin']['margin-bottom'] . ';';
	}
}
$title_text_margin_left  = ! empty( $thm_options['deep_edit_title_text_margin']['margin-right'] ) ? 'margin-right:  ' . $thm_options['deep_edit_title_text_margin']['margin-right'] . ';' : '';
$title_text_margin_right = ! empty( $thm_options['deep_edit_title_text_margin']['margin-left'] ) ? 'margin-left:   ' . $thm_options['deep_edit_title_text_margin']['margin-left'] . ';' : '';
if ( $title_text_margin_top || $title_text_margin_bottom || $title_text_margin_left || $title_text_margin_right ) {
	echo '
      #wrap .widget .subtitle-wrap h4.subtitle {
        ' . $title_text_margin_top . $title_text_margin_bottom . $title_text_margin_left . $title_text_margin_right . '
      }';
}

$thm_options['deep_edit_title_padding'] = isset( $thm_options['deep_edit_title_padding'] ) ? $thm_options['deep_edit_title_padding'] : '1';
$title_padding_top                      = ! empty( $thm_options['deep_edit_title_padding']['padding-top'] ) ? 'padding-top:   ' . $thm_options['deep_edit_title_padding']['padding-top'] . ';' : '';
$title_padding_right                    = ! empty( $thm_options['deep_edit_title_padding']['padding-right'] ) ? 'padding-right: ' . $thm_options['deep_edit_title_padding']['padding-right'] . ';' : '';
$title_padding_bottom                   = ! empty( $thm_options['deep_edit_title_padding']['padding-bottom'] ) ? 'padding-bottom:  ' . $thm_options['deep_edit_title_padding']['padding-bottom'] . ';' : '';
$title_padding_left                     = ! empty( $thm_options['deep_edit_title_padding']['padding-left'] ) ? 'padding-left:  ' . $thm_options['deep_edit_title_padding']['padding-left'] . ';' : '';
if ( $title_padding_top || $title_padding_bottom || $title_padding_left || $title_padding_right ) {
	echo '
    #wrap .widget .subtitle-wrap h4.subtitle {
      ' . $title_padding_top . $title_padding_bottom . $title_padding_left . $title_padding_right . '
    }';
}

$thm_options['deep_edit_title_border'] = isset( $thm_options['deep_edit_title_border'] ) ? $thm_options['deep_edit_title_border'] : '1';
$title_border_color                    = ! empty( $thm_options['deep_edit_title_border']['border-color'] ) ? ' ' . $thm_options['deep_edit_title_border']['border-color'] . ' ' : '';
$title_border_style                    = ! empty( $thm_options['deep_edit_title_border']['border-style'] ) ? ' ' . $thm_options['deep_edit_title_border']['border-style'] . ' ' : '';
$title_border_top                      = ! empty( $thm_options['deep_edit_title_border']['border-top'] ) ? ' border-top:' . $thm_options['deep_edit_title_border']['border-top'] . $title_border_style . $title_border_color . '; ' : '';
$title_border_right                    = ! empty( $thm_options['deep_edit_title_border']['border-right'] ) ? ' border-right:' . $thm_options['deep_edit_title_border']['border-right'] . $title_border_style . $title_border_color . '; ' . ' ' : '';
$title_border_bottom                   = ! empty( $thm_options['deep_edit_title_border']['border-bottom'] ) ? ' border-bottom:' . $thm_options['deep_edit_title_border']['border-bottom'] . $title_border_style . $title_border_color . '; ' . ' ' : '';
$title_border_left                     = ! empty( $thm_options['deep_edit_title_border']['border-left'] ) ? ' border-left:' . $thm_options['deep_edit_title_border']['border-left'] . $title_border_style . $title_border_color . '; ' . ' ' : '';
if ( $title_border_top || $title_border_right || $title_border_bottom || $title_border_left ) {
	echo '
    #wrap .widget .subtitle-wrap {
      ' . $title_border_top . $title_border_right . $title_border_bottom . $title_border_left . '
    }';
}

$thm_options['deep_edit_title_font_size'] = ! empty( $thm_options['deep_edit_title_font_size'] ) ? 'font-size: ' . $thm_options['deep_edit_title_font_size'] . ';' : '';
if ( ! empty( $thm_options['deep_edit_title_font_size'] ) ) {
	echo '#wrap .widget .subtitle-wrap h4.subtitle { ' . $thm_options['deep_edit_title_font_size'] . '}';
}

if ( isset( $thm_options['deep_blog_featuredimage_enable'] ) && $thm_options['deep_blog_featuredimage_enable'] == '0' ) {
	// personalblog full
	echo '.blgtyp1 .blgtyp1-contnet, .showpost4-contnet { margin-left: 0; transform: translate(0,0); -webkit-transform: translate(0,0);}';
	// personalblog list
	echo '.blgtyp5 .omega { position: relative; right: auto; top: auto; transform: translate(0,0); -webkit-transform: translate(0,0);}';
	// magazine full
	echo '.wn-wrap .blgtyp11 .latest-b21-cont, .wn-wrap .latest-b21.col-md-6 .latest-b21-cont { margin-top: 50px; }';
	// magazine list
	echo '.blgtyp4 .omega { margin-left: 0;}';
}

/* .Color Skin */
$thm_options['deep_color_skin_type']	= isset( $thm_options['deep_color_skin_type'] ) ? $thm_options['deep_color_skin_type'] : 'predefined';
$thm_options['deep_color_skin']			= isset( $thm_options['deep_color_skin'] ) ? $thm_options['deep_color_skin'] : 'e3e3e3';
$thm_options['deep_custom_color_skin']	= isset( $thm_options['deep_custom_color_skin'] ) ? $thm_options['deep_custom_color_skin'] : '';


if ( $thm_options['deep_color_skin'] != 'e3e3e3' || $thm_options['deep_custom_color_skin'] ) {

	$color_custom     = ( $thm_options['deep_custom_color_skin'] ) ? $thm_options['deep_custom_color_skin'] : 'e3e3e3';
	$color_predefined = ( $thm_options['deep_color_skin'] != 'e3e3e3' ) ? $thm_options['deep_color_skin'] : 'e3e3e3';
	$color            = ( $thm_options['deep_color_skin_type'] == 'custom' ) ? $color_custom : '#' . $color_predefined; ?>
	/* == .color
	-----------------*/
	#wrap .w-category a, .w-course-price, .course-main .course-postmeta span, .widget .course-categories li a i, a.btn.btn-default.btn-sm.active, .switch-field input:checked+label, .widget .nice-select span, .widget .nice-select span, .colorskin-custom .w-pricing-table.pt-type10 .pt-features .feature-icon, .colorskin-custom .w-pricing-table.pt-type7 .pt-features .feature-icon, .colorskin-custom .ourteam-owl-carousel-type10 .ourteam-item .t-footer a i:hover, .colorskin-custom .our-team14:hover .social-team i:hover, .colorskin-custom .icon-box7 i, .colorskin-custom .teaser-box18 .tb18-content .wn-button-box .wn-btn, .colorskin-custom .book-form-deep .nice-select, .colorskin-custom #user-login .login-links li a, .colorskin-custom #user-login .login-links li a:hover, .colorskin-custom .latest-b-carousel .owl-nav .owl-next:after, .colorskin-custom .latest-b-carousel .owl-nav .owl-prev:after, .colorskin-custom #w-login h3, .colorskin-custom nav.woocommerce-pagination ul li span.current, .colorskin-custom .wn-woo-wrap .products li .wn-woo-contents-wrap h3 a:hover, .colorskin-custom .wn-woo-wrap .products li .wn-woo-contents-wrap .posted_in a:hover, .colorskin-custom .wn-woo-wrap .wn-woo-contents-wrap>a:hover, .colorskin-custom .room-list-view-more:hover, .colorskin-custom .room-list-extra-services, .colorskin-custom .wn-woo-wrap .products li .wn-woo-thumbnail-wrap .wn-woo-thumbnail-hover .wn-woo-btn:hover i, .colorskin-custom .wn-woo-wrap .products li .wn-woo-thumbnail-wrap .wn-woo-thumbnail-hover .wn-woo-btn:hover i, .colorskin-custom .wn-woo-wrap .products li .wn-woo-thumbnail-wrap .wn-woo-thumbnail-hover .wn-woo-btn:hover a, .colorskin-custom .wn-woo-wrap .products li .wn-woo-thumbnail-wrap .wn-woo-thumbnail-hover .wn-woo-btn.wn-woo-compare-btn:hover .compare-button a:before, .colorskin-custom #hotel-booking-results .hb-search-results > .hb-room .hb-room-name a:hover, .colorskin-custom #hotel-booking-results .hb-search-results > .hb-room .hb-room-meta li .hb_search_item_price, .colorskin-custom .htc-booking .hb_input_field:after, .colorskin-custom .hb_single_room #reviews #review_form_wrapper form .form-submit input[type="submit"], .colorskin-custom #webnus-header-builder .woocommerce-mini-cart__total.total span.woocommerce-Price-amount.amount,.colorskin-custom #webnus-header-builder span.woocommerce-Price-amount.amount,.colorskin-custom .max-quote h2:after, .colorskin-custom .max-quote h2:before, .colorskin-custom .max-quote cite, #wrap.colorskin-custom .sermons-toggle .sermon-wrap-toggle .wn-sertg-content .media-links .button span,.colorskin-custom .sermon-wrap-toggle .wn-sertg-content .wn-sertg-speaker a,.colorskin-custom .sermons-toggle2 .sermon-wrap-toggle .wn-sertg-meta i,.colorskin-custom .sermons-simple article:hover h4 a,.colorskin-custom .sermons-clean h4 a:hover,.colorskin-custom .sermon-carousel.sermons-grid .sermon-grid-item .sermon-grid-content .sermon-readmore:hover,.colorskin-custom .sermons-clean .sermon-clean-item .sermon-detail a,.colorskin-custom .sermons-grid .sermon-grid-item .sermons-grid-wrap .sermon-grid-content .media-links a i:hover,.woocommerce-account .colorskin-custom .woocommerce .woocommerce-MyAccount-navigation li:hover a,.colorskin-custom .latest-27 .latest-title a:hover, #wrap.colorskin-custom .wn-backto-shop.button.theme-skin.bordered-bot span, .colorskin-custom .sermons-minimal a:hover h4, .colorskin-custom .sermons-minimal .sermon-detail a:hover, .colorskin-custom .sermons-minimal h4:hover, .colorskin-custom .cause-title.hcolorf:hover, .colorskin-custom .wn-wrap-social:hover, .colorskin-custom .pe-7s-mail:hover, .colorskin-custom .widget-subscribe-submit, .colorskin-custom .our-team4:hover, .colorskin-custom .sermon-grid-header h4:hover, .colorskin-custom .sermon-grid-cat a:hover, .colorskin-custom .sermon-readmore:hover, #wrap.colorskin-custom .wn-loadmore-ajax a, .colorskin-custom .blox.dark .testimonial-brand h5 strong,.colorskin-custom .wn-share-shortcode .wn-share-shortcode-dropdown a:hover i:before, .colorskin-custom .wn-latest-b23 .latest-b23-content h2 a:hover, .colorskin-custom .wn-avatar-block .owl-next i:hover, .colorskin-custom .wn-avatar-block .owl-prev i:hover, .colorskin-custom .testimonial-carousel .owl-nav .owl-prev:hover, .colorskin-custom .testimonial-carousel .owl-nav .owl-next:hover, .colorskin-custom .our-team13 .our-team-socail .social-team i:hover, .book-form-deep .nice-select, .colorskin-custom .icon-box23 i, .colorskin-custom .icon-box23 img, .colorskin-custom .wn-social-network-type2 .socialfollow a i, .colorskin-custom .icon-box8 i, .colorskin-custom .blox.dark .ctd-type-5 .block-w .count-w, .colorskin-custom .post-sharing-4:hover h6, .colorskin-custom .socialfollow a i, .colorskin-custom .teaser-box14 .teaser-title:before, .colorskin-custom .our-process-item-type2 span, .colorskin-custom #footer.litex .widget ul.menu li a:hover, .colorskin-custom .yith-wcwl-share ul li a:hover, .colorskin-custom .wn-wishlist-single-wrap .wn-remove-from-wishlist, .colorskin-custom .wn-wishlist-single-wrap .wn-remove-from-wishlist:hover, .colorskin-custom .wn-wishlist-single-wrap .wn-wishlist-product-title-sl:hover, .colorskin-custom .wn-wishlist-single-wrap .wishlist-in-stock, .colorskin-custom .wn-wishlist-single-wrap .wn-add-to-cart-single, .colorskin-custom .wn-woo-wrap .wn-woo-product-categories .cat-item.current-cat a, .colorskin-custom .wn-woo-wrap .wn-woo-product-categories .cat-item:hover a, .colorskin-custom .wn-woo-wrap .products li .wn-woo-thumbnail-wrap .wn-woo-thumbnail-hover .wn-woo-btn:hover i,.colorskin-custom .wn-woo-wrap .products li .wn-woo-thumbnail-wrap .wn-woo-thumbnail-hover .wn-woo-btn:hover a, .colorskin-custom .wn-woo-wrap .products li .wn-woo-thumbnail-wrap .wn-woo-thumbnail-hover .wn-woo-btn.wn-woo-compare-btn:hover .compare-button a:before, .colorskin-custom .wn-woo-wrap .nice-select.orderby .option:hover, .colorskin-custom .nice-select.orderby .option.selected, .colorskin-custom .nice-select:after, #wrap.colorskin-custom .wp-pagenavi span.current, #wrap.colorskin-custom .vc_tta-color-white.vc_tta-style-modern.vc_tta-o-shape-group .vc_tta-tab.vc_active>a i.vc_tta-icon, .transparent-header-w.t-dark-w #wrap.colorskin-custom .top-bar h6 i, .transparent-header-w.t-dark-w #wrap.colorskin-custom .top-bar .top-links a:hover, #wrap.colorskin-custom .top-bar.litex .top-custom-text a, #wrap.colorskin-custom .top-bar .top-custom-text a:hover, #wrap.colorskin-custom .blog-social-1 a:hover, #wrap.colorskin-custom .blog-social-1 a:hover i, #wrap.colorskin-custom .colorf, #wrap.colorskin-custom .hcolorf:hover, #wrap.colorskin-custom .vc_images_carousel .vc_carousel-control:hover, #wrap.colorskin-custom .vc_images_carousel .vc_carousel-control span:hover, #wrap.colorskin-custom .hebe .tp-tab-title, #wrap.colorskin-custom .testimonial-slider-owl-carousel.ts-di .owl-prev:hover, #wrap.colorskin-custom .testimonial-slider-owl-carousel.ts-di .owl-next:hover, #wrap.colorskin-custom .testimonial-slider-owl-carousel.ts-di .owl-prev:hover, #wrap.colorskin-custom .testimonial-slider-owl-carousel.ts-di .owl-next:hover, #wrap.colorskin-custom .testimonial-slider-owl-carousel.ts-tetra .owl-prev, #wrap.colorskin-custom .testimonial-slider-owl-carousel.ts-tetra .owl-next, #wrap.colorskin-custom .testimonial-slider-owl-carousel.ts-hexa .owl-prev:after,  #wrap.colorskin-custom .latest-author span a:hover, #wrap.colorskin-custom .vc_tta-color-white.vc_tta-style-flat .vc_tta-tab.vc_active > a, #wrap.colorskin-custom .wn-content-slider.arrow-type-arrow3 .content-slider-arrow-icon i, #wrap.colorskin-custom .book-form-deep .r-date:after, #wrap.colorskin-custom #footer .widget ul li .yith-wcbsl-widget-title a, #wrap.colorskin-custom .icon-box9 a.magicmore, #wrap.colorskin-custom .icon-box15 .magicmore:hover:after, #wrap.colorskin-custom .wn-hamburger-wrap .full-menu .current a, #wrap.colorskin-custom .wn-header-toggle .widget_woocommerce-header-cart:hover .woo-cart-header .header-cart:after, .colorskin-custom .breadcrumbs-w i, .colorskin-custom .footer-subscribe-submit, .colorskin-custom .top-bar .socialfollow a:hover i, .colorskin-custom .footer-navi a:after, .colorskin-custom .footer-navi a:hover, .custom-footer-menu a:hover, .colorskin-custom .is-open.wn-ht .hamburger-social-icons a:hover, .colorskin-custom .top-links a:hover, .colorskin-custom .top-bar .inlinelb:hover, .colorskin-custom blockquote:before, .colorskin-custom ul.check li:before, .colorskin-custom li.check:before, .colorskin-custom ul.cross li:before, .colorskin-custom li.cross:before, .colorskin-custom .pbx-req .wn-prayer-inner .wn-prayer-request-name, .colorskin-custom a.liked:hover, .colorskin-custom a.liked:active, .colorskin-custom a.liked:focus, .colorskin-custom .pin-box h4 a:hover, .colorskin-custom .tline-box h4 a:hover, .colorskin-custom .pin-ecxt h6.blog-cat a:hover, .colorskin-custom .pin-ecxt2 p a:hover, .colorskin-custom .postmetadata h6.blog-cat a:hover, .colorskin-custom h6.blog-cat a, .colorskin-custom .blgtyp3.blog-post h6 a, .colorskin-custom .blgtyp2.blog-post h6 a, .colorskin-custom .blog-single-post .postmetadata h6 a, .colorskin-custom .blog-single-post h6.blog-author a, .colorskin-custom .blgtyp3.blog-post h6 a:hover, .colorskin-custom .blgtyp1.blog-post h6 a:hover, .colorskin-custom .blgtyp2.blog-post h6 a:hover, .colorskin-custom .blog-single-post .postmetadata h6 a:hover, .colorskin-custom .blog-single-post h6.blog-author a:hover, .colorskin-custom .blog-post a:hover, .colorskin-custom .blog-author span, .colorskin-custom .blog-line p a:hover, .colorskin-custom .blog-post p.blog-cat a, .colorskin-custom .blog-line p.blog-cat a, .colorskin-custom .blog-date-sp h3, .colorskin-custom h6.blog-date a:hover, .colorskin-custom h6.blog-cat a:hover, .colorskin-custom h6.blog-author a:hover, .colorskin-custom .about-author-sec h5 a:hover, .colorskin-custom blog-line:hover .img-hover:before, .colorskin-custom .blog-line:hover h4 a, .colorskin-custom .rec-post h5 a:hover, .colorskin-custom .rec-post p a:hover, .colorskin-custom a.magicmore, .colorskin-custom a.addtocart, .colorskin-custom a.select-options, .colorskin-custom a.readmore, .colorskin-custom a.magicmore, .colorskin-custom a.addtocart:hover, .colorskin-custom a.select-options:hover, .colorskin-custom .commentlist li .comment-text .reply a, .colorskin-custom .w-next-article:hover a, .colorskin-custom .w-prev-article:hover a, .colorskin-custom .w-next-article:hover i, .colorskin-custom .w-prev-article:hover i, body .colorskin-custom .colorf, body .colorskin-custom .hcolorf:hover, .colorskin-custom .video-play-btn i:hover, .colorskin-custom .blox.dark .max-counter.s-counter .max-count, .colorskin-custom .max-counter.e-counter .max-count, .colorskin-custom .wn-social-network-type3 .socialfollow a:hover i, .colorskin-custom .our-team5 h5, .colorskin-custom .our-team5 .social-team a i:hover:before, .colorskin-custom .our-team6 h5, .colorskin-custom .our-team7 figcaption h2, .colorskin-custom .our-team7 i:hover, .colorskin-custom .ourteam-owl-carousel-type10 .owl-item .ourteam-item .t-footer ul li a i:hover, .colorskin-custom .testimonial2 .testimonial-content h5, .colorskin-custom .our-clients-wrap .owl-nav .owl-prev:after, .colorskin-custom .our-clients-wrap .owl-nav .owl-next:after, .colorskin-custom .testimonial-carousel.testi-carou-3 .tc-name, .colorskin-custom .testimonial-carousel.testi-carou-3 .tc-job, .colorskin-custom .pricing-plan1 .ppfooter .readmore, .colorskin-custom .pricing-plan2 .ppfooter .readmore, .colorskin-custom .our-process-item:hover i, .colorskin-custom .buy-process-item h4, .colorskin-custom .buy-process-item.featured i, .colorskin-custom .contact-info i, .colorskin-custom .acc-trigger a:hover, .colorskin-custom .acc-trigger.active a, .colorskin-custom .acc-trigger.active a:hover, .colorskin-custom .w-pricing-table.pt-type1 .price-footer a:hover, .colorskin-custom .w-pricing-table.pt-type1 .pt-features .feature-icon, .colorskin-custom .w-pricing-table.pt-type1 .pt-footer a, .colorskin-custom .w-pricing-table.pt-type1 .pt-footer a, .colorskin-custom .w-pricing-table.pt-type1.featured .pt-footer a, .colorskin-custom .w-pricing-table.pt-type1.featured .pt-footer a, .colorskin-custom .w-pricing-table.pt-type2 > span, .colorskin-custom .w-pricing-table.pt-type3 .pt-footer a, .colorskin-custom .w-pricing-table.pt-type3.featured .pt-footer a, .colorskin-custom .w-pricing-table.pt-type5 .pt-features .feature-icon, .colorskin-custom .w-pricing-table.pt-type7 .plan-title, .colorskin-custom .wn-portfolio-nav .wn-portfolio-nav-wrap:hover .wn-portfolio-nav-text i, .colorskin-custom .wn-portfolio-nav .wn-portfolio-nav-wrap:hover .wn-portfolio-nav-text span, .colorskin-custom .related-works .portfolio-item:hover h5 a, .colorskin-custom .w-pricing-table.pt-type2 .pt-footer a, .colorskin-custom .subscribe-modern .subscribe-box-input .subscribe-box-email, .colorskin-custom .blox.dark .subscribe-modern .subscribe-box-input .subscribe-box-submit, .colorskin-custom .teaser-box2 a:hover .teaser-title, .colorskin-custom .teaser-box2 a:after, .colorskin-custom .teaser-box3:hover .teaser-subtitle:after, .colorskin-custom .teaser-box5:hover .teaser-title, .colorskin-custom .teaser-box12 .teaser-subtitle:after, .colorskin-custom .latestnews2 .ln-item .ln-content .ln-button:hover, .colorskin-custom .latestnews2 .ln-content .ln-title:hover, .colorskin-custom .dark.blox .latestnews2 .ln-content .ln-title:hover #w-login h3, .colorskin-custom #w-login .login-links li a, .colorskin-custom .ts-di .testimonial .testimonial-content h4 q:before, .colorskin-custom .ts-di.testimonial-slider-owl-carousel .owl-pagination span i:hover, .colorskin-custom .ts-di.testimonial-slider-owl-carousel .owl-pagination span i:hover:before, .colorskin-custom .testimonial-slider-owl-carousel.ts-mono .testimonial-content:before, .colorskin-custom .ts-di .testimonial .testimonial-content h4 q:before, .colorskin-custom .ts-di.testimonial-slider-owl-carousel .owl-pagination span i:hover, .colorskin-custom .ts-di.testimonial-slider-owl-carousel .owl-pagination span i:hover:before, .colorskin-custom .ts-tri.testimonial-slider-owl-carousel .testimonial-content h4 q:before, .colorskin-custom .ts-hexa .testimonial .testimonial-content h4 q:after, .latest-b-carousel .owl-nav .owl-prev:after, .colorskin-custom .latest-b-carousel .owl-nav .owl-next:after, .colorskin-custom .post-format-icon, .colorskin-custom .latestposts-one .latest-title a:hover, .colorskin-custom .latestposts-one .latest-author a:hover, .colorskin-custom .latestposts-two .blog-post p.blog-author a:hover, .colorskin-custom .latestposts-two .blog-line p.blog-cat a, .colorskin-custom .latestposts-two .blog-line:hover h4 a, .colorskin-custom .latestposts-two .blog-line:hover .img-hover:before, .colorskin-custom .latestposts-three h6.latest-b2-cat a, .colorskin-custom .latestposts-three .latest-b2-metad2 span a:hover, .colorskin-custom .latestposts-four h3.latest-b2-title a:hover, .colorskin-custom .latestposts-five h6.latest-b2-cat a, .colorskin-custom .latestposts-six .latest-content p.latest-date, .colorskin-custom .latestposts-six .latest-title a:hover, .colorskin-custom .latestposts-six .latest-author a:hover, .colorskin-custom .latestposts-seven .wrap-date-icons h3.latest-date, .colorskin-custom .latestposts-seven .latest-content .latest-title a:hover, .colorskin-custom .latestposts-seven .latest-content .latest-author a, .colorskin-custom .latestposts-seven .latest-content .latest-author a:hover, .colorskin-custom .latestposts-nine .latest-b9 h3 .link, .colorskin-custom .latestposts-ten .latest-b10 .latest-b10-content a.readmore, .colorskin-custom .latestposts-eleven .latest-b11 .latest-b11-meta .date:after, .colorskin-custom .latestposts-twelve .latest-b12 .latest-b12-cont .latest-b12-cat a, .colorskin-custom .latestposts-twelve .latest-b12 .latest-b12-cont .latest-b12-author:hover a, .colorskin-custom .latestposts-twelve .latest-b12 .latest-b12-cont .latest-b12-title:hover a, .colorskin-custom .latest-b13-title a:hover, .colorskin-custom .latest-b13-author a:hover, .colorskin-custom .latest-b13-cat:hover a, .colorskin-custom .wn-latest-b15 .latest-b15 .latest-b15-content .latest-b15-meta-data a:hover, .colorskin-custom .wn-latest-b15 .latest-b15 .latest-b15-content h2 a:hover, .colorskin-custom .wn-latest-b16 .latest-b16 .latest-b16-overlay .latest-b16-meta-data a:hover, .colorskin-custom .wn-latest-b16 .latest-b16 .latest-b16-overlay h3:hover a, .colorskin-custom .wn-latest-b16 .latest-b16 .latest-b16-content .latest-b16-readmore:hover, .colorskin-custom .wn-latest-b16 .latest-b16 .latest-b16-content .latest-b16-footer .latest-author strong a:hover, .colorskin-custom .wn-latest-b17 .latest-b17 .latest-b17-content h3 a:hover, .colorskin-custom .wn-latest-b17 .latest-b17 .latest-b17-content .latest-b17-readmore:hover, .colorskin-custom .latestposts-ninteen .latest-b19:hover .latest-b19-cont .latest-b19-title a, .colorskin-custom .wn-latest-b22 .latest-b22:hover .latest-b22-content h2 a, .colorskin-custom .a-post-box-1 .latest-title a:hover, .colorskin-custom .a-post-box-2 .latest-title a:hover, .colorskin-custom .vc_tta-tabs.vc_tta-style-modern.vc_tta-shape-round .vc_tta-tab .vc_tta-icon, .colorskin-custom .w-login #user-login .login-links li a, .colorskin-custom .w-login #user-login .login-links li a:hover, .colorskin-custom .wn-vertical-carousel .owl-nav .owl-prev .ol-pre:after, .colorskin-custom .wn-vertical-carousel .owl-nav .owl-next .ol-nxt:after, .colorskin-custom .wn-newsletter .wn-newsletter-close, .colorskin-custom .book-form-deep strong, .colorskin-custom .book-form-deep p, .colorskin-custom .book-form-deep .nice-select:after, .colorskin-custom .postslider-owl-carousel.postslider-1 .latest-title a:hover, .colorskin-custom .widget ul li a:hover, .colorskin-custom .widget ul li .comment-author-link a:hover, .colorskin-custom .footer-in .widget ul li a:hover, .colorskin-custom #footer .widget .socialfollow a:hover i #footer .side-list ul li:hover a, .colorskin-custom .widget ul li.cat-item a:hover, .colorskin-custom .widget ul li.recentcomments a:hover, .colorskin-custom .widget ul li.page_item a:hover, .colorskin-custom .sidebar .widget .tabs li:hover a, .colorskin-custom .sidebar .widget .tabs li.active a, .colorskin-custom #wp-calendar tfoot #prev a, .colorskin-custom .woo-cart-dropdown ul li a:hover, .colorskin-custom .personal-sidebar .widget .widget-subscribe-form button:hover, .colorskin-custom .personal-sidebar .widget .widget-subscribe-form button:hover:before, .colorskin-custom .personal-sidebar .side-list h5 a:hover, .colorskin-custom .icon-box i, .colorskin-custom .icon-box1 h5, .colorskin-custom .icon-box2 i, .colorskin-custom .icon-box3 i, .colorskin-custom .icon-box4 i, .colorskin-custom .icon-box5 i, .colorskin-custom .icon-box8 i, .colorskin-custom .blox.dark .icon-box9 i, .colorskin-custom .icon-box10 h5, .colorskin-custom .icon-box11 i, .colorskin-custom .icon-box12 i, .colorskin-custom .blox.dark .icon-box12:hover a.magicmore, .colorskin-custom .icon-box13 i, .colorskin-custom .icon-box14 i, .colorskin-custom .icon-box15 img, .colorskin-custom .icon-box15 i, .colorskin-custom .icon-box16 i, .colorskin-custom .icon-box16 h4, .colorskin-custom .icon-box16 p strong, .colorskin-custom .icon-box17, .colorskin-custom .icon-box16 a.magicmore, .colorskin-custom .icon-box17 i, .colorskin-custom .icon-box19 i, .colorskin-custom .icon-box20 i, .colorskin-custom .icon-box20:hover h4, .colorskin-custom .icon-box22:hover h4, .colorskin-custom .icon-box22:hover i, .colorskin-custom .icon-box22.w-featured i, .colorskin-custom .icon-box22.w-featured h4, .colorskin-custom .icon-box23 i, .colorskin-custom .icon-box23 img, .colorskin-custom .icon-box24 i, .colorskin-custom .icon-box26 img, .colorskin-custom .icon-box26 i, .colorskin-custom .icon-box27 i, .colorskin-custom .icon-colorx i, .colorskin-custom i.icon-colorx, .colorskin-custom .icon-box28 i, .colorskin-custom .blox.dark .icon-box28:hover, .colorskin-custom .blox.dark .icon-box28:hover *, .colorskin-custom .icon-box29 i, .colorskin-custom .nav a:hover, .colorskin-custom .nav li:hover > a, .colorskin-custom .nav > li.current > a, .colorskin-custom .nav > li > a.active, .colorskin-custom .nav > li:hover > a, .colorskin-custom #header .nav .active a, .colorskin-custom #header.sticky .nav-wrap .nav .nav > li:hover > a, .colorskin-custom .dark-submenu .nav ul li a:hover, .colorskin-custom .nav li > ul li a:hover, .colorskin-custom .nav li.current ul li a:hover, .colorskin-custom .nav-wrap2 .nav ul li a:hover, .colorskin-custom .nav-wrap2.darknavi .nav ul li a:hover, .colorskin-custom .nav ul li.current > a, .colorskin-custom .nav ul li:hover > a, .colorskin-custom .dark-submenu .nav li.mega ul[class^="sub-"] li a:hover, .colorskin-custom .dark-submenu .nav li.mega ul.sub-posts li a:hover, .colorskin-custom .nav-wrap2 .nav > li:hover > a, .colorskin-custom .top-links .nav > li:hover > a, .colorskin-custom .nav-wrap2.darknavi .nav > li > a:hover, .colorskin-custom .nav-wrap2.darknavi .nav > li:hover > a, .colorskin-custom .nav-wrap2 .nav > li.current > a, .colorskin-custom #header.sticky .nav-wrap2.darknavi .nav > li > a:hover, .colorskin-custom .w-header-type-11 .nav > li:hover > a, .colorskin-custom #hamburger-menu #hamburger-nav li:hover > a, .colorskin-custom #hamburger-menu #hamburger-nav li.current > a, .colorskin-custom #hamburger-menu.hm-dark #hamburger-nav li:hover > a, .colorskin-custom #hamburger-menu.hm-dark #hamburger-nav li.current > a, .colorskin-custom #responav .mega li.menu-item a:not(.button):hover, .colorskin-custom .top-header-sec .wtop-weather, .colorskin-custom .top-header-sec .container div:first-child a:hover, .colorskin-custom .top-header-sec .inlinelb:hover, .colorskin-custom .header-type-12.sticky .nav-wrap2 .nav > li.current > a, .colorskin-custom .header-type-12.sticky .nav-wrap2 .nav > li:hover > a, .colorskin-custom #header.box-menu h6 i, .colorskin-custom #header.duplex-hd .nav > li > a.active, .colorskin-custom #header.duplex-hd .nav > li > a.active, .colorskin-custom .nav.duplex-menu > li.current > a, .colorskin-custom .transparent-header-w.t-dark-w #header.horizontal-w.duplex-hd .nav > li:hover > a, .colorskin-custom .transparent-header-w.t-dark-w #header.horizontal-w.duplex-hd .nav > li.current > a, .colorskin-custom #header.sm-rgt-mn #menu-icon:hover i, .colorskin-custom #header.sm-rgt-mn #menu-icon.active i, .colorskin-custom .nav > li:hover > a, .colorskin-custom .nav li.current > a, .colorskin-custom .nav li.active > a, .colorskin-custom #header-share-modal .socialfollow a:hover i, .colorskin-custom #header .wn-header-toggle:hover i, .colorskin-custom #header.w-header-type-13 .tools-section div.active i, #wrap.colorskin-custom .vc_tta-accordion.vc_tta-style-classic.vc_tta-shape-square .vc_tta-controls-icon-position-right .vc_active:before, #wrap.colorskin-custom #commentform input[type="submit"], .colorskin-custom .icon-box28 i, .colorskin-custom .icon-box28:hover i, #wrap.colorskin-custom .wpb_accordion .wpb_accordion_wrapper .ui-state-default .ui-icon:hover:before, .colorskin-custom .widget form input[type="submit"]#searchsubmit, #wrap.colorskin-custom .book-form-deep input[type="text"], .colorskin-custom .ourteam-owl-carousel-type9 .owl-nav .owl-prev:hover::after, .colorskin-custom .ourteam-owl-carousel-type9 .owl-nav .owl-next:hover::after, .mec-wrap.colorskin-custom .mec-color, .mec-wrap.colorskin-custom .mec-event-sharing-wrap .mec-event-sharing > li:hover a, .mec-wrap.colorskin-custom .mec-color-hover:hover, .mec-wrap.colorskin-custom .mec-color-before *:before ,.mec-wrap.colorskin-custom .mec-widget .mec-event-grid-classic.owl-carousel .owl-controls .owl-buttons i,.mec-wrap.colorskin-custom .mec-event-list-classic a.magicmore:hover,.mec-wrap.colorskin-custom .mec-event-grid-simple:hover .mec-event-title,.mec-wrap.colorskin-custom .mec-single-event .mec-event-meta dd.mec-events-event-categories:before,.mec-wrap.colorskin-custom .mec-single-event-date:before,.mec-wrap.colorskin-custom .mec-single-event-time:before,.mec-wrap.colorskin-custom .mec-events-meta-group.mec-events-meta-group-venue:before,.mec-wrap.colorskin-custom .mec-calendar .mec-calendar-side .mec-previous-month i,.mec-wrap.colorskin-custom .mec-calendar .mec-calendar-side .mec-next-month,.mec-wrap.colorskin-custom .mec-calendar .mec-calendar-side .mec-previous-month:hover,.mec-wrap.colorskin-custom .mec-calendar .mec-calendar-side .mec-next-month:hover,.mec-wrap.colorskin-custom .mec-calendar.mec-event-calendar-classic dt.mec-selected-day:hover,.mec-wrap.colorskin-custom .mec-infowindow-wp h5 a:hover, .colorskin-custom .mec-events-meta-group-countdown .mec-end-counts h3,.mec-calendar .mec-calendar-side .mec-next-month i,.mec-wrap .mec-totalcal-box i,.mec-calendar .mec-event-article .mec-event-title a:hover,.mec-attendees-list-details .mec-attendee-profile-link a:hover, .colorskin-custom .icon-box26 img,.colorskin-custom .icon-box26 i,.colorskin-custom #footer .side-list ul li:hover a,.colorskin-custom .bbp-body a,.colorskin-custom .bbp-body a:visited , .colorskin-custom .bbp-body a:hover , .colorskin-custom .bbp-body a.bbp-forum-title:hover , .colorskin-custom .bbp-topic-title a.bbp-topic-permalink:hover , .colorskin-custom .pin-box h4 a:hover, .tline-box h4 a:hover , .colorskin-custom .pin-ecxt h6.blog-cat a:hover , .colorskin-custom .pin-ecxt2 p a:hover , .colorskin-custom .postmetadata h6.blog-cat a:hover , .colorskin-custom h6.blog-cat a , .colorskin-custom .blgtyp3.blog-post h6 a,.colorskin-custom .blgtyp2.blog-post h6 a,.colorskin-custom .blog-single-post .postmetadata h6 a,.colorskin-custom .blog-single-post h6.blog-author a , .colorskin-custom .blgtyp3.blog-post h6 a:hover,.colorskin-custom .blgtyp1.blog-post h6 a:hover,.colorskin-custom .blgtyp2.blog-post h6 a:hover,.colorskin-custom .blog-single-post .postmetadata h6 a:hover,.colorskin-custom .blog-single-post h6.blog-author a:hover , .colorskin-custom .blog-post p.blog-cat a,.colorskin-custom .blog-line p.blog-cat a , .colorskin-custom .about-author-sec h5 a:hover , .colorskin-custom .blog-line:hover .img-hover:before , .colorskin-custom .rec-post h5 a:hover , .colorskin-custom .rec-post p a:hover , #wrap.colorskin-custom .colorf, .colorskin-custom .our-team h5 , .colorskin-custom .our-team6 h5 , #wrap.colorskin-custom .vc_carousel.vc_carousel_horizontal.hero-carousel h2.post-title a:hover , #wrap.colorskin-custom .wpb_gallery_slides .flex-caption h2.post-title a:hover , .colorskin-custom .w-pricing-table.pt-type1 .price-footer a:hover , .colorskin-custom .teaser-box2 a:hover .teaser-title , .colorskin-custom .teaser-box3:hover .teaser-subtitle:after , .colorskin-custom .teaser-box5:hover .teaser-title, #wrap.colorskin-custom .hebe .tp-tab-title , .colorskin-custom .ts-tri.testimonials-slider-w.flexslider .flex-direction-nav a:hover , .colorskin-custom .latestposts-one .latest-author a:hover , .colorskin-custom .latestposts-two .blog-post p.blog-author a:hover , .colorskin-custom .latestposts-two .blog-line:hover .img-hover:before , .colorskin-custom .latestposts-four h3.latest-b2-title a:hover , .colorskin-custom .latestposts-five h6.latest-b2-cat a , .colorskin-custom .latestposts-six .latest-content p.latest-date , .colorskin-custom .a-post-box .latest-title a:hover , .colorskin-custom .w-login #user-login .login-links li a:hover ,  .colorskin-custom .icon-box2 i , .colorskin-custom .icon-box3 i , .colorskin-custom .blox.dark .icon-box9 i , .colorskin-custom .icon-box12 i , .colorskin-custom .blox.dark .icon-box12:hover a.magicmore , .colorskin-custom .icon-box17 , .colorskin-custom .icon-box17 i , .colorskin-custom .nav > li.current > a,.colorskin-custom .nav > li > a.active,.colorskin-custom .nav > li:hover > a , .colorskin-custom #header.sticky .nav-wrap .nav .nav > li:hover > a , .colorskin-custom .dark-submenu .nav ul li a:hover , .colorskin-custom .nav li > ul li a:hover, .nav li.current ul li a:hover,.colorskin-custom .nav-wrap2 .nav ul li a:hover,.colorskin-custom .nav-wrap2.darknavi .nav ul li a:hover,.colorskin-custom .nav ul li.current > a ,.colorskin-custom .nav ul li:hover > a , .colorskin-custom .dark-submenu .nav li.mega ul.sub-posts li a:hover , .colorskin-custom .nav-wrap2.darknavi .nav > li > a:hover,.colorskin-custom .nav-wrap2.darknavi .nav > li:hover > a , .colorskin-custom .nav-wrap2 .nav > li.current > a , .colorskin-custom #header.sticky .nav-wrap2.darknavi .nav > li > a:hover , .colorskin-custom .w-header-type-11 .nav > li:hover > a , .colorskin-custom .nav > li:hover > a, .nav li.current > a,.colorskin-custom .nav li.active > a, .colorskin-custom #header.sm-rgt-mn #menu-icon:hover i,.colorskin-custom #header.sm-rgt-mn #menu-icon.active i , .transparent-header-w.t-dark-w .colorskin-custom #header.horizontal-w.duplex-hd .nav > li:hover > a, .transparent-header-w.t-dark-w .colorskin-custom #header.horizontal-w.duplex-hd .nav > li.current > a , .colorskin-custom #header.box-menu  h6 i , .colorskin-custom #header.box-menu .nav-wrap2 .nav > li.current , .colorskin-custom #responav .mega li.menu-item a:not(.button):hover , .transparent-header-w.t-dark-w #wrap.colorskin-custom .top-bar .top-links a:hover , .transparent-header-w.t-dark-w #wrap.colorskin-custom .top-bar h6 i , .colorskin-custom .transparent-header-w #header.horizontal-w.sticky .nav > li:hover > a, .transparent-header-w.t-dark-w #header.horizontal-w.sticky .nav > li:hover > a , .colorskin-custom .top-bar .socialfollow a:hover i , #wrap.colorskin-custom .vc_tta-color-white.vc_tta-style-modern.vc_tta-o-shape-group .vc_tta-tab.vc_active>a i.vc_tta-icon , .colorskin-custom .pbx-req .wn-prayer-inner .wn-prayer-request-name , .colorskin-custom .woocommerce nav.woocommerce-pagination ul li a , .colorskin-custom .woocommerce table.shop_table td.product-name a:hover , .colorskin-custom blockquote:before , .colorskin-custom .blog-post a:hover, .blog-author span,.colorskin-custom .blog-line p a:hover , .colorskin-custom h6.blog-date a:hover, h6.blog-cat a:hover,.colorskin-custom h6.blog-author a:hover , .colorskin-custom .blog-line:hover h4 a , #wrap.colorskin-custom .blog-social a:hover , #wrap.colorskin-custom .blog-social a:hover i , .colorskin-custom a.readmore , .colorskin-custom a.readmore:hover , .colorskin-custom a.magicmore, .colorskin-custom a.addtocart:hover, a.select-options:hover , #wrap.colorskin-custom .subtitle-element5 h1:after, #wrap.colorskin-custom .subtitle-element5 h2:after, #wrap.colorskin-custom .subtitle-element5 h3:after, #wrap.colorskin-custom .subtitle-element5 h4:after, #wrap.colorskin-custom .subtitle-element5 h5:after, #wrap.colorskin-custom .subtitle-element5 h6:after , #wrap.colorskin-custom .wpb_accordion .wpb_accordion_wrapper .ui-state-default .ui-icon:hover:before , #wrap.colorskin-custom .vc_tta-accordion.vc_tta-style-classic.vc_tta-shape-square .vc_tta-panel.vc_active .vc_tta-panel-heading , #wrap.colorskin-custom .vc_tta-accordion.vc_tta-style-classic.vc_tta-shape-square .vc_active .vc_tta-panel-heading .vc_tta-controls-icon::before , #wrap.colorskin-custom .vc_tta-accordion.vc_tta-style-classic.vc_tta-shape-square .vc_tta-controls-icon-position-right .vc_active:before , .colorskin-custom .blox.dark .max-counter.s-counter .max-count, .colorskin-custom .our-team5 h5 , .colorskin-custom .our-team5 .social-team a i:hover:before , .colorskin-custom .testimonial2 .testimonial-content h5 , .colorskin-custom .testimonials-slider-w.flexslider .flex-direction-nav a i , .colorskin-custom .pricing-plan1 .ppfooter .readmore , .colorskin-custom .pricing-plan2 .ppfooter .readmore , .colorskin-custom .our-process-item:hover i , .colorskin-custom .buy-process-item h4 , .colorskin-custom .buy-process-item.featured i, .colorskin-custom .contact-info i , .colorskin-custom .acc-trigger a:hover,.colorskin-custom .acc-trigger.active a,.colorskin-custom .acc-trigger.active a:hover , .colorskin-custom .w-pricing-table.pt-type1 .pt-footer a,.colorskin-custom .w-pricing-table.pt-type1 .pt-footer a , .colorskin-custom .w-pricing-table.pt-type2 > span , .colorskin-custom .w-pricing-table.pt-type2:hover > span , .colorskin-custom .w-pricing-table.pt-type2 .pt-footer a,.colorskin-custom .w-pricing-table.pt-type2 .pt-footer a , .colorskin-custom .w-pricing-table.pt-type2.featured .pt-footer a , .colorskin-custom .w-pricing-table.pt-type3 .pt-footer a,.colorskin-custom .w-pricing-table.pt-type3.featured .pt-footer a , .colorskin-custom .w-pricing-table.pt-type7 .plan-title , #wrap.colorskin-custom .vc_images_carousel .vc_carousel-control:hover, #wrap.colorskin-custom .vc_images_carousel .vc_carousel-control span:hover , .colorskin-custom .related-works .portfolio-item:hover h5 a , .colorskin-custom .teaser-box2 a:after , .colorskin-custom .teaser-box5:hover:before , .colorskin-custom .teaser-box6:hover:before , .colorskin-custom .teaser-box6 .teaser-subtitle , .colorskin-custom .teaser-box7:hover h4 , .colorskin-custom .teaser-box8:hover .teaser-title , .colorskin-custom .latestnews2 .ln-content .ln-title:hover,.colorskin-custom .dark.blox .latestnews2 .ln-content .ln-title:hover , .colorskin-custom .latestnews2 .ln-item .ln-content .ln-button:hover , .colorskin-custom #w-login h3 , .colorskin-custom #w-login form input , .colorskin-custom #w-login .login-links li a, .colorskin-custom .ts-di .testimonial .testimonial-content h4 q:before , .colorskin-custom .ts-di.testimonials-slider-w.flexslider .flex-direction-nav a i:hover , .colorskin-custom .ts-di.testimonials-slider-w.flexslider .flex-direction-nav a i:hover:before , .colorskin-custom .testimonials-slider-w.ts-mono .testimonial-content:before , .colorskin-custom .ts-tri.testimonials-slider-w .testimonial-content h4 q:before , .colorskin-custom .testimonials-slider-w.flexslider.ts-penta .flex-control-paging li a.flex-active , .colorskin-custom .post-format-icon , .colorskin-custom .latestposts-one .latest-title a:hover , .colorskin-custom .latestposts-two .blog-line p.blog-cat a , .colorskin-custom .latestposts-two .blog-line:hover h4 a , .colorskin-custom .latestposts-three h3.latest-b2-title a:hover , .colorskin-custom .latestposts-three h6.latest-b2-cat a,.colorskin-custom .latestposts-three .latest-b2-metad2 span a:hover, .colorskin-custom .latestposts-six .latest-title a:hover , .colorskin-custom .latestposts-six .latest-author a:hover , .colorskin-custom .latestposts-seven .wrap-date-icons h3.latest-date , .colorskin-custom .latestposts-seven .latest-content .latest-title a:hover , .colorskin-custom .latestposts-seven .latest-content .latest-author a , .colorskin-custom .latestposts-seven .latest-content .latest-author a:hover , .colorskin-custom .latestposts-nine .latest-b9 h3 .link , .colorskin-custom .latestposts-ten .latest-b10 .latest-b10-content a.readmore , .colorskin-custom .latestposts-eleven .latest-b11 .latest-b11-meta .date:after , .colorskin-custom .latestposts-twelve .latest-b12 .latest-b12-cont .latest-b12-cat a , .colorskin-custom .latestposts-twelve .latest-b12 .latest-b12-cont .latest-b12-author:hover a,.colorskin-custom .latestposts-twelve .latest-b12 .latest-b12-cont .latest-b12-title:hover a , .colorskin-custom .latest-b13-title a:hover,.latest-b13-author a:hover,.colorskin-custom .latest-b13-cat:hover a , .colorskin-custom .wn-latest-b15 .latest-b15 .latest-b15-content .latest-b15-meta-data a:hover , .colorskin-custom .wn-latest-b15 .latest-b15 .latest-b15-content h2 a:hover  , .colorskin-custom .wn-latest-b16 .latest-b16 .latest-b16-overlay .latest-b16-meta-data a:hover,.colorskin-custom .wn-latest-b16 .latest-b16 .latest-b16-overlay h3:hover a , .colorskin-custom .wn-latest-b16 .latest-b16 .latest-b16-content .latest-b16-readmore:hover , .colorskin-custom .wn-latest-b16 .latest-b16 .latest-b16-content .latest-b16-footer .latest-author strong  a:hover , .colorskin-custom .wn-latest-b17 .latest-b17 .latest-b17-content h3 a:hover , .colorskin-custom .wn-latest-b17 .latest-b17 .latest-b17-content .latest-b17-readmore:hover , .colorskin-custom .vc_tta-tabs.vc_tta-style-modern.vc_tta-shape-round .vc_tta-tab .vc_tta-icon , .colorskin-custom .w-login #user-login .login-links li a  , #wrap.colorskin-custom .vc_tta-color-white.vc_tta-style-flat .vc_tta-tab.vc_active>a , #wrap.colorskin-custom .mec-event-list-minimal .mec-event-article.mec-clear .btn-wrapper .mec-detail-button:hover , .colorskin-custom .icon-box i , .colorskin-custom .icon-box1 h5 , .colorskin-custom .icon-box4 i , .colorskin-custom .icon-box4:hover i , .colorskin-custom .icon-box5 i , .colorskin-custom .icon-box8 i , #wrap.colorskin-custom .icon-box9 a.magicmore , .colorskin-custom .icon-box10 h5 , .colorskin-custom .icon-box11 i , .colorskin-custom .icon-box11:hover i , .colorskin-custom .icon-box13 i , .colorskin-custom .icon-box14 i , .colorskin-custom .icon-box15 img,.colorskin-custom .icon-box15 i , #wrap.colorskin-custom .icon-box15 .magicmore:hover:after , .colorskin-custom .icon-box16 i , .colorskin-custom .icon-box16 h4 , .colorskin-custom .icon-box16 p strong , .colorskin-custom .icon-box16 a.magicmore , .colorskin-custom .icon-box19 i , .colorskin-custom .icon-box19 i , .colorskin-custom .icon-box20 i , .colorskin-custom .icon-box20:hover h4 , .colorskin-custom .icon-box20:hover i , .colorskin-custom .icon-box22:hover h4,.colorskin-custom .icon-box22:hover i, .icon-box22.w-featured i , .colorskin-custom .icon-box22.w-featured h4 , .colorskin-custom .icon-box23 i,.colorskin-custom .icon-box23 img , .colorskin-custom .icon-box24 i , .colorskin-custom .icon-box27  i , .colorskin-custom .icon-colorx i,.colorskin-custom i.icon-colorx , .colorskin-custom .nav a:hover,.colorskin-custom .nav li:hover > a , .colorskin-custom #header .nav .active a , .colorskin-custom .nav-wrap2 .nav > li:hover > a,.colorskin-custom .top-links .nav > li:hover > a , #wrap.colorskin-custom #header .wn-header-toggle:hover i , .colorskin-custom #header.w-header-type-13 .tools-section div.active i , #wrap.colorskin-custom .wn-header-toggle .widget_woocommerce-header-cart:hover .woo-cart-header .header-cart:after , .colorskin-custom .header-type-12.sticky .nav-wrap2 .nav > li.current > a,.colorskin-custom .header-type-12.sticky .nav-wrap2 .nav > li:hover > a , .colorskin-custom .top-header-sec .container div:first-child a:hover,.colorskin-custom .top-header-sec .inlinelb:hover , .colorskin-custom .top-header-sec .wtop-weather , #wrap.colorskin-custom .wn-hamburger-wrap .full-menu .current a , .colorskin-custom #hamburger-menu #hamburger-nav li:hover > a , .colorskin-custom #hamburger-menu #hamburger-nav li.current > a , .colorskin-custom #hamburger-menu.hm-dark #hamburger-nav li:hover > a,.colorskin-custom #hamburger-menu.hm-dark #hamburger-nav li.current > a , #wrap.colorskin-custom #header .hamburger-toggle-link:hover .hamburger-toggle-link-icon,#wrap.colorskin-custom #header .hamburger-toggle-link:hover .hamburger-toggle-link-icon:before,#wrap.colorskin-custom #header .hamburger-toggle-link:hover .hamburger-toggle-link-icon:after , .colorskin-custom .is-open.wn-ht .hamburger-social-icons a:hover , .colorskin-custom .top-links a:hover , #wrap.colorskin-custom .top-bar .top-custom-text a:hover , .colorskin-custom .top-bar .inlinelb:hover , .transparent-header-w.t-dark-w .colorskin-custom #header.horizontal-w .nav > li:hover > a, .transparent-header-w.t-dark-w .colorskin-custom #header.horizontal-w .nav > li.current > a , .colorskin-custom .footer-navi a:hover,.colorskin-custom .custom-footer-menu a:hover , .colorskin-custom .footer-navi a:after , .colorskin-custom .breadcrumbs-w i , #wrap.colorskin-custom .wp-pagenavi a:hover ,.colorskin-custom .wpcf7 .wpcf7-form input[type="reset"],.colorskin-custom .wpcf7 .wpcf7-form input[type="button"], .colorskin-custom .widget ul li .comment-author-link a:hover , .colorskin-custom .sidebar .widget .tabs li:hover a ,.colorskin-custom .sidebar .widget .tabs li.active a , .colorskin-custom #wp-calendar tfoot #prev a , .colorskin-custom .woo-cart-dropdown ul li a:hover , .colorskin-custom a.vc_control:hover , .colorskin-custom .woocommerce div.product .woocommerce-tabs ul.tabs li.active , .colorskin-custom .woocommerce .button , .colorskin-custom .widget_shopping_cart_content p.buttons a.button, .colorskin-custom #header-share-modal .socialfollow a:hover i, .colorskin-custom .widget ul li.cat-item:hover a, .colorskin-custom .ts-hexa .testimonial .testimonial-content h4 q:after, #wrap.colorskin-custom .testimonial-slider-owl-carousel.ts-hexa .owl-prev:after, #wrap.colorskin-custom .testimonial-slider-owl-carousel.ts-hexa .owl-next:after, .colorskin-custom.blox.dark .testimonial-brand h5 strong, #wrap.colorskin-custom .latest-author span a:hover, #hamburger-menu #hamburger-nav li:hover > a, #hamburger-menu #hamburger-nav li.current > a, .portfolio-hover-8 .tg-nav-color:not(.dots):not(.tg-dropdown-value):not(.tg-dropdown-title):hover, #wrap.colorskin-custom .portfolio-hover-8 .tg-nav-color, #wrap.colorskin-custom .deepshop .tg-item-inner i,.colorskin-custom .wn-woo-wrap ul.product-categories li a:hover,.colorskin-custom .wn-woo-wrap ul.product-categories li a:hover+span.count,.colorskin-custom .wn-woo-wrap ul.product-categories li.current-cat>a,.colorskin-custom .wn-woo-wrap ul.product-categories li.current-cat>span,.colorskin-custom .wn-woo-wrap .products li .wn-woo-contents-wrap h3 a:hover,.colorskin-custom  .wn-woo-wrap .products li .wn-woo-contents-wrap .posted_in a:hover,#wrap.colorskin-custom .widget_product_tag_cloud .tagcloud a:hover,.colorskin-custom .deep-woo-single-product-price .amount,.colorskin-custom .deep-woo-single-product-price ins .amount,.colorskin-custom .deep-woo-single-details-content.deep-woo-single-share-button .social-sharing a:hover i,.colorskin-custom .woocommerce-error,.colorskin-custom .woocommerce-message,.colorskin-custom .woocommerce-Message,.colorskin-custom .woocommerce-info,.colorskin-custom .woocommerce-info a,.colorskin-custom .pbx-req .wm-prayer-inner .wm-prayer-request-name
	{color: <?php echo esc_attr( $color ); ?>;}

	/* == .fill
	-----------------*/
	.colorskin-custom .socialfollow a i path
	{fill: <?php echo esc_attr( $color ); ?>;}

	/* == background
	-----------------*/
	#wrap .filter-category .course-category.active > a, .course-bar a.llms-button-primary.wn-button, .wp-block-llms-course-continue-button a, .course-content #old_reviews h3:after, .filter-category h3:after, .course-content .course-titles:after, #wrap.colorskin-custom .icon-box28:hover, #wrap.colorskin-custom .widget .subtitle-wrap:after, .course-instructor-name, #wrap.colorskin-custom .widget .subtitle-wrap:before, .colorskin-custom .our-team3 .social-team i:hover, .colorskin-custom .our-team13 .our-team-socail:before, .colorskin-custom .our-team13 .our-team-num:before, .colorskin-custom .teaser-box18 .tb18-content .wn-image-box:hover:after, .colorskin-custom #loginform input[type=checkbox]:checked::before, .colorskin-custom .wp-sh-login .wp-login-title .login-title:before, .colorskin-custom .webnus-login #user-login .login-submit input[type=submit], .colorskin-custom .wp-sh-login #wp-submit, .colorskin-custom .testimonial-slider-owl-carousel.ts-hepta .owl-dots .owl-dot.active, .colorskin-custom .deep-gallery-wrap .deep-gallery-item i.hover-icon, #w-login form .login-submit #wp-submit, body .mfp-ready.mfp-bg.full-search, .colorskin-custom .hotel_booking_mini_cart .hb_mini_cart_item .hb_mini_cart_remove:hover, .colorskin-custom #hotel-booking-cart .hb_button.hb_checkout, .colorskin-custom #hotel-booking-payment .hb_button.hb_checkout, .colorskin-custom #hotel-booking-cart button[type="submit"], .colorskin-custom #hotel-booking-payment button[type="submit"], .colorskin-custom #hotel-booking-cart button[type="button"], .colorskin-custom #hotel-booking-payment button[type="button"], .colorskin-custom .hb_button, .colorskin-custom #hotel-booking-results form .hb_button.hb_checkout, .colorskin-custom #hotel-booking-results form button.hb_add_to_cart, .colorskin-custom #hotel-booking-results form button[type="submit"], .colorskin-custom .hb-booking-room-details .hb_search_room_item_detail_price_close:hover, .colorskin-custom .htc-booking .hotel-booking-search button, .colorskin-custom .hb_single_room .hb_single_room_details .hb_single_room_tabs>li a.active:after, .colorskin-custom #webnus-header-builder .woocommerce-mini-cart__buttons.buttons .button.wc-forward.checkout,.colorskin-custom .wn-sd-snt-icon .bar:after, .colorskin-custom .sermons-toggle2 .title-toggle,.kingcomposer .colorskin-custom .cause-meta .kc-ui-progress,.colorskin-custom .causes .wn-cause-sharing .wn-cause-sharing-icons .wn-wrap-social li:hover,.colorskin-custom .causes .wn-cause-sharing .wn-cause-sharing-icons li:hover,.woocommerce-account #wrap.colorskin-custom .woocommerce form.woocommerce-EditAccountForm.edit-account button[type="submit"],.woocommerce-account .colorskin-custom  .woocommerce .woocommerce-MyAccount-navigation li.is-active:before,.colorskin-custom .our-team14,.colorskin-custom .sermons-minimal .media-links a:hover i, .colorskin-custom .media-links a i:hover, .colorskin-custom .sermons-minimal .sermon-icon, .colorskin-custom .sermons-minimal .pe-7s-play:hover, .colorskin-custom .vc_bar.colorb, .colorskin-custom .testimonial-slider-owl-carousel.ts-tetra .owl-dots .owl-dot.active,.error404 .colorskin-custom h1.pnf404:before, .colorskin-custom .widget .subtitle-wrap:before,.colorskin-custom .blog-social-4 a:hover:after, .colorskin-custom .blog-social-4 a:hover:after, .colorskin-custom .button.theme-skin:not(.bordered-bot), .colorskin-custom #footer .widget .socialfollow a:hover, #wrap.colorskin-custom .pagination-blgtype4 .wp-pagenavi .current, #wrap.colorskin-custom .colorb, #wrap.colorskin-custom .hcolorb:hover, #wrap.colorskin-custom .wpcf7 .w-contact-p input[type=submit], #wrap.colorskin-custom .vc_tta-accordion.vc_tta-style-classic.vc_tta-shape-square .vc_tta-panel.vc_active .vc_tta-panel-heading, #wrap.colorskin-custom .vc_tta-accordion.vc_tta-style-classic.vc_tta-shape-square .vc_tta-controls-icon-position-right .vc_tta-controls-icon, #wrap.colorskin-custom .vc_carousel.vc_carousel_horizontal.hero-carousel .hero-carousel-wrap .hero-metadata .category a, #wrap.colorskin-custom .blox.dark .subscribe-modern .subscribe-box-input .subscribe-box-submit.button:not(.rounded):after, #wrap.colorskin-custom .ls-slider1-a, #wrap.colorskin-custom .testimonial-slider-owl-carousel.ts-tetra .owl-next:hover, #wrap.colorskin-custom .testimonial-slider-owl-carousel.ts-tetra .owl-prev:hover, #wrap.colorskin-custom .testimonial-slider-owl-carousel.ts-hexa .owl-prev:hover, #wrap.colorskin-custom .testimonial-slider-owl-carousel.ts-hexa .owl-next:hover, #wrap.colorskin-custom .wn-content-slider.arrow-type-arrow3 .content-slider-arrow-icon:hover i, #wrap.colorskin-custom .book-form-deep .r-submition input[type="submit"], #wrap.colorskin-custom .icon-box21 .iconbox-rightsection .magicmore, #wrap.colorskin-custom .woo-cart-header .header-cart span, #wrap.colorskin-custom #header .hamburger-toggle-link:hover .hamburger-toggle-link-icon, #wrap.colorskin-custom #header .hamburger-toggle-link:hover .hamburger-toggle-link-icon:before, #wrap.colorskin-custom #header .hamburger-toggle-link:hover .hamburger-toggle-link-icon:after, #wrap.colorskin-custom .wp-pagenavi a:hover, .colorskin-custom .highlight3, .colorskin-custom .wn-btn, .colorskin-custom input[type="submit"], .colorskin-custom input[type="reset"], .colorskin-custom input[type="button"], .colorskin-custom input[type="submit"].green, .colorskin-custom input[type="reset"].green, .colorskin-custom input[type="button"].green, .colorskin-custom .pbx-req .wn-prayer-inner .wn-pray-request-button:hover, .colorskin-custom #praybox_wrapper .wn-prayer-request, .colorskin-custom .pbx-formfield input[type="submit"], .colorskin-custom .pin-ecxt2 .col1-3 span, .colorskin-custom .comments-number-x span, .colorskin-custom #tline-content:before, .colorskin-custom .tline-row-l:after, .colorskin-custom .tline-row-r:before, .colorskin-custom .tline-topdate, .colorskin-custom .port-tline-dt h3, .colorskin-custom .postmetadata h6.blog-views span, .colorskin-custom .container.rec-posts h3.rec-title:before, .colorskin-custom .commentbox h3.comment-reply-title:before, .colorskin-custom .commentbox h4.comments-title:before, .colorskin-custom .rec-posts-type3 h3.rec-posts-type3-title:before, .colorskin-custom #commentform input[type="submit"], .colorskin-custom .about-author-sec-ps3 .blue-sec, .colorskin-custom body .colorb, .colorskin-custom body .hcolorb:hover, .colorskin-custom #talk-business input[type=submit], .colorskin-custom #talk-business .host-btn-form, .colorskin-custom .wn-social-network.active.other-social, .colorskin-custom .our-team4:hover, .colorskin-custom .our-team8:hover .tdetail, .colorskin-custom .testimonial4 h5:after, .colorskin-custom .buy-process-item .icon-wrapper:before, .colorskin-custom .buy-process-item i, .colorskin-custom .w-pricing-table.pt-type1.featured .plan-title, .colorskin-custom .w-pricing-table.pt-type1.featured .plan-price, .colorskin-custom .w-pricing-table.pt-type1.featured .pt-footer, .colorskin-custom .w-pricing-table.pt-type1.featured .pt-footer, .colorskin-custom .w-pricing-table.pt-type2.featured .pt-footer a, .colorskin-custom .w-pricing-table.pt-type3 .pt-header, .colorskin-custom .w-pricing-table.pt-type3 .pt-footer, .colorskin-custom .w-pricing-table.pt-type3.featured .pt-footer, .colorskin-custom .w-pricing-table.pt-type6 .pt-footer, .colorskin-custom .w-pricing-table.pt-type7.featured:before, .colorskin-custom .w-pricing-table.pt-type7 .pt-footer a.magicmore, .colorskin-custom .w-pricing-table.pt-type9, .colorskin-custom .w-pricing-table.pt-type9.featured .pt-footer a, .colorskin-custom .portfolio-carousel .portfolio-item:hover .bgc-overlay, .colorskin-custom .related-works .portfolio-item > a:hover:before, .colorskin-custom .latest-projects-navigation a:hover, .colorskin-custom .subscribe-box .subscribe-box-top, .colorskin-custom .subscribe-box .subscribe-box-input .subscribe-box-submit, .colorskin-custom .subscribe-modern .subscribe-box-input:after, .colorskin-custom .subscribe-modern .subscribe-box-input .subscribe-box-submit, .colorskin-custom .teaser-box6 .teaser-subtitle, .colorskin-custom .teaser-box1 .teaser-title, .colorskin-custom .teaser-box1 a:after, .colorskin-custom .teaser-box1:hover a:after, .colorskin-custom .teaser-box3:hover, .colorskin-custom .teaser-box3 .teaser-subtitle:after, .colorskin-custom .teaser-box4 .teaser-title, .colorskin-custom .teaser-box4 .teaser-subtitle, .colorskin-custom .teaser-box5 .teaser-featured, .colorskin-custom .teaser-box9 .teaser-title.has-image, .colorskin-custom .teaser-box10 a, .colorskin-custom .teaser-box11 .bgc-overlay, .colorskin-custom .latestnews1 .ln-item:hover .ln-content, .colorskin-custom .latestnews2 .ln-date .ln-month, .colorskin-custom .flip-clock-wrapper ul li a div div.inn, .colorskin-custom #w-login form .login-submit input[type=submit], .colorskin-custom #w-login .login-links li a[href$="register"], .colorskin-custom .modal-title, .colorskin-custom .ts-di .testimonial .testimonial-brand h5, .colorskin-custom .ts-di .testimonial .testimonial-brand h5, .colorskin-custom .ts-tri.testimonial-slider-owl-carousel .testimonial-brand, .colorskin-custom .testimonial-slider-owl-carousel.ts-penta .owl-dots .owl-dot.active, .colorskin-custom .testimonial-slider-owl-carousel.ts-hepta .testimonial, .colorskin-custom .testimonial-slider-owl-carousel.ts-nona, .colorskin-custom .testimonial-slider-undeca .owl-dots .owl-dot.active:after, .colorskin-custom .owl-dots .owl-dot.active, .colorskin-custom .latestposts-one .latest-b-cat:hover, .colorskin-custom .latestposts-four .latest-b2 h6.latest-b2-cat, .colorskin-custom .latestposts-seven .latest-img:hover img, .colorskin-custom .latestposts-twelve .latest-b12 .latest-b12-cont .latest-b12-title:after, .colorskin-custom .latest-b13-title a:after, .colorskin-custom .wn-latest-b14:hover .latest-b14-cont, .colorskin-custom .wn-latest-b15 .latest-b15 .latest-b15-img .latest-b15-overlay, .colorskin-custom .wn-latest-b16 .latest-b16 .latest-b16-content .latest-b16-readmore:hover:before, .colorskin-custom .wn-latest-b17 .latest-b17 .latest-b17-content .latest-b17-readmore:hover:before, .colorskin-custom .a-post-box-1 .latest-cat, .colorskin-custom .blox .custom-404 p:first-child:before, .colorskin-custom .w-login #user-logged .logged-links, .colorskin-custom .wpcf7 .deep-contact .w-contact-submit input[type=submit], .colorskin-custom .offer-toggle .toogle-plus i, .colorskin-custom .wn-vertical-carousel .owl-dots .owl-dot.active, .colorskin-custom .wn-vertical-carousel .owl-dots .owl-dot:after, .colorskin-custom .wn-collections .collection-title .after, .colorskin-custom .wn-loadmore-ajax a:hover, .colorskin-custom .twentytwenty-handle, .colorskin-custom .twentytwenty-horizontal .twentytwenty-handle:after, .colorskin-custom .twentytwenty-horizontal .twentytwenty-handle:before, .colorskin-custom .twentytwenty-vertical .twentytwenty-handle:after, .colorskin-custom .twentytwenty-vertical .twentytwenty-handle:before, .colorskin-custom .magazin-wrap .magazin-cat-nav-wrap .magazin-title:before, .colorskin-custom .side-list li:hover img, .colorskin-custom .tagcloud a:hover, .colorskin-custom #footer.litex .tagcloud a:hover, .colorskin-custom #footer .tagcloud a:hover, .colorskin-custom .toggle-top-area .tagcloud a:hover, .colorskin-custom #wp-calendar tbody td#today, .colorskin-custom .widget .widget-subscribe-form.type-two button, .colorskin-custom #footer .product_list_widget li ins, .colorskin-custom #footer .woocommerce-product-search input[type="submit"], .colorskin-custom .icon-box6 i, .colorskin-custom .icon-box14 i:after, .colorskin-custom .icon-box17 .icon-wrap, .colorskin-custom .icon-box19:hover i, .colorskin-custom .icon-box20:hover i, .colorskin-custom .blox .icon-box20:hover i, .colorskin-custom .icon-box23 h4:after, .colorskin-custom .icon-box23:hover.icon-box23 h4:before, .colorskin-custom .icon-box24:hover i, .colorskin-custom .icon-box25 i, .colorskin-custom .icon-box26 h4:before, .colorskin-custom .icon-box27:hover, .colorskin-custom #header.w-header-type-11 .logo-wrap, .colorskin-custom .wn-donate-contact-modal .wpcf7 .wpcf7-form input[type="submit"], .colorskin-custom #header-contact-modal .wn-header-contact-modal .wpcf7 .wpcf7-form input[type="submit"], .colorskin-custom #menu-icon:hover, .colorskin-custom #menu-icon.active, .colorskin-custom #header.sm-rgt-mn #menu-icon span.mn-ext1, .colorskin-custom #header.sm-rgt-mn #menu-icon span.mn-ext2, .colorskin-custom #header.sm-rgt-mn #menu-icon span.mn-ext3, .colorskin-custom .top-bar .inlinelb.topbar-contact:hover, .colorskin-custom .error404 h1.pnf404:before, .colorskin-custom .footer-in .tribe-events-widget-link a:hover, .colorskin-custom .footer-in .contact-inf button:hover, .colorskin-custom #footer.litex .footbot, .colorskin-custom #pre-footer .footer-social-items a:hover i, .colorskin-custom #scroll-top a:hover, .colorskin-custom .wpcf7 .wpcf7-form input[type="submit"], .colorskin-custom .wpcf7 .wpcf7-form input[type="reset"], .colorskin-custom .wpcf7 .wpcf7-form input[type="button"], .colorskin-custom #header.sm-rgt-mn #menu-icon span.mn-ext1, .colorskin-custom #header.sm-rgt-mn #menu-icon span.mn-ext2, .colorskin-custom #header.sm-rgt-mn #menu-icon span.mn-ext3, .colorskin-custom .subtitle-element.subtitle-element6 .before,.colorskin-custom .subtitle-element .after,.colorskin-custom .container.rec-posts h3.rec-title:before,.colorskin-custom .commentbox h3:before,.colorskin-custom .commentlist li .comment-text .reply a:hover , #wrap.colorskin-custom .colorb , .colorskin-custom .latestnews1 .ln-item:hover .ln-content , .colorskin-custom .latestposts-one .latest-b-cat:hover , .colorskin-custom .latestposts-seven .latest-img:hover img , .colorskin-custom .wpcf7 .deep-contact .w-contact-submit input[type=submit] , .colorskin-custom .icon-box17 .icon-wrap , .colorskin-custom .top-bar .inlinelb.topbar-contact:hover , .colorskin-custom .pbx-req .wn-prayer-inner .wn-pray-request-button:hover , .colorskin-custom #praybox_wrapper .pbx-formfield.pbx-active:after ,.colorskin-custom .pbx-formfield input[type="submit"] , .colorskin-custom .woocommerce-message a.button, .colorskin-custom .max-title:after , .colorskin-custom .subtitle-element:after , .colorskin-custom .buy-process-wrap:before , .colorskin-custom .buy-process-item .icon-wrapper:before  , .colorskin-custom .buy-process-item i , .colorskin-custom .teaser-box1 .teaser-title , .colorskin-custom .teaser-box1:hover a:after , .colorskin-custom .teaser-box4 .teaser-title,.colorskin-custom .teaser-box4 .teaser-subtitle , .colorskin-custom .modal-title , .colorskin-custom .flip-clock-wrapper ul li a div div.inn , .colorskin-custom .vc_tta-tabs.vc_tta-style-modern.vc_tta-shape-round .vc_tta-tab.vc_active > a , .colorskin-custom .w-login #user-logged .logged-links , .colorskin-custom #header.w-header-type-11 .logo-wrap , #wrap.colorskin-custom .woo-cart-header .header-cart span , .colorskin-custom #menu-icon:hover,.colorskin-custom #menu-icon.active , .colorskin-custom #scroll-top a:hover , .colorskin-custom #praybox_wrapper .wn-prayer-request , .colorskin-custom .tagcloud a:hover,.colorskin-custom #footer.litex .tagcloud a:hover , .single .colorskin-custom .woo-template span.onsale,.colorskin-custom .woocommerce ul.products li.product .onsale , .colorskin-custom a.readmore:hover , .colorskin-custom .max-title3 h1:before,.colorskin-custom .max-title4 h2:before,.colorskin-custom .max-title4 h3:before,.colorskin-custom .max-title4 h4:before,.colorskin-custom .max-title4 h5:before,.colorskin-custom .max-title4 h6:before , #wrap.colorskin-custom .vc_tta-accordion.vc_tta-style-classic.vc_tta-shape-square .vc_tta-controls-icon-position-right .vc_tta-controls-icon , .colorskin-custom #social-media.active.other-social , .colorskin-custom #talk-business input[type=submit] , .colorskin-custom #talk-business .host-btn-form , #wrap.colorskin-custom .wpcf7 .w-contact-p input[type=submit] , .colorskin-custom .our-team4:hover , .colorskin-custom .testimonial4 h5:after , .colorskin-custom .testimonial-carousel.testi-carou-3 .tc-name:after , .colorskin-custom .w-pricing-table.pt-type2.featured .pt-footer a , .colorskin-custom .w-pricing-table.pt-type6 .pt-footer , .colorskin-custom .w-pricing-table.pt-type7.featured:before , .colorskin-custom .related-works .portfolio-item > a:hover:before , .colorskin-custom .latest-projects-navigation a:hover , .colorskin-custom .teaser-box3:hover , .colorskin-custom .teaser-box9 .teaser-title.has-image , .colorskin-custom .latestnews2 .ln-date .ln-month , .colorskin-custom #w-login .login-links li a[href$="register"] , .colorskin-custom .ts-di .testimonial .testimonial-brand h5 , .colorskin-custom .ts-tri.testimonials-slider-w.flexslider .testimonial-brand , .colorskin-custom .testimonials-slider-w.flexslider.ts-penta .flex-control-paging li a.flex-active , .colorskin-custom .latestposts-twelve .latest-b12 .latest-b12-cont .latest-b12-title:after , .colorskin-custom .latest-b13-title a:after , .colorskin-custom .wn-latest-b14:hover .latest-b14-cont , .colorskin-custom .wn-latest-b16 .latest-b16 .latest-b16-content .latest-b16-readmore:hover:before , .colorskin-custom .wn-latest-b17 .latest-b17 .latest-b17-content .latest-b17-readmore:hover:before , .colorskin-custom .offer-toggle .toogle-plus i ,  #wrap.colorskin-custom .mec-event-list-minimal .mec-event-article.mec-clear .btn-wrapper .mec-detail-button:hover:before , .colorskin-custom .icon-box6 i , .colorskin-custom .icon-box11:hover i , .colorskin-custom .icon-box14 i:after , .colorskin-custom .icon-box19:hover i , .colorskin-custom .icon-box20:hover i , .colorskin-custom .blox .icon-box20:hover i , #wrap.colorskin-custom .icon-box21 .iconbox-rightsection .magicmore , .colorskin-custom .icon-box23 h4:after , .colorskin-custom .icon-box23:hover.icon-box23 h4:before , .colorskin-custom .icon-box24:hover i , .colorskin-custom .icon-box25 i , .colorskin-custom .icon-box26 h4:before , .colorskin-custom .icon-box27:hover , .colorskin-custom .wn-donate-contact-modal .wpcf7 .wpcf7-form input[type="submit"],.colorskin-custom #header-contact-modal .wn-header-contact-modal .wpcf7 .wpcf7-form input[type="submit"] , .colorskin-custom #header.sm-rgt-mn.w-header-type-11 .logo-wrap , .colorskin-custom #pre-footer .footer-subscribe-bar, .colorskin-custom #footer .tagcloud a:hover,.colorskin-custom .toggle-top-area .tagcloud a:hover , .colorskin-custom #wp-calendar tbody td#today , .colorskin-custom .widget .widget-subscribe-form button , .colorskin-custom .widget .widget-subscribe-form.type-two button , .colorskin-custom #footer a.button.black.square.small.thin.footer-link-custom:hover , .colorskin-custom .woocommerce .widget_price_filter .ui-slider .ui-slider-handle , .colorskin-custom .highlight3 , .colorskin-custom .pin-ecxt2 .col1-3 span,.colorskin-custom .comments-number-x span , .colorskin-custom #tline-content:before , .colorskin-custom .tline-row-l:after,.colorskin-custom .tline-row-r:before , .colorskin-custom .tline-topdate , .colorskin-custom .port-tline-dt h3 , .colorskin-custom .postmetadata h6.blog-views span , .colorskin-custom #commentform input[type="submit"] , #wrap.colorskin-custom .vc_carousel.vc_carousel_horizontal.hero-carousel .hero-carousel-wrap .hero-metadata .category a , .colorskin-custom .w-pricing-table.pt-type7 .pt-footer a.magicmore , .colorskin-custom .teaser-box3 .teaser-subtitle:after , .colorskin-custom .teaser-box5 .teaser-featured , #wrap.colorskin-custom .ls-slider1-a , .colorskin-custom .latestposts-four .latest-b2 h6.latest-b2-cat , .colorskin-custom .a-post-box .latest-cat , .colorskin-custom #header.sm-rgt-mn #menu-icon span.mn-ext3 , .colorskin-custom .footer-in .tribe-events-widget-link a:hover,.colorskin-custom .footer-in .contact-inf button:hover , .colorskin-custom #footer.litex .footbot , #wrap.colorskin-custom .wp-pagenavi a:hover , .colorskin-custom .side-list li:hover img,.colorskin-custom .teaser-box1 a:after,.colorskin-custom .teaser-box6 .teaser-subtitle,.colorskin-custom .wn-latest-b15 .latest-b15 .latest-b15-img .latest-b15-overlay,.colorskin-custom .max-title.max-title6:before,.colorskin-custom .wpcf7 .wpcf7-form input[type="submit"],.colorskin-custom .widget .subtitle-wrap:before, .colorskin-custom .max-title.max-title6 .before, .colorskin-custom .blox .custom-404 p:first-child:before,.colorskin-custom .max-title .after,#wrap.colorskin-custom #header .hamburger-toggle-link:hover .hamburger-toggle-link-icon, #wrap.colorskin-custom #header .hamburger-toggle-link:hover .hamburger-toggle-link-icon:before, #wrap.colorskin-custom #header .hamburger-toggle-link:hover .hamburger-toggle-link-icon:after, .mec-wrap.colorskin-custom .mec-event-sharing .mec-event-share:hover .event-sharing-icon,.mec-wrap.colorskin-custom .mec-event-grid-clean .mec-event-date,.mec-wrap.colorskin-custom .mec-event-list-modern .mec-event-sharing > li:hover a i,.mec-wrap.colorskin-custom .mec-event-list-modern .mec-event-sharing .mec-event-share:hover .mec-event-sharing-icon,.mec-wrap.colorskin-custom .mec-event-list-modern .mec-event-sharing li:hover a i,.mec-wrap.colorskin-custom .mec-calendar .mec-selected-day,.mec-wrap.colorskin-custom .mec-calendar .mec-selected-day:hover,.mec-wrap.colorskin-custom .mec-calendar .mec-calendar-row  dt.mec-has-event:hover,.mec-wrap.colorskin-custom .mec-calendar .mec-has-event:after, .mec-wrap.colorskin-custom .mec-bg-color, .mec-wrap.colorskin-custom .mec-bg-color-hover:hover, .colorskin-custom .mec-event-sharing-wrap:hover > li, .mec-wrap.colorskin-custom .mec-totalcal-box .mec-totalcal-view span.mec-totalcalview-selected,.mec-wrap .flip-clock-wrapper ul li a div div.inn,.mec-wrap .mec-totalcal-box .mec-totalcal-view span.mec-totalcalview-selected,.event-carousel-type1-head .mec-event-date-carousel,.mec-event-countdown-style3 .mec-event-date,#wrap .mec-wrap article.mec-event-countdown-style1,.mec-event-countdown-style1 .mec-event-countdown-part3 a.mec-event-button,.mec-wrap .mec-event-countdown-style2, .colorskin-custom .our-team1 figcaption, .colorskin-custom #footer .footer-in h5.subtitle:before, .colorskin-custom .wn-wishlist-single-wrap .wn-add-to-cart-single:hover,.colorskin-custom .tg-item.portfolio-hover-7 .tg-item-content-holder,.colorskin-custom .tg-item.portfolio-hover-6:hover .tg-item-overlay:after, .colorskin-custom .tg-item.portfolio-hover-5:hover .tg-item-overlay:after, #wrap.colorskin-custom  .tg-item.photography-home:hover .liner:before, #wrap.colorskin-custom .widget .subtitle-wrap h4.subtitle:before, #wrap.colorskin-custom .widget .subtitle-wrap:after,.colorskin-custom .wn-woo-wrap .wn-woo-sidebar .widget-title:after,.colorskin-custom .widget_price_filter .ui-slider .ui-slider-range,.colorskin-custom .deep-woo-single-product-addtocart button.button, .woocommerce .colorskin-custom .woocommerce-Button,.single-product .colorskin-custom  h3.deep-related-products-title:before,#wrap.colorskin-custom #wn-woo-wrap .woocommerce-message a.button,#wrap.colorskin-custom .woocommerce-checkout-payment button[type="submit"],.colorskin-custom .pbx-req .wm-prayer-inner .wm-pray-request-button:hover
	{background: <?php echo esc_attr( $color ); ?>;}

	/* == box shadow
	-----------------*/
	#w-login form .login-submit input[type=submit], .colorskin-custom #hotel-booking-results form .hb_button.hb_checkout, .colorskin-custom #hotel-booking-results form button.hb_add_to_cart, .colorskin-custom #hotel-booking-results form button[type="submit"], .colorskin-custom .wn-ftc .wn-ftc-header, #wrap.colorskin-custom .wn-ftc .wn-ftc-body .wpcf7 .wpcf7-form input[type="submit"]
	{box-shadow: 0px 5px 28px -6px <?php echo esc_attr( $color ); ?>;}
	.colorskin-custom .deep-woo-single-product-addtocart button.button, .woocommerce    .colorskin-custom .woocommerce-Button  { box-shadow: 0 2px 14px -2px <?php echo esc_attr( $color ); ?>;}
	.colorskin-custom .woocommerce-error,.colorskin-custom .woocommerce-message,.colorskin-custom .woocommerce-Message,.colorskin-custom .woocommerce-info {box-shadow: 0 3px 16px -7px <?php echo esc_attr( $color ); ?>;}
	#wrap.colorskin-custom #wn-woo-wrap .woocommerce-message a.button {box-shadow: 0 3px 16px -6px <?php echo esc_attr( $color ); ?>;}
	.list-room-extra li.selected { box-shadow: 0 7px 24px -11px <?php echo esc_attr( $color ); ?>; }

	/* == border-color
	------------------*/
	.colorskin-custom #pre-footer .footer-social-items a:hover i, .colorskin-custom .widget #user-logged .author-avatar img, .colorskin-custom #w-login form input, .colorskin-custom .room-grid-content .full-details, .colorskin-custom .list-room-extra li.selected, .colorskin-custom .hb_single_room .hb_room_gallery .camera_thumbs .camera_thumbs_cont ul li.cameracurrent:before, .wn-sd-snt-icon .bar, .colorskin-custom .tg-item.portfolio-hover-1:hover .tg-item-overlay, .colorskin-custom .woocommerce-MyAccount-content .woocommerce-Addresses .woocommerce-Address .title h3:after, .woocommerce-account .colorskin-custom .woocommerce-MyAccount-content form h3:after,#wrap.colorskin-custom .home-insta .instagram-feed li:hover a:before,#wrap.colorskin-custom .testimonial-slider-owl-carousel.ts-tetra .owl-prev, #wrap.colorskin-custom .testimonial-slider-owl-carousel.ts-tetra .owl-next,#wrap.colorskin-custom .wn-latest-b23 a.readmore, .colorskin-custom .twentytwenty-handle,.colorskin-custom .button.theme-skin.bordered-bot, .colorskin-custom .our-process-item-type2 span, .colorskin-custom .wn-woo-wrap .wn-woo-product-categories .cat-item.current-cat a, .colorskin-custom .wn-woo-wrap .wn-woo-product-categories .cat-item:hover a, .colorskin-custom .wn-woo-wrap .wn-woo-product-categories .cat-item.current-cat a, .colorskin-custom .wn-woo-wrap .wn-woo-product-categories .cat-item:hover a, #wrap.colorskin-custom .wn-loadmore-ajax a, .colorskin-custom .freelancer-2:hover .border-box:before, .mec-wrap.colorskin-custom .mec-event-list-modern .mec-event-sharing > li:hover a i,.mec-wrap.colorskin-custom .mec-event-list-modern .mec-event-sharing .mec-event-share:hover .mec-event-sharing-icon,.mec-wrap.colorskin-custom .mec-event-list-standard .mec-month-divider span:before,.mec-wrap.colorskin-custom .mec-single-event .mec-social-single:before,.mec-wrap.colorskin-custom .mec-single-event .mec-frontbox-title:before,.mec-wrap.colorskin-custom .mec-calendar .mec-calendar-events-side .mec-table-side-day, .mec-wrap.colorskin-custom .mec-border-color, .mec-wrap.colorskin-custom .mec-border-color-hover:hover, .colorskin-custom .mec-single-event .mec-frontbox-title:before, .colorskin-custom .mec-single-event .mec-events-meta-group-booking form > h4:before, .mec-wrap.colorskin-custom .mec-totalcal-box .mec-totalcal-view span.mec-totalcalview-selected,.mec-wrap .mec-totalcal-box .mec-totalcal-view span.mec-totalcalview-selected,.event-carousel-type1-head .mec-event-date-carousel:after, .colorskin-custom .icon-box25, .colorskin-custom .commentlist li .comment-text .reply a:hover , .colorskin-custom .teaser-box1:hover , .colorskin-custom #header.box-menu .nav-wrap2 .nav > li:hover , .colorskin-custom #pre-footer .instagram-feed li:hover a:before , .colorskin-custom .toggle-top-area .widget .instagram-feed a img:hover,.colorskin-custom #footer .widget .instagram-feed a img:hover , .colorskin-custom .widget .instagram-feed a:hover:before , .colorskin-custom a.readmore:hover , #wrap.colorskin-custom .vc_tta-accordion.vc_tta-style-classic.vc_tta-shape-square .vc_active .vc_tta-panel-heading .vc_tta-controls-icon::before , .colorskin-custom .w-pricing-table.pt-type2:hover > span , .colorskin-custom .w-pricing-table.pt-type2.featured .pt-footer a , .colorskin-custom .teaser-box5:hover:before , .colorskin-custom .teaser-box6:hover:before , .colorskin-custom #w-login form input , .colorskin-custom .testimonials-slider-w.flexslider.ts-penta .flex-control-paging li a.flex-active , .colorskin-custom .max-title h1:after,.colorskin-custom .max-title h2:after,.colorskin-custom .max-title h3:after,.colorskin-custom .max-title h4:after,.colorskin-custom .max-title h5:after,.colorskin-custom .max-title h6:after , .colorskin-custom .subtitle-element h1:after,.colorskin-custom .subtitle-element h2:after,.colorskin-custom .subtitle-element h3:after,.colorskin-custom .subtitle-element h4:after,.colorskin-custom .subtitle-element h5:after,.colorskin-custom .subtitle-element h6:after , .colorskin-custom .our-team3:hover figure img , .colorskin-custom .our-team4:hover, .colorskin-custom .pricing-plan1 .ppfooter .readmore , .colorskin-custom .pricing-plan2 .ppfooter .readmore , .colorskin-custom .w-pricing-table.pt-type2.featured > span , .colorskin-custom .w-pricing-table.pt-type3 .pt-footer a,.colorskin-custom .w-pricing-table.pt-type3.featured .pt-footer a , .colorskin-custom .w-login #user-logged .author-avatar img , .colorskin-custom .icon-box16 a.magicmore , #wrap.colorskin-custom .wp-pagenavi span.current,#wrap.colorskin-custom .wp-pagenavi a:hover, #wrap .colorr, .colorr, #wrap .hcolorr:hover, .hcolorr:hover, #wrap.colorskin-custom .colorr, .colorr, #wrap.colorskin-custom .hcolorr:hover, .hcolorr:hover, #wrap.colorskin-custom .w-pricing-table.pt-type6, #wrap.colorskin-custom #slide-6-layer-35, #wrap.colorskin-custom .w-pricing-table.pt-type6:nth-of-type(4n+4),#wrap.colorskin-custom .icon-box14 a.magicmore:hover:before,#wrap.colorskin-custom .esg-filterbutton.selected,.colorskin-custom .title-plus-text.type-1 h3:before, .colorskin-custom .colorr .vc_column-inner, #wrap.colorskin-custom .icon-box28:hover, .colorskin-custom .wn-latest-b22 .latest-b22:hover .latest-b22-img img, #wrap.colorskin-custom .wn-wishlist-single-wrap .wn-add-to-cart-single:hover,.colorskin-custom .portfolio-carousel-1 .tg-item.portfolio-carousel-1:hover .tg-item-overlay, .colorskin-custom .portfolio-carousel-2 .tg-item.portfolio-carousel-2:hover .tg-item-overlay,.colorskin-custom .tg-item.portfolio-hover-3:hover .tg-item-overlay,.colorskin-custom .tg-item.portfolio-hover-2:hover .tg-item-overlay,.colorskin-custom .tg-item.portfolio-hover-1:hover .tg-item-overlaym, .colorskin-custom .widget_price_filter .ui-slider .ui-slider-handle,#wrap.colorskin-custom .widget_product_tag_cloud .tagcloud a:hover,.colorskin-custom .woocommerce-tabs ul.tabs li.active,.colorskin-custom .woocommerce-error,.colorskin-custom .woocommerce-message,.colorskin-custom .woocommerce-Message,.colorskin-custom .woocommerce-info
	{border-color: <?php echo esc_attr( $color ); ?>;}

	/* == border-top-color
	=========================*/
	.colorskin-custom .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .colorskin-custom .hpg-title:before,.colorskin-custom .woocommerce-message,.colorskin-custom .latestposts-eleven .latest-b11, #wrap.colorskin-custom .latestposts-eleven .latest-b11, #wrap.colorskin-custom .w-pricing-table.pt-type5 .pt-header h4:after, #wrap.colorskin-custom #bridge .navbar .nav li.dropdown .dropdown-toggle .caret, #wrap.colorskin-custom #bridge .navbar .nav li.dropdown.open .caret, .colorskin-custom .w-pricing-table.pt-type1.featured .plan-price:after,.colorskin-custom .title-plus-text.type-1 h3:before ,.colorskin-custom .pricing-plan3 .pptriangle
	{ border-top-color: <?php echo esc_attr( $color ); ?>;}

	/* == border-left-color
	=========================*/
	.colorskin-custom [data-loader=wn-circle-side]
	{ border-left-color: <?php echo esc_attr( $color ); ?>;}

	/* == border-bottom-color
	=========================*/
	.colorskin-custom .latest-readmore-28 a, .colorskin-custom .book-form-deep .r-deep-form input[type=text], .colorskin-custom .book-form-deep .nice-select, .colorskin-custom .max-title3 h1:before, .colorskin-custom .max-title3 h2:before, .colorskin-custom .max-title3 h3:before, .colorskin-custom .max-title3 h4:before, .colorskin-custom .max-title3 h5:before, .colorskin-custom .max-title3 h6:before,.colorskin-custom .max-title2 .before,.colorskin-custom .teaser-box7 h4:before, #wrap.colorskin-custom .vc_tta-color-white.vc_tta-style-flat .vc_tta-tab.vc_active,#wrap.colorskin-custom .max-title2 h1:before, #wrap.colorskin-custom .max-title2 h2:before, #wrap.colorskin-custom .max-title2 h3:before, #wrap.colorskin-custom .max-title2 h4:before, .book-form-deep .nice-select, .book-form-deep .r-deep-form input[type="text"], #wrap.colorskin-custom .max-title2 h5:before, #wrap.colorskin-custom .max-title2 h6:before, #wrap.colorskin-custom .subtitle-element2 h4:before, .mec-event-countdown-style3 .mec-event-date:after
	{ border-bottom-color: <?php echo esc_attr( $color ); ?>;}

	/* == fill Important
	========================*/
	.colorskin-custom #wpc-weather .now .time_symbol.climacon svg, #wrap .tg-item.portfolio-hover-5 .tg-element-3.liked .to-heart-icon path, #wrap .tg-item.portfolio-hover-4 .tg-element-3 .to-heart-icon svg:hover path, #wrap .tg-item.portfolio-hover-4 .tg-element-3.liked .to-heart-icon path, #wrap .tg-item.portfolio-hover-4 .tg-element-3 .to-heart-icon svg:hover path
	{ fill: <?php echo esc_attr( $color ); ?>!important; stroke: <?php echo esc_attr( $color ); ?>!important;}

	/* == fill
	========================*/
	#wrap .tg-item.portfolio-hover-5 .tg-element-3 .to-heart-icon path, #wrap .tg-item.portfolio-hover-4 .tg-element-3 .to-heart-icon path, #wrap .tg-item.photography-home .tg-element-4 .to-heart-icon path
	{ fill: <?php echo esc_attr( $color ); ?>; stroke: <?php echo esc_attr( $color ); ?>;}


	/* == Importants
	=========================================== */

	/* == color
	========================*/
	.wpb-js-composer .colorskin-custom .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active > a ,
	.wpb-js-composer .colorskin-custom .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading
	{ background-color: <?php echo esc_attr( $color ); ?> !important; }

	/* == color
	========================*/
	.colorskin-custom .colorf
	{ color: <?php echo esc_attr( $color ); ?> !important; }

	/* == Woocommerce Specifics
	=========================== */
	.colorskin-custom .woocommerce div.product .woocommerce-tabs ul.tabs li.active
	{ border-top-color: <?php echo esc_attr( $color ); ?> !important; }
	#wrap.colorskin-custom .wn-coupon-submit input[type="submit"] { color: #fff !important;}
	body #wrap.colorskin-custom .deep-woo-single-product-addtocart .wc_email_inquiry_button_container .wc_email_inquiry_email_button { background: <?php echo esc_attr( $color ); ?> !important;}
	body #wrap.colorskin-custom .deep-woo-single-product-addtocart .wc_email_inquiry_button_container .wc_email_inquiry_email_button:hover { background: #222 !important;}
	body #wrap.colorskin-custom .wn-woo-products-grid .wc_email_inquiry_button_container .wc_email_inquiry_email_button:hover { color: <?php echo esc_attr( $color ); ?> !important;}

	/* ==  Slider button hover
	========================== */
	#wrap.colorskin-custom .tp-caption.Button-Style:hover, #wrap.colorskin-custom .Button-Style:hover { background: rgba(28,28,28,1.00) !important;}

	/* ==  Box Shadow
	========================== */
	.colorskin-custom .twentytwenty-horizontal .twentytwenty-handle:before {
		-webkit-box-shadow: 0 3px 0 <?php echo esc_attr( $color ); ?>, 0 0 12px rgba(51,51,51,.5);
		-moz-box-shadow: 0 3px 0 <?php echo esc_attr( $color ); ?>,0 0 12px rgba(51,51,51,.5);
		box-shadow: 0 3px 0 <?php echo esc_attr( $color ); ?>, 0 0 12px rgba(51,51,51,.5);
	}
	.colorskin-custom .twentytwenty-horizontal .twentytwenty-handle:after {
		-webkit-box-shadow: 0 -3px 0 <?php echo esc_attr( $color ); ?>, 0 0 12px rgba(51,51,51,.5);
		-moz-box-shadow: 0 -3px 0 <?php echo esc_attr( $color ); ?>,0 0 12px rgba(51,51,51,.5);
		box-shadow: 0 -3px 0 <?php echo esc_attr( $color ); ?>, 0 0 12px rgba(51,51,51,.5);
	}

 /* ==  loading Animation
  ========================== */
@-webkit-keyframes wnBounce {
	0% {
		background-color: #e3e3e3;
	}
	50% {
		background-color: <?php echo esc_attr( $color ); ?>;
	}
	100% {
		background-color: #e3e3e3;
	}
}

@keyframes wnBounce {
	0% {
		background-color: #e3e3e3;
	}
	50% {
		background-color: <?php echo esc_attr( $color ); ?>;
	}
	100% {
		background-color: #e3e3e3;
	}
}

.w-login #user-logged .logged-links,.modal-title,.mfp-content .wpcf7 .wpcf7-form input[type=reset],.mfp-content .wpcf7 .wpcf7-form input[type=button],.mfp-content .wpcf7 .wpcf7-form input[type=submit] { background-color: <?php echo esc_attr( $color ); ?>;}
.ts-dodeca:after, .ts-dodeca:before, .w-login #user-logged .author-avatar img { border-color: <?php echo esc_attr( $color ); ?>;}

	<?php
}


/*
 * Custom CSS
*/
$thm_options['deep_custom_css'] = isset( $thm_options['deep_custom_css'] ) ? $thm_options['deep_custom_css'] : '';
echo $thm_options['deep_custom_css'];

$out = $GLOBALS['deep_dyncss'] = $GLOBALS['deep_dynshortcodes'] = '';

$out                    = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $out );
$GLOBALS['deep_dyncss'] = str_replace( array( "\r\n", "\r", "\n", "\t", '    ' ), '', $out );
$out                    = ob_get_contents();
ob_end_clean();

global $wp_filesystem;
if ( empty( $wp_filesystem ) ) {
	require_once ABSPATH . '/wp-admin/includes/file.php';
	WP_Filesystem();
}
$deep_dyn_css_dir = DEEP_ASSETS_DIR . 'css/frontend/dynamic-style/dyncssphp.css';
file_exists( DEEP_ASSETS_DIR . 'css/frontend/dynamic-style/dyncss.php.css' ) ? wp_delete_file( DEEP_ASSETS_DIR . 'css/frontend/dynamic-style/dyncss.php.css' ) : '';
$wp_filesystem->put_contents(
	$deep_dyn_css_dir,
	str_replace(
		array( "\r\n", "\r", "\n", "\t", '    ' ),
		'',
		preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $out )
	), 0644
);
