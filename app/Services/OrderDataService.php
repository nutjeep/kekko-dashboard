<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class OrderDataService 
{
   public static function prepareOrderData(Request $request): array
   {
      self::validateRequest($request);
      
      return [
         'customer_name' => $request->customer_name,
         'user_id' => $request->user_id,
         'customer_phone' => $request->customer_phone,
         'status' => $request->status ?? '',
         'order_information' => self::prepareOrderInformation($request),
         'groom_bride_data' => self::prepareGroomBrideData($request),
         'agenda_data' => self::prepareAgendaData($request),
         'addons' => self::prepareAddons($request),
      ];
   }

   protected static function prepareOrderInformation(Request $request): array
   {
      return [
         'first_come' => $request->first_come,
         'invitation_type' => $request->invitation_type,
         'digital_invitation' => [
               'theme' => $request->digital_theme,
               'package' => $request->digital_package,
               'price' => $request->digital_price ?? 0,
         ],
         'printed_invitation' => [
               'type' => $request->printed_type,
               'quantity' => $request->printed_quantity ?? 0,
               'price' => $request->digital_price ?? 0,
         ]
      ];
   }

   protected static function prepareAddons(Request $request): array
   {
      return [
         'addon_1' => [
            'name' => $request->addon_1_name,
            'price' => $request->addon_1_price, 
         ]
      ];
   }

   protected static function prepareGroomBrideData(Request $request): array
   {
      return [
         'groom' => self::preparePersonData($request, 'groom'),
         'bride' => self::preparePersonData($request, 'bride'),
         'others' => [
               'link_gdrive' => $request->link_gdrive,
               'backsound_music' => $request->backsound_music,
               'notes' => $request->notes,
         ]
      ];
   }

   protected static function preparePersonData(Request $request, string $prefix): array
   {
      return [
         'name' => $request->{$prefix.'_name'},
         'nickname' => $request->{$prefix.'_nickname'},
         'father_name' => $request->{$prefix.'_father_name'},
         'mother_name' => $request->{$prefix.'_mother_name'},
         'number_child' => $request->{$prefix.'_number_child'},
         'address' => $request->{$prefix.'_address'},
         'phone' => $request->{$prefix.'_phone'},
         'instagram' => $request->{$prefix.'_instagram'},
      ];
   }

   protected static function prepareAgendaData(Request $request): array
   {
      return [
         'akad' => self::prepareEventData($request, 'akad'),
         'resepsi' => self::prepareEventData($request, 'resepsi'),
         'ngunduh_mantu' => self::prepareEventData($request, 'ngunduh_mantu')
      ];
   }

   protected static function prepareEventData(Request $request, string $prefix): array
   {
      return [
         'date' => $request->{$prefix.'_date'},
         'time_start' => $request->{$prefix.'_time_start'},
         'time_end' => $request->{$prefix.'_time_end'} ?? 'Selesai',
         'place' => $request->{$prefix.'_place'},
         'maps' => $request->{$prefix.'_maps'},
      ];
   }

   protected static function validateRequest(Request $request): void
   {
      $validator = Validator::make($request->all(), [
         'customer_name' => 'required|string|max:200',
         'customer_phone' => 'required|string|max:16',
      ]);

      if ($validator->fails()) {
         throw new ValidationException($validator);
      }
   }
}