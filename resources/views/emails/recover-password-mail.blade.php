<div style="background-color:#efefef;width:100%;font-family: Helvetica;font-size: 13px;">
    <div style="width:70%;margin: 30px 15%;background-color:#ffffff;display: inline-block;padding: 10px;">
        <div style="height:50px;">
            <img style="height:100%;width:auto;float: left;" src="{{ url('images/reset-password-blue.png') }}">
            <div style="font-size: 30px;float: left;margin: 10px;color: #565656;">Reset Your password</div>
        </div>
        <hr style="margin:10px 0">
        <p>You requested us to reset a password. Click on the link below to enter your new password.</p>
        <div style="background-color: #d5f9ff;padding: 5px;border: 1px solid #d8d8d8;">
            <a style="text-decoration:none; font-weight:bold; color:deepbluesky;" href="https://kft-web.local/recover-password/{{ $token }}">
                https://kft-web.local/recover-password/{{ $token }}
            </a>
        </div>
        <hr style="margin:10px 0">
        <div style="float:right;height:40px;">
            <img style="height:100%;width:auto;" src="{{url('images/logo-kft.png')}}">
            <img style="height:100%;width:auto;" src="{{url('images/telkom.png')}}">
        </div>
    </div>
</div>