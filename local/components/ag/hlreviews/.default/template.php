<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

?>
<div class="reviews">
  <?foreach($arResult['REVIEWS'] as $review):?>
  <div class="row blockquote review-item">
    <div class="col-md-12">
      <div class="ratebox text-center" data-id="0" data-rating="<?=$reviews['UF_RATING']?>"></div>
      <p class="review-text"><?=$review['UF_REVIEW']?></p>
      <small class="review-date"><?=$review['UF_DATETIME']->toString();?></small>
    </div>
  </div>
  <?endforeach;?>

  <form id  = 'submit_review'>
    <div class="form-group">
    <label for="UF_RATING">Выберите оценкуt</label>
    <select class="form-control" id="UF_RATING" name  = 'UF_RATING'>
      <option value = '1'>1</option>
      <option value = '2'>2</option>
      <option value = '3'>3</option>
      <option value = '4'>4</option>
      <option value = '5'>5</option>
    </select>
  </div>
  <div class="form-group">
    <label for="UF_REVIEW">Введите текст отзыва</label>
    <textarea class="form-control" id="UF_REVIEW" rows="3" name = 'UF_REVIEW'></textarea>
  </div>
  <input style = 'display:none;' name = 'UF_ENTITY_ID' type = 'text' class = 'hidden' value='<?=($arParams['ID']?$arParams['ID']:0) ?>'>
  <input style = 'display:none;'  name = 'UF_ENTITY_TYPE' type = 'text' class = 'hidden' value='<?=$arParams['ENT_TYPE']?>'>
  <input style = 'display:none;'  name = 'UF_URL_ID' type = 'text' class = 'hidden' value='<?=$arParams['URL_TO_REVIEW']?>'>
  <button type="submit" class="btn btn-primary">Отправить</button>

</form>
</div>
