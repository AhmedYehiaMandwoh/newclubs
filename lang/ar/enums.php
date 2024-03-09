<?php

return [
    'ModuleNameEnum'=>[
        \App\Enums\ModuleNameEnum::USERS->value=>'الهيكل الإداري',
        \App\Enums\ModuleNameEnum::ROLES->value=>'الأدوار',
        \App\Enums\ModuleNameEnum::hospitality_providers->value=>'مقدمى الضيافة',
        \App\Enums\ModuleNameEnum::BRANCHES->value=>'الفروع',
        \App\Enums\ModuleNameEnum::WITHDRAWS->value=>'سحب',
        \App\Enums\ModuleNameEnum::CLIENTS->value=>'العملاء',
        \App\Enums\ModuleNameEnum::SPONSORS->value=>'الراعاة',
        \App\Enums\ModuleNameEnum::OFFERS->value=>'العروض',
        \App\Enums\ModuleNameEnum::SETTINGS->value=>'الأعدادات',
    ],
    'IsActiveEnum'=>[
        \App\Enums\IsActiveEnum::ACTIVE->value=>'نشط',
        \App\Enums\IsActiveEnum::NOT_ACTIVE->value=>'غير نشط',
    ],

    'OfferDiscountTypeEnum'=>[
        \App\Enums\OfferDiscountTypeEnum::DISCOUNT->value=>'خصم',
        \App\Enums\OfferDiscountTypeEnum::FREE->value=>'مجاناً',
        \App\Enums\OfferDiscountTypeEnum::HONOR->value=>'شرفتنا',
    ],
    'OfferValidToTypeEnum'=>[
        \App\Enums\OfferValidToTypeEnum::WEEK->value=>'أسبوع',
        \App\Enums\OfferValidToTypeEnum::DAY->value=>'يوم',
        \App\Enums\OfferValidToTypeEnum::MONTH->value=>'شهر',
        \App\Enums\OfferValidToTypeEnum::TWO_MONTHS->value=>'شهريين',
        \App\Enums\OfferValidToTypeEnum::THREE_MONTHS->value=>'3 شهور',
        \App\Enums\OfferValidToTypeEnum::SIX_MONTHS->value=>'6 شهور',
    ],
    'OfferCanUseTypeEnum'=>[
        \App\Enums\OfferCanUseTypeEnum::DIRECT->value=>'مباشرة',
        \App\Enums\OfferCanUseTypeEnum::TOMORROW_MORNING->value=>'مع صباح الغد',
        \App\Enums\OfferCanUseTypeEnum::AFTER_ONE_DAY->value=>'بعد 24 ساعة',
        \App\Enums\OfferCanUseTypeEnum::FROM_DATE->value=>'من تاريخ',
    ],
    'HospitalityProviderTypesEnum'=>[
        \App\Enums\HospitalityProviderTypesEnum::RESTAURANT->value=>'مطعم',
        \App\Enums\HospitalityProviderTypesEnum::HOTEL->value=>'فندق',
        \App\Enums\HospitalityProviderTypesEnum::EXHIBITION->value=>'معرض',
        \App\Enums\HospitalityProviderTypesEnum::CAFE->value=>'مقهى',
    ],
    'SettingsKeysEnum'=>[
        \App\Enums\SettingsKeysEnum::WHEEL_ROTATION_TIME->value=>'الفرق بين مدة دوران العجلة (بالساعة)',
        \App\Enums\SettingsKeysEnum::TERMS_AND_CONDITIONS->value=>'الشروط والأحكام',
    ],
    'ClientOfferStatusEnum'=>[
        \App\Enums\ClientOfferStatusEnum::USED->value=>'مستخدمة',
        \App\Enums\ClientOfferStatusEnum::SAVED->value=>'محفوظة',
        \App\Enums\ClientOfferStatusEnum::ENDED->value=>'منتهية',
        \App\Enums\ClientOfferStatusEnum::NEW->value=>'جديد',
    ]
];
