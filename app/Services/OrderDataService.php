<?php

namespace App\Services;

use Illuminate\Http\Request;

class OrderDataService 
{
   public static function prepareOrderData(Request $request): array
   {
      return [
         'customer_name' => $request->customer_name,
         'customer_phone' => $request->customer_phone,
         'status' => $request->status ?? 'pending',
         'order_information' => self::prepareOrderInformation($request),
         'groom_bride_data' => self::prepareGroomBrideData($request),
         'agenda_data' => self::prepareAgendaData($request),
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
         ],
         'printed_invitation' => [
               'type' => $request->printed_type,
               'quantity' => $request->printed_quantity ?? 0,
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
         'time' => $request->{$prefix.'_time'},
         'place' => $request->{$prefix.'_place'},
         'maps' => $request->{$prefix.'_maps'},
      ];
   }
}