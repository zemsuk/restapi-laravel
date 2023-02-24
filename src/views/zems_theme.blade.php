
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zems Admin CMS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/zemsuk/zems_grid/zems_grid.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/main.css')}}" />
</head>
<body>    
    <main class="main">
        <aside class="side_bar">            
            <ul>
                <li class="brand">
                    <a href="{{url('/')}}">
                    <span class="icon"><img src="https://zems.uk/img/logo.png" alt="Logo"></span>
                    <span class="text">Zems API</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/')}}" title="Dashboard">
                    <span class="icon"><i class="fa-solid fa-gauge-high"></i></span>
                    <span class="text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/pos')}}" title="POS">
                    <span class="icon"><i class="fa-solid fa-solar-panel"></i></span>
                    <span class="text">POS</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/allergy')}}" title="Allergy">
                    <span class="icon"><i class="fa-solid fa-hand-dots"></i></span>
                    <span class="text">Allergy</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/category')}}" title="Category">
                    <span class="icon"><i class="fa-regular fa-object-group"></i></span>
                    <span class="text">Category</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/city')}}" title="City">
                    <span class="icon"><i class="fa-solid fa-city"></i></span>
                    <span class="text">City</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/locality')}}" title="Locality">
                    <span class="icon"><i class="fa-solid fa-building-user"></i></span>
                    <span class="text">Locality</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/schedule')}}" title="Schedule">
                    <span class="icon"><i class="fa-solid fa-clock"></i></span>
                    <span class="text">Schedule</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/tbl')}}" title="Table">
                    <span class="icon"><i class="fa-solid fa-dice-one"></i></span>
                    <span class="text">Table</span>
                    </a>
                </li>
                
                
                
                
                
                
                <li>
                    <a href="#" title="title">
                    <!-- <span class="icon"><i class="fa-regular fa-file-lines"></i></span> -->
                    <span class="text">Website Settings</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('/menu')}}" title="menu">
                            <span class="icon"><i class="fa-regular fa-file-lines"></i></span>
                            <span class="text">Menu</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/pages')}}" title="Pages">
                            <span class="icon"><i class="fa-regular fa-file-lines"></i></span>
                            <span class="text">Pages</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/sections')}}" title="Section">
                            <span class="icon"><i class="fa-solid fa-list"></i></span>
                            <span class="text">Section</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/seo')}}" title="Section">
                            <span class="icon"><i class="fa-brands fa-google"></i></span>
                            <span class="text">SEO</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/setting')}}" title="Setting">
                            <span class="icon"><i class="fa-solid fa-gear"></i></span>
                            <span class="text">Setting</span>
                            </a>
                        </li>
                        
                        
                        <li>
                            <a href="{{url('/user')}}" title="user">
                                <span class="icon"><i class="fa-solid fa-user"></i></span>
                                <span class="text">Profile</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <form action="{{url('/signout')}}" method="post">
                        @csrf
                        <span class="icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
                        <button class="text">Logout</button>
                    </form>
                </li>
            </ul>
        </aside>
        <content>
            @yield('content')
        </content>
    </main>    
</body>
</html>