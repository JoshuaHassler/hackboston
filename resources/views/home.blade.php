@extends('layouts.app')

@section('content')
<script>
window.ButtonWebConfig = {
  applicationId: 'app-48d2bd5ff23e71f6',
  enableLogging: true,
  defaults: {
    'test': {
      context: {
        user_location: {
          latitude: '40.6827',
          longitude: '-73.9754'
        },
        subject_location: {
          name: 'Button HQ',
          latitude: '40.7382869',
          longitude: '-73.9823721'
        }
      }
    }
  }
};
(function(u,s,e,b,t,n){
  u['__bttnio']=b;u[b]=u[b]||function(){(u[b].q=u[b].q||[]).push(arguments)};t=s.createElement(e);n=s.getElementsByTagName(e)[0];t.async=1;t.src='https://web.btncdn.com/v1/button.js';n.parentNode.insertBefore(t,n)
})(window, document, 'script', 'bttnio');
</script>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    <body>
                        <div data-bttnio-id="test"></div>
                    </body>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
