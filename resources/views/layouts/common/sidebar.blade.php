<style>
    .side-text{
        text-decoration: none;
    }
    .sidebar{
        z-index: 2;
    }
    
</style>
<div id="mySidebar" class="sidebar">
    <div class="nav text-end mx-4">
        <a class="my-2 py-2 text-start active" href="{{ route('home') }}" style="text-decoration:none;">
            <span class="px-2 side-text">
                <i class='bx bxs-dashboard text-primary '></i>
                Dashboard
            </span>
        </a>
        @canany(['log-index', 'log-show', 'log-update', 'log-edit'])
            <a class="my-2 py-2 text-start active" href="{{ route('log.info') }}" style="text-decoration:none;">
                <span class="px-2 side-text">
                    <i class='bx bx-data text-primary' ></i>
                    Api Store Log
                </span>
            </a>
        @endcanany
        @canany(['category-list', 'category-create', 'category-edit', 'category-delete'])
            <a class="my-2 py-2 text-start active" href="{{ route('category.list') }}" style="text-decoration:none;">
                <span class="px-2 side-text">
                    <i class='bx bx-data text-primary' ></i>
                    Category
                </span>
            </a>
        @endcanany
        @canany(['form-list', 'form-create', 'form-edit', 'form-delete'])
            <div class="dropdown">
                <a class="my-2 py-2 text-start dropdown-toggle" href="#" role="button" id="formsDropdown"
                    data-bs-toggle="dropdown" aria-expanded="true" style="text-decoration:none;">
                    <span class="px-2 side-text" > <i class='bx bx-paperclip text-primary' ></i>
                        Templates
                    </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-custom mx-4 bg-white" aria-labelledby="formsDropdown">
                    <li><a class="dropdown-item" href="{{ route('form.create') }}">Create</a></li>
                    <li><a class="dropdown-item" href="{{ route('form.index') }}">List</a></li>
                </ul>
            </div>
         @endcanany
        @canany(['home-index', 'role-list', 'role-create', 'role-edit', 'role-delete', 'user-list', 'user-create',
           'user-edit', 'user-delete'])
            <div class="dropdown">
                <a class="my-2 py-2 text-start dropdown-toggle" href="#" role="button" id="formsDropdown1"
                    data-bs-toggle="dropdown" aria-expanded="true" style="text-decoration:none;">
                    <span class="px-2 side-text"> <i class='bx bx-paperclip text-primary' ></i>
                        Role & Permission
                    </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-custom mx-4 bg-white" aria-labelledby="formsDropdown1">
                    <li><a class="dropdown-item" href="{{ route('usersrole') }}">User</a></li>
                    @canany([ 'role-list', 'role-create', 'role-edit', 'role-delete'])
                    <li><a class="dropdown-item" href="{{ route('roles.index') }}">Role & Permission</a></li>
                    @endcanany
                </ul>
            </div>
        @endcanany
    </div>
</div>
