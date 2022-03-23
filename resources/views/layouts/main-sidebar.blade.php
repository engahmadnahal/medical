<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

        <aside class="app-sidebar sidebar-scroll">

			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="{{asset('upload/files').'/'. auth()->user()->avater}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{auth()->user()->first_name ." ". auth()->user()->last_name}}</h4>
						</div>
					</div>
				</div>
				<ul class="side-menu">
					<li class="side-item side-item-category">الاقسام الرئيسية</li>
					<li class="slide">
						<a class="side-menu__item" href="{{route('index')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg>
                            <span class="side-menu__label">الصفحة الرئيسية</span>
                        </a>
					</li>
					@canany(['Create-Appoinment', 'Read-Appoinments', 'Delete-Appoinment','Update-Appoinment'])
					<li class="side-item side-item-category"> المواعيد</li>
                    @can('Read-Appoinments')

					<li class="slide">
						<a class="side-menu__item" href="{{route('appointment.index')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M13 4H6v16h12V9h-5V4zm3 14H8v-2h8v2zm0-6v2H8v-2h8z" opacity=".3"></path><path d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"></path></svg>
                            <span class="side-menu__label">كل المواعيد</span>
                        </a>
					</li>
                    @endcan
                    @can('Create-Appoinment')
					<li class="slide">
						<a class="side-menu__item" href="{{route('appointment.create')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M13 4H6v16h12V9h-5V4zm3 14H8v-2h8v2zm0-6v2H8v-2h8z" opacity=".3"></path><path d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"></path></svg>
                            <span class="side-menu__label">أضف موعد جديد</span>
                        </a>
					</li>
                    @endcan

					@endcanany
                    @canany(['Create-Doctor', 'Read-Doctors', 'Delete-Doctor','Update-Doctor','Create-Patent', 'Read-Patents', 'Delete-Patent','Update-Patent'])
                    <li class="side-item side-item-category">المستخدمين</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3.31 11l2.2 8.01L18.5 19l2.2-8H3.31zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" opacity=".3"/><path d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>
                            <span class="side-menu__label">كل المستخدمين</span>
                            <i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">

                            @canany(['Create-Doctor', 'Read-Doctors', 'Delete-Doctor','Update-Doctor'])
							<li><a class="slide-item" href="{{route('doctors.index')}}">الاطباء</a></li>
                            @endcan

                            @canany(['Create-Patent', 'Read-Patents', 'Delete-Patent','Update-Patent'])
							<li><a class="slide-item" href="{{route('patients.index')}}">المرضى</a></li>
                            @endcan
						</ul>
					</li>
                    @endcanany

                    @canany(['Create-City', 'Read-Citis', 'Delete-City','Update-City'])
                    <li class="side-item side-item-category">المدن</li>
					<li class="slide">
						<a class="side-menu__item" href="{{route('cities.index')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"  viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v4H5zm10 10h4v4h-4zM5 15h4v4H5zM16.66 4.52l-2.83 2.82 2.83 2.83 2.83-2.83z" opacity=".3"/><path d="M16.66 1.69L11 7.34 16.66 13l5.66-5.66-5.66-5.65zm-2.83 5.65l2.83-2.83 2.83 2.83-2.83 2.83-2.83-2.83zM3 3v8h8V3H3zm6 6H5V5h4v4zM3 21h8v-8H3v8zm2-6h4v4H5v-4zm8-2v8h8v-8h-8zm6 6h-4v-4h4v4z"/></svg>
                            <span class="side-menu__label"> عرض المدن</span>
                        </a>
					</li>
                    @endcanany

                    @canany(['Create-Specialite', 'Read-Specialites', 'Delete-Specialite','Update-Specialite'])
					<li class="side-item side-item-category">التخصصات</li>
					<li class="slide">
						<a class="side-menu__item" href="{{route('specialites.index')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"  viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v4H5zm10 10h4v4h-4zM5 15h4v4H5zM16.66 4.52l-2.83 2.82 2.83 2.83 2.83-2.83z" opacity=".3"/><path d="M16.66 1.69L11 7.34 16.66 13l5.66-5.66-5.66-5.65zm-2.83 5.65l2.83-2.83 2.83 2.83-2.83 2.83-2.83-2.83zM3 3v8h8V3H3zm6 6H5V5h4v4zM3 21h8v-8H3v8zm2-6h4v4H5v-4zm8-2v8h8v-8h-8zm6 6h-4v-4h4v4z"/></svg>
                            <span class="side-menu__label">كل التخصصات</span>
                        </a>
					</li>
                    @endcanany

                    @canany(['Create-Role', 'Read-Roles', 'Delete-Role','Update-Role'])
                    <li class="side-item side-item-category">المسميات الوظيفية</li>
					<li class="slide">
						<a class="side-menu__item" href="{{route('roles.index')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"  viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v4H5zm10 10h4v4h-4zM5 15h4v4H5zM16.66 4.52l-2.83 2.82 2.83 2.83 2.83-2.83z" opacity=".3"/><path d="M16.66 1.69L11 7.34 16.66 13l5.66-5.66-5.66-5.65zm-2.83 5.65l2.83-2.83 2.83 2.83-2.83 2.83-2.83-2.83zM3 3v8h8V3H3zm6 6H5V5h4v4zM3 21h8v-8H3v8zm2-6h4v4H5v-4zm8-2v8h8v-8h-8zm6 6h-4v-4h4v4z"/></svg>
                            <span class="side-menu__label"> عرض المسميات</span>
                        </a>
					</li>
                    @endcanany
				</ul>
			</div>
		</aside>


<!-- main-sidebar -->
