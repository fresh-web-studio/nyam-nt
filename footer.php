<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
        </div>
    </div>
</main>
<footer>
    <div class="footer__red">
        <div class="container">
            <div class="footer__top-row">
                <div class="footer__column">
                    <img class="footer__logo" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/footer__logo.svg" alt="���� �������� ��� ���">
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
                        <ul class="footer__menu">
                            <li class="footer__menu-li">
                                <a href="/" class="footer__menu-link">�������</a>
                            </li>
                            <li class="footer__menu-li">
                                <a href="contacts.html" class="footer__menu-link">��������</a>
                            </li>
                            <li class="footer__menu-li">
                                <a href="delivery.html" class="footer__menu-link">��������</a>
                            </li>
                            <li class="footer__menu-li">
                                <a href="about.html" class="footer__menu-link">� ���</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="footer__column">
                    <div class="footer__menu-botton">
                        <ul class="footer__menu">
                            <li class="footer__menu-li">
                                <a href="pizza.html" class="footer__menu-link">�����</a>
                            </li>
                            <li class="footer__menu-li">
                                <a href="salads.html" class="footer__menu-link">������</a>
                            </li>
                            <li class="footer__menu-li">
                                <a href="drinks.html" class="footer__menu-link">�������</a>
                            </li>
                            <li class="footer__menu-li">
                                <a href="dissert.html" class="footer__menu-link">�������</a>
                            </li>
                        </ul>
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
                <div class="footer__copyright">��� ����� �������� &copy; 2004 - 2020 �������� ���-���</div>
                <a href="#">�������� ����������</a>
                <a href="karta-sayta.php">����� �����</a>
            </div>
        </div>
    </div>
</footer>
</body>
</html>