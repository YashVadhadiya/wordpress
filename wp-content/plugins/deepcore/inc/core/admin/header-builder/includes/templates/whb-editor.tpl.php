<?php

/**
 * Header Builder - Editor Template.
 *
 * @author Webnus
 */

// don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}
$editor_components = WHB_Multilanguage::language() ? get_option( WHB_Multilanguage::language() . '_whb_data_editor_components' ) : get_option( 'whb_data_editor_components' );

// Desktop: Topbar settings
$desktopTopbarHidden = $editor_components['desktop-view']['topbar']['settings']['hidden_element'] ? 'true': 'false';
$desktopTopbarUniqueID = $editor_components['desktop-view']['topbar']['settings']['uniqueId'];
// Desktop: Row1 settings
$desktopRow1Hidden = $editor_components['desktop-view']['row1']['settings']['hidden_element'] ? 'true': 'false';
$desktopRow1UniqueID = $editor_components['desktop-view']['row1']['settings']['uniqueId'];
// Desktop: Row2 settings
$desktopRow2Hidden = $editor_components['desktop-view']['row2']['settings']['hidden_element'] ? 'true': 'false';
$desktopRow2UniqueID = $editor_components['desktop-view']['row2']['settings']['uniqueId'];
// Desktop: Row3 settings
$desktopRow3Hidden = $editor_components['desktop-view']['row3']['settings']['hidden_element'] ? 'true': 'false';
$desktopRow3UniqueID = $editor_components['desktop-view']['row3']['settings']['uniqueId'];

// Tablets: Topbar settings
$tabletsTopbarHidden = $editor_components['tablets-view']['topbar']['settings']['hidden_element'] ? 'true': 'false';
$tabletsTopbarUniqueID = $editor_components['tablets-view']['topbar']['settings']['uniqueId'];
// Tablets: Row1 settings
$tabletsRow1Hidden = $editor_components['tablets-view']['row1']['settings']['hidden_element'] ? 'true': 'false';
$tabletsRow1UniqueID = $editor_components['tablets-view']['row1']['settings']['uniqueId'];
// Tablets: Row2 settings
$tabletsRow2Hidden = $editor_components['tablets-view']['row2']['settings']['hidden_element'] ? 'true': 'false';
$tabletsRow2UniqueID = $editor_components['tablets-view']['row2']['settings']['uniqueId'];
// Tablets: Row3 settings
$tabletsRow3Hidden = $editor_components['tablets-view']['row3']['settings']['hidden_element'] ? 'true': 'false';
$tabletsRow3UniqueID = $editor_components['tablets-view']['row3']['settings']['uniqueId'];

// Mobiles: Topbar settings
$mobilesTopbarHidden = $editor_components['mobiles-view']['topbar']['settings']['hidden_element'] ? 'true': 'false';
$mobilesTopbarUniqueID = $editor_components['mobiles-view']['topbar']['settings']['uniqueId'];
// Mobiles: Row1 settings
$mobilesRow1Hidden = $editor_components['mobiles-view']['row1']['settings']['hidden_element'] ? 'true': 'false';
$mobilesRow1UniqueID = $editor_components['mobiles-view']['row1']['settings']['uniqueId'];
// Mobiles: Row2 settings
$mobilesRow2Hidden = $editor_components['mobiles-view']['row2']['settings']['hidden_element'] ? 'true': 'false';
$mobilesRow2UniqueID = $editor_components['mobiles-view']['row2']['settings']['uniqueId'];
// Mobiles: Row3 settings
$mobilesRow3Hidden = $editor_components['mobiles-view']['row3']['settings']['hidden_element'] ? 'true': 'false';
$mobilesRow3UniqueID = $editor_components['mobiles-view']['row3']['settings']['uniqueId'];

// Sticky: Row1 settings
$stickySrow1Hidden = $editor_components['sticky-view']['srow1']['settings']['hidden_element'] ? 'true': 'false';
$stickySrow1UniqueID = $editor_components['sticky-view']['srow1']['settings']['uniqueId'];
// Sticky: Row2 settings
$stickySrow2Hidden = $editor_components['sticky-view']['srow2']['settings']['hidden_element'] ? 'true': 'false';
$stickySrow2UniqueID = $editor_components['sticky-view']['srow2']['settings']['uniqueId'];
// Sticky: Row3 settings
$stickySrow3Hidden = $editor_components['sticky-view']['srow3']['settings']['hidden_element'] ? 'true': 'false';
$stickySrow3UniqueID = $editor_components['sticky-view']['srow3']['settings']['uniqueId'];

$class_frontend_builder = WHB_Helper::is_frontend_builder() ? ' whb-frontend-builder' : '';

?>

<!-- webnus header builder wrap -->
<div class="wn-header-builder-wrap wp-clearfix<?php echo esc_attr( $class_frontend_builder ); ?>" id="wn-header-builder">

    <div class="whb-actions">

        <?php if ( WHB_Helper::is_frontend_builder() ) : ?>
            <div class="whb-action-collapse whb-tooltip whb-open" data-tooltip="<?php esc_html_e( 'Toggle', 'deep' ); ?>"><i class="ti-arrow-circle-down"></i></div>
            <a href="#" id="whb-publish" class="button button-primary"><i class="ti-new-window"></i><?php esc_html_e( 'Publish', 'deep' ); ?></a>
            <a href="<?php echo admin_url( 'admin.php?page=wn-admin-welcome' ); ?>" class="btob-button whb-tooltip" data-tooltip="<?php esc_html_e( 'Backend editor', 'deep' ) ?>"><i class="ti-arrow-left"></i></a>
        <?php else : ?>
            <a href="<?php echo admin_url( 'admin.php?page=webnus_header_builder' ); ?>" id="whb-f-editor" class="button button-primary"><i class="ti-arrow-right"></i><?php esc_html_e( 'Front-end Header Builder', 'deep' ); ?></a>
        <?php endif; ?>

        <!-- <a href="#" id="whb-page-options" class="btob-button whb-tooltip" data-tooltip="Page Options"><i class="ti-settings"></i></a> -->
        <a href="#" id="whb-vertical-header" class="button" data-header_type="horizontal"><i class="ti-align-justify"></i><span><?php esc_html_e( 'Vertical Header', 'deep' ); ?></span></a>
        <a href="#" id="whb-predefined" class="button whb-full-modal-btn" data-modal-target="prebuilds-modal-content"><i class="ti-harddrive"></i><?php esc_html_e( 'Pre-defined Headers', 'deep' ) ?></a>
        <?php
        echo WHB_Multilanguage::get_instance()->get_languages();
        ?>

        <div class="whb-full-modal" data-modal="prebuilds-modal-content">
            <i class="whb-full-modal-close ti-close"></i>
            <h4><?php esc_html_e( 'Pre-defined Headers', 'deep' ); ?></h4>
            <div class="whb-predefined-modal-contents wp-clearfix">
                <?php include_once WHB_Helper::get_file( 'includes/prebuilds/prebuilds.php' ); ?>
            </div>
        </div>

        <!-- import export -->
        <div class="whb-import-export">

            <a id="whb-export" class="button" href="<?php echo esc_url( admin_url( 'admin-ajax.php?action=whb_export' ) ); ?>"><i class="ti-cloud-down"></i><?php esc_html_e( 'Export Header', 'deep' ) ?></a>
            <div class="whb-import-wrap">
                <a class="button whb-full-modal-btn" href="#" data-modal-target="import-modal-content"><i class="ti-cloud-up"></i><?php esc_html_e( 'Import Header', 'deep' ) ?></a>
                <input type="file" id="whb-import">
            </div>

        </div> <!-- end .whb-import-export -->

    </div><!-- .whb-actions -->

    <!-- tabs -->
    <div class="whb-tabs-wrap">

        <ul class="whb-tabs-list wp-clearfix">
            <li class="whb-tab w-active">
                <a href="#desktop-view" id="whb-desktop-tab">
                    <i class="sl-screen-desktop" aria-hidden="true"></i>
                    <span><?php esc_html_e( 'Desktop', 'deep' ); ?></span>
                </a>
            </li>
            <li class="whb-tab">
                <a href="#tablets-view" id="whb-tablets-tab">
                    <i class="sl-screen-tablet" aria-hidden="true"></i>
                    <span><?php esc_html_e( 'Tablets', 'deep' ); ?></span>
                </a>
            </li>
            <li class="whb-tab">
                <a href="#mobiles-view" id="whb-mobiles-tab">
                    <i class="sl-screen-smartphone" aria-hidden="true"></i>
                    <span><?php esc_html_e( 'Mobiles', 'deep' ); ?></span>
                </a>
            </li>
            <li class="whb-tab">
                <a href="#sticky-view" id="whb-sticky-tab">
                    <i class="sl-lock" aria-hidden="true"></i>
                    <span><?php esc_html_e( 'Sticky', 'deep' ); ?></span>
                </a>
            </li>
        </ul> <!-- end .whb-tabs-list -->

        <div class="whb-tabs-panels">

            <!-- desktop panel -->
            <div class="whb-tab-panel whb-desktop-panel" id="desktop-view">

                <!-- topbar -->
                <div class="whb-columns" data-columns="topbar">
                    <div class="whb-elements-item" data-element="header-area" data-unique-id="<?php echo '' . $desktopTopbarUniqueID ?>" data-hidden_element="<?php echo '' . $desktopTopbarHidden; ?>">
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Hide">
                            <i class="whb-control whb-hide-btn ti-eye"></i>
                        </span>
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Settings">
                            <i class="whb-control whb-edit-btn sl-settings"></i>
                        </span>
                    </div>
                    <span class="whb-element-name"><?php esc_html_e( 'Topbar Area', 'deep' ); ?></span>
                    <div class="whb-col col-left wp-clearfix" data-align-col="left">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'desktop-view', 'topbar', 'left'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="left" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-center wp-clearfix" data-align-col="center">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'desktop-view', 'topbar', 'center'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="center" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-right wp-clearfix" data-align-col="right">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'desktop-view', 'topbar', 'right'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="right" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                </div> <!-- end whb-columns -->

                <!-- header area row 1 -->
                <div class="whb-columns" data-columns="row1">
                    <div class="whb-elements-item" data-element="header-area" data-unique-id="<?php echo '' . $desktopRow1UniqueID ?>" data-hidden_element="<?php echo '' . $desktopRow1Hidden; ?>">
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Hide">
                            <i class="whb-control whb-hide-btn ti-eye"></i>
                        </span>
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Settings">
                            <i class="whb-control whb-edit-btn sl-settings"></i>
                        </span>
                    </div>
                    <span class="whb-element-name"><?php esc_html_e( 'Header Area Row 1', 'deep' ); ?></span>
                    <div class="whb-col col-left wp-clearfix" data-align-col="left">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'desktop-view', 'row1', 'left'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="left" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-center wp-clearfix" data-align-col="center">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'desktop-view', 'row1', 'center'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="center" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-right wp-clearfix" data-align-col="right">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'desktop-view', 'row1', 'right'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="right" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                </div> <!-- end whb-columns -->

                <!-- header area row 2 -->
                <div class="whb-columns" data-columns="row2">
                    <div class="whb-elements-item" data-element="header-area" data-unique-id="<?php echo '' . $desktopRow2UniqueID ?>" data-hidden_element="<?php echo '' . $desktopRow2Hidden; ?>">
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Hide">
                            <i class="whb-control whb-hide-btn ti-eye"></i>
                        </span>
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Settings">
                            <i class="whb-control whb-edit-btn sl-settings"></i>
                        </span>
                    </div>
                    <span class="whb-element-name"><?php esc_html_e( 'Header Area Row 2', 'deep' ); ?></span>
                    <div class="whb-col col-left wp-clearfix" data-align-col="left">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'desktop-view', 'row2', 'left'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="left" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-center wp-clearfix" data-align-col="center">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'desktop-view', 'row2', 'center'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="center" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-right wp-clearfix" data-align-col="right">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'desktop-view', 'row2', 'right'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="right" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                </div> <!-- end whb-columns -->

                <!-- header area row 3 -->
                <div class="whb-columns" data-columns="row3">
                    <div class="whb-elements-item" data-element="header-area" data-unique-id="<?php echo '' . $desktopRow3UniqueID ?>" data-hidden_element="<?php echo '' . $desktopRow3Hidden; ?>">
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Hide">
                            <i class="whb-control whb-hide-btn ti-eye"></i>
                        </span>
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Settings">
                            <i class="whb-control whb-edit-btn sl-settings"></i>
                        </span>
                    </div>
                    <span class="whb-element-name"><?php esc_html_e( 'Header Area Row 3', 'deep' ); ?></span>
                    <div class="whb-col col-left wp-clearfix" data-align-col="left">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'desktop-view', 'row3', 'left'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="left" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-center wp-clearfix" data-align-col="center">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'desktop-view', 'row3', 'center'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="center" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-right wp-clearfix" data-align-col="right">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'desktop-view', 'row3', 'right'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="right" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                </div> <!-- end whb-columns -->

            </div> <!-- end .whb-desktop-panel -->

            <!-- tablets panel -->
            <div class="whb-tab-panel whb-tablets-panel" id="tablets-view">

                <!-- topbar -->
                <div class="whb-columns" data-columns="topbar">
                    <div class="whb-elements-item" data-element="header-area" data-unique-id="<?php echo '' . $tabletsTopbarUniqueID ?>" data-hidden_element="<?php echo '' . $tabletsTopbarHidden; ?>">
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Hide">
                            <i class="whb-control whb-hide-btn ti-eye"></i>
                        </span>
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Settings">
                            <i class="whb-control whb-edit-btn sl-settings"></i>
                        </span>
                    </div>
                    <span class="whb-element-name"><?php esc_html_e( 'Topbar Area', 'deep' ); ?></span>
                    <div class="whb-col col-left wp-clearfix" data-align-col="left">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'tablets-view', 'topbar', 'left'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="left" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-center wp-clearfix" data-align-col="center">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'tablets-view', 'topbar', 'center'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="center" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-right wp-clearfix" data-align-col="right">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'tablets-view', 'topbar', 'right'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="right" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                </div> <!-- end whb-columns -->

                <!-- header area row 1 -->
                <div class="whb-columns" data-columns="row1">
                    <div class="whb-elements-item" data-element="header-area" data-unique-id="<?php echo '' . $tabletsRow1UniqueID ?>" data-hidden_element="<?php echo '' . $tabletsRow1Hidden; ?>">
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Hide">
                            <i class="whb-control whb-hide-btn ti-eye"></i>
                        </span>
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Settings">
                            <i class="whb-control whb-edit-btn sl-settings"></i>
                        </span>
                    </div>
                    <span class="whb-element-name"><?php esc_html_e( 'Header Area Row 1', 'deep' ); ?></span>
                    <div class="whb-col col-left wp-clearfix" data-align-col="left">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'tablets-view', 'row1', 'left'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="left" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-center wp-clearfix" data-align-col="center">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'tablets-view', 'row1', 'center'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="center" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-right wp-clearfix" data-align-col="right">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'tablets-view', 'row1', 'right'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="right" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                </div> <!-- end whb-columns -->

                <!-- header area row 2 -->
                <div class="whb-columns" data-columns="row2">
                    <div class="whb-elements-item" data-element="header-area" data-unique-id="<?php echo '' . $tabletsRow2UniqueID ?>" data-hidden_element="<?php echo '' . $tabletsRow2Hidden; ?>">
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Hide">
                            <i class="whb-control whb-hide-btn ti-eye"></i>
                        </span>
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Settings">
                            <i class="whb-control whb-edit-btn sl-settings"></i>
                        </span>
                    </div>
                    <span class="whb-element-name"><?php esc_html_e( 'Header Area Row 2', 'deep' ); ?></span>
                    <div class="whb-col col-left wp-clearfix" data-align-col="left">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'tablets-view', 'row2', 'left'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="left" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-center wp-clearfix" data-align-col="center">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'tablets-view', 'row2', 'center'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="center" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-right wp-clearfix" data-align-col="right">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'tablets-view', 'row2', 'right'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="right" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                </div> <!-- end whb-columns -->

                <!-- header area row 3 -->
                <div class="whb-columns" data-columns="row3">
                    <div class="whb-elements-item" data-element="header-area" data-unique-id="<?php echo '' . $tabletsRow3UniqueID ?>" data-hidden_element="<?php echo '' . $tabletsRow3Hidden; ?>">
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Hide">
                            <i class="whb-control whb-hide-btn ti-eye"></i>
                        </span>
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Settings">
                            <i class="whb-control whb-edit-btn sl-settings"></i>
                        </span>
                    </div>
                    <span class="whb-element-name"><?php esc_html_e( 'Header Area Row 3', 'deep' ); ?></span>
                    <div class="whb-col col-left wp-clearfix" data-align-col="left">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'tablets-view', 'row3', 'left'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="left" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-center wp-clearfix" data-align-col="center">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'tablets-view', 'row3', 'center'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="center" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-right wp-clearfix" data-align-col="right">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'tablets-view', 'row3', 'right'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="right" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                </div> <!-- end whb-columns -->

            </div> <!-- end .whb-tablets-panel -->

            <!-- mobiles panel -->
            <div class="whb-tab-panel whb-mobiles-panel" id="mobiles-view">

                <!-- topbar -->
                <div class="whb-columns" data-columns="topbar">
                    <div class="whb-elements-item" data-element="header-area" data-unique-id="<?php echo '' . $mobilesTopbarUniqueID ?>" data-hidden_element="<?php echo '' . $mobilesTopbarHidden; ?>">
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Hide">
                            <i class="whb-control whb-hide-btn ti-eye"></i>
                        </span>
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Settings">
                            <i class="whb-control whb-edit-btn sl-settings"></i>
                        </span>
                    </div>
                    <span class="whb-element-name"><?php esc_html_e( 'Topbar Area', 'deep' ); ?></span>
                    <div class="whb-col col-left wp-clearfix" data-align-col="left">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'mobiles-view', 'topbar', 'left'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="left" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-center wp-clearfix" data-align-col="center">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'mobiles-view', 'topbar', 'center'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="center" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-right wp-clearfix" data-align-col="right">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'mobiles-view', 'topbar', 'right'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="right" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                </div> <!-- end whb-columns -->

                <!-- header area row 1 -->
                <div class="whb-columns" data-columns="row1">
                    <div class="whb-elements-item" data-element="header-area" data-unique-id="<?php echo '' . $mobilesRow1UniqueID ?>" data-hidden_element="<?php echo '' . $mobilesRow1Hidden; ?>">
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Hide">
                            <i class="whb-control whb-hide-btn ti-eye"></i>
                        </span>
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Settings">
                            <i class="whb-control whb-edit-btn sl-settings"></i>
                        </span>
                    </div>
                    <span class="whb-element-name"><?php esc_html_e( 'Header Area Row 1', 'deep' ); ?></span>
                    <div class="whb-col col-left wp-clearfix" data-align-col="left">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'mobiles-view', 'row1', 'left'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="left" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-center wp-clearfix" data-align-col="center">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'mobiles-view', 'row1', 'center'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="center" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-right wp-clearfix" data-align-col="right">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'mobiles-view', 'row1', 'right'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="right" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                </div> <!-- end whb-columns -->

                <!-- header area row 2 -->
                <div class="whb-columns" data-columns="row2">
                    <div class="whb-elements-item" data-element="header-area" data-unique-id="<?php echo '' . $mobilesRow2UniqueID ?>" data-hidden_element="<?php echo '' . $mobilesRow2Hidden; ?>">
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Hide">
                            <i class="whb-control whb-hide-btn ti-eye"></i>
                        </span>
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Settings">
                            <i class="whb-control whb-edit-btn sl-settings"></i>
                        </span>
                    </div>
                    <span class="whb-element-name"><?php esc_html_e( 'Header Area Row 2', 'deep' ); ?></span>
                    <div class="whb-col col-left wp-clearfix" data-align-col="left">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'mobiles-view', 'row2', 'left'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="left" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-center wp-clearfix" data-align-col="center">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'mobiles-view', 'row2', 'center'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="center" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-right wp-clearfix" data-align-col="right">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'mobiles-view', 'row2', 'right'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="right" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                </div> <!-- end whb-columns -->

                <!-- header area row 3 -->
                <div class="whb-columns" data-columns="row3">
                    <div class="whb-elements-item" data-element="header-area" data-unique-id="<?php echo '' . $mobilesRow3UniqueID ?>" data-hidden_element="<?php echo '' . $mobilesRow3Hidden; ?>">
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Hide">
                            <i class="whb-control whb-hide-btn ti-eye"></i>
                        </span>
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Settings">
                            <i class="whb-control whb-edit-btn sl-settings"></i>
                        </span>
                    </div>
                    <span class="whb-element-name"><?php esc_html_e( 'Header Area Row 3', 'deep' ); ?></span>
                    <div class="whb-col col-left wp-clearfix" data-align-col="left">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'mobiles-view', 'row3', 'left'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="left" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-center wp-clearfix" data-align-col="center">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'mobiles-view', 'row3', 'center'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="center" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-right wp-clearfix" data-align-col="right">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'mobiles-view', 'row3', 'right'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="right" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                </div> <!-- end whb-columns -->

            </div> <!-- end .whb-mobiles-panel -->

            <!-- sticky panel -->
            <div class="whb-tab-panel whb-sticky-panel" id="sticky-view">

                <!-- header sticky row 1 -->
                <div class="whb-columns" data-columns="srow1">
                    <div class="whb-elements-item" data-element="sticky-area" data-unique-id="<?php echo '' . $stickySrow1UniqueID ?>" data-hidden_element="<?php echo '' . $stickySrow1Hidden; ?>">
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Hide">
                            <i class="whb-control whb-hide-btn ti-eye"></i>
                        </span>
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Settings">
                            <i class="whb-control whb-edit-btn sl-settings"></i>
                        </span>
                    </div>
                    <span class="whb-element-name"><?php esc_html_e( 'Sticky Area Row 1', 'deep' ); ?></span>
                    <div class="whb-col col-left wp-clearfix" data-align-col="left">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'sticky-view', 'srow1', 'left'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="left" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-center wp-clearfix" data-align-col="center">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'sticky-view', 'srow1', 'center'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="center" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-right wp-clearfix" data-align-col="right">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'sticky-view', 'srow1', 'right'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="right" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                </div> <!-- end whb-columns -->

                <!-- header area row 2 -->
                <div class="whb-columns" data-columns="srow2">
                    <div class="whb-elements-item" data-element="sticky-area" data-unique-id="<?php echo '' . $stickySrow2UniqueID ?>" data-hidden_element="<?php echo '' . $stickySrow2Hidden; ?>">
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Hide">
                            <i class="whb-control whb-hide-btn ti-eye"></i>
                        </span>
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Settings">
                            <i class="whb-control whb-edit-btn sl-settings"></i>
                        </span>
                    </div>
                    <span class="whb-element-name"><?php esc_html_e( 'Sticky Area Row 2', 'deep' ); ?></span>
                    <div class="whb-col col-left wp-clearfix" data-align-col="left">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'sticky-view', 'srow2', 'left'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="left" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-center wp-clearfix" data-align-col="center">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'sticky-view', 'srow2', 'center'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="center" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-right wp-clearfix" data-align-col="right">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'sticky-view', 'srow2', 'right'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="right" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                </div> <!-- end whb-columns -->

                <!-- header area row 3 -->
                <div class="whb-columns" data-columns="srow3">
                    <div class="whb-elements-item" data-element="sticky-area" data-unique-id="<?php echo '' . $stickySrow3UniqueID ?>" data-hidden_element="<?php echo '' . $stickySrow3Hidden; ?>">
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Hide">
                            <i class="whb-control whb-hide-btn ti-eye"></i>
                        </span>
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Settings">
                            <i class="whb-control whb-edit-btn sl-settings"></i>
                        </span>
                    </div>
                    <span class="whb-element-name"><?php esc_html_e( 'Sticky Area Row 3', 'deep' ); ?></span>
                    <div class="whb-col col-left wp-clearfix" data-align-col="left">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'sticky-view', 'srow3', 'left'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="left" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-center wp-clearfix" data-align-col="center">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'sticky-view', 'srow3', 'center'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="center" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                    <div class="whb-col col-right wp-clearfix" data-align-col="right">
                        <div class="whb-elements-place wp-clearfix">
                            <?php echo WHB_Helper::getCellComponents($editor_components, 'sticky-view', 'srow3', 'right'); ?>
                        </div>
                        <a href="#" class="w-add-element whb-tooltip tooltip-on-top" data-align-col="right" data-tooltip="Add Element"><i class="sl-plus"></i></a>
                    </div>
                </div> <!-- end whb-columns -->

            </div> <!-- end .whb-sticky-panel -->

        </div> <!-- end .whb-tabs-panels -->

    </div> <!-- end .whb-tabs-wrap -->

    <?php
        // add element modal
        include_once WHB_Helper::get_file( 'includes/elements/add-elements.php' );

        if ( WHB_Multilanguage::language() ) {
            $localize_data = array(
                'nonce'                 => wp_create_nonce( 'whb-nonce' ),
                'ajaxurl'               => admin_url( 'admin-ajax.php', 'relative' ),
                'assets_url'            => WHB_Helper::get_file_uri( 'assets/' ),
                'prebuilds_url'         => WHB_Helper::get_file_uri( 'includes/prebuilds/headers/' ),
                'components'            => get_option( WHB_Multilanguage::language() . '_whb_data_components' ),
                'editor_components'     => get_option( WHB_Multilanguage::language() . '_whb_data_editor_components' ),
                'frontend_components'   => get_option( WHB_Multilanguage::language() . '_whb_data_frontend_components' ),
            );
        } else {
            $localize_data = array(
                'nonce'                 => wp_create_nonce( 'whb-nonce' ),
                'ajaxurl'               => admin_url( 'admin-ajax.php', 'relative' ),
                'assets_url'            => WHB_Helper::get_file_uri( 'assets/' ),
                'prebuilds_url'         => WHB_Helper::get_file_uri( 'includes/prebuilds/headers/' ),
                'components'            => get_option( 'whb_data_components' ),
                'editor_components'     => get_option( 'whb_data_editor_components' ),
                'frontend_components'   => get_option( 'whb_data_frontend_components' ),
            );
        }
        wp_localize_script( 'whb-editor-scripts', 'whb_localize', $localize_data );
    ?>

</div> <!-- end .wn-header-builder-wrap -->
