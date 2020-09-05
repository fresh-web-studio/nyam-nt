<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
        </div>
    </div>
</main>
<footer>
    <div class="footer__red">
        <div class="container">
            <div class="footer__top-row">
                <div class="footer__column">
                    <img class="footer__logo" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/footer__logo.svg" alt="Лого пиццерия ням ням">
                    <div class="footer__text">
                        <?$APPLICATION->IncludeFile(
                            SITE_TEMPLATE_PATH."/include_areas/slogan_inc.php",
                            Array(),
                            Array("MODE"=>"text")
                        );?>
                    </div>
                </div>
                <div class="footer__column">
                    <div class="footer__menu-botton">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "bottom",
                            array(
                                "ROOT_MENU_TYPE" => "bottom_left",
                                "MAX_LEVEL" => "1",
                                "USE_EXT" => "N",
                                "COMPONENT_TEMPLATE" => "bottom",
                                "MENU_CACHE_TYPE" => "N",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "CHILD_MENU_TYPE" => "",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N"
                            ),
                            false
                        );?>
                    </div>
                </div>
                <div class="footer__column">
                    <div class="footer__menu-botton">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "bottom",
                            array(
                                "ROOT_MENU_TYPE" => "bottom_right",
                                "MAX_LEVEL" => "1",
                                "USE_EXT" => "N",
                                "COMPONENT_TEMPLATE" => "bottom",
                                "MENU_CACHE_TYPE" => "N",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "CHILD_MENU_TYPE" => "",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N"
                            ),
                            false
                        );?>
                    </div>
                </div>
                <div class="footer__column column-between">
                    <div class="footer__address">
                        <?$APPLICATION->IncludeFile(
                            SITE_TEMPLATE_PATH."/include_areas/address-karla_inc.php",
                            Array(),
                            Array("MODE"=>"text")
                        );?>
                    </div>
                    <div class="footer__phone">
                        <?$APPLICATION->IncludeFile(
                            SITE_TEMPLATE_PATH."/include_areas/phone-karla_inc.php",
                            Array(),
                            Array("MODE"=>"php")
                        );?>
                    </div>
                    <div class="footer__address">
                        <?$APPLICATION->IncludeFile(
                            SITE_TEMPLATE_PATH."/include_areas/address-cosmo_inc.php",
                            Array(),
                            Array("MODE"=>"text")
                        );?>
                    </div>
                    <div class="footer__phone">
                        <?$APPLICATION->IncludeFile(
                            SITE_TEMPLATE_PATH."/include_areas/phone-cosmo_inc.php",
                            Array(),
                            Array("MODE"=>"php")
                        );?>
                    </div>
                </div>
                <div class="footer__column">
                    <div class="footer__social">
                        <a href="#" class="hover">
                            <img class="first" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/footer__vk.svg"/>
                            <img class="second" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/vk-active.svg"/>
                        </a>
                        <a href="#" class="hover">
                            <img class="first" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/footer__ok.svg"/>
                            <img class="second" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/ok-active.svg"/>
                        </a>
                        <a href="#" class="hover">
                            <img class="first" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/footer__inst.svg"/>
                            <img class="second" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/inst-active.svg"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__yellow">
        <div class="container">
            <div class="footer__footer-bottom">
                <div class="footer__copyright">Все права защищены &copy; 2004 - 2020 Пиццерия Ням-Ням</div>
                <a href="#">Правовая информация</a>
                <a href="karta-sayta.php">Карта сайта</a>
            </div>
        </div>
    </div>
</footer>
</body>
</html>