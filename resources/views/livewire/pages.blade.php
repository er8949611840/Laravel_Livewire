<div>

    {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MBR CMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @forelse ($pages as $page)
                        <li class="nav-item @if ($page->children->isNotEmpty()) {{ 'dropdown' }} @endif">

                            @if ($page->children->isNotEmpty())
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $page->title }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @forelse ($page->children as $child)
                                        <li>
                                            <a class="dropdown-item" href="#">{{ $child->title }}</a>
                                        </li>
                                    @empty
                                    @endforelse

                                </ul>
                            @else
                                <a class="nav-link" aria-current="page"
                                    href="{{ route('show.page', $page->slug) }}">{{ $page->title }}</a>
                            @endif

                        </li>
                    @empty
                    @endforelse

                </ul>
                <a href="{{ route('create.page') }}" style="text-decoration: none;"
                    class="btn-primary btn-sm float-right">Add New Post</a>
            </div>
        </div>
    </nav> --}}

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a style="padding: 10px" class="navbar-brand" href="{{ route('get.page') }}">MBR CMS</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">

                @forelse ($pages as $page)
                    @if ($page->children->isEmpty())
                        <li class="nav-item"><a style="padding: 10px; text-decoration:none;"
                                href="{{ route('show.page', $page->slug) }}">{{ $page->title }}</a></li>
                    @else
                        <li class="root">
                            <a href="{{ route('show.page', $page->slug) }}" style="padding: 10px;text-decoration:none;"
                                class="dropdown-toggle" data-toggle="dropdown">
                                {{ $page->title }}
                                <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                @forelse ($page->children as $child)
                                    @if ($child->children->isEmpty())
                                        <li><a style="padding: 10px;text-decoration:none;"
                                                href="{{ route('show.page', [$page->slug, $child->slug]) }}">{{ $child->title }}</a>
                                        </li>
                                    @else
                                        <li class="dropdown-submenu"> <a style="padding: 10px;text-decoration:none;"
                                                href="{{ route('show.page', [$page->slug, $child->slug]) }}">{{ $child->title }}</a>
                                            <ul class="dropdown-menu">
                                                @forelse ($child->children as $subchild)
                                                    <li><a style="padding: 10px;text-decoration:none;" tabindex="-1"
                                                            href="{{ route('show.page', [$page->slug, $child->slug, $subchild->slug]) }}">{{ $subchild->title }}</a>
                                                    </li>
                                                @empty
                                                @endforelse
                                            </ul>
                                        </li>
                                    @endif

                                @empty
                                @endforelse
                            </ul>
                        </li>
                    @endif
                @empty
                @endforelse
                {{-- <li class="root">
                    <a href="#" style="padding: 10px" class="dropdown-toggle" data-toggle="dropdown">Multi Level
                        <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a style="padding: 10px" href="#">Level 1</a></li>
                        <li class="dropdown-submenu"> <a style="padding: 10px" tabindex="-1" href="#">More
                                options</a>
                            <ul class="dropdown-menu">
                                <li><a style="padding: 10px" tabindex="-1" href="#">Level 2</a>
                                </li>
                                <li class="dropdown-submenu"> <a style="padding: 10px" href="#">More..</a>
                                    <ul class="dropdown-menu">
                                        <li><a style="padding: 10px" href="#">Level 3</a>
                                        </li>
                                        <li><a style="padding: 10px" href="#">Level 3</a>
                                        </li>
                                        <li class="dropdown-submenu"> <a style="padding: 10px" href="#">More..</a>
                                            <ul class="dropdown-menu">
                                                <li><a style="padding: 10px" href="#">Level 4</a>
                                                </li>
                                                <li><a style="padding: 10px" href="#">Level 4</a>
                                                </li>
                                                <li class="dropdown-submenu"> <a style="padding: 10px"
                                                        href="#">More..</a>
                                                    <ul class="dropdown-menu">
                                                        <li><a style="padding: 10px" href="#">Level 5</a>
                                                        </li>
                                                        <li><a style="padding: 10px" href="#">Level 5</a>
                                                        </li>
                                                    </ul>
                                                </li>

                                            </ul>
                                        </li>

                                    </ul>
                                </li>
                                <li><a style="padding: 10px" href="#">Level 2</a>
                                </li>
                                <li><a style="padding: 10px" href="#">Level 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a style="padding: 10px" href="#">Level 1</a></li>
                    </ul>
                </li> --}}
            </ul>

        </div><!-- /.navbar-collapse -->
        <a href="{{ route('create.page') }}" style="text-decoration: none;" class="btn-primary btn-sm float-right">Add
            New Post</a>
    </nav>


</div>
