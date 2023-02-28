<ul class="list-group list-group-flush">
                        <a href="{{ route('index') }}" class="btn btn-primary btn-sm btn-block">{{ __('system.home') }}</a><br>
                        <a href="{{ route('user.profile.edit') }}" class="btn btn-primary btn-sm btn-block">{{ __('system.update_password') }}</a><br>
                        <a href="{{route('user.change.password')}}" class="btn btn-primary btn-sm btn-block">{{ __('system.change_password') }}</a><br>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('frm-logout').submit();"
                            class="btn btn-danger btn-sm btn-block">{{ __('system.logout') }}</a>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </ul>
