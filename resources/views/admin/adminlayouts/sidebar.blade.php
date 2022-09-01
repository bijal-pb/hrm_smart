 <!-- BEGIN Left Aside -->
 <aside class="page-sidebar">
     <div class="page-logo">
         <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
             <img src="{{ URL::asset('admin_assets/img/logo.png') }}" aria-roledescription="logo">
             <span class="page-logo-text mr-1">{{ config('app.name') }}</span>
             <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
             {{-- <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i> --}}
         </a>
     </div>
     <!-- BEGIN PRIMARY NAVIGATION -->
     <nav id="js-primary-nav" class="primary-nav" role="navigation">
         <div class="nav-filter">
             <div class="position-relative">
                 <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                 <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off"
                     data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                     <i class="fal fa-chevron-up"></i>
                 </a>
             </div>
         </div>
         <div class="info-card">
             @if (admin()->type == 'admin')
                 <img src="{{ $loggedAdmin->company->logo_image_url }}" class="profile-image rounded-circle">
             @else
                 <img src="{{ $setting->logo_image_url }}" class="profile-image rounded-circle">
             @endif
             <div class="info-card-text">
                 <a href="#" class="d-flex align-items-center text-white">
                     <span class="text-truncate text-truncate-sm d-inline-block">
                         {{ $loggedAdmin->name }}
                     </span>
                 </a>
                 {{-- <span class="d-inline-block text-truncate text-truncate-sm">Toronto, Canada</span> --}}
             </div>
             <img src="{{ URL::asset('smart_assets/img/card-backgrounds/cover-2-lg.png') }}" class="cover"
                 alt="cover">
             <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle"
                 data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                 <i class="fal fa-angle-down"></i>
             </a>
         </div>
         <!--
        TIP: The menu items are not auto translated. You must have a residing lang file associated with the menu saved inside dist/media/data with reference to each 'data-i18n' attribute.
        -->
         <ul id="js-nav-menu" class="nav-menu">
             @if ($loggedAdmin->type == 'superadmin')
                 @include('admin.include.superadmin_menu')
             @endif
             <!-- dashboard -->
             @if (isset($loggedAdmin->company) && $loggedAdmin->type !== 'superadmin')
                 @if ($loggedAdmin->company->license_expired == 0)
                     <li class="{{ isset($dashboardActive) ? 'active' : '' }}">
                         <a href="{{ URL::to('admin') }}" title="Dashboard" data-filter-tags="dashboard">
                             <i class="fal fa-tachometer "></i>
                             <span class="nav-link-text" data-i18n="nav.programs">{{ __('menu.dashboard') }}</span>
                         </a>
                     </li>
                     <!-- People -->

                     <li class="{{ isset($peopleMenuActive) ? 'active' : '' }}">
                         <a href="#" title="people" data-filter-tags="people">
                             <i class="fal fa-users"></i>
                             <span class="nav-link-text" data-i18n="nav.pages">@lang('menu.people')</span>
                         </a>
                         <ul>
                             @if ($loggedAdmin->manager != 1)
                                 <li class="{{ isset($departmentOpen) ? 'active' : '' }}"><a
                                         href="{{ route('admin.departments.index') }}" title="department"
                                         data-filter-tags="departments">
                                         <i class="fal fa-sitemap"></i>
                                         <span class="nav-link-text" data-i18n="nav.department">
                                             {{ __('menu.department') }}
                                         </span>
                                     </a>
                                 </li>
                             @else
                                 <li class="{{ isset($departmentOpen) ? 'active' : '' }}"><a
                                         href="{{ route('admin.departments.index') }}" title="department"
                                         data-filter-tags="departments">
                                         <i class="fal fa-sitemap"></i>
                                         <span class="nav-link-text" data-i18n="nav.department">
                                             {{ __('menu.department') }}
                                         </span>
                                     </a>
                                 </li>
                             @endif
                             <li class="{{ isset($employeesActive) ? 'active' : '' }}">
                                 <a href="{{ route('admin.employees.index') }}" title="Employee"
                                     data-filter-tags="employees">
                                     <i class="fal fa-user-circle"></i>
                                     <span class="nav-link-text"
                                         data-i18n="nav.employees">{{ __('menu.employees') }}</span>
                                 </a>
                             </li>
                         </ul>
                     </li>
                     <!-- People -->

                     {{-- project --}}
                     <li class="{{ isset($projectActive) ? $projectActive : '' }}">
                         <a href="{{ route('admin.projects.index') }}" data-filter-tags="projects">
                             <i class="fa fa-list-alt"></i>
                             Projects</a>
                     </li>

                     {{-- employee tasks --}}
                     <li class="{{ isset($employeetaskActive) ? 'active' : '' }}">
                         <a href="{{ route('admin.employee_tasks.index') }}" title="employee task"
                             data-filter-tags="employee task">
                             <i class="fal fa-user-clock"></i>
                             <span class="nav-link-text" data-i18n="nav.employee_task">Employee Tasks</span>
                         </a>
                     </li>


                     <li class="{{ isset($projectAllocationActive) ? $projectAllocationActive : '' }}">
                         <a href="{{ route('admin.project_allocation.index') }}"
                             data-filter-tags="project allocation">
                             <i class="fal fa-file-spreadsheet"></i>
                             Projects Allocation</a>
                     </li>
                     {{-- project --}}

                     <!-- HR -->
                     <li class="{{ isset($hrMenuActive) ? 'active' : '' }}">
                         <a href="#" title="HR" data-filter-tags="hr">
                             <i class="fal fa-user-tie"></i>
                             <span class="nav-link-text" data-i18n="nav.pages">HR</span>
                         </a>
                         <ul>
                             @if ($loggedAdmin->type == 'superadmin' || $loggedAdmin->company->award_feature == 1)
                                 <li class="{{ isset($awardsActive) ? 'active' : '' }}"><a
                                         href="{{ route('admin.awards.index') }}" title="awards"
                                         data-filter-tags="awards">
                                         <i class="fal fa-trophy"></i>
                                         <span class="nav-link-text" data-i18n="nav.award">
                                             {{ __('menu.award') }}
                                         </span>
                                     </a>
                                 </li>
                             @endif
                             @if ($loggedAdmin->type == 'superadmin' || $loggedAdmin->company->expense_feature == 1)
                                 <li class="{{ isset($expensesActive) ? 'active' : '' }}">
                                     <a href="{{ route('admin.expenses.index') }}" title="expense"
                                         data-filter-tags="expense">
                                         <i class="fal fa-rupee-sign"></i>
                                         <span class="nav-link-text"
                                             data-i18n="nav.expense">{{ __('menu.expense') }}</span>
                                     </a>
                                 </li>

                                 <li class="{{ isset($holidayActive) ? $holidayActive : '' }}">
                                     <a href="{{ route('admin.holidays.index') }}" data-filter-tags="holidays">
                                         <i class="fal fa-send"></i>
                                         <span class="nav-link-text"
                                             data-i18n="nav.holidays">{{ __('menu.holiday') }}</span>

                                     </a>
                                 </li>

                                 <li class="{{ isset($payrollActive) ? $payrollActive : '' }}">
                                     <a href="{{ route('admin.payrolls.index') }}" data-filter-tags="payroll">
                                         <i class="fal fa-rupee-sign"></i>
                                         <!-- &nbsp; {{ $loggedAdmin->company->currency_symbol }} &nbsp; -->
                                         <span class="nav-link-text"
                                             data-i18n="nav.payroll">{{ __('menu.payroll') }}</span>

                                     </a>
                                 </li>

                                 <li class="{{ isset($noticeBoardActive) ? $noticeBoardActive : '' }}">
                                     <a href="{{ route('admin.noticeboards.index') }}"
                                         data-filter-tags="notice board">
                                         <i class="fal fa-quote-left"></i>
                                         <span class="nav-link-text"
                                             data-i18n="nav.noticeboard">{{ __('menu.noticeBoard') }}</span>
                                     </a>

                                 </li>
                             @endif
                         </ul>
                     </li>

                     <!-- end HR -->

                     <!-- job vacancies -->
                     @if ($setting->jobs_feature == 1)
                         <li class="{{ isset($jobActive) ? 'active' : '' }}">
                             <a href="{{ route('jobs.index') }}" title="job vacancies"
                                 data-filter-tags="job vacancies">
                                 <i class="fal fa-mail-bulk "></i>
                                 <span class="nav-link-text"
                                     data-i18n="nav.job_vacancies">{{ __('menu.job') }}</span>
                             </a>
                         </li>
                     @endif
                     <!-- end job vacancies -->

                     <!-- Attendance -->
                     <li class="{{ isset($attendanceOpen) ? 'active' : '' }}">
                         <a href="#" title="attendance" data-filter-tags="attendance">
                             <i class="fal fa-user-check "></i>
                             <span class="nav-link-text"
                                 data-i18n="nav.attendance">{{ __('core.attendance') }}</span>
                         </a>
                         <ul>
                             <li class="{{ isset($markAttendanceActive) ? $markAttendanceActive : '' }}">
                                 <a href="{{ route('admin.attendances.create') }}" title="markattendance"
                                     data-filter-tags="markattendance">
                                     <i class="fal  fa-check"></i>
                                     Attendance Sheet</a>
                             </li>
                             <li class="{{ isset($viewAttendanceActive) ? $viewAttendanceActive : '' }}">
                                 <a href="{{ route('admin.attendances.index') }}" data-filter-tags="view attendance">
                                     <i class="fal fa-eye"></i>
                                     {{ __('menu.viewAttendance') }}</a>
                             </li>
                             @if ($loggedAdmin->manager != 1)
                                 <li class="{{ isset($leaveTypeActive) ? $leaveTypeActive : '' }}">
                                     <a href="{{ route('admin.leavetypes.index') }}" data-filter-tags="leave types">
                                         <i class="fa fa-sitemap"></i>
                                         {{ __('menu.leaveTypes') }}</a>
                                 </li>
                             @endif
                             <li class="{{ isset($leaveApplicationOpen) ? $leaveApplicationOpen : '' }}">
                                 <a href="{{ route('admin.leave_applications.index') }}"
                                     data-filter-tags="leave application">
                                     <i class="fa fa-rocket"></i>
                                     <span class="title">{{ __('menu.leaveApplication') }}</span>
                                     <span class="selected "></span>
                                 </a>
                             </li>
                         </ul>
                     </li>


                     <!-- Attendance -->
                     <!-- Recruitment -->
                     <li class="{{ isset($jobsOpen) ? $jobsOpen : '' }}">
                         <a href="#" data-filter-tags="recruitment">
                             <i class="fal fa-chair-office"></i>
                             <span class="nav-link-text" data-i18n="nav.recrutment">Recruitment</span>

                         </a>
                         <ul>
                             <li class="{{ isset($jobsPostedActive) ? $jobsPostedActive : '' }}">
                                 <a href="{{ route('admin.jobs.index') }}" data-filter-tags="job opening">
                                     <i class="fal fa-phone-laptop"></i>
                                     {{ __('menu.jobsPosted') }}</a>
                             </li>
                             <li class=" {{ isset($jobsApplicationActive) ? $jobsApplicationActive : '' }}">
                                 <a href="{{ route('admin.job_applications.index') }}"
                                     data-filter-tags="job application">
                                     <i class="fal fa-clipboard-check"></i>
                                     {{ __('menu.jobApplications') }}</a>
                             </li>
                         </ul>
                     </li>
                     <!-- Recruitment -->
                     <!-- Setting -->
                     <li class="{{ isset($csettingOpen) ? $csettingOpen : '' }}">
                         <a href="#" data-filter-tags="settings">
                             <i class="fal fa-cog"></i>
                             <span class="nav-link-text" data-i18n="nav.setting">{{ __('menu.settings') }}</span>
                             @if ($unpaid_invoices > 0)
                                 <span class="badge badge-danger">{{ $unpaid_invoices }}</span>
                             @else
                             @endif
                         </a>
                         <ul>

                             {{-- @if ($loggedAdmin->manager != 1)
                                 <li class="{{ isset($billingActive) ? $billingActive : '' }}">
                                     <a href="{{ route('admin.billing.index') }}" data-filter-tags="billing">
                                         <i class="fal fa-dollar"></i>
                                         {{ __('menu.billing') }}
                                         @if ($unpaid_invoices > 0)
                                             <span class="badge badge-danger">{{ $unpaid_invoices }}</span>
                                         @endif
                                     </a>

                                 </li>
                             @endif --}}
                             @if ($loggedAdmin->company->license_expired == 0)
                                 @if ($loggedAdmin->type != 'superadmin')
                                     @if ($loggedAdmin->manager != 1)
                                         <li class="{{ isset($csettingActive) ? $csettingActive : '' }}">
                                             <a href="{{ route('admin.general_setting.edit') }}"
                                                 data-filter-tags="general setting">
                                                 <i class="fal  fa-cog"></i>
                                                 {{ __('menu.generalSetting') }}</a>
                                         </li>
                                     @endif
                                 @endif

                                 @if ($loggedAdmin->type != 'superadmin')
                                     <li class="{{ isset($profileSettingActive) ? $profileSettingActive : '' }}">
                                         <a href="{{ route('admin.profile_settings.edit', 'profile') }}"
                                             data-filter-tags="profile setting">
                                             <i class="fal fa-user"></i>
                                             {{ __('menu.profileSetting') }}</a>
                                     </li>
                                 @endif

                                 <li
                                     class="nav-item {{ isset($notificationSettingActive) ? $notificationSettingActive : '' }}">
                                     <a href="{{ route('admin.notification.edit') }}"
                                         data-filter-tags="notification">
                                         <i class="fal fa-bell"></i>
                                         {{ __('menu.notificationSetting') }}</a>
                                 </li>

                                 @if ($loggedAdmin->manager != 1)
                                     {{-- <li class="{{ isset($cthemeSettingActive) ? $cthemeSettingActive : '' }}">
                                         <a href="{{ route('admin.company_setting.theme') }}"
                                             data-filter-tags="theme setting">
                                             <i class="fal fa-gem"></i>
                                             {{ __('menu.theme') }}</a>
                                     </li> --}}

                                     <li class="{{ isset($adminSettingActive) ? $adminSettingActive : '' }}">
                                         <a href="{{ route('admin.attendance_settings.edit') }}"
                                             data-filter-tags="attendance settings">
                                             <i class="fal fa-gears"></i>
                                             Attendance Settings</a>
                                     </li>

                                     <li class=" {{ isset($adminUserActive) ? $adminUserActive : '' }}">
                                         <a href="{{ route('admin.admin_users.index') }}"
                                             data-filter-tags="admin User">
                                             <i class="fal fa-user"></i>
                                             {{ __('menu.adminUser') }}</a>
                                     </li>
                                 @endif
                             @endif
                         </ul>
                     </li>
                 @endif
             @endif

         </ul>
         <div class="filter-message js-filter-message bg-success-600"></div>
     </nav>
     <!-- END PRIMARY NAVIGATION -->
     <!-- NAV FOOTER -->
 </aside>
 <!-- END Left Aside -->
