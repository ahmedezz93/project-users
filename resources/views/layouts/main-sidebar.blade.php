<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


            <li class="nav-item"><a href="#"><i class="la la-group"></i>
                <span class="menu-title" data-i18n="nav.dash.main">users </span>
                <span
                    class="badge badge badge-danger badge-pill float-right mr-2"></span>
            </a>
            <ul class="menu-content">
                <li class="active"><a class="menu-item" href="{{ route('users') }}"
                                      data-i18n="nav.dash.ecommerce"> show users</a>
                </li>

                <li class="nav-item"><a href="#"><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">create users </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2"></span>
                </a>
                <ul class="menu-content">

                    @foreach ($types=App\Models\type_user::all()  as $type )
                    <li class="active"><a class="menu-item" href="{{ route('create_user',$type->id) }}"
                        data-i18n="nav.dash.ecommerce"> {{ $type->name }}</a>
                     </li>

                    @endforeach


                    </li>

                </ul>
            </li>

            </ul>
        </li>


        </ul>
    </div>
</div>
