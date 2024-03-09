<?php

namespace Database\Seeders;

use App\Enums\OfferCanUseTypeEnum;
use App\Enums\OfferDiscountTypeEnum;
use App\Models\{HospitalityProvider, Branch};
use App\Models\Offer;
use Illuminate\Database\Seeder;

class HospitalityProvidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createHospitality();
    }

    public function createHospitality(): void
    {

        $hospitality_providers = [
            [
                'name' => 'مطعم كويا', 'type' => 'restaurant', 'avatar' => 'fake_data/restaurants/Coya.png',
                'branches' => [
                    [
                        'name' => 'مطعم كويا', 'latitude' => '24.704777249801428', 'longitude' => '46.705972026436996', 'address' => '8710 Prince Abdulaziz Ibn Musaid Ibn Jalawi St, As Sulimaniyah, 4237, Riyadh 12223, Saudi Arabia',
                        'offers' => [
                            [
                                'name' => 'خصم 20 % على وجبة الافطار',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::DISCOUNT,
                                'discount_percent' => 20,
                                'show_percent' => 20,
                                'can_use_type' => OfferCanUseTypeEnum::AFTER_ONE_DAY,
                                'can_use_from_date' => '2024-05-22',
                                'valid_to_type' => 'day',
                                'valid_to_date' => '2024-05-22',
                                'max_used' => '10',
                            ],
                            [
                                'name' => 'خصم 15 % على وجبة الغداء',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::DISCOUNT,
                                'discount_percent' => 15,
                                'show_percent' => 20,
                                'can_use_type' => OfferCanUseTypeEnum::AFTER_ONE_DAY,
                                'can_use_from_date' => '2024-05-22',
                                'valid_to_type' => 'day',
                                'valid_to_date' => '2024-05-22',
                                'max_used' => '10',
                            ],
                            [
                                'name' => 'خصم 30 % على وجبة العشاء',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::DISCOUNT,
                                'discount_percent' => 30,
                                'show_percent' => 20,
                                'can_use_type' => OfferCanUseTypeEnum::FROM_DATE,
                                'can_use_from_date' => '2024-03-05',
                                'valid_to_type' => 'week',
                                'valid_to_date' => '2024-03-07',
                                'max_used' => '15',
                            ],
                            [
                                'name' => 'خصم مجاناً على وجبة الغداء',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::FREE,
                                'discount_percent' => 0,
                                'show_percent' => 20,
                                'can_use_type' => OfferCanUseTypeEnum::AFTER_ONE_DAY,
                                'can_use_from_date' => '2024-05-22',
                                'valid_to_type' => 'day',
                                'valid_to_date' => '2024-05-22',
                                'max_used' => '10',
                            ],
                            [
                                'name' => 'شرفتنا ,حظ سعيد المرة القادمة',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::HONOR,
                                'discount_percent' => 0,
                                'show_percent' => 20,
                                'can_use_type' => OfferCanUseTypeEnum::FROM_DATE,
                                'can_use_from_date' => '2024-03-05',
                                'valid_to_type' => 'week',
                                'valid_to_date' => '2024-03-07',
                                'max_used' => '15',
                            ],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'مطعم هابرا', 'type' => 'restaurant', 'avatar' => 'fake_data/restaurants/Habra.png',
                'branches' => [
                    [
                        'name' => 'مطعم هابرا', 'latitude' => '24.7507111001417', 'longitude' => '46.62404489575173', 'address' => 'الطريق الدائري الشمالي، يقع في مركز ميفك، الرياض 12385، المملكة العربية السعودية',
                        'offers' => [
                            [
                                'name' => 'خصم 10 % على وجبة الافطار',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::DISCOUNT,
                                'discount_percent' => 10,
                                'show_percent' => 30,
                                'can_use_type' => OfferCanUseTypeEnum::AFTER_ONE_DAY,
                                'can_use_from_date' => '2024-05-22',
                                'valid_to_type' => 'day',
                                'valid_to_date' => '2024-05-22',
                                'max_used' => '10',
                            ],
                            [
                                'name' => 'خصم 7 % على وجبة الغداء',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::DISCOUNT,
                                'discount_percent' => 7,
                                'show_percent' => 12,
                                'can_use_type' => OfferCanUseTypeEnum::AFTER_ONE_DAY,
                                'can_use_from_date' => '2024-05-22',
                                'valid_to_type' => 'day',
                                'valid_to_date' => '2024-05-22',
                                'max_used' => '10',
                            ],
                            [
                                'name' => 'خصم 22 % على وجبة العشاء',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::DISCOUNT,
                                'discount_percent' => 22,
                                'show_percent' => 22,
                                'can_use_type' => OfferCanUseTypeEnum::FROM_DATE,
                                'can_use_from_date' => '2024-03-05',
                                'valid_to_type' => 'week',
                                'valid_to_date' => '2024-03-07',
                                'max_used' => '15',
                            ],
                            [
                                'name' => 'خصم مجاناً على وجبة الغداء',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::FREE,
                                'discount_percent' => 0,
                                'show_percent' => 20,
                                'can_use_type' => OfferCanUseTypeEnum::AFTER_ONE_DAY,
                                'can_use_from_date' => '2024-05-22',
                                'valid_to_type' => 'day',
                                'valid_to_date' => '2024-05-22',
                                'max_used' => '10',
                            ],
                            [
                                'name' => 'شرفتنا ,حظ سعيد المرة القادمة',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::HONOR,
                                'discount_percent' => 0,
                                'show_percent' => 20,
                                'can_use_type' => OfferCanUseTypeEnum::FROM_DATE,
                                'can_use_from_date' => '2024-03-05',
                                'valid_to_type' => 'week',
                                'valid_to_date' => '2024-03-07',
                                'max_used' => '15',
                            ],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'مطعم ماربل', 'type' => 'restaurant', 'avatar' => 'fake_data/restaurants/Marble.png',
                'branches' => [
                    [
                        'name' => 'مطعم ماربل', 'latitude' => '24.67604969504648', 'longitude' => '46.668051013801964', 'address' => 'أم الحمام الشرقي، الرياض المملكة العربية السعودية',
                        'offers' => [
                            [
                                'name' => 'خصم 10 % على وجبة الافطار',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::DISCOUNT,
                                'discount_percent' => 10,
                                'show_percent' => 30,
                                'can_use_type' => OfferCanUseTypeEnum::AFTER_ONE_DAY,
                                'can_use_from_date' => '2024-05-22',
                                'valid_to_type' => 'day',
                                'valid_to_date' => '2024-05-22',
                                'max_used' => '10',
                            ],
                            [
                                'name' => 'خصم 7 % على وجبة الغداء',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::DISCOUNT,
                                'discount_percent' => 7,
                                'show_percent' => 12,
                                'can_use_type' => OfferCanUseTypeEnum::AFTER_ONE_DAY,
                                'can_use_from_date' => '2024-05-22',
                                'valid_to_type' => 'day',
                                'valid_to_date' => '2024-05-22',
                                'max_used' => '10',
                            ],
                            [
                                'name' => 'خصم 22 % على وجبة العشاء',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::DISCOUNT,
                                'discount_percent' => 22,
                                'show_percent' => 22,
                                'can_use_type' => OfferCanUseTypeEnum::FROM_DATE,
                                'can_use_from_date' => '2024-03-05',
                                'valid_to_type' => 'week',
                                'valid_to_date' => '2024-03-07',
                                'max_used' => '15',
                            ],
                            [
                                'name' => 'خصم مجاناً على وجبة الغداء',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::FREE,
                                'discount_percent' => 0,
                                'show_percent' => 20,
                                'can_use_type' => OfferCanUseTypeEnum::AFTER_ONE_DAY,
                                'can_use_from_date' => '2024-05-22',
                                'valid_to_type' => 'day',
                                'valid_to_date' => '2024-05-22',
                                'max_used' => '10',
                            ],
                            [
                                'name' => 'شرفتنا ,حظ سعيد المرة القادمة',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::HONOR,
                                'discount_percent' => 0,
                                'show_percent' => 20,
                                'can_use_type' => OfferCanUseTypeEnum::FROM_DATE,
                                'can_use_from_date' => '2024-03-05',
                                'valid_to_type' => 'week',
                                'valid_to_date' => '2024-03-22',
                                'max_used' => '15',
                            ],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'مطعم لبم', 'type' => 'restaurant', 'avatar' => 'fake_data/restaurants/LPM.png',
                'branches' => [
                    [
                        'name' => 'مطعم لبم', 'latitude' => '24.6909392891133', 'longitude' => '46.684117766913815', 'address' => 'شارع المعتصم، العليا، الرياض 12212، المملكة العربية السعودية',
                        'offers' => [
                            [
                                'name' => 'خصم 10 % على وجبة الافطار',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::DISCOUNT,
                                'discount_percent' => 10,
                                'show_percent' => 30,
                                'can_use_type' => OfferCanUseTypeEnum::AFTER_ONE_DAY,
                                'can_use_from_date' => '2024-05-22',
                                'valid_to_type' => 'day',
                                'valid_to_date' => '2024-05-22',
                                'max_used' => '10',
                            ],
                            [
                                'name' => 'خصم 7 % على وجبة الغداء',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::DISCOUNT,
                                'discount_percent' => 7,
                                'show_percent' => 12,
                                'can_use_type' => OfferCanUseTypeEnum::AFTER_ONE_DAY,
                                'can_use_from_date' => '2024-05-22',
                                'valid_to_type' => 'day',
                                'valid_to_date' => '2024-05-22',
                                'max_used' => '10',
                            ],
                            [
                                'name' => 'خصم 22 % على وجبة العشاء',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::DISCOUNT,
                                'discount_percent' => 22,
                                'show_percent' => 22,
                                'can_use_type' => OfferCanUseTypeEnum::FROM_DATE,
                                'can_use_from_date' => '2024-03-05',
                                'valid_to_type' => 'week',
                                'valid_to_date' => '2024-03-07',
                                'max_used' => '15',
                            ],
                            [
                                'name' => 'خصم مجاناً على وجبة الغداء',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::FREE,
                                'discount_percent' => 0,
                                'show_percent' => 20,
                                'can_use_type' => OfferCanUseTypeEnum::AFTER_ONE_DAY,
                                'can_use_from_date' => '2024-05-22',
                                'valid_to_type' => 'day',
                                'valid_to_date' => '2024-05-22',
                                'max_used' => '10',
                            ],
                            [
                                'name' => 'شرفتنا ,حظ سعيد المرة القادمة',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::HONOR,
                                'discount_percent' => 0,
                                'show_percent' => 20,
                                'can_use_type' => OfferCanUseTypeEnum::FROM_DATE,
                                'can_use_from_date' => '2024-03-05',
                                'valid_to_type' => 'week',
                                'valid_to_date' => '2024-03-07',
                                'max_used' => '15',
                            ],
                        ]
                    ]
                ]
            ],
            [
                'name' => 'مطعم مزايا', 'type' => 'restaurant', 'avatar' => 'fake_data/restaurants/Myazu.png',
                'branches' => [
                    [
                        'name' => 'مطعم مزايا', 'latitude' => '24.700193322586554', 'longitude' => '46.70487686691415', 'address' => 'مسعد بن جلوي، السليمانية، الرياض 12244، المملكة العربية السعودية',
                        'offers' => [
                            [
                                'name' => 'خصم 10 % على وجبة الافطار',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::DISCOUNT,
                                'discount_percent' => 10,
                                'show_percent' => 30,
                                'can_use_type' => OfferCanUseTypeEnum::AFTER_ONE_DAY,
                                'can_use_from_date' => '2024-05-22',
                                'valid_to_type' => 'day',
                                'valid_to_date' => '2024-05-22',
                                'max_used' => '10',
                            ],
                            [
                                'name' => 'خصم 7 % على وجبة الغداء',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::DISCOUNT,
                                'discount_percent' => 7,
                                'show_percent' => 12,
                                'can_use_type' => OfferCanUseTypeEnum::AFTER_ONE_DAY,
                                'can_use_from_date' => '2024-05-22',
                                'valid_to_type' => 'day',
                                'valid_to_date' => '2024-05-22',
                                'max_used' => '10',
                            ],
                            [
                                'name' => 'خصم 22 % على وجبة العشاء',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::DISCOUNT,
                                'discount_percent' => 22,
                                'show_percent' => 22,
                                'can_use_type' => OfferCanUseTypeEnum::FROM_DATE,
                                'can_use_from_date' => '2024-03-05',
                                'valid_to_type' => 'week',
                                'valid_to_date' => '2024-03-07',
                                'max_used' => '15',
                            ],
                            [
                                'name' => 'خصم مجاناً على وجبة الغداء',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::FREE,
                                'discount_percent' => 0,
                                'show_percent' => 20,
                                'can_use_type' => OfferCanUseTypeEnum::AFTER_ONE_DAY,
                                'can_use_from_date' => '2024-05-22',
                                'valid_to_type' => 'day',
                                'valid_to_date' => '2024-05-22',
                                'max_used' => '10',
                            ],
                            [
                                'name' => 'شرفتنا ,حظ سعيد المرة القادمة',
                                'icon' => 'fake_data/offers/1.png',
                                'discount_type' => OfferDiscountTypeEnum::HONOR,
                                'discount_percent' => 0,
                                'show_percent' => 20,
                                'can_use_type' => OfferCanUseTypeEnum::FROM_DATE,
                                'can_use_from_date' => '2024-03-05',
                                'valid_to_type' => 'week',
                                'valid_to_date' => '2024-03-07',
                                'max_used' => '15',
                            ],
                        ]
                    ]
                ]
            ],
        ];


        foreach ($hospitality_providers as $key=>$value) {
            $value['phone']='055111111'.$key;
            $value['email']="uo$key@uo.com";
            $value['password']="123456789";
            $branches=$value['branches'];
            unset($value['branches']);
            $provider = HospitalityProvider::updateOrCreate(['email'=>$value['email']],$value);
            foreach ($branches as $el_branch) {
                $el_branch['hospitality_provider_id'] = $provider->id;
                $offers=$el_branch['offers'];
                unset($el_branch['offers']);
                $branch = Branch::updateOrCreate(['hospitality_provider_id'=>$provider->id,'name'=>$el_branch['name']],$el_branch);
                foreach ($offers as $el_offer) {
                    $el_offer['branch_id'] = $branch->id;
                    Offer::updateOrCreate(['branch_id'=>$branch->id,'name'=>$el_offer['name']],$el_offer);
                }
            }
        }

    }
}
