<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Keyword Ranking Report for SEO Tracking</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg,
        video {
            display: block;
            vertical-align: middle
        }

        video {
            max-width: 100%;
            height: auto
        }

        .table {
            width: 100% !important;
        }

        .bg-white {
            --bg-opacity: 1;
            background-color: #fff;
            background-color: rgba(255, 255, 255, var(--bg-opacity))
        }

        .bg-gray-100 {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity))
        }

        .border-gray-200 {
            --border-opacity: 1;
            border-color: #edf2f7;
            border-color: rgba(237, 242, 247, var(--border-opacity))
        }

        .border-t {
            border-top-width: 1px
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .font-semibold {
            font-weight: 600
        }

        .h-5 {
            height: 1.25rem
        }

        .h-8 {
            height: 2rem
        }

        .h-16 {
            height: 4rem
        }

        .text-sm {
            font-size: .875rem
        }

        .text-lg {
            font-size: 1.125rem
        }

        .leading-7 {
            line-height: 1.75rem
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .ml-1 {
            margin-left: .25rem
        }

        .mt-2 {
            margin-top: .5rem
        }

        .mr-2 {
            margin-right: .5rem
        }

        .ml-2 {
            margin-left: .5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-8 {
            margin-top: 2rem
        }

        .ml-12 {
            margin-left: 3rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .max-w-6xl {
            max-width: 72rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .overflow-hidden {
            overflow: hidden
        }

        .p-6 {
            padding: 1.5rem
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .pt-8 {
            padding-top: 2rem
        }

        .fixed {
            position: fixed
        }

        .relative {
            position: relative
        }

        .top-0 {
            top: 0
        }

        .edit {

            display: inline-block;
            outline: none;
            cursor: pointer;
            border-radius: 3px;
            font-size: 14px;
            font-weight: 500;
            /* line-height: 16px; */
            padding: 5px 12px;
            /* height: 38px; */
            min-width: 96px;
            min-height: 38px;
            border: none;
            color: #fff;
            background-color: rgb(88, 101, 242);
            transition: background-color .17s ease, color .17s ease;

            :hover {
                background-color: rgb(71, 82, 196);
            }

        }

        .right-0 {
            right: 0
        }

        .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06)
        }

        .text-center {
            text-align: center
        }

        .text-gray-200 {
            --text-opacity: 1;
            color: #edf2f7;
            color: rgba(237, 242, 247, var(--text-opacity))
        }

        .text-gray-300 {
            --text-opacity: 1;
            color: #e2e8f0;
            color: rgba(226, 232, 240, var(--text-opacity))
        }

        .text-gray-400 {
            --text-opacity: 1;
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--text-opacity))
        }

        .text-gray-500 {
            --text-opacity: 1;
            color: #a0aec0;
            color: rgba(160, 174, 192, var(--text-opacity))
        }

        .text-gray-600 {
            --text-opacity: 1;
            color: #718096;
            color: rgba(113, 128, 150, var(--text-opacity))
        }

        .text-gray-700 {
            --text-opacity: 1;
            color: #4a5568;
            color: rgba(74, 85, 104, var(--text-opacity))
        }

        .text-gray-900 {
            --text-opacity: 1;
            color: #1a202c;
            color: rgba(26, 32, 44, var(--text-opacity))
        }

        .underline {
            text-decoration: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .w-5 {
            width: 1.25rem
        }

        .w-8 {
            width: 2rem
        }

        .w-auto {
            width: auto
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }

        @media (min-width:640px) {
            .sm\:rounded-lg {
                border-radius: .5rem
            }

            .sm\:block {
                display: block
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-start {
                justify-content: flex-start
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:h-20 {
                height: 5rem
            }

            .sm\:ml-0 {
                margin-left: 0
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width:768px) {
            .md\:border-t-0 {
                border-top-width: 0
            }

            .md\:border-l {
                border-left-width: 1px
            }

            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width:1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }

        @media (prefers-color-scheme:dark) {
            .dark\:bg-gray-800 {
                --bg-opacity: 1;
                background-color: #2d3748;
                background-color: rgba(45, 55, 72, var(--bg-opacity))
            }

            .dark\:bg-gray-900 {
                --bg-opacity: 1;
                background-color: #1a202c;
                background-color: rgba(26, 32, 44, var(--bg-opacity))
            }

            .dark\:border-gray-700 {
                --border-opacity: 1;
                border-color: #4a5568;
                border-color: rgba(74, 85, 104, var(--border-opacity))
            }

            .dark\:text-white {
                --text-opacity: 1;
                color: #fff;
                color: rgba(255, 255, 255, var(--text-opacity))
            }

            .dark\:text-gray-400 {
                --text-opacity: 1;
                color: #cbd5e0;
                color: rgba(203, 213, 224, var(--text-opacity))
            }

            .dark\:text-gray-500 {
                --tw-text-opacity: 1;
                color: #6b7280;
                color: rgba(107, 114, 128, var(--tw-text-opacity))
            }
        }

        /*the container must be positioned relative:*/
        .autocomplete {
            position: relative;
            display: inline-block;
        }

        button.btn.btn-blue {
            background: hsl(198deg 73% 43%);
            color: white;
            padding: 10px 50px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
            text-align: center;
            /* width: 100%; */
            display: block;
        }

        input,
        select {
            border: 1px solid transparent;
            background-color: #f1f1f1;
            border: 1px solid #333;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            width: 225px;
        }

        .autocomplete-suggestions {
            border: 1px solid rgb(155, 153, 153);
            padding: 5px;
            overflow-x: hidden;
            overflow-y: scroll;
            background: #fff;
        }

        body {
            font-family: 'Nunito', sans-serif;
        }

        .container {
            max-width: 1170px;
            margin: 0 auto;
        }
    </style>

</head>

<body class="antialiased">
    <div class="justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0"
        style="padding-top: 120px">
        <form method='POST' action="{{ route('search') }}">
            @csrf
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0 autocomplete">
                    <input type="text" class="px-4 py-3 rounded-full" name="keyword" placeholder="Search Keyword" />
                </div>
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0 autocomplete">
                    <input type="text" class="px-4 py-3 rounded-full" name="location" id="autocomplete"
                        placeholder="Locations" />
                </div>
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0 autocomplete">
                    <input type="text" class="px-4 py-3 rounded-full" name="website_name" placeholder="Domain" />
                </div>
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0 autocomplete">
                    <select class="px-4 py-3 rounded-full" name="google_domain">
                        <option value="">Select Google Domain</option>
                        <option value="google.com">google.com</option>
                        <option value="google.ca">google.ca</option>
                    </select>
                </div>
            </div>
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <button type="submit" class="btn btn-blue">Search</button>
            </div>
            @if (session('data'))
                <h1 class="text-center">{{ session('data')['website_name'] }} positioned at
                    {{ session('data')['website_position'] }} for the keyword "{{ session('data')['keyword'] }}" at
                    google rank. </h1>
            @endif
        </form>

        <div class="container mt-5">
            <h2 class="mb-4 text-center" style="padding-top: 120px">
                Keyword Ranking Tracker
            </h2>
            <table class="table table-bordered yajra-datatable text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Location</th>
                        <th>Keyword</th>
                        <th>Current Ranking</th>
                        <th>Website</th>
                        <th>History</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    </div>



</body>
<script src={{ asset('js/jquery-1.8.2.min.js') }}></script>
<script src={{ asset('js/jquery.autocomplete.min.js') }}></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    const locations = @json($locations);
    const data = $.map(locations, function(dataItem) {
        return {
            value: dataItem,
            data: dataItem
        };
    });
    window.localStorage.setItem('locations', JSON.stringify(data));

    $('#autocomplete').autocomplete({
        lookup: JSON.parse(window.localStorage.getItem('locations')),
        minChars: 3
    });


    $(function() {
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('rankings.list') }}",
            columns: [{
                    data: 'id',
                    keyword: 'no'
                },
                {
                    data: 'location_id',
                    keyword: 'location_id',
                    searchable: true
                },
                {
                    data: 'keyword',
                    keyword: 'name',
                    searchable: true
                },
                {
                    data: 'current_ranking',
                    name: 'current_ranking',
                    searchable: true
                },
                {
                    data: 'website',
                    name: 'website',
                    searchable: true
                },
                {
                    data: 'meta',
                    name: 'meta',
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false
                }
            ]
        });
    });
</script>

</html>
