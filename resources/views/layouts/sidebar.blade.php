<div class="sidebar print:hidden">
    <!-- Main Sidebar -->
    <div class="main-sidebar">
      <div
        class="flex flex-col items-center w-full h-full bg-white border-r border-slate-150">
        <!-- Application Logo -->
        <div class="flex pt-4">
          <a href="index.htm.html">
            <img class="size-11 transition-transform duration-500 ease-in-out hover:rotate-[360deg]"
              src="{{ asset('images/app-logo.png') }}" alt="logo">
          </a>
        </div>

        <!-- Main Sections Links -->
        <div class="flex flex-col pt-6 space-y-4 overflow-y-auto is-scrollbar-hidden grow">
          <!-- Dashobards -->
          <a href="dashboards-crm-analytics.html"
            class="flex items-center justify-center transition-colors duration-200 rounded-lg outline-none size-11 bg-primary/10 text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25"
            x-tooltip.placement.right="'Dashboards'">
            <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24">
              <path fill="currentColor" fill-opacity=".3"
                d="M5 14.059c0-1.01 0-1.514.222-1.945.221-.43.632-.724 1.453-1.31l4.163-2.974c.56-.4.842-.601 1.162-.601.32 0 .601.2 1.162.601l4.163 2.974c.821.586 1.232.88 1.453 1.31.222.43.222.935.222 1.945V19c0 .943 0 1.414-.293 1.707C18.414 21 17.943 21 17 21H7c-.943 0-1.414 0-1.707-.293C5 20.414 5 19.943 5 19v-4.94Z">
              </path>
              <path fill="currentColor"
                d="M3 12.387c0 .267 0 .4.084.441.084.041.19-.04.4-.204l7.288-5.669c.59-.459.885-.688 1.228-.688.343 0 .638.23 1.228.688l7.288 5.669c.21.163.316.245.4.204.084-.04.084-.174.084-.441v-.409c0-.48 0-.72-.102-.928-.101-.208-.291-.355-.67-.65l-7-5.445c-.59-.459-.885-.688-1.228-.688-.343 0-.638.23-1.228.688l-7 5.445c-.379.295-.569.442-.67.65-.102.208-.102.448-.102.928v.409Z">
              </path>
              <path fill="currentColor" d="M11.5 15.5h1A1.5 1.5 0 0 1 14 17v3.5h-4V17a1.5 1.5 0 0 1 1.5-1.5Z"></path>
              <path fill="currentColor"
                d="M17.5 5h-1a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5Z"></path>
            </svg>
          </a>

          <!-- Apps -->
          {{-- <a href="apps-list.html"
            class="flex items-center justify-center transition-colors duration-200 rounded-lg outline-none size-11 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25"
            x-tooltip.placement.right="'Applications'">
            <svg class="h-7 w-7" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M5 8H19V16C19 17.8856 19 18.8284 18.4142 19.4142C17.8284 20 16.8856 20 15 20H9C7.11438 20 6.17157 20 5.58579 19.4142C5 18.8284 5 17.8856 5 16V8Z"
                fill="currentColor" fill-opacity="0.3"></path>
              <path
                d="M12 8L11.7608 5.84709C11.6123 4.51089 10.4672 3.5 9.12282 3.5V3.5C7.68381 3.5 6.5 4.66655 6.5 6.10555V6.10555C6.5 6.97673 6.93539 7.79026 7.66025 8.2735L9.5 9.5"
                stroke="currentColor" stroke-linecap="round"></path>
              <path
                d="M12 8L12.2392 5.84709C12.3877 4.51089 13.5328 3.5 14.8772 3.5V3.5C16.3162 3.5 17.5 4.66655 17.5 6.10555V6.10555C17.5 6.97673 17.0646 7.79026 16.3397 8.2735L14.5 9.5"
                stroke="currentColor" stroke-linecap="round"></path>
              <rect x="4" y="8" width="16" height="3" rx="1" fill="currentColor"></rect>
              <path d="M12 11V15" stroke="currentColor" stroke-linecap="round"></path>
            </svg>
          </a> --}}

          <!-- Pages And Layouts -->
          {{-- <a href="pages-card-user-1.html"
            class="flex items-center justify-center transition-colors duration-200 rounded-lg outline-none size-11 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25"
            x-tooltip.placement.right="'Pages & Layouts'">
            <svg class="h-7 w-7" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M9.85714 3H4.14286C3.51167 3 3 3.51167 3 4.14286V9.85714C3 10.4883 3.51167 11 4.14286 11H9.85714C10.4883 11 11 10.4883 11 9.85714V4.14286C11 3.51167 10.4883 3 9.85714 3Z"
                fill="currentColor"></path>
              <path
                d="M9.85714 12.8999H4.14286C3.51167 12.8999 3 13.4116 3 14.0428V19.757C3 20.3882 3.51167 20.8999 4.14286 20.8999H9.85714C10.4883 20.8999 11 20.3882 11 19.757V14.0428C11 13.4116 10.4883 12.8999 9.85714 12.8999Z"
                fill="currentColor" fill-opacity="0.3"></path>
              <path
                d="M19.757 3H14.0428C13.4116 3 12.8999 3.51167 12.8999 4.14286V9.85714C12.8999 10.4883 13.4116 11 14.0428 11H19.757C20.3882 11 20.8999 10.4883 20.8999 9.85714V4.14286C20.8999 3.51167 20.3882 3 19.757 3Z"
                fill="currentColor" fill-opacity="0.3"></path>
              <path
                d="M19.757 12.8999H14.0428C13.4116 12.8999 12.8999 13.4116 12.8999 14.0428V19.757C12.8999 20.3882 13.4116 20.8999 14.0428 20.8999H19.757C20.3882 20.8999 20.8999 20.3882 20.8999 19.757V14.0428C20.8999 13.4116 20.3882 12.8999 19.757 12.8999Z"
                fill="currentColor" fill-opacity="0.3"></path>
            </svg>
          </a> --}}
        </div>

        <!-- Bottom Links -->
        <div class="flex flex-col items-center py-3 space-y-3">
          <!-- Settings -->
          <a href="form-layout-5.html"
            class="flex items-center justify-center transition-colors duration-200 rounded-lg outline-none size-11 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25">
            <svg class="h-7 w-7" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-opacity="0.3" fill="currentColor"
                d="M2 12.947v-1.771c0-1.047.85-1.913 1.899-1.913 1.81 0 2.549-1.288 1.64-2.868a1.919 1.919 0 0 1 .699-2.607l1.729-.996c.79-.474 1.81-.192 2.279.603l.11.192c.9 1.58 2.379 1.58 3.288 0l.11-.192c.47-.795 1.49-1.077 2.279-.603l1.73.996a1.92 1.92 0 0 1 .699 2.607c-.91 1.58-.17 2.868 1.639 2.868 1.04 0 1.899.856 1.899 1.912v1.772c0 1.047-.85 1.912-1.9 1.912-1.808 0-2.548 1.288-1.638 2.869.52.915.21 2.083-.7 2.606l-1.729.997c-.79.473-1.81.191-2.279-.604l-.11-.191c-.9-1.58-2.379-1.58-3.288 0l-.11.19c-.47.796-1.49 1.078-2.279.605l-1.73-.997a1.919 1.919 0 0 1-.699-2.606c.91-1.58.17-2.869-1.639-2.869A1.911 1.911 0 0 1 2 12.947Z">
              </path>
              <path fill="currentColor"
                d="M11.995 15.332c1.794 0 3.248-1.464 3.248-3.27 0-1.807-1.454-3.272-3.248-3.272-1.794 0-3.248 1.465-3.248 3.271 0 1.807 1.454 3.271 3.248 3.271Z">
              </path>
            </svg>
          </a>

          <!-- Profile -->
          <div x-data="usePopper({placement:'right-end',offset:12})"
            @click.outside="isShowPopper  && (isShowPopper = false)" class="flex">
            <button @click="isShowPopper = !isShowPopper" x-ref="popperRef" class="avatar size-12">
              <img class="rounded-full" src="images/avatar/avatar-12.jpg" alt="avatar">
              <span
                class="absolute right-0 size-3.5 rounded-full border-2 border-white bg-success"></span>
            </button>

            <div :class="isShowPopper  && 'show'" class="fixed popper-root" x-ref="popperRoot">
              <div
                class="w-64 bg-white border rounded-lg popper-box border-slate-150 shadow-soft">
                <div class="flex items-center px-4 py-5 space-x-4 rounded-t-lg bg-slate-100">
                  <div class="avatar size-14">
                    <img class="rounded-full" src="images/avatar/avatar-12.jpg" alt="avatar">
                  </div>
                  <div>
                    <a href="#"
                      class="text-base font-medium text-slate-700 hover:text-primary focus:text-primary">
                      StarCodeKh
                    </a>
                    <p class="text-xs text-slate-400">
                      Full-Stack Developer
                    </p>
                  </div>
                </div>
                <div class="flex flex-col pt-2 pb-5">
                  <a href="#"
                    class="flex items-center px-4 py-2 space-x-3 tracking-wide transition-all outline-none group hover:bg-slate-100 focus:bg-slate-100">
                    <div class="flex items-center justify-center text-white rounded-lg size-8 bg-warning">
                      <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5" fill="none" viewbox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                      </svg>
                    </div>

                    <div>
                      <h2
                        class="font-medium transition-colors text-slate-700 group-hover:text-primary group-focus:text-primary">
                        Profile
                      </h2>
                      <div class="text-xs text-slate-400 line-clamp-1">
                        Your profile setting
                      </div>
                    </div>
                  </a>
                  <a href="#"
                    class="flex items-center px-4 py-2 space-x-3 tracking-wide transition-all outline-none group hover:bg-slate-100 focus:bg-slate-100">
                    <div class="flex items-center justify-center text-white rounded-lg size-8 bg-info">
                      <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5" fill="none" viewbox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                      </svg>
                    </div>

                    <div>
                      <h2
                        class="font-medium transition-colors text-slate-700 group-hover:text-primary group-focus:text-primary">
                        Messages
                      </h2>
                      <div class="text-xs text-slate-400 line-clamp-1">
                        Your messages and tasks
                      </div>
                    </div>
                  </a>
                  <a href="#"
                    class="flex items-center px-4 py-2 space-x-3 tracking-wide transition-all outline-none group hover:bg-slate-100 focus:bg-slate-100">
                    <div class="flex items-center justify-center text-white rounded-lg size-8 bg-secondary">
                      <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5" fill="none" viewbox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                      </svg>
                    </div>

                    <div>
                      <h2
                        class="font-medium transition-colors text-slate-700 group-hover:text-primary group-focus:text-primary">
                        Team
                      </h2>
                      <div class="text-xs text-slate-400 line-clamp-1">
                        Your team activity
                      </div>
                    </div>
                  </a>
                  <a href="#"
                    class="flex items-center px-4 py-2 space-x-3 tracking-wide transition-all outline-none group hover:bg-slate-100 focus:bg-slate-100">
                    <div class="flex items-center justify-center text-white rounded-lg size-8 bg-error">
                      <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5" fill="none" viewbox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                      </svg>
                    </div>

                    <div>
                      <h2
                        class="font-medium transition-colors text-slate-700 group-hover:text-primary group-focus:text-primary">
                        Activity
                      </h2>
                      <div class="text-xs text-slate-400 line-clamp-1">
                        Your activity and events
                      </div>
                    </div>
                  </a>
                  <a href="#"
                    class="flex items-center px-4 py-2 space-x-3 tracking-wide transition-all outline-none group hover:bg-slate-100 focus:bg-slate-100">
                    <div class="flex items-center justify-center text-white rounded-lg size-8 bg-success">
                      <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5" fill="none" viewbox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                        </path>
                      </svg>
                    </div>

                    <div>
                      <h2
                        class="font-medium transition-colors text-slate-700 group-hover:text-primary group-focus:text-primary">
                        Settings
                      </h2>
                      <div class="text-xs text-slate-400 line-clamp-1">
                        Webapp settings
                      </div>
                    </div>
                  </a>
                  <div class="px-4 mt-3">
                    {{-- <button
                      class="w-full space-x-2 text-white btn h-9 bg-primary hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90">
                      <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewbox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                      </svg>
                      <span>Logout</span>
                    </button> --}}
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
    </div>

    <!-- Sidebar Panel -->
    <div class="sidebar-panel">
      <div class="flex h-full grow flex-col bg-white pl-[var(--main-sidebar-width)]">
        <!-- Sidebar Panel Header -->
        <div class="flex items-center justify-between w-full pl-4 pr-1 h-18">
          <p class="text-base tracking-wider text-slate-800">
            Dashboards
          </p>
          <button @click="$store.global.isSidebarExpanded = false"
            class="p-0 rounded-full btn h-7 w-7 text-primary hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 xl:hidden">
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
                <a x-data="navLink" href="{{url('model-list/school')}}" 
                  :class="isActive ? 'font-medium text-primary' : 'text-slate-600 hover:text-slate-900'"
                  class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out">
                  Escuelas  
                </a>
            </li> 
            <li>
                <a x-data="navLink" href="{{url('model-list/user')}}"
                  :class="isActive ? 'font-medium text-primary' : 'text-slate-600 hover:text-slate-900'"
                  class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out">
                  Usuarios 
                </a>
            </li>   
            <li>
                <a x-data="navLink" href="{{url('model-list/teacher')}}" 
                  :class="isActive ? 'font-medium text-primary' : 'text-slate-600 hover:text-slate-900'"
                  class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out">
                  Profesores 
                </a>
            </li> 
            <li>
                <a x-data="navLink" href="{{url('model-list/level')}}" 
                  :class="isActive ? 'font-medium text-primary' : 'text-slate-600 hover:text-slate-900'"
                  class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out">
                  Niveles   
                </a>
            </li>
            <li>
                <a x-data="navLink" href="{{url('model-list/grade')}}" 
                  :class="isActive ? 'font-medium text-primary' : 'text-slate-600 hover:text-slate-900'"
                  class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out">
                  Grados
                </a>
            </li>
            <li>
                <a x-data="navLink" href="{{url('model-list/course')}}" 
                  :class="isActive ? 'font-medium text-primary' : 'text-slate-600 hover:text-slate-900'"
                  class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out">
                  Cursos   
                </a>
            </li>
            <li>
                <a x-data="navLink" href="{{url('model-list/quarter')}}" 
                  :class="isActive ? 'font-medium text-primary' : 'text-slate-600 hover:text-slate-900'"
                  class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out">
                  Trimestre   
                </a>
            </li>
            <li>
                <a x-data="navLink" href="{{url('model-list/subject')}}" 
                  :class="isActive ? 'font-medium text-primary' : 'text-slate-600 hover:text-slate-900'"
                  class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out">
                    Materias   
                </a>
            </li>
            <li>
                <a x-data="navLink" href="{{url('model-list/course-subject')}}" 
                  :class="isActive ? 'font-medium text-primary' : 'text-slate-600 hover:text-slate-900'"
                  class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out">
                    Curso por materia 
                </a>
            </li>
            <li>
                <a x-data="navLink" href="{{url('model-list/')}}" 
                  :class="isActive ? 'font-medium text-primary' : 'text-slate-600 hover:text-slate-900'"
                  class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out">
                  Registro de Información  
                </a>
            </li>        
            <li>
                <a x-data="navLink" href="{{url('model-list/student')}}"
                  :class="isActive ? 'font-medium text-primary' : 'text-slate-600 hover:text-slate-900'"
                  class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out">
                  Estudiantes
                </a>
            </li>
            <li>
                <a x-data="navLink" href="{{url('model-list/qualification')}}"
                  :class="isActive ? 'font-medium text-primary' : 'text-slate-600 hover:text-slate-900'"
                  class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out">
                  Calificaciones 
                </a>
            </li>
          </ul>
          
        </div>
      </div>
    </div>
  </div>
