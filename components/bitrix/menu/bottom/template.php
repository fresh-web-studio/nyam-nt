<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
   <?if (!empty($arResult)):?>
      <ul class="footer__menu"> 
      <?foreach($arResult as $arItem):?>
          <?if($arItem["SELECTED"]):?>
               <li><a class="footer__menu-link selected" href="<?=$arItem["LINK"]?>">
               <?=$arItem["TEXT"]?></a></li>
          <?else:?>
               <li><a class="footer__menu-link" href="<?=$arItem["LINK"]?>">
               <?=$arItem["TEXT"]?></a></li>
          <?endif?>
      <?endforeach?>
      </ul>
   <?endif?>