<div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
    <h3 class="section-title">{{ __('system.newsletters') }}</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <p>{{ __('system.sign_up_for_newsletters') }}!</p>
        @error('email')
            <div class="alert alert-danger"><b>{{ $message }}</b>
            </div>
        @enderror
        <form method="POST" action="{{ route('subscribe') }}" onsubmit="preventScrollToTop()">
            @csrf
            <div class="form-group">
                <label class="sr-only" for="exampleInputEmail1">{{ __('system.email_address') }}</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                    placeholder="{{ __('system.subscribe_to_our_newsletter') }}">
            </div>
            <button class="btn btn-primary">{{ __('system.subscribe') }}</button>
        </form>
    </div>
    <!-- /.sidebar-widget-body -->
</div>
  <script>
  function preventScrollToTop() {
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  }
</script>
