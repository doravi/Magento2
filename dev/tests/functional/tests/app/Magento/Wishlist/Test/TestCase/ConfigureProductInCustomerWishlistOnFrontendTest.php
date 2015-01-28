<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Wishlist\Test\TestCase;

use Magento\Customer\Test\Fixture\CustomerInjectable;

/**
 * Test Flow:
 *
 * Preconditions:
 * 1. Create customer
 * 2. Create composite products
 * 3. Log in to frontend
 * 4. Add products to the customer's wish list (unconfigured)
 *
 * Steps:
 * 1. Open Wish list
 * 2. Click 'Configure' for the product
 * 3. Fill data
 * 4. Click 'Ok'
 * 5. Perform assertions
 *
 * @group Wishlist_(CS)
 * @ZephyrId MAGETWO-29507
 */
class ConfigureProductInCustomerWishlistOnFrontendTest extends AbstractWishlistTest
{
    /* tags */
    const MVP = 'no';
    const DOMAIN = 'CS';
    /* end tags */

    /**
     * Prepare data
     *
     * @param CustomerInjectable $customer
     * @return array
     */
    public function __prepare(CustomerInjectable $customer)
    {
        $customer->persist();

        return ['customer' => $customer];
    }

    /**
     * Configure customer wish list on frontend
     *
     * @param CustomerInjectable $customer
     * @param string $product
     * @return array
     */
    public function test(CustomerInjectable $customer, $product)
    {
        $this->markTestIncomplete('Bug: MAGETWO-32815');
        // Preconditions
        $product = $this->createProducts($product)[0];
        $this->loginCustomer($customer);
        $this->addToWishlist([$product]);

        // Steps
        $this->cmsIndex->getLinksBlock()->openLink('My Wish List');
        $this->wishlistIndex->getItemsBlock()->getItemProduct($product)->clickEdit();
        $this->catalogProductView->getViewBlock()->addToWishlist($product);

        return ['product' => $product];
    }
}
