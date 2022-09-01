<li class="nav-item start {{ isset($superadmindashboardActive) ? $superadmindashboardActive : ''}}">
    <a class="nav-link"
       href="javascript: loadView('{{URL::route('superadmin.dashboard.index')}}')">
        <i class="fa fa-home"></i>
        <span class="title">{{__('menu.dashboard')}}</span>
        <span class="selected"></span>
    </a>
</li>
{{---------------------------------------/Super AdminDashboard-------------------------------}}
{{---------------------------------------Companies-------------------------------}}
<li class="nav-item {{ isset($companyActive) ? $companyActive : ''}}">
    <a class="nav-link"
       href="{{route('admin.companies.index')}}">
        <i class="fa fa-th-large"></i>
        <span class="title">Companies</span>
        <span class="selected "></span>
    </a>
</li>


{{-- <li class="nav-item {{ isset($contactRequestActive) ? $contactRequestActive : ''}}">
    <a class="nav-link"
       href="javascript: loadView('{{route('admin.contact_requests.index')}}')">
        <i class="fa fa-envelope"></i>
        Contact Requests</a>
</li> --}}


{{-- <li class="nav-item {{ isset($licenseTypesActive) ? $licenseTypesActive : ''}}">
    <a class="nav-link"
       href="javascript: loadView('{{route('admin.plans.index')}}')">
        <i class="fa fa-paper-plane"></i>
        Subscription Plans</a>
</li> --}}

{{-- <li class="nav-item {{ isset($invoicesActive) ? $invoicesActive : ''}}">
    <a class="nav-link"
       href="javascript: loadView('{{route('admin.invoices.index')}}')">
        <i class="fa fa-file"></i>
        Invoices</a>
</li> --}}

 <!-- <li class="{{ isset($superAdminUserActive) ? $superAdminUserActive : ''}}">
    <a href="{{route('admin.superadmin_users.index')}}">
        <i class="fa fa-user"></i>
        SuperAdmins</a>
</li>  -->
{{-- <li class="{{ isset($superAdminUserActive) ? $superAdminUserActive : '' }}">
    <a href="{{route('admin.superadmin_users.index')}}"
        data-filter-tags="superadmins">
        <i class="fal fa-user"></i>
        SuperAdmins</a>
</li> --}}
{{-- <li class="nav-item {{ $pagesActive??''}}">
    <a class="nav-link"
       href="javascript: loadView('{{route('admin.pages.index')}}')">
        <i class="fa fa-pagelines"></i>
        Pages</a>
</li> --}}
 <li class="{{ isset($faqCategoryActive) ? $faqCategoryActive : '' }}">
 <a href="#" title="setings" data-filter-tags="setings">
        <i class="fa fa-user"></i>
        <span class="nav-link-text" data-i18n="nav.pages"> CMS</span>
    </a>
    <ul>

        <li class="{{ isset($faqCategoryActive) ? $faqCategoryActive : ''}}">
            <a href="{{route('admin.faq_categories.index')}}">
                <i class="fa fa-file-text"></i>
                FAQ Category</a>
        </li>

        <li class="{{ isset($faqActive) ? $faqActive : ''}}">
            <a href="{{route('admin.faq.index')}}">
                <i class="fa fa-support"></i>
                FAQ</a>
        </li>



        <li class="{{ isset($featureActive) ? $featureActive : ''}}">
        <a href="{{route('admin.features.index','setting')}}"
                data-filter-tags="feature">
                <i class="fa  fa-briefcase"></i>
                <span class="nav-link-text"
                    data-i18n="nav.settings">Features</a></span>
            </a>
        </li>

    </ul>
</li> 


 <!-- HR -->
 <li class="{{ isset($settingActive) ? 'active' : '' }}">
    <a href="#" title="setings" data-filter-tags="setings">
        <i class="fa fa-cog"></i>
        <span class="nav-link-text" data-i18n="nav.pages">Settings</span>
    </a>
    <ul>
        <li class="{{ isset($generalSettingActive) ? $generalSettingActive : '' }}">
            <a href="{{route('admin.settings.edit','setting')}}"
                data-filter-tags="notice board">
                <i class="fa  fa-cog"></i>
                <span class="nav-link-text"
                    data-i18n="nav.settings">{{__('menu.generalSetting')}}</a></span>
            </a>
        </li>
        <li class="{{ isset($emailTemplateActive) ? $emailTemplateActive : '' }}">
            <a href="{{route('admin.email_templates.index')}}"
                data-filter-tags="email templates">
                <i class="fa fa-envelope"></i>
                <span class="nav-link-text"
                    data-i18n="nav.email-templates">{{__('menu.emailTemplate')}}</a></span>
            </a>
        </li>
         <li class="{{ isset($stripeSettingActive) ? $stripeSettingActive : '' }}">
            <a href="{{route('admin.stripe_settings')}}"
                data-filter-tags="payment setting">
                <i class="fa fa-cc-stripe"></i>
                <span class="nav-link-text"
                    data-i18n="nav.payment-settings">{{__('menu.paymentSetting')}}</span>
            </a>
        </li> 
        {{-- @if(env('APP_ENV') !=='demo')
            <li>
                <a href="{{action('\Barryvdh\TranslationManager\Controller@getIndex')}}"
                    data-filter-tags="translation manager">
                    <i class="fa fa-language"></i>
                    <span class="nav-link-text"
                        data-i18n="nav.email-templates"> {{__('menu.translationManager')}}</a></span>
                </a>
            </li>
        @endif --}}
        {{-- <li class="{{ isset($stripeSettingActive) ? $stripeSettingActive : ''}}">
            <a href="{{ route('admin.language.index')}}"
                data-filter-tags="languages">
                <i class="fa fa-language"></i>
                <span class="nav-link-text"
                data-i18n="nav.payment-settings">{{__('menu.language')}}</span>
            </a>
        </li> --}}
        {{-- @if($setting->system_update == 1)
            <li class="nav-item">
                <a href="{{route('admin.updateVersion.index')}}"
                    data-filter-tags="update logs">
                    <i class="fa fa-refresh"></i>
                    <span class="nav-link-text"
                    data-i18n="nav.update-log">{{__('menu.updateLog')}}</span>
                </a>
            </li>
        @endif --}}
        <li class="nav-item {{ isset($smtpSettingActive) ? $smtpSettingActive : ''}}">
            <a class="nav-link"
               href="{{route('admin.smtp_settings')}}">
                <i class="fa fa-envelope"></i>
                {{__('menu.smtpSetting')}}</a>
        </li>

        {{-- <li class="nav-item {{ isset($gdprSettingActive) ? $gdprSettingActive : ''}}">
            <a class="nav-link"
               href="javascript: loadView('{{route('admin.custom-modules.index')}}')">
                <i class="fa fa-suitcase"></i>
                {{__('menu.customModule')}}</a>
        </li> --}}
    </ul>
</li>

<!-- end HR -->
{{-- <li class="menu-dropdown classic-menu-dropdown {{ isset($settingActive) ? $settingActive : '' }}">
    <a href="javascript:;">
        <i class="fa fa-cog"></i> Settings
        <i class="fa fa-angle-down"></i>
    </a>
    <ul class="dropdown-menu pull-left">

        <li class="nav-item {{ isset($generalSettingActive) ? $generalSettingActive : ''}}">
            <a class="nav-link"
               href="javascript: loadView('{{route('admin.settings.edit','setting')}}')">
                <i class="fa  fa-cog"></i>
                {{__('menu.generalSetting')}}</a>
        </li>

        <li class="nav-item {{ isset($emailTemplateActive) ? $emailTemplateActive : ''}}">
            <a class="nav-link"
               href="javascript: loadView('{{route('admin.email_templates.index')}}')">
                <i class="icon-envelope"></i>
                {{__('menu.emailTemplate')}}</a>
        </li>

        <li class="nav-item {{ isset($stripeSettingActive) ? $stripeSettingActive : ''}}">
            <a class="nav-link"
               href="javascript: loadView('{{route('admin.stripe_settings')}}')">
                <i class="fa fa-cc-stripe"></i>
                {{__('menu.paymentSetting')}}</a>
        </li>
        @if(env('APP_ENV') !=='demo')
            <li class="nav-item">
                <a class="nav-link"
                   href="{{action('\Barryvdh\TranslationManager\Controller@getIndex')}}">
                    <i class="fa fa-language"></i>
                    {{__('menu.translationManager')}}</a>
            </li>
        @endif
        <li class="nav-item {{ isset($stripeSettingActive) ? $stripeSettingActive : ''}}">
            <a class="nav-link"
               href="javascript: loadView('{{route('admin.language.index')}}')">
                <i class="fa fa-language"></i>
                {{__('menu.language')}}</a>
        </li>
        @if($setting->system_update == 1)
            <li class="nav-item">
                <a class="nav-link"
                   href="javascript:;" onclick="loadView('{{route('admin.updateVersion.index')}}')">
                    <i class="fa fa-refresh"></i>
                    {{__('menu.updateLog')}}</a>
            </li>
        @endif
        <li class="nav-item {{ isset($smtpSettingActive) ? $smtpSettingActive : ''}}">
            <a class="nav-link"
               href="javascript: loadView('{{route('admin.smtp_settings')}}')">
                <i class="icon-envelope"></i>
                {{__('menu.smtpSetting')}}</a>
        </li>

        <li class="nav-item {{ isset($gdprSettingActive) ? $gdprSettingActive : ''}}">
            <a class="nav-link"
               href="javascript: loadView('{{route('admin.custom-modules.index')}}')">
                <i class="fa fa-suitcase"></i>
                {{__('menu.customModule')}}</a>
        </li>

    </ul>
</li> --}}
