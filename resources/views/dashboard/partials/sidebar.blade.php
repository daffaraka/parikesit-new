<div id="sideBar"
    class="relative flex flex-col flex-wrap bg-white border-r border-gray-300 p-6 flex-none w-64 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster">


    <!-- sidebar content -->
    <div class="flex flex-col">

        <!-- sidebar toggle -->
        <div class="text-right hidden md:block mb-4">
            <button id="sideBarHideBtn">
                <i class="fad fa-times-circle"></i>
            </button>
        </div>
        <!-- end sidebar toggle -->

        <p class="uppercase text-xs text-gray-600 mb-4 tracking-wider">homes</p>

        <!-- link -->


        <a href="/"
            class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-chart-pie text-xs mr-2"></i>
            Beranda
        </a>

        <!-- end link -->

        @if (Auth::user()->role == 'admin')
            <!-- link -->
            <a href="{{ route('user.index') }}"
                class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fad fa-user text-xs mr-2"></i>
                Manajemen User
            </a>
            <!-- end link -->
        @endif

        @if (Auth::user()->role == 'admin')
            <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider">Penilaian</p>

            <!-- link -->
            <a href="{{ route('penilaian.index') }}"
                class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fad fa-tasks text-xs mr-2"></i>
                Penilaian Mandiri
            </a>

            <a href="{{ route('formulir.index') }}"
                class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fad fa-folder text-xs mr-2"></i>
                Kegiatan Penilaian
            </a>

            <a href="{{ route('disposisi.penelaian.tersedia') }}"
                class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fad fa-check-circle text-xs mr-2"></i>
                Penilaian Selesai
            </a>
            <!-- end link -->

            <!-- link -->
            {{-- <a href="#"
                class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fad fa-comments text-xs mr-2"></i>
                Domain
            </a>
            <!-- end link -->

            <!-- link -->
            <a href="#"
                class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fad fa-shield-check text-xs mr-2"></i>
                Aspek
            </a>
            <!-- end link -->

            <!-- link -->
            <a href="#"
                class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fad fa-calendar-edit text-xs mr-2"></i>
                Indikator
            </a>
            <!-- end link -->

            <!-- link -->
            <a href="#"
                class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fad fa-file-invoice-dollar text-xs mr-2"></i>
                Penilaian
            </a> --}}
            <!-- end link -->
        @endif




        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'walidata' || Auth::user()->role == 'opd')
            <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider">Informasi</p>

            <!-- link -->
            <a href="{{ route('penjadwalan.index') }}"
                class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fad fa-text text-xs mr-2"></i>
                Penjadwalan
            </a>
            <!-- end link -->

            <!-- link -->
            <a href="{{ route('pembinaan.index') }}"
                class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fad fa-whistle text-xs mr-2"></i>
                Pembinaan
            </a>
            <!-- end link -->
        @endif






    </div>
    <!-- end sidebar content -->

</div>
