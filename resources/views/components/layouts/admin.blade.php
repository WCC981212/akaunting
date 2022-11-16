<!DOCTYPE html>
<html dir="{{ language()->direction() }}" lang="{{ app()->getLocale() }}">
    <x-layouts.admin.head>
        @if (! empty($metaTitle))
        <x-slot name="metaTitle">
            {!! !empty($metaTitle->attributes->has('title')) ? $metaTitle->attributes->get('title') : $metaTitle !!}
        </x-slot>
        @endif

        <x-slot name="title">
            {!! !empty($title->attributes->has('title')) ? $title->attributes->get('title') : $title !!}
        </x-slot>
    </x-layouts.admin.head>

    @mobile
    <body class="g-sidenav-hidden bg-body">
    @elsemobile
    <body class="g-sidenav-show bg-body">
    @endmobile

        @stack('body_start')

        <x-layouts.admin.menu />

        <div class="main-content xl:ltr:ml-64  xl:rtl:mr-64 transition-all ease-in-out" id="panel">
            <div id="main-body">
                <div class="container">
                    <x-layouts.admin.header>
                        <x-slot name="title">
                            {!! ! empty($title->attributes->has('title')) ? $title->attributes->get('title') : $title !!}
                        </x-slot>

                        @if (! empty($status))
                            <x-slot name="status">
                                {!! $status !!}
                            </x-slot>
                        @endif

                        @if (! empty($info))
                            <x-slot name="info">
                                {!! $info !!}
                            </x-slot>
                        @endif

                        @if (! empty($favorite) || (! empty($favorite) && $favorite->attributes->has('title')))
                            @if (! $favorite->attributes->has('title'))
                                <x-slot name="favorite">
                                    {!! $favorite !!}
                                </x-slot>
                            @else
                                @php
                                    $favorite = [
                                        'title' => $favorite->attributes->get('title'),
                                        'icon' => $favorite->attributes->get('icon'),
                                        'route' => !empty($favorite->attributes->has('route')) ? $favorite->attributes->get('route') : '',
                                        'url' => !empty($favorite->attributes->has('url')) ? $favorite->attributes->get('url') : '',
                                    ];
                                @endphp

                                <x-slot name="favorite">
                                    <x-menu.favorite
                                        :title="$favorite['title']"
                                        :icon="$favorite['icon']"
                                        :route="$favorite['route']"
                                        :url="$favorite['url']"
                                    />
                                </x-slot>
                            @endif
                        @endif

                        <x-slot name="buttons">
                            {!! $buttons ?? '' !!}
                        </x-slot>

                        <x-slot name="moreButtons">
                            {!! $moreButtons ?? '' !!}
                        </x-slot>
                    </x-layouts.admin.header>

                    <x-layouts.admin.content>
                        <x-layouts.admin.notifications />

                        {!! $content !!}
                    </x-layouts.admin.content>

                    <x-layouts.admin.footer />
                </div>
            </div>
        </div>

        @stack('body_end')

        <x-layouts.admin.scripts />
    </body>
</html>