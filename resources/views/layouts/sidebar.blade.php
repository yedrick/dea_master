<div class="sidebar print:hidden">
    <!-- Main Sidebar -->
    <div class="main-sidebar">
      <div
        class="flex flex-col items-center w-full h-full bg-white border-r border-slate-150 dark:border-navy-700 dark:bg-navy-800">
        <!-- Application Logo -->
        <div class="flex pt-4">
          <a href="index.htm.html">
            <img class="size-20  transition-transform duration-500 ease-in-out hover:rotate-[360deg]"
              src="{{ asset('image/logo1.png') }}" alt="logo">
          </a>
        </div>

        <!-- Main Sections Links -->
        <div class="flex flex-col pt-6 space-y-4 overflow-y-auto is-scrollbar-hidden grow">

        </div>

        <!-- Bottom Links -->
        <div class="flex flex-col items-center py-4 space-y-3">
          <!-- Settings -->


          <!-- Profile -->
          <div x-data="usePopper({placement:'right-end',offset:12})"
            @click.outside="isShowPopper  && (isShowPopper = false)" class="flex">
            <button @click="isShowPopper = !isShowPopper" x-ref="popperRef" class="avatar size-12">
              <img class="rounded-full" src="{{ asset('image/profile.jpg') }}" alt="avatar">
              <span
                class="absolute right-0 size-3.5 rounded-full border-2 border-white bg-success dark:border-navy-700"></span>
            </button>

            <div :class="isShowPopper  && 'show'" class="fixed popper-root" x-ref="popperRoot">
              <div
                class="w-64 bg-white border rounded-lg popper-box border-slate-150 shadow-soft dark:border-navy-600 dark:bg-navy-700">
                <div class="flex items-center px-4 py-5 space-x-4 rounded-t-lg bg-slate-100 dark:bg-navy-800">
                  <div class="avatar size-14">
                    <img class="rounded-full" src="{{ asset('image/profile.jpg') }}" alt="avatar">
                  </div>
                  <div>
                    <a href="#"
                      class="text-base font-medium text-slate-700 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">
                      Usuario
                    </a>
                    <p class="text-xs text-slate-400 dark:text-navy-300">
                      Nombre Usuario
                    </p>
                  </div>
                </div>
                <div class="flex flex-col pt-2 pb-5">

                  <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit"
                    class="w-full space-x-2 text-white btn h-9 bg-primary hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewbox="0 0 24 24"
                      stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                      </path>
                    </svg>
                    <span>Cerrar Sesion</span>
                  </button>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Sidebar Panel -->
    <div class="sidebar-panel">
      <div class="flex h-full grow flex-col bg-white pl-[var(--main-sidebar-width)] dark:bg-navy-750">
        <!-- Sidebar Panel Header -->
        <div class="flex items-center justify-between w-full pl-4 pr-1 h-18">
          <p class="text-base tracking-wider text-slate-800 dark:text-navy-100">
            Dashboards
          </p>
          <button @click="$store.global.isSidebarExpanded = false"
            class="p-0 rounded-full btn h-7 w-7 text-primary hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:text-accent-light/80 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 xl:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewbox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
          </button>
        </div>

        <!-- Sidebar Panel Body -->
        <div x-data="{expandedItem:null}" class="h-[calc(100%-4.5rem)] overflow-x-hidden pb-6"
          x-init="$el._x_simplebar = new SimpleBar($el);">
          <ul class="flex flex-col flex-1 px-4 font-inter">
            <li>
              <a x-data="navLink" href="{{url('./dashboard')}}"
                :class="isActive ? 'font-medium text-primary dark:text-accent-light' : 'text-slate-600 hover:text-slate-900 dark:text-navy-200 dark:hover:text-navy-50'"
                class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out">
                Dashboard
              </a>
            </li>
            <li>
                <a x-data="navLink" href="{{url('model-list/user')}}"
                :class="isActive ? 'font-medium text-primary dark:text-accent-light' : 'text-slate-600 hover:text-slate-900 dark:text-navy-200 dark:hover:text-navy-50'"
                class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out">
                Usuarios
              </a>
            </li>
            {{-- <li>
                <a x-data="navLink" href="{{ url('model-list/membership-status') }}"
                  :class="isActive ? 'font-medium text-primary dark:text-accent-light' : 'text-slate-600 hover:text-slate-900 dark:text-navy-200 dark:hover:text-navy-50'"
                  class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out">
                  Membresias
                </a>
            </li> --}}
            <li>
                <a x-data="navLink" href="{{ url('model-list/people') }}"
                :class="isActive ? 'font-medium text-primary dark:text-accent-light' : 'text-slate-600 hover:text-slate-900 dark:text-navy-200 dark:hover:text-navy-50'"
                  class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out">
                  Personas
                </a>
            </li>
          </ul>
          <div class="h-px mx-4 my-3 bg-slate-200 dark:bg-navy-500"></div>
          <ul class="flex flex-col flex-1 px-4 font-inter">
            <li x-data="accordionItem('menu-item-1')">
              <a :class="expanded ? 'text-slate-800 font-semibold dark:text-navy-50' : 'text-slate-600 dark:text-navy-200  hover:text-slate-800  dark:hover:text-navy-50'"
                @click="expanded = !expanded"
                class="flex items-center justify-between py-2 text-xs+ tracking-wide outline-none transition-[color,padding-left] duration-300 ease-in-out"
                href="javascript:void(0);">
                <span>Parametros</span>
                <svg :class="expanded && 'rotate-90'" xmlns="http://www.w3.org/2000/svg"
                  class="transition-transform ease-in-out size-4 text-slate-400" fill="none" viewbox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </a>
              <ul x-collapse="" x-show="expanded">
                <li>
                  <a x-data="navLink" href="{{url('model-list/country')}}"
                    :class="isActive ? 'font-medium text-primary dark:text-accent-light' : 'text-slate-600 hover:text-slate-900 dark:text-navy-200 dark:hover:text-navy-50'"
                    class="flex items-center justify-between p-2 text-xs+ tracking-wide outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4">
                    <div class="flex items-center space-x-2">
                      <div class="size-1.5 rounded-full border border-current opacity-40"></div>
                      <span>Paises</span>
                    </div>
                  </a>
                </li>
                <li>
                    <a x-data="navLink" href="{{ url('model-list/city') }}"
                      :class="isActive ? 'font-medium text-primary dark:text-accent-light' : 'text-slate-600 hover:text-slate-900 dark:text-navy-200 dark:hover:text-navy-50'"
                      class="flex items-center justify-between p-2 text-xs+ tracking-wide outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4">
                      <div class="flex items-center space-x-2">
                        <div class="size-1.5 rounded-full border border-current opacity-40"></div>
                        <span>Ciudades</span>
                      </div>
                    </a>
                  </li>
                <li>
                    <a x-data="navLink" href="{{ url('model-list/zone') }}"
                      :class="isActive ? 'font-medium text-primary dark:text-accent-light' : 'text-slate-600 hover:text-slate-900 dark:text-navy-200 dark:hover:text-navy-50'"
                      class="flex items-center justify-between p-2 text-xs+ tracking-wide outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4">
                      <div class="flex items-center space-x-2">
                        <div class="size-1.5 rounded-full border border-current opacity-40"></div>
                        <span>Zonas</span>
                      </div>
                    </a>
                </li>
                <li>
                    <a x-data="navLink" href="{{ url('model-list/civil-status') }}"
                      :class="isActive ? 'font-medium text-primary dark:text-accent-light' : 'text-slate-600 hover:text-slate-900 dark:text-navy-200 dark:hover:text-navy-50'"
                      class="flex items-center justify-between p-2 text-xs+ tracking-wide outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4">
                      <div class="flex items-center space-x-2">
                        <div class="size-1.5 rounded-full border border-current opacity-40"></div>
                        <span>Estados Civiles</span>
                      </div>
                    </a>
                </li>
                <li>
                    <a x-data="navLink" href="{{ url('model-list/membership-status') }}"
                      :class="isActive ? 'font-medium text-primary dark:text-accent-light' : 'text-slate-600 hover:text-slate-900 dark:text-navy-200 dark:hover:text-navy-50'"
                      class="flex items-center justify-between p-2 text-xs+ tracking-wide outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4">
                      <div class="flex items-center space-x-2">
                        <div class="size-1.5 rounded-full border border-current opacity-40"></div>
                        <span>Estado de Membresias</span>
                      </div>
                    </a>
                </li>
                <li>
                    <a x-data="navLink" href="{{ url('model-list/ministry') }}"
                    :class="isActive ? 'font-medium text-primary dark:text-accent-light' : 'text-slate-600 hover:text-slate-900 dark:text-navy-200 dark:hover:text-navy-50'"
                    class="flex items-center justify-between p-2 text-xs+ tracking-wide outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4">
                    <div class="flex items-center space-x-2">
                      <div class="size-1.5 rounded-full border border-current opacity-40"></div>
                      <span>Ministerios</span>
                    </div>
                  </a>
                </li>
                <li>
                    <a x-data="navLink" href="{{ url('model-list/profession') }}"
                      :class="isActive ? 'font-medium text-primary dark:text-accent-light' : 'text-slate-600 hover:text-slate-900 dark:text-navy-200 dark:hover:text-navy-50'"
                      class="flex items-center justify-between p-2 text-xs+ tracking-wide outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4">
                      <div class="flex items-center space-x-2">
                        <div class="size-1.5 rounded-full border border-current opacity-40"></div>
                        <span>Profesiones</span>
                      </div>
                    </a>
                </li>

              </ul>
            </li>
          </ul>
          <ul class="flex flex-col flex-1 px-4 font-inter">
            <li x-data="accordionItem('menu-item-2')">
              <a :class="expanded ? 'text-slate-800 font-semibold dark:text-navy-50' : 'text-slate-600 dark:text-navy-200  hover:text-slate-800  dark:hover:text-navy-50'"
                @click="expanded = !expanded"
                class="flex items-center justify-between py-2 text-xs+ tracking-wide outline-none transition-[color,padding-left] duration-300 ease-in-out"
                href="javascript:void(0);">
                <span>Jovenes</span>
                <svg :class="expanded && 'rotate-90'" xmlns="http://www.w3.org/2000/svg"
                  class="transition-transform ease-in-out size-4 text-slate-400" fill="none" viewbox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </a>
              <ul x-collapse="" x-show="expanded">
                <li>
                  <a x-data="navLink" href="{{url('model-list/youth')}}"
                    :class="isActive ? 'font-medium text-primary dark:text-accent-light' : 'text-slate-600 hover:text-slate-900 dark:text-navy-200 dark:hover:text-navy-50'"
                    class="flex items-center justify-between p-2 text-xs+ tracking-wide outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4">
                    <div class="flex items-center space-x-2">
                      <div class="size-1.5 rounded-full border border-current opacity-40"></div>
                      <span>Jovenes</span>
                    </div>
                  </a>
                </li>
                <li>
                    <a x-data="navLink" href="{{ url('model-list/type-score') }}"
                      :class="isActive ? 'font-medium text-primary dark:text-accent-light' : 'text-slate-600 hover:text-slate-900 dark:text-navy-200 dark:hover:text-navy-50'"
                      class="flex items-center justify-between p-2 text-xs+ tracking-wide outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4">
                      <div class="flex items-center space-x-2">
                        <div class="size-1.5 rounded-full border border-current opacity-40"></div>
                        <span>Tipo Puntajes</span>
                      </div>
                    </a>
                  </li>
                <li>
                    <a x-data="navLink" href="{{ url('model-list/youth-score') }}"
                      :class="isActive ? 'font-medium text-primary dark:text-accent-light' : 'text-slate-600 hover:text-slate-900 dark:text-navy-200 dark:hover:text-navy-50'"
                      class="flex items-center justify-between p-2 text-xs+ tracking-wide outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4">
                      <div class="flex items-center space-x-2">
                        <div class="size-1.5 rounded-full border border-current opacity-40"></div>
                        <span>Puntaje de jovenes</span>
                      </div>
                    </a>
                </li>
                <li>
                    <a x-data="navLink" href="{{ url('view-young-pst') }}"
                      :class="isActive ? 'font-medium text-primary dark:text-accent-light' : 'text-slate-600 hover:text-slate-900 dark:text-navy-200 dark:hover:text-navy-50'"
                      class="flex items-center justify-between p-2 text-xs+ tracking-wide outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4">
                      <div class="flex items-center space-x-2">
                        <div class="size-1.5 rounded-full border border-current opacity-40"></div>
                        <span>Añadir Puntos</span>
                      </div>
                    </a>
                </li>
              </ul>
            </li>
          </ul>
          {{-- <div class="h-px mx-4 my-3 bg-slate-200 dark:bg-navy-500"></div> --}}
        </div>
      </div>
    </div>
  </div>
