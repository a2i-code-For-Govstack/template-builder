
<style>
    #nav2{
        width:100%;
        background-color:#C8E9FF  ;
        padding:5px 0 5px 0;
        display:flex;
        align-items:center;
        justify-content:center;
        flex-wrap:wrap;
        margin-bottom:30px;
    }
    .nav2-ref{
        text-decoration:none;
        color:black;
        font-weight:bolder;
        font-size:12px;
        margin:0 20px 0 20px;
    }
    a:hover{
        color:black;
        text-decoration:none;
    }
    .nav2-list{
        font-size:12px;
    }
    .nav2-ref.active{
        text-decoration:underline;
    }
</style>
<div id="nav2" class="ms-auto">
        <a   class="nav2-ref"href="{{ route('home') }}" >
            <span>
                DASHBOARD
            </span>
        </a>
        <a  class="nav2-ref"href="{{ route('collection') }}" >
            <span>
                COLLECTION
            </span>
        </a>
        <a  class="nav2-ref"href="{{ route('form.index') }}" >
            <span>
                EDITOR
            </span>
        </a>
        <a  class="nav2-ref"href="{{ route('home') }}" >
            <span>
                COLLABORATION
            </span>
        </a>
        <a  class="nav2-ref"href="{{ route('home') }}" >
            <span>
                ANYTHING
            </span>
        </a>
        @canany(['log-index', 'log-show', 'log-update', 'log-edit'])
            <a  class="nav2-ref"href="{{ route('log.info') }}" >
                <span >
                    API STORE LOG
                </span>
            </a>
        @endcanany
        @canany(['category-list', 'category-create', 'category-edit', 'category-delete'])
            <a class="nav2-ref"href="{{ route('category.list') }}" >
                <span >
                    CATEGORY
                </span>
            </a>
        @endcanany
        @canany(['form-list', 'form-create', 'form-edit', 'form-delete'])
            <div class="dropdown">
                <a class="nav2-ref dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <span >
                        TEMPLATE
                    </span>
                </a>

                <ul class="dropdown-menu" style="background-color:#ECF6FD;" aria-labelledby="formsDropdown">
                    <li><a class="nav2-list dropdown-item" href="{{ route('form.create') }}">Create</a></li>
                    <li><a class="nav2-list dropdown-item" href="{{ route('form.index') }}">List</a></li>
                </ul>
            </div>
         @endcanany
        @canany(['home-index', 'role-list', 'role-create', 'role-edit', 'role-delete', 'user-list', 'user-create',
           'user-edit', 'user-delete'])
            <div class="dropdown">
                <a class="nav2-ref dropdown-toggle" href="#" role="button"
                data-bs-toggle="dropdown">
                    <span >
                        ROLE & PERMISSION
                    </span>
                </a>

                <ul class="dropdown-menu" style="background-color:#ECF6FD;" aria-labelledby="formsDropdown1">
                    <li><a class="nav2-list dropdown-item" href="{{ route('usersrole') }}">User</a></li>
                    @canany([ 'role-list', 'role-create', 'role-edit', 'role-delete'])
                    <li><a class="nav2-list dropdown-item" href="{{ route('roles.index') }}">Role & Permission</a></li>
                    @endcanany
                </ul>
            </div>
        @endcanany
        
</div>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        let currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.nav2-ref');
        currentPath="http://127.0.0.1:8000"+currentPath;
        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });
    });
</script>