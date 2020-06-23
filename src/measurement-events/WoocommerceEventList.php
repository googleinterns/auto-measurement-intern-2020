<?php
include_once 'MeasurementEventList.php';


/**
 * Subclass that contains information for Woocommerce plugin
 *
 * @class WoocommerceEventList
 */
class WoocommerceEventList extends MeasurementEventList {

    public function __construct() {
        $builder = MeasurementEvent::createBuilder([
            'pluginName' => 'Woocommerce',
            'category' => 'ecommerce',
            'action' => 'add_to_cart',
            'selector' => '.woocommerce-page .add_to_cart_button',
            'on' => 'click'
        ]);
        $this->addEvent($builder->build());

        $builder = MeasurementEvent::createBuilder([
            'pluginName' => 'Woocommerce',
            'category' => 'ecommerce',
            'action' => 'add_to_cart',
            'selector' => '.woocommerce-page .single_add_to_cart_button',
            'on' => 'click'
        ]);
        $this->addEvent($builder->build());

        $builder = MeasurementEvent::createBuilder([
            'pluginName' => 'Woocommerce',
            'category' => 'ecommerce',
            'action' => 'remove_from_cart',
            'selector' => '.woocommerce-page .remove',
            'on' => 'click'
        ]);
        $this->addEvent($builder->build());

        $builder = MeasurementEvent::createBuilder([
            'pluginName' => 'Woocommerce',
            'category' => 'ecommerce',
            'action' => 'checkout',
            'selector' => 'div.wc-proceed-to-checkout .checkout-button',
            'on' => 'click'
        ]);
        $this->addEvent($builder->build());

        $builder = MeasurementEvent::createBuilder([
            'pluginName' => 'Woocommerce',
            'category' => 'ecommerce',
            'action' => 'review_cart',
            'selector' => 'a.added_to_cart.wc-forward',
            'on' => 'click',
            'secondLayerSelector' => 'document.body',
            'secondLayerOn' => 'added_to_cart'
        ]);
        $this->addEvent($builder->build());

        $builder = MeasurementEvent::createBuilder([
            'pluginName' => 'Woocommerce',
            'category' => 'ecommerce',
            'action' => 'review_cart',
            'selector' => 'div.woocommerce-message a.wc-forward',
            'on' => 'click'
        ]);
        $this->addEvent($builder->build());

        $builder = MeasurementEvent::createBuilder([
            'pluginName' => 'Woocommerce',
            'category' => 'ecommerce',
            'action' => 'cart_contents',
            'selector' => 'a.cart-contents',
            'on' => 'click'
        ]);
        $this->addEvent($builder->build());

        $builder = MeasurementEvent::createBuilder([
            'pluginName' => 'Woocommerce',
            'category' => 'ecommerce',
            'action' => 'update_cart',
            'selector' => '.woocommerce-cart-form__contents .coupon ~ .button',
            'on' => 'click'
        ]);
        $this->addEvent($builder->build());

        $builder = MeasurementEvent::createBuilder([
            'pluginName' => 'Woocommerce',
            'category' => 'ecommerce',
            'action' => 'product_details',
            'selector' => '.content-area a.woocommerce-LoopProduct-link',
            'on' => 'click'
        ]);
        $this->addEvent($builder->build());

        $builder = MeasurementEvent::createBuilder([
            'pluginName' => 'Woocommerce',
            'category' => 'ecommerce',
            'action' => 'place_order',
            'selector' => '.woocommerce-page form.woocommerce-checkout',
            'on' => 'click'
        ]);
        $this->addEvent($builder->build());
    }

}
