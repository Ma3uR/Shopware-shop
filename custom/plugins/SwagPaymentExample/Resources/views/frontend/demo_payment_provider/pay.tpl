{block name='payment_example'}
    <h2>Hello {$firstName} {$lastName}, its PRIVAT24</h2>
    <p>Do you want to pay {$amount} {$currency} with this example payment provider?</p>
    <a href="{$returnUrl}" title="pay {$amount} {$currency}">pay {$amount} {$currency}</a>
    <br/>
    <a href="{$cancelUrl}" title="cancel payment">cancel payment</a>

    <form method="POST" action="https://www.liqpay.ua/api/3/checkout"
          accept-charset="utf-8">
        <input type="hidden" name="data" value="eyAidmVyc2lvbiIgOiAzLCAicHVibGljX2tleSIgOiAieW91cl9wdWJsaWNfa2V5IiwgImFjdGlv
biIgOiAicGF5IiwgImFtb3VudCIgOiAxLCAiY3VycmVuY3kiIDogIlVTRCIsICJkZXNjcmlwdGlv
biIgOiAiZGVzY3JpcHRpb24gdGV4dCIsICJvcmRlcl9pZCIgOiAib3JkZXJfaWRfMSIgfQ=="/>
        <input type="hidden" name="signature" value="QvJD5u9Fg55PCx/Hdz6lzWtYwcI="/>
        <input type="image"
               src="//static.liqpay.ua/buttons/p1ru.radius.png"/>
    </form>
{/block}
