<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!doctype html>
<html>
<head>
	<?
    $APPLICATION->ShowHead();
    use Bitrix\Main\Page\Asset;
    // CSS
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/owlcarousel/assets/owl.carousel.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/owlcarousel/assets/owl.theme.default.css');
    // JS
    CJSCore::Init(array("jquery"));
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery-3.4.1min.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/main_slider.min.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/owlcarousel/owl.carousel.min.js');
    //STRING
    //Asset::getInstance()->addString("<link rel='shortcut icon' href='/local/templates/nyam-nt/images/favicon.ico' />");
    Asset::getInstance()->addString("<meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>");
    Asset::getInstance()->addString("<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>");
    Asset::getInstance()->addString("<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,400italic,500italic,700,700italic,100&subset=latin,cyrillic' rel='stylesheet' type='text/css'>");
    ?>
	<title><?$APPLICATION->ShowTitle()?></title>
	<script type='application/ld+json'>
        {"@context":"http://schema.org","@type":"WebSite","@id":"#website","url":"http://SITE.ru/","name":"Название - Описание","potentialAction":{"@type":"SearchAction","target":"http://SITE.ru/search/index.php","query-input":"required name=search_term_string"}}
    </script>
    <script type='application/ld+json'>
        {"@context":"http://schema.org","@type":"Organization","url":"http://SITE.ru/","sameAs":[],"@id":"#organization","name":"Домен - Описание","logo":"http://SITE.ru/полный_путь_к_логотипу.png"}
    </script>
    <link rel="icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH;?>/images/favicon.ico" />
    <title><?$APPLICATION->ShowTitle()?></title>
</head>
<body>
<?$APPLICATION->ShowPanel();?>
<header class="header__fix">
    <div class="container">
        <div class="header__top">
            <a class="header__link-logo" href="/"><img class="header__logo" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/header__logo.svg" alt="Логотип пиццерии Ням-ням"/></a>
            <div class="header__town-time">
                <div class="header__row-top">
                    <div class="header__text town-icon">Доставка пиццы:</div>
                    <div class="header__text_red">Нижний Тагил</div>
                </div>
                <div class="header__row-top">
                    <div class="header__text time-icon">Часы работы:</div>
                    <div class="header__text_red">
                        <?$APPLICATION->IncludeFile(
                                SITE_TEMPLATE_PATH."/include_areas/time_inc.php",
                        Array(),
                        Array("MODE"=>"text")
                        );?>
                    </div>
                </div>
            </div>
            <div class="header__address-phone">
                <div class="header__row-top">
                    <div class="header__text address">
                        <?$APPLICATION->IncludeFile(
                            SITE_TEMPLATE_PATH."/include_areas/address-karla_inc.php",
                            Array(),
                            Array("MODE"=>"text")
                        );?>
                    </div>
                    <div class="header__text_red">
                        <?$APPLICATION->IncludeFile(
                            SITE_TEMPLATE_PATH."/include_areas/phone-karla_inc.php",
                            Array(),
                            Array("MODE"=>"php")
                        );?>
                    </div>
                </div>
                <div class="header__row-top">
                    <div class="header__text address">
                        <?$APPLICATION->IncludeFile(
                            SITE_TEMPLATE_PATH."/include_areas/address-cosmo_inc.php",
                            Array(),
                            Array("MODE"=>"text")
                        );?>
                    </div>
                    <div class="header__text_red">
                        <?$APPLICATION->IncludeFile(
                            SITE_TEMPLATE_PATH."/include_areas/phone-cosmo_inc.php",
                            Array(),
                            Array("MODE"=>"php")
                        );?>
                    </div>
                </div>
            </div>
            <div class="header__login">
                <div class="header__text"><a href="auth" class="header__link login"><span class="login-greg-none">Вход</span></a></div>
                <div class="header__text"><a href="login.html" class="header__link reg"><span class="login-greg-none">Регистрация</span></a></div>
            </div>
        </div>
    </div>
    <div class="header__back-red">
        <div class="main_menu">
            <nav class="container header__row">
                <input id="menu-toggle" type="checkbox"/>
                <label class="menu-btn" for="menu-toggle">
                    <span></span>
                </label>
                <?$APPLICATION->IncludeComponent("bitrix:menu", "main_menu", Array(
                    "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
                        "MAX_LEVEL" => "1",	// Уровень вложенности меню
                        "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                        "COMPONENT_TEMPLATE" => "main_menu",
                        "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                        "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                        "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                        "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                        "CHILD_MENU_TYPE" => "",	// Тип меню для остальных уровней
                        "DELAY" => "N",	// Откладывать выполнение шаблона меню
                        "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                    ),
                    false
                );?>
                <div class="main_menu__cart">
                    <a href="cart.html">
                        <div class="main_menu__back">
                            <div class="main_menu__quantity">3</div>
                        </div>
                        <span class="main_menu__price">
                        1280.00 Руб.
                        </span>
                    </a>
                </div>
            </nav>
        </div>
        <?if($APPLICATION->GetCurPage() == "/"):?>
        <div class="slide-wrapper">
            <div class="owl-carousel owl-theme" id="owl-carousel1">
                <div class="slide-item slide1">
                    <div class="container slide-item__row">
                        <div class="slide-item__text">
                            <div class="slide-item__header">
                                Приготовлено
                                <span class="slide-item__span">с&nbsp;любовью</span>
                                по&nbsp;домашним
                                рецептам!
                            </div>
                            <div class="slide-item__info">
                                Доставляем в течение часа!<br>
                                Заказ от 2 порций одного наименования
                            </div>
                        </div>
                        <div class="slide-item__img">
                            <div class="slide-item__social">
                                <a href="#" class="hover">
                                    <img class="first" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/vk.svg" alt="Иконка ВК"/>
                                    <img class="second" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/vk-active.svg" alt="Иконка ВК"/>
                                </a>
                                <a href="#" class="hover">
                                    <img class="first" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/ok.svg" alt="Иконка ОК"/>
                                    <img class="second" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/ok-active.svg" alt="Иконка ОК"/>
                                </a>
                                <a href="#" class="hover">
                                    <img class="first" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/inst.svg" alt="Иконка Инстаграм"/>
                                    <img class="second" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/inst-active.svg" alt="Иконка Инстаграм"/>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide-item slide2">
                    <div class="container row">
                        <div class="slide-item__text">
                            <div class="slide-item__header">
                                Скидка 7%
                                <span class="slide-item__span">в день рожденья!</span>
                                <span class="slide-item__span-add">*При предъявлении документа</span>
                            </div>
                        </div>
                        <div class="slide-item__img">
                            <div class="slide-item__social">
                                <a href="#" class="hover">
                                    <img class="first" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/vk.svg"/>
                                    <img class="second" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/vk-active.svg"/>
                                </a>
                                <a href="#" class="hover">
                                    <img class="first" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/ok.svg"/>
                                    <img class="second" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/ok-active.svg"/>
                                </a>
                                <a href="#" class="hover">
                                    <img class="first" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/inst.svg"/>
                                    <img class="second" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/inst-active.svg"/>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?endif?>
    </div>
</header>
<main>
    <div class="content">
        <div class="container">

	