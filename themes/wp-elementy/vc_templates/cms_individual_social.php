<?php
$social_position = $social_align = $social_icon_size = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$social_position = (!empty($social_position)) ? $social_position : 'comming-soon';
$social_align = (!empty($social_align)) ? $social_align : 'text-left';
if (!empty($social_icon_size)) $social_align .= ' '.$social_icon_size;

wp_elementy_social_from_themeoption($social_position, $social_align);