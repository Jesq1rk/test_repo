<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
#тестовые данные. Выводим только для сущности с URL-адресом http://agurya5e.beget.tech/about/;
$arParams['ID']=null;
$arParams['ENT_TYPE']=2;
$arParams['URL_TO_REVIEW'] = explode('?', $_SERVER['REQUEST_URI'])[0];
use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
use Bitrix\Highloadblock as HL;
Loader::IncludeModule('highloadblock');
#addnewhlblock;
if($arParams['HL_ID']==null){
    $arLangs = Array('ru' => 'Отзывы','en' => 'Reviews');
    $result = HL\HighloadBlockTable::add(array(
    'NAME' => 'Reviews',
    'TABLE_NAME' => 'Reviews_AG_Component',
    ));
      if ($result->isSuccess()) {
        $id = $result->getId();
        foreach($arLangs as $lang_key => $lang_val){
            HL\HighloadBlockLangTable::add(array(
                'ID' => $id,
                'LID' => $lang_key,
                'NAME' => $lang_val
            ));
        }
    } else {
        $errors = $result->getErrorMessages();
        var_dump($errors);
        die();
    }
    $UFObject = 'HLBLOCK_'.$id;
    $arCartFields = Array(
    'UF_TYPE'=>Array(
        'ENTITY_ID' => $UFObject,
        'FIELD_NAME' => 'UF_TYPE',
        'USER_TYPE_ID' => 'int',
        'MANDATORY' => 'N',
    ),
    'UF_RATING'=>Array(
        'ENTITY_ID' => $UFObject,
        'FIELD_NAME' => 'UF_RATING',
        'USER_TYPE_ID' => 'int',
        'MANDATORY' => 'N',
    ),
    'UF_REVIEW'=>Array(
        'ENTITY_ID' => $UFObject,
        'FIELD_NAME' => 'UF_REVIEW',
        'USER_TYPE_ID' => 'string',
        'MANDATORY' => 'N',
    ),
    'UF_DATETIME'=>Array(
        'ENTITY_ID' => $UFObject,
        'FIELD_NAME' => 'UF_DATETIME',
        'USER_TYPE_ID' => 'string',
        'MANDATORY' => 'N',
    ),
    'UF_ENTITY_ID'=>Array(
        'ENTITY_ID' => $UFObject,
        'FIELD_NAME' => 'UF_ENTITY_ID',
        'USER_TYPE_ID' => 'string',
        'MANDATORY' => 'N',
    ),
    'UF_URL_ID'=>Array(
        'ENTITY_ID' => $UFObject,
        'FIELD_NAME' => 'UF_URL_ID',
        'USER_TYPE_ID' => 'string',
        'MANDATORY' => 'N',
    ),
);

    $arSavedFieldsRes = Array();
    foreach($arCartFields as $arCartField){
        $obUserField  = new CUserTypeEntity;
        $ID = $obUserField->Add($arCartField);
        $arSavedFieldsRes[] = $ID;
    }
}
switch($arParams['ENT_TYPE']){
    case 0:
      $arFilter = Array(Array("LOGIC"=>"AND", Array("UF_TYPE"=>0), Array("UF_ENTITY_ID"=>$arParams['ID'])));
      break;
    case 1:
      $arFilter = Array(Array("LOGIC"=>"AND", Array("UF_TYPE"=>1), Array("UF_ENTITY_ID"=>$arParams['ID'])));
      break;
    default:
      $arFilter =array('UF_URL_ID'=>explode('?', $_SERVER['REQUEST_URI'])[0]);
      break;
};
$hlblock = HLBT::getById(4)->fetch();
$entity = HLBT::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$rsData = $entity_data_class::getList(array(
   'select' => array('*'),
   'filter'=>array('UF_URL_ID'=>explode('?', $_SERVER['REQUEST_URI'])[0])
));
while($el = $rsData->fetch()){
  $arResult['REVIEWS'][]=$el;
}

$this->IncludeComponentTemplate();
