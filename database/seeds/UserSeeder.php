<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Huy Bùi',
            'email' => 'nhathuycn13@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('chutban1912'),
        ]);
        \App\Model\Type::create([
            'name' => 'phone',
        ]);
        \App\Model\Suplier::create([
            'name' => 'Apple',
            'company_name' => 'GTVT',
            'tax_id' => '1234567890',
            'address' => 'Q9',
        ]);
        \App\Model\Manufacturer::create([
            'name' => 'samsung',
        ]);
        \App\Model\Customer::create([
            'name' => 'Nguyen Van A',
            'phone' => '123456',
            'mobile' => '123456',
            'address' => 'Q9',
            'tax_id' => '1234567890',
        ]);
        \App\Model\Customer::create([
            'name' => 'Nguyen Van B',
            'phone' => '123456',
            'mobile' => '123456',
            'address' => 'Q9',
            'tax_id' => '134234567890',

        ]);
        \App\Model\Status::create([
            'name' => 'yêu cầu nhập',
            'label' => 'label label-primary',
        ]);
        \App\Model\Status::create([
            'name' => 'đang đợi',
            'label' => 'label bg-green',
        ]);
        \App\Model\Status::create([
            'name' => 'đã nhập',
            'label' => 'label label-success',
        ]);
        \App\Model\Status::create([
            'name' => 'đã hủy',
            'label' => 'label label-danger',
        ]);
        \App\Model\Product::create([
            'name' => 'Product A',
            'code' => 'A',
            'type_id' => 1,
            'manufacturer_id' => 1,
        ]);
        \App\Model\Product::create([
            'name' => 'Product B',
            'code' => 'B',
            'type_id' => 1,
            'manufacturer_id' => 1,
        ]);
        \App\Model\PaymentType::create([
            'name' => 'trả liền cho tôi',

        ]);
        \App\Model\PaymentType::create([
            'name' => 'cho thiếu',

        ]);
        \App\Model\PaymentType::create([
            'name' => 'cuối tháng sau',

        ]);
        \App\Model\PaymentType::create([
            'name' => 'khỏi trả',

        ]);

        // Order type
        \App\Model\OrderType::create([
            'name' => 'đã hủy',
        ]);
        \App\Model\OrderType::create([
            'name' => 'Báo gía',
        ]);
        \App\Model\OrderType::create([
            'name' => 'đơn hàng',
        ]);
        \App\Model\OrderType::create([
            'name' => 'thành công',
        ]);
        \App\Model\Tax::create([
            'name' => 'không có',
            'value' => 0,
        ]);
        \App\Model\Tax::create([
            'name' => 'thuế VAT',
            'value' => 10,
        ]);
        

    }
}
