<div class="wrapper">

<!-- Sidebar Holder -->
<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Clinical Management System</h3>
    </div>

    <ul class="list-unstyled components">
        <p class="hide">Dummy Heading</p>
        <li class="active hide">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Home</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li><a href="#">Home 1</a></li>
                <li><a href="#">Home 2</a></li>
                <li><a href="#">Home 3</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ url('dashboard') }}">Dashboard</a>
        </li>
        <li>
            <a href="{{ url('patient') }}">Patients</a>
            <a  class="hide" href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Pages</a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li><a href="#">Page 1</a></li>
                <li><a href="#">Page 2</a></li>
                <li><a href="#">Page 3</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ url('appointment') }}">Appointments</a>
        </li>
        <li>
            <a href="{{ url('complaint') }}">Complaints</a>
        </li>
        <li>
            <a href="{{ url('visit') }}">Visits</a>
        </li>
        <li>
            <a href="{{ url('medication') }}">Medication/Treatment</a>
        </li>
        <li>
            <a href="{{ url('diagnose') }}">Findings/Diseases</a>
        </li>
        <li>
            <a href="{{ url('setting') }}">Settings</a>
        </li>
    </ul>
</nav>

<!-- Page Content Holder -->
<div id="content">

    <nav class="navbar navbar-default">
        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    {{--<li><a href="#">Page</a></li>--}}
                    {{--<li><a href="#">Page</a></li>--}}
                    {{--<li><a href="#">Page</a></li>--}}
                    {{--<li><a href="#">Page</a></li>--}}
                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li style="margin-right: 30px">
                            <select class="form-control" id="language">
                                <option>English</option>
                                <option>German</option>
                            </select>
                        </li>
                        <li class="dropdown" style="background: #7386d5;">
                            <a style="color: white" href="#" class="dropdown-toggle custom-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" style="background: #6d7fcd;">
                                <li>
                                    <a style="padding: 8px;
    font-size: 15px !important;
    color: white;" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
