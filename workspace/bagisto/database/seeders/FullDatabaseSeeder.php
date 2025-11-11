<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Webkul\Customer\Models\Customer;
use Webkul\Product\Models\Product;
use Webkul\Category\Models\Category;
use Webkul\Attribute\Models\AttributeFamily;
use Webkul\Inventory\Models\InventorySource;
use Webkul\Sales\Models\Order;
use Webkul\Sales\Models\OrderItem;
use Webkul\Customer\Models\CustomerAddress;

class FullDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Create Attribute Family
        $attributeFamily = AttributeFamily::firstOrCreate([
            'code' => 'default',
        ], [
            'name' => 'Default',
        ]);

        // Create Category
        $category = Category::create([
            'position' => 1,
            'status' => 1,
            'display_mode' => 'products_and_description',
            'parent_id' => null,
            'en' => [
                'name' => 'Root',
                'slug' => 'root',
                'description' => 'Root category',
                'locale_id' => 1,
            ],
        ]);

        // Create Sub Category
        $subCategory = Category::create([
            'position' => 1,
            'status' => 1,
            'display_mode' => 'products_and_description',
            'parent_id' => $category->id,
            'en' => [
                'name' => 'Electronics',
                'slug' => 'electronics',
                'description' => 'Electronic products',
                'locale_id' => 1,
            ],
        ]);

        // Create Inventory Source
        $inventorySource = InventorySource::firstOrCreate([
            'code' => 'default',
        ], [
            'name' => 'Default',
            'description' => 'Default inventory source',
            'contact_name' => 'Admin',
            'contact_email' => 'admin@example.com',
            'contact_number' => '1234567890',
            'contact_fax' => null,
            'country' => 'US',
            'state' => 'CA',
            'city' => 'Los Angeles',
            'street' => '123 Main St',
            'postcode' => '90001',
            'priority' => 0,
            'latitude' => null,
            'longitude' => null,
            'status' => 1,
        ]);

        // Create Customer
        $customer = Customer::firstOrCreate([
            'email' => 'customer@example.com',
        ], [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone' => '1234567890',
            'gender' => 'Male',
            'date_of_birth' => '1990-01-01',
            'status' => 1,
            'customer_group_id' => 1,
            'subscribed_to_news_letter' => 1,
        ]);

        // Create Customer Address
        CustomerAddress::create([
            'customer_id' => $customer->id,
            'company_name' => null,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => '123 Customer St',
            'country' => 'US',
            'state' => 'CA',
            'city' => 'Los Angeles',
            'postcode' => '90001',
            'phone' => '1234567890',
            'default_address' => 1,
            'address_type' => 'customer',
        ]);

        // Create Product
        $product = Product::firstOrCreate([
            'sku' => 'PROD001',
        ], [
            'attribute_family_id' => $attributeFamily->id,
            'type' => 'simple',
        ]);

        // For simplicity, skip detailed attribute values and let Bagisto handle defaults

        // Associate Product with Category
        DB::table('product_categories')->insert([
            'product_id' => $product->id,
            'category_id' => $subCategory->id,
        ]);

        // Create Product Inventory
        DB::table('product_inventories')->updateOrInsert([
            'product_id' => $product->id,
            'inventory_source_id' => $inventorySource->id,
        ], [
            'qty' => 100,
        ]);

        // Create Product Images
        DB::table('product_images')->insert([
            'product_id' => $product->id,
            'path' => 'product/1/sample-image.jpg',
            'position' => 1,
        ]);

        // Create Order
                // Create Order
        $order = Order::firstOrCreate([
            'increment_id' => 'ORD001',
        ], [
            'status' => 'pending',
            'channel_name' => 'Default',
            'is_guest' => 0,
            'customer_email' => $customer->email,
            'customer_first_name' => $customer->first_name,
            'customer_last_name' => $customer->last_name,
            'customer_id' => $customer->id,
            'shipping_method' => 'flatrate_flatrate',
            'shipping_title' => 'Flat Rate - Fixed',
            'shipping_description' => 'Flat Rate Shipping',
            'coupon_code' => null,
            'is_gift' => 0,
            'total_item_count' => 1,
            'total_qty_ordered' => 1,
            'base_currency_code' => 'USD',
            'channel_currency_code' => 'USD',
            'order_currency_code' => 'USD',
            'grand_total' => 90.00,
            'base_grand_total' => 90.00,
            'sub_total' => 90.00,
            'base_sub_total' => 90.00,
            'tax_amount' => 0.00,
            'base_tax_amount' => 0.00,
            'shipping_amount' => 10.00,
            'base_shipping_amount' => 10.00,
            'discount_amount' => 10.00,
            'base_discount_amount' => 10.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create Order Address
        DB::table('addresses')->insert([
            'order_id' => $order->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => '123 Customer St',
            'city' => 'Los Angeles',
            'state' => 'CA',
            'country' => 'US',
            'postcode' => '90001',
            'phone' => '1234567890',
            'address_type' => 'billing',
        ]);

        DB::table('addresses')->insert([
            'order_id' => $order->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => '123 Customer St',
            'city' => 'Los Angeles',
            'state' => 'CA',
            'country' => 'US',
            'postcode' => '90001',
            'phone' => '1234567890',
            'address_type' => 'shipping',
        ]);

        // Create Order Item
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'sku' => 'PROD001',
            'name' => 'Sample Product',
            'qty_ordered' => 1,
            'qty_shipped' => 1,
            'qty_invoiced' => 1,
            'qty_canceled' => 0,
            'qty_refunded' => 0,
            'price' => 90.00,
            'base_price' => 90.00,
            'total' => 90.00,
            'base_total' => 90.00,
            'tax_amount' => 0.00,
            'base_tax_amount' => 0.00,
            'discount_amount' => 10.00,
            'base_discount_amount' => 10.00,
            'product_type' => 'simple',
            'weight' => 1.5,
            'total_invoiced' => 90.00,
            'base_total_invoiced' => 90.00,
            'amount_refunded' => 0.00,
            'base_amount_refunded' => 0.00,
        ]);

        // Create Order Payment
        DB::table('order_payment')->insert([
            'order_id' => $order->id,
            'method' => 'cash_on_delivery',
            'method_title' => 'Cash On Delivery',
        ]);

        // Output
        $this->command->info('Full database seeded successfully!');
    }
}
