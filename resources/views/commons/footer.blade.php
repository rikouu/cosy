@php
    $socials = Blog::socials();
    $info = Blog::info();
    $description = $info['description'] ?? '';
    $name = Cosy::name();
    $year = implode('-', array_flip(array_flip([$info['year'] ?? date('Y'), date('Y')])));
@endphp

<footer class="footer bg-dark pt-4 pt-md-5">
    <div class="container">
        <div class="row my-n3">
            <div class="col py-3">
                <div class="footer-widget pr-lg-5">
                    <div class="footer-widget-header">{{ $name }}</div>
                    <div class="footer-widget-content">
                        <p>{{ $description }}</p>
                    </div>
                    <div class="footer-widget-social mx-n2 mt-2">
                        @foreach($socials as $social => $value)
                            @if (is_array($value))
                                <a href="javascript:" class="single-popup {{ $social }} px-2"
                                   data-img="{{ $value['img'] }}" data-title="{{ $value['title'] }}"
                                   data-desc="{{ $value['desc'] }}"><i class="iconfont icon-{{ $social }}"></i></a>
                            @else
                                <a href="{{ $value }}" target="_blank" class="px-2" rel="nofollow">
                                    <span><i class="iconfont icon-{{ $social }}"></i></span>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-3 py-3">
                <div class="footer-widget">
                    <div class="footer-widget-header">{{ __('Tag') }}</div>
                    <div class="footer-widget-content">
                        <div class="footer-widget-links">
                            @foreach(Blog::footerTags() as $tag)
                                <a href="{{ $tag->getLink() }}" target="_self">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 py-3">
                @if(routeIs('home'))
                    <div class="footer-widget">
                        <div class="footer-widget-header">{{ __('prism.footer.links') }}</div>
                        <div class="footer-widget-content">
                            <div class="footer-widget-links">
                                @foreach(Blog::links() as $link)
                                    <a href="{{ $link->url }}" target="{{ $link->target }}">
                                        {{ $link->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div class="footer-widget">
                        <div class="footer-widget-header">{{ __('Category') }}</div>
                        <div class="footer-widget-content">
                            <div class="footer-widget-links m-n1">
                                @foreach(Blog::footerCategories() as $category)
                                    <a href="{{ $category->getLink() }}" target="_self">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="footer-copyright border-top py-4 mt-4">
            Copyright © {{ $year }} <a href="{{ url('/') }}" title="{{ $name }}" rel="home">{{ $name }}</a>.
            Designed by <a href="https://loyep.com" title="Prism" target="_blank">Loyep</a>.
            @if(routeIs('home') && !empty(config('prism.app.miitbeian')))
                <a href="http://beian.miit.gov.cn/" target="_blank" rel="nofollow"
                   class="d-none d-lg-inline-block">{{ config('prism.app.miitbeian') }}
                </a>
            @endif
        </div>
    </div>
</footer>

{{-- <div class="back-to-top" id="back-to-top">
    <span class="icon-stack">
        <i class="text-sm iconfont icon-backtop"></i>
        <span class="back-to-top-text">{{ __('Top') }}</span>
    </span>
</div> --}}

<back-top class="back-to-top" id="back-to-top">
    <span class="icon-stack">
        <i class="text-sm iconfont icon-backtop"></i>
        <span class="back-to-top-text">{{ __('Top') }}</span>
    </span>
</back-top>

@include('components.popup.search')
