<aside class="main-sidebar" style="margin-top: 120px;">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') || request()->is('profile/*') ? 'active' : '' }}">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview mt-2 {{ (request()->is('services') || request()->is('services/create') || request()->is('services/*/edit') || request()->is('member_directory') || request()->is('member_directory/create') || request()->is('member_directory/*/edit')) ? 'active' : '' }}" style="height: auto;">
                <a href="#" class="{{ (request()->is('services') || request()->is('services/create') || request()->is('services/*/edit') || request()->is('member_directory') || request()->is('member_directory/create') || request()->is('member_directory/*/edit')) ? 'active' : '' }}">
                    <i class="fa fa-files-o"></i>
                    <span>Member Directory</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu" style="display: {{ (request()->is('member_directory') || request()->is('member_directory/create') || request()->is('member_directory/*/edit') || request()->is('services') || request()->is('services/create') || request()->is('services/*/edit')) ? 'block' : 'none' }};">
                
                    @can('services-list')
                    <li class="treeview mt-2" >
                        <a href="{{ route('services.index') }}" class="{{ request()->is('services') || request()->is('services/create') || request()->is('services/*/edit') ? 'active' : '' }}">
                            <i class="fa fa-code-fork"></i> <span>All Services</span>
                        </a>
                    </li>
                    @endcan
                   
                    @can('member_directory-list')
                    <li class="treeview mt-2">
                        <a href="{{ route('member_directory.index') }}" class="{{ request()->is('member_directory') || request()->is('member_directory/create') || request()->is('member_directory/*/edit') ? 'active' : '' }}">
                            <i class="fa fa-sitemap"></i> <span>Add Member</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
           {{--  <li class="treeview {{ ( request()->is('jobpost') || request()->is('jobpost/create') || request()->is('jobpost/*/edit')) ? 'active' : '' }}" style="height: auto;">
                <a href="#" class="{{ ( request()->is('jobpost') || request()->is('jobpost/create') || request()->is('jobpost/*/edit')) ? 'active' : '' }}">
                    <i class="fa fa-files-o"></i>
                    <span>Contractor</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display: {{ ( request()->is('jobpost') || request()->is('jobpost/create') || request()->is('jobpost/*/edit')) ? 'block' : 'none' }};">
                
                    <li class="treeview mt-2">
                        <a href="#" class="">
                            <i class="fa fa-handshake-o"></i> <span>Browse Project Jobs</span>
                        </a>
                    </li> 
        
                    <li class="treeview mt-2">
                        <a href="#" class="">
                            <i class="fa fa-handshake-o"></i> <span>My Proposals</span>
                        </a>
                    </li> 
                    

                    <li class="treeview mt-2">
                        <a href="#" class="">
                            <i class="fa fa-handshake-o"></i> <span>Profile & Qualifications</span>
                        </a>
                    </li>
                    <li class="treeview mt-2">
                        <a href="#" class="">
                            <i class="fa fa-handshake-o"></i> <span>Notifications & Updates</span>
                        </a>
                    </li>
                </ul>
            </li> --}}
            {{-- <li class="treeview">
                <a href="{{ route('advertisement.index') }}" class="{{ request()->is('advertisement') || request()->is('advertisement/create') || request()->is('advertisement/*/edit') ? 'active' : '' }}">
                    <i class="fa fa-tasks"></i> <span>All Advertisements</span>
                </a>
            </li> --}}
            {{--  <li class="treeview">
                <a href="{{ route('user.profile.edit') }}" class="{{ request()->is('user/profile/edit') || request()->is('profile/*') ? 'active' : '' }}">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span>Edit Profile</span>
                </a>
            </li> --}}

            {{--<!-- <li class="treeview">
                <a href="{{ route('property.index') }}" class="{{ request()->is('property') || request()->is('property/create') || request()->is('property/*/edit') ? 'active' : '' }}">
                    <i class="fa fa-tasks"></i> <span>All Properties</span>
                </a>
            </li> -->--}}
        </ul>
    </section>
</aside>
