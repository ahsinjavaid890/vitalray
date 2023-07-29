@include('frontend.email.header')
<tr>
    <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:40px;word-break:break-word;">

        <div style="font-family:'Helvetica Neue',Arial,sans-serif;font-size:28px;font-weight:bold;line-height:1;text-align:center;color:white;">
            Your request to join <b>BAEECAY</b> has been rejected
        </div>

    </td>
</tr>
<tr>
    <style type="text/css">
        p{
            color: white !important;
        }
    </style>
    <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
        <div style="font-family:'Helvetica Neue',Arial,sans-serif;font-size:16px;line-height:22px;text-align:left;color:white;">
            {!! $reason !!}
        </div>
    </td>
</tr>
@include('frontend.email.footer')                       