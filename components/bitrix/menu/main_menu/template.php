<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
   <?if (!empty($arResult)):?>
      <ul id="nav" class="main_multimenu top-menu"> 
      <?foreach($arResult as $arItem):?>
          <?if($arItem["SELECTED"]):?>
               <li class="nav-list selected"><a class="root-item selected" href="<?=$arItem["LINK"]?>">
               <?=$arItem["TEXT"]?></a></li>
          <?else:?>
               <li class="nav-list"><a class="root-item" href="<?=$arItem["LINK"]?>">
               <?=$arItem["TEXT"]?></a></li>
          <?endif?>
      <?endforeach?>
      </ul>
   <?endif?>