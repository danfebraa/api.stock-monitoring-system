<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
        <!--Responsive Extension Datatables CSS-->
        <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
        <style>

            /*Overrides for Tailwind CSS */

            /*Form fields*/
            .dataTables_wrapper select,
            .dataTables_wrapper .dataTables_filter input {
                color: #4a5568; 			/*text-gray-700*/
                padding-left: 1rem; 		/*pl-4*/
                padding-right: 1rem; 		/*pl-4*/
                padding-top: .5rem; 		/*pl-2*/
                padding-bottom: .5rem; 		/*pl-2*/
                line-height: 1.25; 			/*leading-tight*/
                border-width: 2px; 			/*border-2*/
                border-radius: .25rem;
                border-color: #edf2f7; 		/*border-gray-200*/
                background-color: #edf2f7; 	/*bg-gray-200*/
            }

            /*Row Hover*/
            table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
                background-color: #ebf4ff;	/*bg-indigo-100*/
            }

            /*Pagination Buttons*/
            .dataTables_wrapper .dataTables_paginate .paginate_button		{
                font-weight: 700;				/*font-bold*/
                border-radius: .25rem;			/*rounded*/
                border: 1px solid transparent;	/*border border-transparent*/
            }

            /*Pagination Buttons - Current selected */
            .dataTables_wrapper .dataTables_paginate .paginate_button.current	{
                color: #fff !important;				/*text-white*/
                box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06); 	/*shadow*/
                font-weight: 700;					/*font-bold*/
                border-radius: .25rem;				/*rounded*/
                background: #667eea !important;		/*bg-indigo-500*/
                border: 1px solid transparent;		/*border border-transparent*/
            }

            /*Pagination Buttons - Hover */
            .dataTables_wrapper .dataTables_paginate .paginate_button:hover		{
                color: #fff !important;				/*text-white*/
                box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);	 /*shadow*/
                font-weight: 700;					/*font-bold*/
                border-radius: .25rem;				/*rounded*/
                background: #667eea !important;		/*bg-indigo-500*/
                border: 1px solid transparent;		/*border border-transparent*/
            }

            /*Add padding to bottom border */
            table.dataTable.no-footer {
                border-bottom: 1px solid #e2e8f0;	/*border-b-1 border-gray-300*/
                margin-top: 0.75em;
                margin-bottom: 0.75em;
            }

            /*Change colour of responsive icon*/
            table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before, table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
                background-color: #667eea !important; /*bg-indigo-500*/
            }


            /*Banner open/load animation*/
            .alert-banner {
                -webkit-animation: slide-in-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
                animation: slide-in-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
            }

            /*Banner close animation*/
            .alert-banner input:checked ~ * {
                -webkit-animation: slide-out-top 0.5s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
                animation: slide-out-top 0.5s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
            }

            /* -------------------------------------------------------------
             * Animations generated using Animista * w: http://animista.net,
             * ---------------------------------------------------------- */

            @-webkit-keyframes slide-in-top{0%{-webkit-transform:translateY(-1000px);transform:translateY(-1000px);opacity:0}100%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}}@keyframes slide-in-top{0%{-webkit-transform:translateY(-1000px);transform:translateY(-1000px);opacity:0}100%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}}@-webkit-keyframes slide-out-top{0%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}100%{-webkit-transform:translateY(-1000px);transform:translateY(-1000px);opacity:0}}@keyframes slide-out-top{0%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}100%{-webkit-transform:translateY(-1000px);transform:translateY(-1000px);opacity:0}}@-webkit-keyframes slide-in-bottom{0%{-webkit-transform:translateY(1000px);transform:translateY(1000px);opacity:0}100%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}}@keyframes slide-in-bottom{0%{-webkit-transform:translateY(1000px);transform:translateY(1000px);opacity:0}100%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}}@-webkit-keyframes slide-out-bottom{0%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}100%{-webkit-transform:translateY(1000px);transform:translateY(1000px);opacity:0}}@keyframes slide-out-bottom{0%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}100%{-webkit-transform:translateY(1000px);transform:translateY(1000px);opacity:0}}@-webkit-keyframes slide-in-right{0%{-webkit-transform:translateX(1000px);transform:translateX(1000px);opacity:0}100%{-webkit-transform:translateX(0);transform:translateX(0);opacity:1}}@keyframes slide-in-right{0%{-webkit-transform:translateX(1000px);transform:translateX(1000px);opacity:0}100%{-webkit-transform:translateX(0);transform:translateX(0);opacity:1}}@-webkit-keyframes fade-out-right{0%{-webkit-transform:translateX(0);transform:translateX(0);opacity:1}100%{-webkit-transform:translateX(50px);transform:translateX(50px);opacity:0}}@keyframes fade-out-right{0%{-webkit-transform:translateX(0);transform:translateX(0);opacity:1}100%{-webkit-transform:translateX(50px);transform:translateX(50px);opacity:0}}


        </style>
    </head>
    <body class="font-sans antialiased">
    @if (\Session::has('success'))
        <div class="alert-banner fixed w-full top-0" style="z-index: 1">
            <input type="checkbox" class="hidden" id="banneralert">

            <label class="close cursor-pointer flex items-center justify-between w-full p-2 bg-green-900 shadow text-white" title="close" for="banneralert">
                {!! \Session::get('success') !!}
                <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
            </label>
        </div>
    @endif
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @livewireScripts
        <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>
        <script>
            const beamsClient = new PusherPushNotifications.Client({
                instanceId: 'c67fdeea-30dc-48ef-9b03-2cecbb08e578',
            });

            beamsClient.start()
                .then(() => beamsClient.addDeviceInterest('App.User.{{auth()->id()}}'))
                .then(() => console.log('Successfully registered and subscribed!'))
                .catch(console.error);
        </script>


        <!-- jQuery -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

        <!--Datatables -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script>
            $(document).ready(function() {

                var table = $('#example').DataTable( {
                    responsive: true
                } )
                    .columns.adjust()
                    .responsive.recalc();
            } );

        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
        <script>
            var ctx = document.getElementById('myChart');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: '# of Votes',
                        data: [999999, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>
    </body>
</html>
