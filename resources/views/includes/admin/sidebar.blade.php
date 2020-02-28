@section('admin.sidebar-content')
<div class="sidebar">
<ul class="sidebarLinks">
    @permission(['ADMIN_ALL', 'ADMIN_*'])
    <li class="sidebarOuterLink">
        <a href="#" class="sidebarLink" data-toggle="tooltip" title="Dashboard">
            <i class="fas fa-th"></i>
            <span class="sidebarLinkText">Dashboard</span>
        </a>
    </li>
    @endpermission
    @permission(['ADMIN_ALL', 'ADMIN_USER_*'])
    <li class="sidebarOuterLink" id="user_item">
        <a href="/admin/user_list" class="sidebarLink" data-toggle="tooltip" title="Users" id="user_link">
            <i class="far fa-user"></i>
            <span class="sidebarLinkText" id="user_span">Users</span>
        </a>
    </li>
    @endpermission
    @permission(['ADMIN_ALL', 'ADMIN_ROLE_*'])
    <li class="sidebarOuterLink" id="role_item">
        <a href="/admin/role" class="sidebarLink" data-toggle="tooltip" title="Roles" id="role_link">
            <i class="fas fa-user-tie"></i>
            <span class="sidebarLinkText" id="role_span">Roles</span>
        </a>
    </li>
    @endpermission
    @permission(['ADMIN_ALL', 'ADMIN_PERMISSION_*'])
    <li class="sidebarOuterLink" id="permission_item">
        <a href="/admin/permission" class="sidebarLink" data-toggle="tooltip" title="Promotion" id="permission_link">
            <i class="fas fa-key"></i>
            <span class="sidebarLinkText" id="permission_span">Permission</span>
        </a>
    </li>
    @endpermission
    @permission(['ADMIN_ALL', 'ADMIN_CLIENT_*'])
    <li class="sidebarOuterLink" id="client_item">
        <a href="/admin/client" class="sidebarLink" data-toggle="tooltip" title="Clients" id="client_link">
            <i class="far fa-building"></i>
            <span class="sidebarLinkText" id="client_span">Clients</span>
        </a>
    </li>
    <li class="sidebarOuterLink" id="contact_item">
        <a href="/admin/client_contact" class="sidebarLink" data-toggle="tooltip" title="Clients" id="contact_link">
            <i class="far fa-building"></i>
            <span class="sidebarLinkText" id="contact_span">Clients Contact</span>
        </a>
    </li>
    @endpermission
    @role(['ACCOUNT_MANAGER'])
    <li class="sidebarOuterLink" id="amDashboard_item">
        <a href="/home" class="sidebarLink" data-toggle="tooltip" title="Clients" id="amDashboard_link">
            <i class="far fa-building"></i>
            <span class="sidebarLinkText" id="amDashboard_span">Dashboard</span>
        </a>
    </li>
    <li class="sidebarOuterLink" id="contact_item">
        <a href="/home" class="sidebarLink" data-toggle="tooltip" title="Clients" id="contact_link">
            <i class="far fa-building"></i>
            <span class="sidebarLinkText" id="contact_span">Add Requirement</span>
        </a>
    </li>
    <li class="sidebarOuterLink" id="contact_item">
        <a href="#" class="sidebarLink" data-toggle="tooltip" title="Clients" id="contact_link">
            <i class="far fa-building"></i>
            <span class="sidebarLinkText" id="contact_span">Interview Schedule</span>
        </a>
    </li>
    <li class="sidebarOuterLink" id="contact_item">
        <a href="#" class="sidebarLink" data-toggle="tooltip" title="Clients" id="contact_link">
            <i class="far fa-building"></i>
            <span class="sidebarLinkText" id="contact_span">Onboarding status</span>
        </a>
    </li>
    @endrole
    @role(['HR_LEAD'])
    <li class="sidebarOuterLink" id="tlDashboard_item">
        <a href="/home" class="sidebarLink" data-toggle="tooltip" title="Clients" id="tlDashboard_link">
            <i class="far fa-building"></i>
            <span class="sidebarLinkText" id="tlDashboard_span">Dashboard</span>
        </a>
    </li>
    <li class="sidebarOuterLink" id="contact_item">
        <a href="#" class="sidebarLink" data-toggle="tooltip" title="Clients" id="contact_link">
            <i class="far fa-building"></i>
            <span class="sidebarLinkText" id="contact_span">Interview Schedule</span>
        </a>
    </li>
    <li class="sidebarOuterLink" id="contact_item">
        <a href="#" class="sidebarLink" data-toggle="tooltip" title="Clients" id="contact_link">
            <i class="far fa-building"></i>
            <span class="sidebarLinkText" id="contact_span">Profile Screening</span>
        </a>
    </li>
    <li class="sidebarOuterLink" id="contact_item">
        <a href="#" class="sidebarLink" data-toggle="tooltip" title="Clients" id="contact_link">
            <i class="far fa-building"></i>
            <span class="sidebarLinkText" id="contact_span">Profile Search</span>
        </a>
    </li>
    @endrole
    @role(['HR_RECRUITER'])
    <li class="sidebarOuterLink" id="recruiterDashboard_item">
        <a href="/home" class="sidebarLink" data-toggle="tooltip" title="Clients" id="recruiterDashboard_link">
            <i class="far fa-building"></i>
            <span class="sidebarLinkText" id="recruiterDashboard_span">Dashboard</span>
        </a>
    </li>
    <li class="sidebarOuterLink" id="contact_item">
        <a href="#" class="sidebarLink" data-toggle="tooltip" title="Clients" id="contact_link">
            <i class="far fa-building"></i>
            <span class="sidebarLinkText" id="contact_span">Interview Listing</span>
        </a>
    </li>
    <li class="sidebarOuterLink" id="contact_item">
        <a href="#" class="sidebarLink" data-toggle="tooltip" title="Clients" id="contact_link">
            <i class="far fa-building"></i>
            <span class="sidebarLinkText" id="contact_span">Profile Screening</span>
        </a>
    </li>
    <li class="sidebarOuterLink" id="contact_item">
        <a href="#" class="sidebarLink" data-toggle="tooltip" title="Clients" id="contact_link">
            <i class="far fa-building"></i>
            <span class="sidebarLinkText" id="contact_span">Profile Search</span>
        </a>
    </li>
    <li class="sidebarOuterLink" id="contact_item">
        <a href="#" class="sidebarLink" data-toggle="tooltip" title="Clients" id="contact_link">
            <i class="far fa-building"></i>
            <span class="sidebarLinkText" id="contact_span">Onboarding status</span>
        </a>
    </li>
    @endrole
 </ul>
</div>
@endsection