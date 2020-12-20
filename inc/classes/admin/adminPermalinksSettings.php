<?php
namespace PAIG\Admin;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( class_exists( 'Paig_Admin_Permalinks_Settings', false ) ) {
    return new Paig_Admin_Permalinks_Settings();
}

/**
 * WC_Admin_Permalink_Settings Class.
 */
class adminPermalinksSettings {

    /**
     * Permalink settings.
     *
     * @var array
     */
    private $permalinks = array();

    /**
     * Hook in tabs.
     */
    public function __construct() {
        $this->settings_init();
        $this->settings_save();
    }

    /**
     * Init our settings.
     */
    public function settings_init() {

        add_settings_section( 'paig-permalink', __( 'Property permalinks', 'paig' ), array( $this, 'settings' ), 'permalink' );

        add_settings_field(
            'paig_property_category_slug',
            __( 'Property category base', 'paig' ),
            array( $this, 'property_category_slug_input' ),
            'permalink',
            'optional'
        );
        add_settings_field(
            'paig_property_tag_slug',
            __( 'Property tag base', 'paig' ),
            array( $this, 'property_tag_slug_input' ),
            'permalink',
            'optional'
        );
        add_settings_field(
            'paig_property_attribute_slug',
            __( 'Property attribute base', 'paig' ),
            array( $this, 'property_attribute_slug_input' ),
            'permalink',
            'optional'
        );

        $this->permalinks = wc_get_permalink_structure();
    }

    /**
     * Show a slug input box.
     */
    public function property_category_slug_input() {
        ?>
        <input name="paig_property_category_slug" type="text" class="regular-text code" value="<?php echo esc_attr( $this->permalinks['category_base'] ); ?>" placeholder="<?php echo esc_attr_x( 'property-category', 'slug', 'paig' ); ?>" />
        <?php
    }

    /**
     * Show a slug input box.
     */
    public function property_tag_slug_input() {
        ?>
        <input name="paig_property_tag_slug" type="text" class="regular-text code" value="<?php echo esc_attr( $this->permalinks['tag_base'] ); ?>" placeholder="<?php echo esc_attr_x( 'property-tag', 'slug', 'paig' ); ?>" />
        <?php
    }

    /**
     * Show a slug input box.
     */
    public function property_attribute_slug_input() {
        ?>
        <input name="paig_property_attribute_slug" type="text" class="regular-text code" value="<?php echo esc_attr( $this->permalinks['attribute_base'] ); ?>" /><code>/attribute-name/attribute/</code>
        <?php
    }

    /**
     * Show the settings.
     */
    public function settings() {
        /* translators: %s: Home URL */
        echo wp_kses_post( wpautop( sprintf( __( 'If you like, you may enter custom structures for your property URLs here. For example, using <code>shop</code> would make your property links like <code>%sshop/sample-property/</code>. This setting affects property URLs only, not things such as property categories.', 'woocommerce' ), esc_url( home_url( '/' ) ) ) ) );

        $shop_page_id = wc_get_page_id( 'shop' );
        $base_slug    = urldecode( ( $shop_page_id > 0 && get_post( $shop_page_id ) ) ? get_page_uri( $shop_page_id ) : _x( 'shop', 'default-slug', 'woocommerce' ) );
        $property_base = _x( 'property', 'default-slug', 'paig' );

        $structures = array(
            0 => '',
            1 => '/' . trailingslashit( $base_slug ),
            2 => '/' . trailingslashit( $base_slug ) . trailingslashit( '%property_cat%' ),
        );
        ?>
        <table class="form-table wc-permalink-structure">
            <tbody>
            <tr>
                <th><label><input name="property_permalink" type="radio" value="<?php echo esc_attr( $structures[0] ); ?>" class="wctog" <?php checked( $structures[0], $this->permalinks['property_base'] ); ?> /> <?php esc_html_e( 'Default', 'woocommerce' ); ?></label></th>
                <td><code class="default-example"><?php echo esc_html( home_url() ); ?>/?property=sample-property</code> <code class="non-default-example"><?php echo esc_html( home_url() ); ?>/<?php echo esc_html( $property_base ); ?>/sample-property/</code></td>
            </tr>
            <?php if ( $shop_page_id ) : ?>
                <tr>
                    <th><label><input name="property_permalink" type="radio" value="<?php echo esc_attr( $structures[1] ); ?>" class="wctog" <?php checked( $structures[1], $this->permalinks['property_base'] ); ?> /> <?php esc_html_e( 'Shop base', 'woocommerce' ); ?></label></th>
                    <td><code><?php echo esc_html( home_url() ); ?>/<?php echo esc_html( $base_slug ); ?>/sample-property/</code></td>
                </tr>
                <tr>
                    <th><label><input name="property_permalink" type="radio" value="<?php echo esc_attr( $structures[2] ); ?>" class="wctog" <?php checked( $structures[2], $this->permalinks['property_base'] ); ?> /> <?php esc_html_e( 'Shop base with category', 'woocommerce' ); ?></label></th>
                    <td><code><?php echo esc_html( home_url() ); ?>/<?php echo esc_html( $base_slug ); ?>/property-category/sample-property/</code></td>
                </tr>
            <?php endif; ?>
            <tr>
                <th><label><input name="property_permalink" id="paig_custom_selection" type="radio" value="custom" class="tog" <?php checked( in_array( $this->permalinks['property_base'], $structures, true ), false ); ?> />
                        <?php esc_html_e( 'Custom base', 'paig' ); ?></label></th>
                <td>
                    <input name="property_permalink_structure" id="paig_permalink_structure" type="text" value="<?php echo esc_attr( $this->permalinks['property_base'] ? trailingslashit( $this->permalinks['property_base'] ) : '' ); ?>" class="regular-text code"> <span class="description"><?php esc_html_e( 'Enter a custom base to use. A base must be set or WordPress will use default instead.', 'woocommerce' ); ?></span>
                </td>
            </tr>
            </tbody>
        </table>
        <?php wp_nonce_field( 'wc-permalinks', 'wc-permalinks-nonce' ); ?>
        <script type="text/javascript">
            jQuery( function() {
                jQuery('input.wctog').change(function() {
                    jQuery('#paig_permalink_structure').val( jQuery( this ).val() );
                });
                jQuery('.permalink-structure input').change(function() {
                    jQuery('.wc-permalink-structure').find('code.non-default-example, code.default-example').hide();
                    if ( jQuery(this).val() ) {
                        jQuery('.wc-permalink-structure code.non-default-example').show();
                        jQuery('.wc-permalink-structure input').removeAttr('disabled');
                    } else {
                        jQuery('.wc-permalink-structure code.default-example').show();
                        jQuery('.wc-permalink-structure input:eq(0)').click();
                        jQuery('.wc-permalink-structure input').attr('disabled', 'disabled');
                    }
                });
                jQuery('.permalink-structure input:checked').change();
                jQuery('#paig_permalink_structure').focus( function(){
                    jQuery('#paig_custom_selection').click();
                } );
            } );
        </script>
        <?php
    }

    /**
     * Save the settings.
     */
    public function settings_save() {
        if ( ! is_admin() ) {
            return;
        }

        // We need to save the options ourselves; settings api does not trigger save for the permalinks page.
        if ( isset( $_POST['permalink_structure'], $_POST['wc-permalinks-nonce'], $_POST['paig_property_category_slug'], $_POST['woocommerce_property_tag_slug'], $_POST['woocommerce_property_attribute_slug'] ) && wp_verify_nonce( wp_unslash( $_POST['wc-permalinks-nonce'] ), 'wc-permalinks' ) ) { // WPCS: input var ok, sanitization ok.
            wc_switch_to_site_locale();

            $permalinks                   = (array) get_option( 'paig_permalinks', array() );
            $permalinks['category_base']  = wc_sanitize_permalink( wp_unslash( $_POST['paig_property_category_slug'] ) ); // WPCS: input var ok, sanitization ok.
            $permalinks['tag_base']       = wc_sanitize_permalink( wp_unslash( $_POST['paig_property_tag_slug'] ) ); // WPCS: input var ok, sanitization ok.
            $permalinks['attribute_base'] = wc_sanitize_permalink( wp_unslash( $_POST['paig_property_attribute_slug'] ) ); // WPCS: input var ok, sanitization ok.

            // Generate property base.
            $property_base = isset( $_POST['property_permalink'] ) ? wc_clean( wp_unslash( $_POST['property_permalink'] ) ) : ''; // WPCS: input var ok, sanitization ok.

            if ( 'custom' === $property_base ) {
                if ( isset( $_POST['property_permalink_structure'] ) ) { // WPCS: input var ok.
                    $property_base = preg_replace( '#/+#', '/', '/' . str_replace( '#', '', trim( wp_unslash( $_POST['property_permalink_structure'] ) ) ) ); // WPCS: input var ok, sanitization ok.
                } else {
                    $property_base = '/';
                }

                // This is an invalid base structure and breaks pages.
                if ( '/%property_cat%/' === trailingslashit( $property_base ) ) {
                    $property_base = '/' . _x( 'property', 'slug', 'paig' ) . $property_base;
                }
            } elseif ( empty( $property_base ) ) {
                $property_base = _x( 'property', 'slug', 'paig' );
            }

            $permalinks['property_base'] = wc_sanitize_permalink( $property_base );

            // Shop base may require verbose page rules if nesting pages.
            $shop_page_id   = wc_get_page_id( 'shop' );
            $shop_permalink = ( $shop_page_id > 0 && get_post( $shop_page_id ) ) ? get_page_uri( $shop_page_id ) : _x( 'shop', 'default-slug', 'woocommerce' );

            if ( $shop_page_id && stristr( trim( $permalinks['property_base'], '/' ), $shop_permalink ) ) {
                $permalinks['use_verbose_page_rules'] = true;
            }

            update_option( 'paig_permalinks', $permalinks );
            wc_restore_locale();
        }
    }
}

