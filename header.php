<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!doctype html>
<html lang="<?=GetMessage('LANG')?>">
<head>

    <?$APPLICATION->ShowHead();
    use Bitrix\Main\Page\Asset;

    CJSCore::Init(array("jquery"));
    // CSS
    Asset::getInstance()->addCss('/bitrix/css/main/font-awesome.min.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/owlcarousel/assets/owl.carousel.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/owlcarousel/assets/owl.theme.default.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/bootstrap.min.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/js/fancy/jquery.fancybox.min.css');

    // JS
    //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery-3.4.1min.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/fancy/jquery.fancybox.min.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/main_slider.min.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/owlcarousel/owl.carousel.min.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/bootstrap.min.js');

    //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/myscripts.js');

    //STRING
    Asset::getInstance()->addString("<meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>");
    Asset::getInstance()->addString("<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>");
    Asset::getInstance()->addString("<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,400italic,500italic,700,700italic,100&subset=latin,cyrillic' rel='stylesheet' type='text/css'>");
    ?>
	<title><?$APPLICATION->ShowTitle()?></title>

	<script type='application/ld+json'>
        {"@context":"http://schema.org","@type":"WebSite","@id":"#website","url":"http://SITE.ru/","name":"�������� - ��������","potentialAction":{"@type":"SearchAction","target":"http://SITE.ru/search/index.php","query-input":"required name=search_term_string"}}
    </script>
    <script type='application/ld+json'>
        {"@context":"http://schema.org","@type":"Organization","url":"http://SITE.ru/","sameAs":[],"@id":"#organization","name":"����� - ��������","logo":"http://SITE.ru/������_����_�_��������.png"}
    </script>
    <script src="https://rawgit.com/RobinHerbots/Inputmask/5.x/dist/jquery.inputmask.js"></script>
    <link rel="icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH;?>/images/favicon.ico" />
</head>
<body>
<?$APPLICATION->ShowPanel();?>
<header class="header__fix">
    <div class="container-base">
        <div class="header__top">
            <a class="header__link-logo" href="/"><img class="header__logo" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/header__logo.svg" alt="������� �������� ���-���"/></a>
            <div class="header__town-time">
                <div class="header__row-top">
                    <div class="header__text time-icon">���� ������:</div>
                    <div class="header__text_red">�� - �� 10:00 - 21:00</div>
                </div>
                <div class="header__row-top">
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
                <!-- #Begin_Auth -->
                <div class="header__login">
                    <?if(CUser::IsAuthorized()):?>
                        <div class="header__text"><a href="/personal/" class="header__link reg"><?=(CUser::GetFirstName())?CUser::GetFirstName():CUser::GetLogin()?></a></div>
                        <div class="header__text"><a href="/personal/auth/?logout=yes" class="header__link exit"><span class="login-greg-none">�����</span></a></div>
                    <?else:?>
                        <div class="header__text"><a href="/personal/auth/" class="header__link login"><span class="login-greg-none">����</span></a></div>
                        <div class="header__text"><a href="/personal/reg/" class="header__link reg"><span class="login-greg-none">�����������</span></a></div>
                    <?endif;?>
                </div>
                <!-- #End_Auth -->
            </div>
        </div>
    </div>
    <div class="header__back-red">
        <div class="main_menu">
            <nav class="container-base header__row">
                <input id="menu-toggle" type="checkbox"/>
                <label class="menu-btn" for="menu-toggle">
                    <span></span>
                </label>
                <?$APPLICATION->IncludeComponent("bitrix:menu", "main_menu", Array(
                    "ROOT_MENU_TYPE" => "top",	// ��� ���� ��� ������� ������
                        "MAX_LEVEL" => "1",	// ������� ����������� ����
                        "USE_EXT" => "N",	// ���������� ����� � ������� ���� .���_����.menu_ext.php
                        "COMPONENT_TEMPLATE" => "main_menu",
                        "MENU_CACHE_TYPE" => "N",	// ��� �����������
                        "MENU_CACHE_TIME" => "3600",	// ����� ����������� (���.)
                        "MENU_CACHE_USE_GROUPS" => "Y",	// ��������� ����� �������
                        "MENU_CACHE_GET_VARS" => "",	// �������� ���������� �������
                        "CHILD_MENU_TYPE" => "",	// ��� ���� ��� ��������� �������
                        "DELAY" => "N",	// ����������� ���������� ������� ����
                        "ALLOW_MULTI_SELECT" => "N",	// ��������� ��������� �������� ������� ������������
                    ),
                    false
                );?>
                <div id="basket-container" class="main_menu__cart">
                    <?if($_GET['refresh-cart'] == 'Y'){$APPLICATION->RestartBuffer();}?>
                    <?$APPLICATION->IncludeComponent(
                        "bazarow:basket.small.bazarow",
                        "ajax",
                        array(
                            "COMPONENT_TEMPLATE" => "ajax",
                            "PATH_TO_BASKET" => "/personal/cart",
                            "PATH_TO_ORDER" => "/personal/orders/",
                            "SHOW_DELAY" => "N",
                            "SHOW_NOTAVAIL" => "Y",
                            "SHOW_SUBSCRIBE" => "Y"
                        ),
                        false
                    );
                    ?>
                    <?if($_GET['refresh-cart'] == 'Y'){die();}?>
                </div>
            </nav>
        </div>
        <?if($APPLICATION->GetCurPage() == "/"):?>
        <div class="slide-wrapper">
            <div class="owl-carousel owl-theme" id="owl-carousel1">
                <div class="slide-item slide1">
                    <div class="container-base slide-item__row">
                        <div class="slide-item__text">
                            <div class="slide-item__header">
                                ������������
                                <span class="slide-item__span">�&nbsp;�������</span>
                                ��&nbsp;��������
                                ��������!
                            </div>
                            <div class="slide-item__info">
                                ���������� � ������� ����!<br>
                                ����� �� 2 ������ ������ ������������
                            </div>
                        </div>
                        <div class="slide-item__img">
                            <div class="slide-item__social">
                                <a href="https://vk.com/njamnjam_nt" target="_blank" class="hover">
                                    <img class="first" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/vk.svg" alt="������ ��"/>
                                    <img class="second" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/vk-active.svg" alt="������ ��"/>
                                </a>
                                <!--<a href="#" class="hover">
                                    <img class="first" src="/local/templates/<?/* echo SITE_TEMPLATE_ID;*/?>/images/ok.svg" alt="������ ��"/>
                                    <img class="second" src="/local/templates/<?/* echo SITE_TEMPLATE_ID;*/?>/images/ok-active.svg" alt="������ ��"/>
                                </a>
                                <a href="#" class="hover">
                                    <img class="first" src="/local/templates/<?/* echo SITE_TEMPLATE_ID;*/?>/images/inst.svg" alt="������ ���������"/>
                                    <img class="second" src="/local/templates/<?/* echo SITE_TEMPLATE_ID;*/?>/images/inst-active.svg" alt="������ ���������"/>
                                </a>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide-item slide2">
                    <div class="container-base row-base">
                        <div class="slide-item__text">
                            <div class="slide-item__header">
                                ������ 7%
                                <span class="slide-item__span">� ���� ��������!</span>
                                <span class="slide-item__span-add">*��� ������������ ���������</span>
                            </div>
                        </div>
                        <div class="slide-item__img">
                            <div class="slide-item__social">
                                <a href="https://vk.com/njamnjam_nt" target="_blank" class="hover">
                                    <img class="first" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/vk.svg"/>
                                    <img class="second" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/vk-active.svg"/>
                                </a>
                                <!--<a href="#" class="hover">
                                    <img class="first" src="/local/templates/<?/* echo SITE_TEMPLATE_ID;*/?>/images/ok.svg"/>
                                    <img class="second" src="/local/templates/<?/* echo SITE_TEMPLATE_ID;*/?>/images/ok-active.svg"/>
                                </a>
                                <a href="#" class="hover">
                                    <img class="first" src="/local/templates/<?/* echo SITE_TEMPLATE_ID;*/?>/images/inst.svg"/>
                                    <img class="second" src="/local/templates/<?/* echo SITE_TEMPLATE_ID;*/?>/images/inst-active.svg"/>
                                </a>-->
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
        <div class="container-base">
            <? if ($APPLICATION->GetCurDir() !== '/') { ?>
                <h1 class="
                    <? if ($APPLICATION->GetCurDir() == '/about/')
                { ?>main__title-about<?}
                else { ?>main__title<? } ?>
                    ">
                    <? if ($APPLICATION->GetCurDir() == '/about/')
                    { echo "�������� ���-���";}
                    else { $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breads", Array(
                            "COMPOSITE_FRAME_MODE" => "A",    // ����������� ������� ���������� �� ���������
                            "COMPOSITE_FRAME_TYPE" => "AUTO",    // ���������� ����������
                            "PATH" => "",    // ����, ��� �������� ����� ��������� ������������� ������� (�� ���������, ������� ����)
                            "SITE_ID" => "s1",    // C��� (��������������� � ������ ������������� ������, ����� DOCUMENT_ROOT � ������ ������)
                            "START_FROM" => "2",    // ����� ������, ������� � �������� ����� ��������� ������������� �������
                        ),
                            false
                        );
                    } ?>
                </h1>

            <? } ?>


