<header class="header bg-black py-[10px]">
    <div class="container" data-aos="fade-down"
        data-aos-easing="linear"
        data-aos-duration="1500">
        <div class="topbar text-end mb-[5px]">
            <a href="#" class="text-white font-secondary "><span class="pe-[10px] text-[#0079D4]"><i class="fa-solid fa-envelope"></i></span>youremailhere@.com</a>
        </div>
        <div class="border-b border-bottom mb-[10px]"></div>
        <div class="grid grid-cols-4 lg:grid-cols-3 items-center justify-between">
            <div class="logo">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('/admin/assets/images/page') }}/{{ $home_page_data['header_logo'] }}" alt="logo">
                </a>
            </div>
            <div class="">
                <nav>
                    <ul class="flex  primary-navs font-secondary text-white justify-between">
                        <div class="close-icon">
                            <i class="fa-solid fa-xmark menu-toggle"></i>
                        </div>
                        <li><a href="{{ route('index') }}" class="{{ request()->routeIs('index') ? 'active' : '' }}">Home</a></li>
                        <li><a href="#" class="{{ request()->routeIs('about-us') ? 'active' : '' }}">About us</a></li>
                        {{-- <li>
                            <select class="block w-full focus:outline-none">
                                <option value="" selected>Services</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->slug }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </li>  --}}

                        <li><a href="{{ route('trainers') }}" class="{{ request()->routeIs('trainers') ? 'active' : '' }}">Trainers</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#" class="{{ request()->routeIs('contact-us') ? 'active' : '' }}">Contact us</a></li>
                    </ul>
                </nav>
            </div>
            <div class="text-end">
                <a href="" class="btn primary-btn border border-transparent">Try for FREE</a>
            </div>
            <div class="menu-icon flex justify-end">
                <i class="fa-solid fa-bars menu-toggle"></i>
            </div>
        </div>
    </div>
</header>