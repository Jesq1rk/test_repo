<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
use Bitrix\Highloadblock as HL;
Loader::IncludeModule('highloadblock');
$data = $_POST;
$time = new \Bitrix\Main\Type\DateTime();
$hlblock_id = 4;
$hlblock   = HLBT::getById( $hlblock_id )->fetch();
$entity   = HLBT::compileEntity( $hlblock );
$entity_data_class = $entity->getDataClass();
$arMass = Array(
                'UF_TYPE' => $data['UF_TYPE'],
                'UF_URL_ID' => $data['UF_URL_ID'],
				        'UF_RATING' => $data['UF_RATING'],
				        'UF_REVIEW' => $data['UF_REVIEW'],
				        'UF_ENTITY_ID' => $data['UF_ENTITY_ID'],
				        'UF_DATETIME' => $time,
            );
$otvet = $entity_data_class::add($arMass);
?>
