<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if (CModule::IncludeModule("sale") && CModule::IncludeModule("catalog")) { 
   
   if (isset($_POST['id']) && isset($_POST['QUANTITY'])) { 
      $PRODUCT_ID = intval($_POST['id']);
      $QUANTITY = intval($_POST['QUANTITY']);
      Add2BasketByProductID( $PRODUCT_ID, $QUANTITY ); 
   }
   else { echo "��� ����������";  } 
 } 
else { echo "�� ���������� ������"; }

$APPLICATION->IncludeComponent(
    "bazarow:basket.small.bazarow",
    "small-basket",
    Array(
        "COMPONENT_TEMPLATE" => "ajax",
        "PATH_TO_BASKET" => "/personal/cart",
        "PATH_TO_ORDER" => "/personal/orders",
        "SHOW_DELAY" => "N",
        "SHOW_NOTAVAIL" => "Y",
        "SHOW_SUBSCRIBE" => "Y"
    )
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>