    <style>
        .dv-paypal {
            display: none;
            width: 100px;
            height: 70px;
            position: fixed;
            z-index: 999999;
            top: 50%;
            left: 50%;
            padding: 15px;
            text-align: center;
            background: #ffff;
            box-shadow: 0 0 20px rgb(107, 107, 107);
            border-radius: 7px;
            transform: translate(-50%,-50%);
        }

        .dv-paypal img {
            width: 65px;
        }

        .dv-paypal-cont {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 99999;
            background: rgba(0, 0, 0, 0.4);
            width: 100%;
            height: 100%;
        }

        .paypal_form_new {
            display: none;
        }
    </style>
    <div class="dv-paypal-cont"></div>
    <!--<div class="dv-paypal">-->
    <!--    <img src="images/index.-text-entering-comment-loader.svg" alt="Silver-Balls-Swinging">-->
    <!--</div>-->
    <form name="myform" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="paypal_form_new">
        <input type="hidden" name="business" value="sb-qiqtp310482@business.example.com"/>
        <input type="hidden" name="cancel_return" value="<?= $full_url ?>/paypal-false/"/>
        <input type="hidden" name="return" value="<?= $full_url ?>/paypal-success/"/>
        <input type="hidden" name="rm" value="2"/>
        <input type="hidden" name="lc" value=""/>
        <input type="hidden" name="no_shipping" value="1"/>
<!--        <input type="hidden" name="no_shipping" value="1"/>-->
        <input type="hidden" name="itemName" value="1"/>
        <input type="hidden" name="no_note" value="1"/>
        <input type="hidden" name="currency_code" value="USD"/>
        <input type="hidden" name="page_style" value="paypal"/>
        <input type="hidden" name="charset" value="utf-8"/>
        <input type="hidden" name="item_name" value="" class="ma_donhang_paypal"/>
        <input type="hidden" name="cbt" value="cbt"/>
        <input type="hidden" value="_xclick" name="cmd"/>
        <input type="hidden" name="amount" value="0" class="num_price_paypal"/>
        <input type="submit" name="submit" value="" class="paypal_form_new">
    </form>
    <script>
        function TIEN_paypal(num, iddh) {
            var tile = 24000;
            var price = parseFloat(num / tile);
            price = Math.round(price * 100) / 100;
            $(".num_price_paypal").val(price);
            $(".ma_donhang_paypal").val(iddh);
        }
    </script>
    <form class="hidden" action="<?= $full_url ?>/onepay_noidia/" method="post">
        <input type="hidden" name="Title" value="VPC 3-Party"/>
        <input type="text" name="virtualPaymentClientURL"
               size="63" value="https://mtf.onepay.vn/onecomm-pay/vpc.op"
               maxlength="250"/>
        <input type="text" name="vpc_Merchant" value="ONEPAY" size="20"
               maxlength="16"/>
        <input type="text" name="vpc_AccessCode" value="D67342C2"
               size="20" maxlength="8"/>
        <input type="text" name="vpc_MerchTxnRef"
               value="20190919110938910609248" size="20"
               maxlength="40"/>
        <input type="text" name="vpc_OrderInfo" id="vpc_OrderInfo" value="JSECURETEST01"
               size="20" maxlength="34"/>
        <input type="text" name="vpc_Amount" id="vpc_Amount" value="100" size="20"
               maxlength="10"/>
        <input type="text" name="vpc_ReturnURL" size="45"
               value="<?= $full_url ?>/onepay_noidia_dr/"
               maxlength="250"/>
        <input type="text" name="vpc_Version" value="2" size="20"
               maxlength="8"/>
        <input type="text" name="vpc_Command" value="pay" size="20"
               maxlength="16"/>
        <input type="text" name="vpc_Locale" value="vn" size="20"
               maxlength="5"/>
        <input type="text" name="vpc_Currency" value="VND"
               size="20"
               maxlength="5"/>
        <input type="submit" class="onepay_noidia" value="Pay Now!"/>
        </center>
    </form>
    <form style="display: none" action="<?= $full_url ?>/onepay_quocte/" method="post">
        <input type="hidden" name="Title" value="VPC 3-Party"/>
        <input type="text" name="virtualPaymentClientURL"
               size="63" value="https://mtf.onepay.vn/vpcpay/vpcpay.op"
               maxlength="250"/>
        <input type="text" name="vpc_Merchant" value="TESTONEPAY" size="20"
               maxlength="16"/>
        <input type="text" name="vpc_AccessCode" value="6BEB2546"
               size="20" maxlength="8"/>
        <input type="text" name="vpc_MerchTxnRef"
               value="201909191109381053867380" size="20"
               maxlength="40"/>
        <input type="text" name="vpc_OrderInfo" id="vpc_OrderInfo_quocte" value="JSECURETEST01"
               size="20" maxlength="34"/>
        <input type="text" name="vpc_Amount" id="vpc_Amount_quocte"  value="1000000" size="20"
               maxlength="10"/>
        <input type="text" name="vpc_ReturnURL" size="45"
               value="<?= $full_url ?>/onepay_quocte_dr/"
               maxlength="250"/>
        <input type="text" name="vpc_Version" value="2" size="20"
               maxlength="8"/>
        <input type="text" name="vpc_Command" value="pay" size="20"
               maxlength="16"/>
        <input type="text" name="vpc_Locale" value="en" size="20"
               maxlength="5"/>
        <td align="center" colspan="4"><input class="onepay_quocte" type="submit" value="Pay Now!"/></td>
    </form>