<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?><?
ShowMessage($arParams["~AUTH_RESULT"]);
?>
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
<p>
    ���� �� ������ ������, ������� ����� ��� E-Mail.<br />
    ����������� ������ ��� ����� ������, � ����� ���� ��������������� ������, ����� ������� ��� �� E-Mail.
</p>
    <div class="input-group input-group-lg">
        <!--input class="form-control" type="text" name="USER_LOGIN" placeholder="�����" maxlength="50" value="<?= $arResult["LAST_LOGIN"] ?>"/--->
        <input class="form-control" type="text" name="USER_EMAIL" placeholder="��� E-mail" maxlength="255"/>
    </div>
    <br>
        <input class="btn btn-default" type="submit" name="send_account_info" value="<?= GetMessage("AUTH_SEND") ?>"/>
</form>
<script type="text/javascript">
    document.bform.USER_LOGIN.focus();
</script>
