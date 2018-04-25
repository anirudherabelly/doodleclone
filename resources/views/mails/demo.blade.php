<!-- Hello <i>Receiver</i>,
<p>This is a demo email for testing purposes! Also, it's the HTML version.</p>

<p><u>Demo object values:</u></p>
<a href="{{ $link }}">{{ $link }}</a>

Thank You,
<br/>
<i>Vijay</i> -->

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">You have been invited to a poll for an event!</div>
                <div class="panel-body">
                  Click here to register your response : <a href="{{ $link }}">{{ $link }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
