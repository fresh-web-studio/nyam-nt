<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?><?
ShowMessage($arParams["~AUTH_RESULT"]);
?>

<div class="login__row">
    <div class="login__column">
        <div class="flex-tabs">
            <div class="login__label-row">
                <noindex>
                    <div class="tab">
                        <a href="../auth/">����</a>
                    </div>
                </noindex>
                <noindex>
                    <div class="tab">
                        <a href="../reg/">�����������</a>
                    </div>
                </noindex>
                <noindex>
                    <div class="tab active">
                        ������������
                    </div>
                </noindex>
            </div>
            <div>
                <form name="bform" method="post" target="_top" action="<?= $arResult["AUTH_URL"] ?>">
                    <?
                    if (strlen($arResult["BACKURL"]) > 0) {
                        ?>
                        <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                        <?
                    }
                    ?>
                    <input type="hidden" name="AUTH_FORM" value="Y">
                    <input type="hidden" name="TYPE" value="SEND_PWD">
                    <div class="login__info">
                        ���� �� ������ ������, ������� ����� ��� E-Mail.
                        ����������� ������ ��� ����� ������, � ����� ���� ��������������� ������, ����� ������� ��� �� E-Mail.
                    </div>
                    <div class="input-group input-group-lg">
                        <!--input class="form-control" type="text" name="USER_LOGIN" placeholder="�����" maxlength="50" value="<?= $arResult["LAST_LOGIN"] ?>"/--->
                        <input class="form-control" type="text" name="USER_EMAIL" placeholder="��� E-mail" maxlength="255"/>
                    </div>
                    <br>
                    <input class="btn btn-default" type="submit" name="send_account_info" value="<?= GetMessage("AUTH_SEND") ?>"/>
                </form>
            </div>
        </div>
    </div>
    <div class="login__column">
        <div class="login__contacts">
            <div class="login__title">��������</div>
            <div class="login__subtitle">
                �����
            </div>
            <div class="login__address">
                ��. ����� ������, 81/23
            </div>
            <div class="login__phone">+7 (3435) 41-62-60</div>
            <div class="login__phone">+7 (3435) 41-37-47</div>
            <div class="login__time">��������: <span>10:00 - 20:00</span></div>
            <div class="login__time">��������: <span>10:00 - 21:00</span></div>
            <div class="login__subtitle">
                ���
            </div>
            <div class="login__address">
                ��. �����������, 10
            </div>
            <div class="login__phone">+7 (3435) 34-30-10</div>
            <div class="login__time">��������: <span>10:00 - 20:00</span></div>
            <div class="login__time">��������: <span>10:00 - 21:00</span></div>
        </div>
    </div>
</div>


<script type="text/javascript">
    document.bform.USER_LOGIN.focus();
</script>
