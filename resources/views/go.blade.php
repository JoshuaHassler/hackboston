@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                        <div data-bttnio-id="test"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
window.ButtonWebConfig = {
  applicationId: 'app-4e830eadf834fbd2'
};
(function(u,s,e,b,t,n){
  u['__bttnio']=b;u[b]=u[b]||function(){(u[b].q=u[b].q||[]).push(arguments)};t=s.createElement(e);n=s.getElementsByTagName(e)[0];t.async=1;t.src='https://web.btncdn.com/v1/button.js';n.parentNode.insertBefore(t,n)
})(window, document, 'script', 'bttnio');
</script>
@endsection
