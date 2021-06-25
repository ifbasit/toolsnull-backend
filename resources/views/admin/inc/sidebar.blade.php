<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Website
            </div>

           

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="far fa-newspaper"></i>
                    <span>Articles</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Articles:</h6>
                        <a class="collapse-item" href="new-article.php">Add</a>
                         <h6 class="collapse-header">Categories</h6>
                        <a class="collapse-item" href="{{route('categories')}}">Manage</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Code Solution Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities-1" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-code"></i>
                    <span>Code Solution</span>
                </a>
                <div id="collapseUtilities-1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Code Solution</h6>
                        <a class="collapse-item" href="{{route('code-solution')}}">Manage</a>
                         <h6 class="collapse-header">Tags</h6>
                        <a class="collapse-item" href="{{route('tags')}}">Manage</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Tools Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities-2" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Tools</span>
                </a>
                <div id="collapseUtilities-2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Tools:</h6>
                        <a class="collapse-item" href="add-tools.php">Add</a>
                        <a class="collapse-item" href="view-tools.php">New</a>
                    </div>
                </div>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Others
            </div>


            <!-- Nav Item - Settings Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings" aria-expanded="true" aria-controls="collapseSettings">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Settings</span>
                </a>
                <div id="collapseSettings" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Settings:</h6>
                        <a class="collapse-item" href="{{route('social-links')}}">Social Links</a>
                        <a class="collapse-item" href="{{route('personal-information')}}">Information</a>
                        <a class="collapse-item" href="{{route('site-content')}}">Site Content</a>
                        <a class="collapse-item" href="{{route('testimonials')}}">Testimonials</a>
                        <a class="collapse-item" href="{{route('update-password')}}">Password</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>