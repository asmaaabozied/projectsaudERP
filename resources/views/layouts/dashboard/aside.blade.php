<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-dark sidenav-active-rounded">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="{{ route('dashboard.welcome') }}"><img
                    class="hide-on-med-and-down "
                    src="{{asset('style/app-assets/images/logo/materialize-logo.png')}}"
                    alt="materialize logo"/><img
                    class="show-on-medium-and-down hide-on-med-and-up"
                    src="{{asset('style/app-assets/images/logo/materialize-logo-color.png')}}"
                    alt="materialize logo"/><span
                    class="logo-text hide-on-med-and-down">@lang('site.title')</span></a><a class="navbar-toggler"
                                                                                            href="#"><i
                    class="material-icons"></i></a></h1>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out"
        data-menu="menu-navigation" data-collapsible="accordion">
        {{--                <li class="active bold"><a href="{{ route('dashboard.welcome') }}"><i--}}
        {{--                            class="fa fa-home"></i><span>@lang('site.dashboard')</span></a></li>--}}
        <br>

        <li class="bold"><a class="waves-effect waves-cyan "
                            href="{{ route('dashboard.welcome') }}"><i
                    class="material-icons">settings_input_svideo</i><span
                    class="menu-title" data-i18n="@lang('site.dashboard')">@lang('site.dashboard')</span></a>
        </li>

        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
                <i class="material-icons">person_outline</i><span class="menu-title"
                                                                  data-i18n="@lang('site.management')">@lang('site.management')</span>
                {{--                            <span class="badge badge pill purple float-right mr-10 count">2</span>--}}
            </a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    @if (auth()->user()->hasPermission('read_roles'))
                        <li><a href="{{ route('dashboard.roles.index') }}"><i class="material-icons">radio_button_unchecked</i><span>@lang('site.roles')</span></a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermission('read_users'))
                        <li><a href="{{ route('dashboard.users.index') }}"><i class="material-icons">radio_button_unchecked</i><span>@lang('site.users')</span></a>
                        </li>
                    @endif


                </ul>
            </div>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan "
                            href="{{ route('dashboard.contact_us.index') }}"
                            target="_blank"><i class="material-icons">import_contacts</i><span class="menu-title"
                                                                                               data-i18n=@lang('site.contact')">@lang('site.contact')</span></a>
            </li>






                    <li class="bold"><a  class="waves-effect waves-cyan " href="{{ route('dashboard.locations.index') }}"><i
                        class="material-icons">today</i><span class="menu-title"
                                                              data-i18n="Calendar">@lang('site.locations')</span></a>
        </li>


        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('dashboard.sliders.index') }}"><i
                    class="material-icons">add_to_queue</i><span
                    class="menu-title" data-i18n="User Profile">@lang('site.sliders')</span></a>
        </li>


        <li class="bold"><a class="waves-effect waves-cyan "
                            href="{{ route('dashboard.pages.index') }}"
                            target="_blank"><i class="material-icons">import_contacts</i><span class="menu-title"
                                                                                               data-i18n=@lang('site.pages')">@lang('site.pages')</span></a>
            </li>


         <li class=" bold">
                <a class="waves-effect waves-cyan" href="{{ route('dashboard.settings.index') }}"><i
                        class="material-icons">filter_tilt_shift</i><span class="menu-title"
                                                                      data-i18n="@lang('site.settings')">@lang('site.settings')</span></a>

        </li>


        <li class="bold"><a class="waves-effect waves-cyan" href="{{ route('dashboard.companies.index') }}"><i
                    class="material-icons">face</i><span class="menu-title"
                                                         data-i18n="@lang('site.companies')">@lang('site.companies')</span></a>

        </li>

        <li><a href="{{ route('dashboard.Maincompany') }}"><i
                    class="material-icons">chrome_reader_mode</i><span
                    data-i18n="@lang('site.companies')">@lang('site.Maincompany')</span></a>
        </li>


        <li><a href="{{ route('dashboard.services.index') }}"><i
                    class="material-icons">border_all</i><span
                    data-i18n="@lang('site.services')">@lang('site.services')</span></a>
        </li>

    </ul>

</aside>
