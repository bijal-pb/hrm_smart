@extends("mail.layout")
@section("email_content")
    Hi {{ $name }},<br/>
    
    <br/>
    <div class="panel-tag">      
    Please verify your email address. Click the below link or copy paste in browser to verify your email address: <br/><br/>
    <a href="{{ $verify_link }}">{{ $verify_link }}</a><br/><br/>
</div>
@endsection