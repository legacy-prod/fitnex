<style>
    .treeview-menu {
    display: none;
}

.treeview.active .treeview-menu {
    display: block;
}
</style>
<aside class="main-sidebar" style="margin-top: 120px;">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="treeview mt-2">
                <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') || request()->is('profile/*') ? 'active' : '' }}">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview mt-2 {{ ( request()->is('project_category') || request()->is('project_category/create') || request()->is('project_category/*/edit') || request()->is('projects') || request()->is('projects/create') || request()->is('projects/*/edit') || request()->is('projects/*') || request()->is('member_directory') || request()->is('member_directory/create') || request()->is('member_directory/*/edit')) ? 'active' : '' }}" style="height: auto;">
                <a href="#" class="{{ ( request()->is('project_category') || request()->is('project_category/create') || request()->is('project_category/*/edit') || request()->is('projects') || request()->is('projects/create') || request()->is('projects/*/edit') || request()->is('projects/*') || request()->is('member_directory') || request()->is('member_directory/create') || request()->is('member_directory/*/edit')) ? 'active' : '' }}">
                    <i class="fa fa-files-o"></i>
                    <span>Project Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display: {{ ( request()->is('project_category') || request()->is('project_category/create') || request()->is('project_category/*/edit') || request()->is('projects') || request()->is('projects/create') || request()->is('projects/*/edit') || request()->is('projects/*') || request()->is('member_directory') || request()->is('member_directory/create') || request()->is('member_directory/*/edit')) ? 'block' : 'none' }};">
                
                    <li class="treeview mt-2 {{ ( request()->is('project_category') || request()->is('project_category/create') || request()->is('project_category/*/edit') || request()->is('projects') || request()->is('projects/create') || request()->is('projects/*/edit') || request()->is('projects/*')) ? 'active' : '' }}" style="height: auto;">
                        <a href="#" class="{{ ( request()->is('project_category') || request()->is('project_category/create') || request()->is('project_category/*/edit') || request()->is('projects') || request()->is('projects/create') || request()->is('projects/*/edit') || request()->is('projects/*')) ? 'active' : '' }}">
                            <i class="fa fa-files-o"></i>
                            <span>My Projects</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
        
                        <ul class="treeview-menu" style="display: {{ (request()->is('projects') || request()->is('projects/create') || request()->is('projects/*/edit') || request()->is('projects/*') || request()->is('project_category') || request()->is('project_category/create') || request()->is('project_category/*/edit')) ? 'block' : 'none' }};">
                        
        
                           {{--  @can('project_category-list')
                            <li class="treeview mt-2">
                                <a href="{{ route('project_category.index') }}" class="{{ request()->is('project_category') || request()->is('project_category/create') || request()->is('project_category/*/edit') ? 'active' : '' }}">
                                    <i class="fa fa-code-fork"></i> <span>Project Categories</span>
                                </a>
                            </li>
                            @endcan --}}
                           
                            @can('projects-list')
                            <li class="treeview mt-2">
                                <a href="{{ route('projects.index') }}" class="{{ request()->is('projects') || request()->is('projects/create') || request()->is('projects/*/edit') || request()->is('projects/*') ? 'active' : '' }}">
                                    <i class="fa fa-sitemap"></i> <span>Project Listings</span>
                                </a>
                            </li>
                            @endcan

                            
                        </ul>
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
                    
                </ul>
            </li>
            @can('client_contact-list')
                <li class="treeview"> 
                    <a href="{{ route('client_contact.index') }}" class="{{ request()->is('client_contact') || request()->is('client_contact/create') || request()->is('client_contact/*/edit') ? 'active' : '' }}">
                        <i class="fa fa-envelope"></i> <span>Contact Me</span>
                    </a>
                </li>
            @endcan 
    </section>
</aside>
<script>
    $(document).ready(function() {
    // Toggle only the direct child submenus (i.e., prevent inner submenus from opening)
    $('.treeview > a').click(function(e) {
        var parent = $(this).parent('.treeview');
        
        // Toggle only the first level submenu
        var submenu = parent.find('.treeview-menu').first();
        
        // Check if the submenu is already active, if not, slide it down; if yes, slide it up
        submenu.stop(true, true).slideToggle();
        
        // Toggle 'active' class on parent
        parent.toggleClass('active');

        // Prevent event bubbling so inner submenus don't get toggled
        e.stopPropagation();
    });
});

</script>