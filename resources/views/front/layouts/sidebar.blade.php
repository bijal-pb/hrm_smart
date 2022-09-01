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
             <img src="{{ $employee->profile_image_url }}" class="profile-image rounded-circle">
             <div class="info-card-text">
                 <a href="#" class="d-flex align-items-center text-white">
                     <span class="text-truncate text-truncate-sm d-inline-block">
                         {{ $employee->full_name }}
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
             <!-- dashboard -->
             <li class="{{ request()->is('panel/dashboard') ? 'active' : '' }}">
                 <a href="{{ route('dashboard.index') }}" title="Dashboard" data-filter-tags="dashboard">
                     <i class="fal fa-tachometer "></i>
                     <span class="nav-link-text" data-i18n="nav.programs">Dashboard</span>
                 </a>
             </li>

             {{-- Task --}}
             <li class="{{ isset($taskActive) ? 'active' : '' }}">
                 <a href="{{ route('front.employee_tasks.index') }}" title="employee task"
                     data-filter-tags="employee task">
                     <i class="fal fa-user-clock"></i>
                     <span class="nav-link-text" data-i18n="nav.employee_task">Tasks</span>
                 </a>
             </li>

             {{-- Assign project --}}

             {{-- <li class="{{ isset($assignprojectActive) ? 'active' : '' }}">
                <a href="{{ route('front.assign_projects.index') }}" title="assigned projects"
                    data-filter-tags="assigned projects">
                    <i class="fal fa-calendar-check"></i>
                    <span class="nav-link-text" data-i18n="nav.assign_projects">Assigned Projects</span>
                </a>
            </li> --}}
             <!-- Leave -->

             @if ($setting->leave_feature == 1)
                 <li class="{{ isset($leaveActive) ? 'active' : '' }}">
                     <a href="#" title="Leaves" data-filter-tags="Leaves">
                         <i class="fal fa-laptop-house"></i>
                         <span class="nav-link-text" data-i18n="nav.pages">{{ __('menu.leave') }}</span>
                     </a>
                     <ul>
                         <li><a href="" onclick="leaveModal(); return false;" title="apply leave"
                                 data-filter-tags="apply leave">
                                 <i class="fal fa-check-square"></i>
                                 <span class="nav-link-text" data-i18n="nav.apply_leave">
                                     {{ __('menu.applyLeave') }}
                                 </span>
                             </a>
                         </li>
                         <li>
                             <a href="{{ route('leaves.index') }}" title="My Leaves" data-filter-tags="my leaves">
                                 <i class="fal fa-calendar-alt"></i>
                                 <span class="nav-link-text"
                                     data-i18n="nav.my_leave">{{ __('menu.myLeave') }}</span>
                             </a>
                         </li>
                     </ul>
                 </li>
             @endif

             <!-- End Leave -->

             <!-- Self -->
             <li class="{{ isset($accountActive) ? 'active' : '' }}">
                 <a href="#" title="Self" data-filter-tags="Self">
                     <i class="fal fa-portrait"></i>
                     <span class="nav-link-text" data-i18n="nav.pages">@lang('menu.self')</span>
                 </a>
                 <ul>
                     @if ($setting->payroll_feature == 1)
                         <li><a href="{{ route('front.salary') }}" title="salary slip"
                                 data-filter-tags="salary slip">
                                 <i class="fal fa-receipt"></i>
                                 <span class="nav-link-text" data-i18n="nav.salary_slip">
                                     {{ __('menu.salarySlip') }}
                                 </span>
                             </a>
                         </li>
                     @endif
                     @if ($setting->expense_feature == 1)
                         <li>
                             <a href="{{ route('front.expenses.index') }}" title="expense"
                                 data-filter-tags="expense">
                                 <i class="fal fa-comment-dollar"></i>
                                 <span class="nav-link-text"
                                     data-i18n="nav.expense">{{ trans('menu.expenseFront') }}</span>
                             </a>
                         </li>
                     @endif
                 </ul>
             </li>

             <!-- end self -->

             <!-- job vacancies -->
             @if ($setting->jobs_feature == 1)
                 <li class="{{ isset($jobActive) ? 'active' : '' }}">
                     <a href="{{ route('jobs.index') }}" title="job vacancies" data-filter-tags="job vacancies">
                         <i class="fal fa-mail-bulk "></i>
                         <span class="nav-link-text" data-i18n="nav.job_vacancies">{{ __('menu.job') }}</span>
                     </a>
                 </li>
             @endif
             <!-- end job vacancies -->

             <!-- Attendance -->
             <li class="{{ request()->is('panel/front/attendance') ? 'active' : '' }}">
                 <a href="{{ route('front.attendance.index') }}" title="attendance" data-filter-tags="attendance">
                     <i class="fal fa-user-check "></i>
                     <span class="nav-link-text" data-i18n="nav.attendance">{{ __('core.attendance') }}</span>
                 </a>
             </li>
             <!-- Attendance -->

         </ul>
         <div class="filter-message js-filter-message bg-success-600"></div>
     </nav>
     <!-- END PRIMARY NAVIGATION -->
     <!-- NAV FOOTER -->
 </aside>
 <!-- END Left Aside -->
