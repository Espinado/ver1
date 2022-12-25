<ul class="list-group list-group-flush">
                        <a href="{{ route('index') }}" class="btn btn-primary btn-sm btn-block">Home</a><br>
                        <a href="{{ route('user.profile.edit') }}" class="btn btn-primary btn-sm btn-block">Profile
                            update</a><br>
                        <a href="{{route('user.change.password')}}" class="btn btn-primary btn-sm btn-block">Change password</a><br>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('frm-logout').submit();"
                            class="btn btn-danger btn-sm btn-block">Logout</a>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </ul>
